<?php

namespace App\Exports;

use App\Models\UserEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Carbon\Carbon;

class DepositBalanceExport implements FromQuery, WithMapping, WithHeadings, WithCustomStartCell, WithColumnFormatting, WithColumnWidths, WithStyles, ShouldQueue
{
    use Queueable, SerializesModels, Exportable, Dispatchable, InteractsWithQueue;

    protected $request;
    protected $opening_balance = 0;
    protected $set_opening_balance = false;
    protected $total = 0;

    function __construct($request) {
        $this->request = $request;
    }

    public function map($row): array
    {
        // $this->total += $row->amount;
        if(!$this->set_opening_balance) {
            $result = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)
            ->whereNotNull('deposit')->where('deposit','!=', 0)->groupBy('user_id')->search($this->request)
            ->select(
                sprintf('*', (new UserEntry())->table),
                DB::raw("SUM(user_entries.deposit) AS personalAmount"),
            )->first();

            if(!$result) {
                $this->opening_balance = 0;
            } else {
                $this->opening_balance = $row->total - $result->personalAmount;
            }
            $this->set_opening_balance = true;
        }

        $columns = [
            'A' => $row->created_at,
            'B' => $row->user->identity_no,
            'C' => $row->user->id,
            'D' => $row->user->name,
            'E' => strval($row->personalAmount),
            'F' => strval($row->total),
        ];

        return $columns;
    }

    public function query()
    {
        $query = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)
        ->whereNotNull('deposit')->where('deposit','!=', 0)->groupBy('user_id')->search($this->request)
        ->select(
            sprintf('*', (new UserEntry())->table),
            DB::raw("SUM(user_entries.deposit) AS personalAmount"),
        );
        return $query;
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function headings(): array
    {
        return [
            ['Date', 'Member IC', 'Member ID', 'Member Name', 'Amount', 'Total']
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 20,
            'D' => 30,
            'E' => 20,
            'F' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $start_date = Carbon::parse($this->request->start_date)->format('d/m/Y');
        $end_date = Carbon::parse($this->request->end_date)->format('d/m/Y');
        if($this->request->start_date == null) {
            $result = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)
            ->whereNotNull('deposit')->where('deposit','!=', 0)->groupBy('user_id')->search($this->request)
            ->select(
                sprintf('*', (new UserEntry())->table),
                DB::raw("SUM(user_entries.deposit) AS personalAmount"),
            )->first();
            if($result) {
                $start_date = Carbon::parse($result->created_at)->format('d/m/Y');
            }
        }

        if($end_date == null) {
            $end_date = Carbon::now()->format('d/m/Y');
        }

        $from = 'FROM ' . $start_date . ' - ' . $end_date; 
        $sheet->setCellValue('C2', 'DEPOSIT REPORT (BALANCE)');
        $sheet->setCellValue('C3', $from);
        $sheet->setCellValue('E4', "Opening Balance");
        $sheet->setCellValue('F4', $this->opening_balance);

        $borderStyleArray = [
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => '000'],
                ],
            ],
        ];
        $sheet->getStyle('A4:G4')->applyFromArray($borderStyleArray);
        // $sheet->getDefaultRowDimension()->setRowHeight(22);//Set line height
        $sheet->getStyle('A2:Z2')->applyFromArray(['font' => ['bold' => true, 'size' => 22]]);
        $sheet->getStyle('A3:Z3')->applyFromArray(['font' => ['bold' => true, 'size' => 22]]);
        $sheet->getStyle('A4:Z4')->applyFromArray(['font' => ['bold' => true]]);
    }
}
