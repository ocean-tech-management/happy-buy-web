<?php

namespace App\Exports;

use App\Models\User;
use App\Models\TransactionBonusGiven;
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

class BonusGivenExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithColumnWidths
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
            'C' => substr($row->transaction, 4),
            'D' => $row->amount,
            'E' => TransactionBonusGiven::TYPE_SELECT[$row->type],
            'F' => TransactionBonusGiven::STATUS_SELECT[$row->status],
            'G' => $row->given_at,
        ];

        // TransactionBonusGiven::whereId($row->id)->whereSettlement(1)
        // ->update(['status' => 2]);

        return $columns;
    }
    public function query()
    {
        return TransactionBonusGiven::query()->whereNotIn('user_id', [1,2,3])->search($this->request);
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'User',
            'ID Type',
            'Reference',
            'Amount',
            'Bonus Type',
            'Status',
            'Given At',
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    public function columnWidths(): array
    {
        // TODO: Implement columnWidths() method.
        return [
            'A' => 30,
            'B' => 10,
            'C' => 25,
            'D' => 20,
            'E' => 30,
            'F' => 15,
            'G' => 25,
        ];
    }
}
