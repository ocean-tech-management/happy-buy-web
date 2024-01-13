<?php

namespace App\Exports;

use App\Models\ReportStockCredit;
use App\Models\Order;
use App\Models\DocumentMBRInvoiceLog;
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

class MBRExport implements FromQuery, WithMapping, WithHeadings, WithCustomStartCell, WithColumnFormatting, WithColumnWidths, WithStyles, ShouldQueue
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
        $remark = "";
        foreach (DocumentMBRInvoiceLog::whereName($row->name)->cursor() as $value){
            if ($value->method == 1){
                $remark .= "bank transfer,";
            }else{
                $remark .= $value->payment_remark.",";
            }
        }

        $columns = [
            'A' => $row->created_at,
            'B' => $row->name,
            'C' => $row->user->identity_no,
            'D' => $row->user->id,
            'E' => $row->user->name,
            'F' => DocumentMBRInvoiceLog::whereName($row->name)->sum('amount'),
            'G' => $row->quantity,
            'H' => "90",
            'I' => $row->order_name,
            'J' => $remark,
            'K' => "E5 - EHera",
        ];

        return $columns;
    }

    public function query()
    {
        $query = DocumentMBRInvoiceLog::with(['user'])->whereNotNull('name')->groupBy('name')->search($this->request)->select(sprintf('*', (new DocumentMBRInvoiceLog())->table));
        return $query;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Document',
            'Member IC',
            'Member ID',
            'Member Name',
            'Amount',
            'Quantity',
            'Unit Price',
            'Order ID',
            'Gateway Transaction',
            'Product Description',
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
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
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
            'H' => 20,
            'I' => 25,
            'J' => 25,
            'K' => 25,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $start_date = Carbon::parse($this->request->start_date)->format('d/m/Y');
        $end_date = Carbon::parse($this->request->end_date)->format('d/m/Y');
        if($this->request->start_date == null) {

            $result = DocumentMBRInvoiceLog::with(['user'])->search($this->request)->select(sprintf('*', (new DocumentMBRInvoiceLog())->table))->first();

            if($result) {
                $start_date = Carbon::parse($result->created_at)->format('d/m/Y');
            }
        }

        if($end_date == null) {
            $end_date = Carbon::now()->format('d/m/Y');
        }

        $from = 'FROM ' . $start_date . ' - ' . $end_date;
        $sheet->setCellValue('C2', 'MBR REPORT');
        $sheet->setCellValue('C3', $from);
        // $sheet->setCellValue('G4', "Opening Balance");
        // $sheet->setCellValue('H4', $this->opening_balance);

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
