<?php

namespace App\Exports;

use App\Models\BankList;
use App\Models\TransactionPointWithdraw;
use App\Models\User;
use App\Models\WithdrawExcel;
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

class WithdrawExport implements FromQuery, WithMapping, WithHeadings, WithColumnFormatting, WithColumnWidths, ShouldQueue
{
    use Queueable, SerializesModels, Exportable, Dispatchable, InteractsWithQueue;

//    public function map($user): array
//    {
//        $columns = [
//            'Name' => $user->name,php artisan make:export UsersExport
//            'Data de Nascimento' => $user->name,
//            'CPF' => $user->name,
//            'Valor do Seguro' => $user->client->name
//        ];
//        return $columns;
//    }
    public function map($row): array
    {
        // TODO: Implement map() method.

        $bank = BankList::whereBankName($row->bank_name)->first();
        $columns = [
            'A' => $row->bank_account_name,
            'B' => $bank->code,
            'C' => $row->bank_account_number,
            'D' => User::IDENTITY_TYPE_SELECT[$row->user->identity_type],
            'E' => $row->user->identity_no,
            'F' => $row->amount,
            'G' => substr($row->transaction, 4),
            'H' => "incentive",
        ];

        TransactionPointWithdraw::whereId($row->id)->update([
            'status' => 4
        ]);
        return $columns;
    }
    public function query()
    {
        return TransactionPointWithdraw::query()->whereStatus(1);
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'Beneficiary Name',
            'Beneficiary Bank',
            'Beneficiary Account No',
            'ID Type',
            'ID Number',
            'Payment Amount',
            'Payment Reference',
            'Payment Description',
        ];
    }

    public function columnFormats(): array
    {
        // TODO: Implement columnFormats() method.
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_NUMBER,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_NUMBER,
            'F' => NumberFormat::FORMAT_NUMBER_00,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function columnWidths(): array
    {
        // TODO: Implement columnWidths() method.
        return [
            'A' => 30,
            'B' => 20,
            'C' => 20,
            'D' => 10,
            'E' => 15,
            'F' => 20,
            'G' => 25,
            'H' => 18,
        ];
    }
}
