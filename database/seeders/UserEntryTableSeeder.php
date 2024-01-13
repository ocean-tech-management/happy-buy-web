<?php

namespace Database\Seeders;

use App\Models\DocumentNumberLog;
use App\Models\UserEntry;
use Illuminate\Database\Seeder;

class UserEntryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_entries = [
            [
                'id'                => 1,
                'user_type'         => 3,
                'deposit'           => 3000,
                'fee'               => 6000,
                'top_up'            => 27000,
                'created_at'        => '2021-08-31 21:07:10',
                'updated_at'        => '2021-08-31 21:12:15',
                'deleted_at'        => NULL,
                'user_id'           => 1,
                'invoice_number'    => NULL,
                'receipt_number'    => NULL,
            ],
            [
                'id'                => 2,
                'user_type'         => 3,
                'deposit'           => 3000,
                'fee'               => 6000,
                'top_up'            => 27000,
                'created_at'        => '2021-08-31 21:07:10',
                'updated_at'        => '2021-08-31 21:12:15',
                'deleted_at'        => NULL,
                'user_id'           => 2,
                'invoice_number'    => NULL,
                'receipt_number'    => NULL,
            ],
            [
                'id'                => 3,
                'user_type'         => 3,
                'deposit'           => 3000,
                'fee'               => 6000,
                'top_up'            => 27000,
                'created_at'        => '2021-08-31 21:07:10',
                'updated_at'        => '2021-08-31 21:12:15',
                'deleted_at'        => NULL,
                'user_id'           => 3,
                'invoice_number'    => NULL,
                'receipt_number'    => NULL,
            ],
            [
                'id'                => 4,
                'user_type'         => 3,
                'deposit'           => 3000,
                'fee'               => 0,
                'top_up'            => 0,
                'created_at'        => '2021-08-31 21:07:10',
                'updated_at'        => '2021-08-31 21:12:15',
                'deleted_at'        => NULL,
                'user_id'           => 4,
                'invoice_number'    => DocumentNumberLog::generateDocumentNumber("1", 4),
                'receipt_number'    => DocumentNumberLog::generateDocumentNumber("2", 4),
            ],
            [
                'id'                => 5,
                'user_type'         => 3,
                'deposit'           => 0,
                'fee'               => 6000,
                'top_up'            => 0,
                'created_at'        => '2021-08-31 21:07:10',
                'updated_at'        => '2021-08-31 21:12:15',
                'deleted_at'        => NULL,
                'user_id'           => 4,
                'invoice_number'    => DocumentNumberLog::generateDocumentNumber("1", 4),
                'receipt_number'    => DocumentNumberLog::generateDocumentNumber("2", 4),
            ],
            [
                'id'                => 6,
                'user_type'         => 1,
                'deposit'           => 0,
                'fee'               => 0,
                'top_up'            => 13500,
                'created_at'        => '2021-12-28 18:10:00',
                'updated_at'        => '2021-12-28 18:10:00',
                'deleted_at'        => NULL,
                'user_id'           => 5,
                'invoice_number'    => DocumentNumberLog::generateDocumentNumber("1", 4),
                'receipt_number'    => DocumentNumberLog::generateDocumentNumber("2", 4),
            ],
            [
                'id'                => 7,
                'user_type'         => 2,
                'deposit'           => 0,
                'fee'               => 0,
                'top_up'            => 13500,
                'created_at'        => '2021-12-29 18:10:00',
                'updated_at'        => '2021-12-29 18:10:00',
                'deleted_at'        => NULL,
                'user_id'           => 6,
                'invoice_number'    => DocumentNumberLog::generateDocumentNumber("1", 4),
                'receipt_number'    => DocumentNumberLog::generateDocumentNumber("2", 4),
            ],
            [
                'id'                => 8,
                'user_type'         => 3,
                'deposit'           => 0,
                'fee'               => 0,
                'top_up'            => 13500,
                'created_at'        => '2021-12-30 18:10:00',
                'updated_at'        => '2021-12-30 18:10:00',
                'deleted_at'        => NULL,
                'user_id'           => 7,
                'invoice_number'    => DocumentNumberLog::generateDocumentNumber("1", 4),
                'receipt_number'    => DocumentNumberLog::generateDocumentNumber("2", 4),
            ],
        ];

        UserEntry::insert($user_entries);
    }
}
