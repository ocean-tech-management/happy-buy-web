<?php

namespace App\Exports;

use App\Models\ReportStockCredit;
use App\Models\Order;
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
use Illuminate\Support\Facades\DB;

class stockCreditBalanceTopupMillionaireDetailExport implements FromCollection, WithMapping, WithHeadings, WithCustomStartCell, WithColumnFormatting, WithColumnWidths, WithStyles, ShouldQueue
{
    use Queueable, SerializesModels, Exportable, Dispatchable, InteractsWithQueue;

    protected $request;
    protected $opening_balance = 0;
    protected $set_opening_balance = false;
    protected $total = 0;
    protected $default_start_date = "2021-09-15 00:00:00";

    function __construct($request) {
        $this->request = $request;
    }

    public function map($row): array
    {
        switch ($row->from_table) {
            case 'transaction_point_purchases':
                $this->total += $row->amount;
                break;
            case 'orders':
                $this->total -= abs($row->amount);
                break;
            case 'point_converts':
                $this->total += $row->amount;
                break;
            default:
                // $this->total += 0;
        }

        $columns = [
            'A' => $row->transaction_date,
            'C' => $row->document_no,
            'D' => $row->description,
            'E' => strval($row->amount),
            'F' => strval($this->total),
        ];

        return $columns;
    }

    public function collection()
    {
        $previousBalance = 0;
        if($this->request->has('start_date') && filled($this->request['start_date'])) {
            $pbQuery = ReportStockCredit::with(['user'])->whereHas('user', fn ($q) =>
                $q->where('user_type', 3)->whereNotIn('id', [1,2,3])
            )
            ->where('transaction_date', '<=', $this->request['start_date']." 00:00:00")
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->where('report_stock_credits.user_id', $this->request['user_id'])
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            ->select(
                DB::raw('SUM(report_stock_credits.amount) AS previousBalanceAmount'),
            )->first();
            if($pbQuery) {
                // $previousBalance = $pbQuery->previousBalanceAmount;
                $this->opening_balance = $pbQuery->previousBalanceAmount;
                $this->total = $pbQuery->previousBalanceAmount;
            }
        }

        $stock_credit = ReportStockCredit::where('user_id', $this->request['user_id'])
        ->search($this->request)
        ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
        ->where('report_stock_credits.from_table', '!=', 'point_converts')
        ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
        ->whereBetween('report_stock_credits.transaction_date', [$this->request->start_date != null ? $this->request->start_date : $this->default_start_date, $this->request->end_date != null ? $this->request->end_date : Carbon::now()])
        ->whereIn('top_up_type', [0,1])->whereIn('from_wallet',[0,3])->get();

        DB::statement(DB::raw("set @order_table='orders'"));

        $order = Order::where('user_id', $this->request['user_id'])->whereRaw('(invoice_user_id IS NOT NULL AND invoice_user_id = user_id)')->whereIn('status', [1,2,3])->where('wallet_type', 3)
        ->select(
            'id AS from_table_id',
            'created_at AS transaction_date',
            'new_invoice_number',
            DB::raw("(CASE
            WHEN (status = 1) THEN 'Sales (Pending)'
            WHEN (status = 2) THEN 'Sales (Shipped)'
            WHEN (status = 3) THEN 'Sales (Picked Up)'
            ELSE 0
            END) AS description"),
            DB::raw('(-1 * amount) AS amount'),
            DB::raw("@order_table AS from_table"),
        )->get();

        $all = collect($stock_credit)->merge($order)->sortBy('transaction_date');

        // dd($stock_credit, $order, $all);

        return $all;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Document No',
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
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_NUMBER_00,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 30,
            'D' => 20,
            'E' => 20,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $start_date = Carbon::parse($this->request->start_date)->format('d/m/Y');
        $end_date = Carbon::parse($this->request->end_date)->format('d/m/Y');
        if($this->request->start_date == null) {

            $result = ReportStockCredit::where('user_id', $this->request['user_id'])
            ->search($this->request)
            ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->whereBetween('report_stock_credits.transaction_date', [$this->request->start_date != null ? $this->request->start_date : $this->default_start_date, $this->request->end_date != null ? $this->request->end_date : Carbon::now()])
            ->whereIn('top_up_type', [0,1])->whereIn('from_wallet',[0,3])->first();

            if($result) {
                $start_date = Carbon::parse($result->transaction_date)->format('d/m/Y');
            }
        }

        if($end_date == null) {
            $end_date = Carbon::now()->format('d/m/Y');
        }

        $from = 'FROM ' . $start_date . ' - ' . $end_date; 
        $sheet->setCellValue('B2', 'STOCK CREDIT REPORT (BALANCE TOP UP MILLIONAIRE DETAIL)');
        $sheet->setCellValue('B3', $from);
        $sheet->setCellValue('D4', "Opening Balance");
        $sheet->setCellValue('E4', $this->opening_balance);

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
