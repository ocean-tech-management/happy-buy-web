<?php

namespace App\Exports;

use App\Models\VoucherLog;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class VoucherLogExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithColumnWidths
{
    use SerializesModels, Exportable, Dispatchable;

    protected $request;

    function __construct($request) {
        $this->request = $request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function map($row): array
    {
        // TODO: Implement map() method.

        $columns = [
            'A' => $row->user->name,
            'B' => User::IDENTITY_TYPE_SELECT[$row->user->identity_type],
            'C' => $row->amount,
            'D' => $row->remark,
            'E' => $row->created_at,
        ];

        VoucherLog::whereId($row->id)->whereSettlement(1)
        ->update(['settlement' => 2]);

        return $columns;
    }
    public function query()
    {
        return VoucherLog::query()->search($this->request);
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'User',
            'ID Type',
            'Amount',
            'Remark',
            'Created At',
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function columnWidths(): array
    {
        // TODO: Implement columnWidths() method.
        return [
            'A' => 30,
            'B' => 10,
            'C' => 20,
            'D' => 60,
            'E' => 25,
        ];
    }
}
