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
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Carbon\Carbon;
class JoiningFeeExport implements FromQuery, WithMapping, WithHeadings, WithCustomStartCell, WithColumnFormatting, WithColumnWidths, WithStyles, ShouldQueue
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
        // $this->total += $row->fee;
        if(!$this->set_opening_balance) {
            $result = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)->whereNotNull('fee')->where('fee','!=', 0)
            ->where('created_at', '>=', Carbon::parse($this->request->start_date)->format('Y-m-d H:i:s'))
            ->select(sprintf('*', (new UserEntry())->table))->first();

            if(!$result) {
                $this->opening_balance = 0;
            } else {
                $this->opening_balance = $row->total - $result->fee;
            }
            $this->set_opening_balance = true;
        }

        $columns = [
            'A' => $row->created_at,
            'B' => $row->new_invoice_number,
            'C' => $row->user->identity_no,
            'D' => $row->user->id,
            'E' => $row->user->name,
            'F' => $row->fee,
            'G' => $row->total,
        ];

        return $columns;
    }

    public function query()
    {
        return UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)->whereNotNull('fee')->where('fee','!=', 0)->search($this->request)->select(sprintf('*', (new UserEntry())->table));
    }

    public function headings(): array
    {
        return 
            [
                'Date',
                'Invoice No',
                'Member IC',
                'Member ID',
                'Member Name',
                'Amount',
                'Total',
            ];
    }

    public function startCell(): string
    {
        return 'A5';
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 30,
            'F' => 20,
            'G' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $start_date = Carbon::parse($this->request->start_date)->format('d/m/Y');
        $end_date = Carbon::parse($this->request->end_date)->format('d/m/Y');
        if($this->request->start_date == null) {
            $result = UserEntry::with(['user'])->whereNotIn('user_id',[1,2,3])->where('user_type', '!=', 4)->whereNotNull('fee')->where('fee','!=', 0)->search($this->request)->select(sprintf('*', (new UserEntry())->table))->first();
            if($result) {
                $start_date = Carbon::parse($result->created_at)->format('d/m/Y');
            }
        }

        if($end_date == null) {
            $end_date = Carbon::now()->format('d/m/Y');
        }

        $from = 'FROM ' . $start_date . ' - ' . $end_date; 
        $sheet->setCellValue('C2', 'JOINING FEE REPORT');
        $sheet->setCellValue('C3', $from);
        $sheet->setCellValue('F4', "Opening Balance");
        $sheet->setCellValue('G4', $this->opening_balance);

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
