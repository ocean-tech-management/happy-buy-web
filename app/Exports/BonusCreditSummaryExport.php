<?php

namespace App\Exports;

use App\Models\ReportBonusCredit;
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

class BonusCreditSummaryExport implements FromQuery, WithMapping, WithHeadings, WithCustomStartCell, WithColumnFormatting, WithColumnWidths, WithStyles, ShouldQueue
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
        $columns = [
            'A' => $row->transaction_date,
            'B' => $row->user->identity_no,
            'C' => $row->user->id,
            'D' => $row->user->name,
            'E' => $row->description,
            'F' => strval($row->amount),
            'G' => strval($row->total),
        ];

        return $columns;
    }

    public function query()
    {
        return ReportBonusCredit::with(['user'])->search($this->request)->select(sprintf('*', (new ReportBonusCredit())->table));
    }

    public function headings(): array
    {
        return [
            'Date',
            'Member IC',
            'Member ID',
            'Member Name',
            'Description',
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
            'D' => 30,
            'E' => 20,
            'F' => 20,
            'G' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $start_date = Carbon::parse($this->request->start_date)->format('d/m/Y');
        $end_date = Carbon::parse($this->request->end_date)->format('d/m/Y');
        if($this->request->start_date == null) {
            $result = ReportBonusCredit::with(['user'])->search($this->request)->select(sprintf('*', (new ReportBonusCredit())->table))->first();
            if($result) {
                $start_date = Carbon::parse($result->transaction_date)->format('d/m/Y');
            }
        }

        if($end_date == null) {
            $end_date = Carbon::now()->format('d/m/Y');
        }

        $from = 'FROM ' . $start_date . ' - ' . $end_date; 
        $sheet->setCellValue('C2', 'BONUS CREDIT REPORT (SUMMARY)');
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
