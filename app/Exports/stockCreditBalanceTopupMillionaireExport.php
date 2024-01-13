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

class stockCreditBalanceTopupMillionaireExport implements FromCollection, WithMapping, WithHeadings, WithCustomStartCell, WithColumnFormatting, WithColumnWidths, WithStyles, ShouldQueue
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
        $this->total += $row->personalAmount;
        $columns = [
            'A' => $row->transaction_date,
            'B' => $row->user->identity_no,
            'C' => $row->user->id,
            'D' => $row->user->name,
            'E' => strval($row->personalAmount),
            'F' => strval($this->total),
        ];

        return $columns;
    }

    public function collection()
    {
        $orderArray = Order::select('user_id', DB::raw('SUM(amount) AS pendingAmount'))
        ->where('wallet_type', 3)
        ->whereRaw('(invoice_user_id IS NOT NULL AND invoice_user_id = user_id)')
        ->whereIn('status', [1,2,3])
        ->groupBy('user_id')
        ->pluck('pendingAmount','user_id')->toArray();

        $query = ReportStockCredit::with(['user'])
        ->search($this->request)
        ->whereHas('user', fn ($query) =>
            $query->where('user_type', 3)->whereNotIn('id', [1,2,3])
        )
        ->whereIn('report_stock_credits.from_wallet', [0,3])
        ->whereIn('top_up_type', [0,1])
        ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
        ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
        ->where('report_stock_credits.from_table', '!=', 'point_converts')
        ->groupBy('report_stock_credits.user_id')
        ->select(
            sprintf('*', (new ReportStockCredit())->table),
            DB::raw('SUM(report_stock_credits.amount) AS personalAmount'),
        )->get();

        if($this->request->has('start_date') && filled($this->request['start_date'])) {
            $userIdArray = $query->pluck('user_id');
            $pbQuery = ReportStockCredit::with(['user'])->whereHas('user', fn ($q) =>
                $q->where('user_type', 3)->whereNotIn('id', [1,2,3])
            )
            ->where('transaction_date', '<=', $this->request['start_date']." 00:00:00")
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            ->whereIn('top_up_type', [0,1])
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->whereIn('report_stock_credits.user_id', $userIdArray)
            ->groupBy('report_stock_credits.user_id')
            ->select(
                'user_id',
                DB::raw('SUM(report_stock_credits.amount) AS previousBalanceAmount'),
            );

            $pbData = $pbQuery->get();
            $filtered = $query->filter(function ($item) use ($pbData) {
                foreach($pbData as $key => $pbItem) {
                    if($item->user_id == $pbItem->user_id) {
                        $item->personalAmount += $pbItem->previousBalanceAmount;
                        return $item;
                    }
                }
                return $item;
            });
        } else {
            $filtered = $query;
        }

        foreach($filtered as $item) {
            if(array_key_exists($item->user->id, $orderArray)) {
                $pendingAmount = $orderArray[$item->user->id];
            } else {
                $pendingAmount = 0;
            }
            $item->personalAmount -= $pendingAmount;
        }        
        return $filtered;
    }

    public function headings(): array
    {
        return [
            'Date',
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
            $result = ReportStockCredit::with(['user'])
            ->search($this->request)
            ->whereHas('user', fn ($query) =>
                $query->where('user_type', 3)->whereNotIn('id', [1,2,3])
            )
            ->whereIn('report_stock_credits.from_wallet', [0,3])
            ->whereIn('top_up_type', [0,1])
            ->whereRaw('(CASE WHEN report_stock_credits.from_table = "orders" THEN report_stock_credits.order_wallet_type = 3 ELSE report_stock_credits.order_wallet_type = 0 END)')
            ->where('report_stock_credits.from_table', '!=', 'transaction_agent_top_ups')
            ->where('report_stock_credits.from_table', '!=', 'point_converts')
            ->groupBy('report_stock_credits.user_id')
            ->first();

            if($result) {
                $start_date = Carbon::parse($result->transaction_date)->format('d/m/Y');
            }
        }

        if($end_date == null) {
            $end_date = Carbon::now()->format('d/m/Y');
        }

        $from = 'FROM ' . $start_date . ' - ' . $end_date; 
        $sheet->setCellValue('C2', 'STOCK CREDIT REPORT (BALANCE TOP UP MILLIONAIRE)');
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
