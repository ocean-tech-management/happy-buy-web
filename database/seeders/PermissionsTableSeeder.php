<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'user_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'permission_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'permission_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'permission_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'permission_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'permission_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'role_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'role_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'role_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'role_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'role_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'user_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'user_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'user_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'user_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'user_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'audit_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 55,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'audit_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 55,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'admin_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'admin_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'admin_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'admin_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'admin_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'setting_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 104,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'country_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'country_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'country_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'country_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'country_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'language_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'language_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'language_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'language_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'language_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'banner_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 9,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'banner_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 9,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'banner_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 9,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'banner_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 9,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'banner_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 9,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'bank_list_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'bank_list_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'bank_list_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'bank_list_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'bank_list_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'product_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'product_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'product_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            47 => 
            array (
                'id' => 50,
                'name' => 'product_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            48 => 
            array (
                'id' => 51,
                'name' => 'product_category_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            49 => 
            array (
                'id' => 52,
                'name' => 'product_category_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            50 => 
            array (
                'id' => 53,
                'name' => 'product_category_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            51 => 
            array (
                'id' => 54,
                'name' => 'product_category_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            52 => 
            array (
                'id' => 55,
                'name' => 'product_category_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            53 => 
            array (
                'id' => 56,
                'name' => 'otp_log_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            54 => 
            array (
                'id' => 57,
                'name' => 'otp_log_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            55 => 
            array (
                'id' => 58,
                'name' => 'otp_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            56 => 
            array (
                'id' => 59,
                'name' => 'otp_log_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            57 => 
            array (
                'id' => 60,
                'name' => 'otp_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            58 => 
            array (
                'id' => 61,
                'name' => 'product_batch_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            59 => 
            array (
                'id' => 62,
                'name' => 'product_batch_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            60 => 
            array (
                'id' => 63,
                'name' => 'product_batch_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            61 => 
            array (
                'id' => 64,
                'name' => 'product_batch_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            62 => 
            array (
                'id' => 65,
                'name' => 'product_batch_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            63 => 
            array (
                'id' => 66,
                'name' => 'product_check_qr_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            64 => 
            array (
                'id' => 67,
                'name' => 'product_check_qr_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            65 => 
            array (
                'id' => 68,
                'name' => 'product_check_qr_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            66 => 
            array (
                'id' => 69,
                'name' => 'product_check_qr_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            67 => 
            array (
                'id' => 70,
                'name' => 'product_check_qr_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            68 => 
            array (
                'id' => 71,
                'name' => 'product_redemption_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            69 => 
            array (
                'id' => 72,
                'name' => 'point_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 28,
            ),
            70 => 
            array (
                'id' => 73,
                'name' => 'payout_limit_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            71 => 
            array (
                'id' => 74,
                'name' => 'payout_limit_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            72 => 
            array (
                'id' => 75,
                'name' => 'payout_limit_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            73 => 
            array (
                'id' => 76,
                'name' => 'payout_limit_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            74 => 
            array (
                'id' => 77,
                'name' => 'payout_limit_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            75 => 
            array (
                'id' => 78,
                'name' => 'announcement_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            76 => 
            array (
                'id' => 79,
                'name' => 'announcement_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            77 => 
            array (
                'id' => 80,
                'name' => 'announcement_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            78 => 
            array (
                'id' => 81,
                'name' => 'announcement_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            79 => 
            array (
                'id' => 82,
                'name' => 'announcement_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            80 => 
            array (
                'id' => 83,
                'name' => 'product_quantity_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            81 => 
            array (
                'id' => 84,
                'name' => 'product_quantity_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            82 => 
            array (
                'id' => 85,
                'name' => 'product_quantity_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            83 => 
            array (
                'id' => 86,
                'name' => 'product_quantity_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            84 => 
            array (
                'id' => 87,
                'name' => 'product_quantity_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            85 => 
            array (
                'id' => 88,
                'name' => 'point_convert_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            86 => 
            array (
                'id' => 89,
                'name' => 'point_convert_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            87 => 
            array (
                'id' => 90,
                'name' => 'point_convert_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            88 => 
            array (
                'id' => 91,
                'name' => 'point_convert_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            89 => 
            array (
                'id' => 92,
                'name' => 'point_convert_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            90 => 
            array (
                'id' => 93,
                'name' => 'point_convert_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            91 => 
            array (
                'id' => 94,
                'name' => 'point_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 28,
            ),
            92 => 
            array (
                'id' => 95,
                'name' => 'point_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 28,
            ),
            93 => 
            array (
                'id' => 96,
                'name' => 'point_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 28,
            ),
            94 => 
            array (
                'id' => 97,
                'name' => 'point_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 28,
            ),
            95 => 
            array (
                'id' => 98,
                'name' => 'point_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 28,
            ),
            96 => 
            array (
                'id' => 99,
                'name' => 'report_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 70,
            ),
            97 => 
            array (
                'id' => 100,
                'name' => 'total_revenue_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            98 => 
            array (
                'id' => 101,
                'name' => 'total_revenue_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            99 => 
            array (
                'id' => 102,
                'name' => 'total_revenue_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            100 => 
            array (
                'id' => 103,
                'name' => 'total_revenue_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            101 => 
            array (
                'id' => 104,
                'name' => 'total_revenue_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            102 => 
            array (
                'id' => 105,
                'name' => 'total_redemption_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            103 => 
            array (
                'id' => 106,
                'name' => 'total_redemption_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            104 => 
            array (
                'id' => 107,
                'name' => 'total_redemption_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            105 => 
            array (
                'id' => 108,
                'name' => 'total_redemption_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            106 => 
            array (
                'id' => 109,
                'name' => 'total_redemption_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            107 => 
            array (
                'id' => 110,
                'name' => 'total_point_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 63,
            ),
            108 => 
            array (
                'id' => 111,
                'name' => 'total_point_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 63,
            ),
            109 => 
            array (
                'id' => 112,
                'name' => 'total_point_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 63,
            ),
            110 => 
            array (
                'id' => 113,
                'name' => 'total_point_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 63,
            ),
            111 => 
            array (
                'id' => 114,
                'name' => 'total_point_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 63,
            ),
            112 => 
            array (
                'id' => 115,
                'name' => 'product_detail_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 60,
            ),
            113 => 
            array (
                'id' => 116,
                'name' => 'product_detail_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 60,
            ),
            114 => 
            array (
                'id' => 117,
                'name' => 'product_detail_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 60,
            ),
            115 => 
            array (
                'id' => 118,
                'name' => 'product_detail_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 60,
            ),
            116 => 
            array (
                'id' => 119,
                'name' => 'product_detail_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 60,
            ),
            117 => 
            array (
                'id' => 120,
                'name' => 'commission_report_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            118 => 
            array (
                'id' => 121,
                'name' => 'commission_report_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            119 => 
            array (
                'id' => 122,
                'name' => 'commission_report_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            120 => 
            array (
                'id' => 123,
                'name' => 'commission_report_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            121 => 
            array (
                'id' => 124,
                'name' => 'commission_report_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            122 => 
            array (
                'id' => 125,
                'name' => 'company_profit_loss_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            123 => 
            array (
                'id' => 126,
                'name' => 'company_profit_loss_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            124 => 
            array (
                'id' => 127,
                'name' => 'company_profit_loss_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            125 => 
            array (
                'id' => 128,
                'name' => 'company_profit_loss_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            126 => 
            array (
                'id' => 129,
                'name' => 'company_profit_loss_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            127 => 
            array (
                'id' => 130,
                'name' => 'enquiry_list_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            128 => 
            array (
                'id' => 131,
                'name' => 'enquiry_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            129 => 
            array (
                'id' => 132,
                'name' => 'enquiry_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            130 => 
            array (
                'id' => 133,
                'name' => 'enquiry_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            131 => 
            array (
                'id' => 134,
                'name' => 'enquiry_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            132 => 
            array (
                'id' => 135,
                'name' => 'enquiry_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            133 => 
            array (
                'id' => 136,
                'name' => 'enquiry_reply_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            134 => 
            array (
                'id' => 137,
                'name' => 'enquiry_reply_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            135 => 
            array (
                'id' => 138,
                'name' => 'enquiry_reply_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            136 => 
            array (
                'id' => 139,
                'name' => 'enquiry_reply_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            137 => 
            array (
                'id' => 140,
                'name' => 'enquiry_reply_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            138 => 
            array (
                'id' => 141,
                'name' => 'payment_method_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            139 => 
            array (
                'id' => 142,
                'name' => 'payment_method_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            140 => 
            array (
                'id' => 143,
                'name' => 'payment_method_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            141 => 
            array (
                'id' => 144,
                'name' => 'payment_method_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            142 => 
            array (
                'id' => 145,
                'name' => 'payment_method_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            143 => 
            array (
                'id' => 146,
                'name' => 'point_package_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            144 => 
            array (
                'id' => 147,
                'name' => 'point_package_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            145 => 
            array (
                'id' => 148,
                'name' => 'point_package_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            146 => 
            array (
                'id' => 149,
                'name' => 'point_package_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            147 => 
            array (
                'id' => 150,
                'name' => 'point_package_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            148 => 
            array (
                'id' => 151,
                'name' => 'voucher_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 50,
            ),
            149 => 
            array (
                'id' => 152,
                'name' => 'voucher_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 50,
            ),
            150 => 
            array (
                'id' => 153,
                'name' => 'voucher_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 50,
            ),
            151 => 
            array (
                'id' => 154,
                'name' => 'voucher_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 50,
            ),
            152 => 
            array (
                'id' => 155,
                'name' => 'voucher_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 50,
            ),
            153 => 
            array (
                'id' => 156,
                'name' => 'voucher_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 50,
            ),
            154 => 
            array (
                'id' => 157,
                'name' => 'material_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            155 => 
            array (
                'id' => 158,
                'name' => 'material_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            156 => 
            array (
                'id' => 159,
                'name' => 'material_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            157 => 
            array (
                'id' => 160,
                'name' => 'material_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            158 => 
            array (
                'id' => 161,
                'name' => 'material_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            159 => 
            array (
                'id' => 162,
                'name' => 'admin_setting_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 104,
            ),
            160 => 
            array (
                'id' => 163,
                'name' => 'address_book_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            161 => 
            array (
                'id' => 164,
                'name' => 'address_book_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            162 => 
            array (
                'id' => 165,
                'name' => 'address_book_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            163 => 
            array (
                'id' => 166,
                'name' => 'address_book_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            164 => 
            array (
                'id' => 167,
                'name' => 'address_book_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            165 => 
            array (
                'id' => 168,
                'name' => 'transaction_id_log_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 84,
            ),
            166 => 
            array (
                'id' => 169,
                'name' => 'transaction_id_log_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 84,
            ),
            167 => 
            array (
                'id' => 170,
                'name' => 'transaction_id_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 84,
            ),
            168 => 
            array (
                'id' => 171,
                'name' => 'transaction_id_log_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 84,
            ),
            169 => 
            array (
                'id' => 172,
                'name' => 'transaction_id_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 84,
            ),
            170 => 
            array (
                'id' => 173,
                'name' => 'personal_code_log_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            171 => 
            array (
                'id' => 174,
                'name' => 'personal_code_log_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            172 => 
            array (
                'id' => 175,
                'name' => 'personal_code_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            173 => 
            array (
                'id' => 176,
                'name' => 'personal_code_log_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            174 => 
            array (
                'id' => 177,
                'name' => 'personal_code_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            175 => 
            array (
                'id' => 178,
                'name' => 'new_order_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            176 => 
            array (
                'id' => 179,
                'name' => 'new_order_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            177 => 
            array (
                'id' => 180,
                'name' => 'new_order_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            178 => 
            array (
                'id' => 181,
                'name' => 'new_order_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            179 => 
            array (
                'id' => 182,
                'name' => 'new_order_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            180 => 
            array (
                'id' => 183,
                'name' => 'transaction_redeem_product_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 83,
            ),
            181 => 
            array (
                'id' => 184,
                'name' => 'transaction_redeem_product_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 83,
            ),
            182 => 
            array (
                'id' => 185,
                'name' => 'transaction_redeem_product_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 83,
            ),
            183 => 
            array (
                'id' => 186,
                'name' => 'transaction_redeem_product_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 83,
            ),
            184 => 
            array (
                'id' => 187,
                'name' => 'transaction_redeem_product_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 83,
            ),
            185 => 
            array (
                'id' => 188,
                'name' => 'shipping_company_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            186 => 
            array (
                'id' => 189,
                'name' => 'shipping_company_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            187 => 
            array (
                'id' => 190,
                'name' => 'shipping_company_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            188 => 
            array (
                'id' => 191,
                'name' => 'shipping_company_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            189 => 
            array (
                'id' => 192,
                'name' => 'shipping_company_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            190 => 
            array (
                'id' => 193,
                'name' => 'transaction_bonu_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            191 => 
            array (
                'id' => 194,
                'name' => 'transaction_bonu_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            192 => 
            array (
                'id' => 195,
                'name' => 'transaction_bonu_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            193 => 
            array (
                'id' => 196,
                'name' => 'transaction_bonu_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            194 => 
            array (
                'id' => 197,
                'name' => 'transaction_bonu_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            195 => 
            array (
                'id' => 198,
                'name' => 'transaction_point_withdraw_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 82,
            ),
            196 => 
            array (
                'id' => 199,
                'name' => 'transaction_point_withdraw_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            197 => 
            array (
                'id' => 200,
                'name' => 'transaction_point_withdraw_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            198 => 
            array (
                'id' => 201,
                'name' => 'transaction_point_withdraw_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            199 => 
            array (
                'id' => 202,
                'name' => 'transaction_point_withdraw_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            200 => 
            array (
                'id' => 203,
                'name' => 'transaction_point_purchase_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            201 => 
            array (
                'id' => 204,
                'name' => 'transaction_point_purchase_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            202 => 
            array (
                'id' => 205,
                'name' => 'transaction_point_purchase_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            203 => 
            array (
                'id' => 206,
                'name' => 'transaction_point_purchase_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            204 => 
            array (
                'id' => 207,
                'name' => 'transaction_point_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            205 => 
            array (
                'id' => 208,
                'name' => 'shipped_order_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            206 => 
            array (
                'id' => 209,
                'name' => 'shipped_order_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            207 => 
            array (
                'id' => 210,
                'name' => 'shipped_order_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            208 => 
            array (
                'id' => 211,
                'name' => 'shipped_order_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            209 => 
            array (
                'id' => 212,
                'name' => 'shipped_order_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            210 => 
            array (
                'id' => 213,
                'name' => 'completed_order_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            211 => 
            array (
                'id' => 214,
                'name' => 'completed_order_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            212 => 
            array (
                'id' => 215,
                'name' => 'completed_order_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            213 => 
            array (
                'id' => 216,
                'name' => 'completed_order_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            214 => 
            array (
                'id' => 217,
                'name' => 'completed_order_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            215 => 
            array (
                'id' => 218,
                'name' => 'cancelled_order_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            216 => 
            array (
                'id' => 219,
                'name' => 'cancelled_order_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            217 => 
            array (
                'id' => 220,
                'name' => 'cancelled_order_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            218 => 
            array (
                'id' => 221,
                'name' => 'cancelled_order_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            219 => 
            array (
                'id' => 222,
                'name' => 'cancelled_order_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            220 => 
            array (
                'id' => 223,
                'name' => 'new_purchase_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 92,
            ),
            221 => 
            array (
                'id' => 224,
                'name' => 'new_purchase_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 92,
            ),
            222 => 
            array (
                'id' => 225,
                'name' => 'new_purchase_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 92,
            ),
            223 => 
            array (
                'id' => 226,
                'name' => 'new_purchase_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 92,
            ),
            224 => 
            array (
                'id' => 227,
                'name' => 'new_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 92,
            ),
            225 => 
            array (
                'id' => 228,
                'name' => 'verified_purchase_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            226 => 
            array (
                'id' => 229,
                'name' => 'verified_purchase_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            227 => 
            array (
                'id' => 230,
                'name' => 'verified_purchase_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            228 => 
            array (
                'id' => 231,
                'name' => 'verified_purchase_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            229 => 
            array (
                'id' => 232,
                'name' => 'verified_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            230 => 
            array (
                'id' => 233,
                'name' => 'failed_purchase_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 94,
            ),
            231 => 
            array (
                'id' => 234,
                'name' => 'failed_purchase_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 94,
            ),
            232 => 
            array (
                'id' => 235,
                'name' => 'failed_purchase_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 94,
            ),
            233 => 
            array (
                'id' => 236,
                'name' => 'failed_purchase_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 94,
            ),
            234 => 
            array (
                'id' => 237,
                'name' => 'failed_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 94,
            ),
            235 => 
            array (
                'id' => 238,
                'name' => 'permissions_group_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            236 => 
            array (
                'id' => 239,
                'name' => 'permissions_group_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            237 => 
            array (
                'id' => 240,
                'name' => 'permissions_group_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            238 => 
            array (
                'id' => 241,
                'name' => 'permissions_group_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            239 => 
            array (
                'id' => 242,
                'name' => 'permissions_group_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            240 => 
            array (
                'id' => 243,
                'name' => 'point_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            241 => 
            array (
                'id' => 244,
                'name' => 'point_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            242 => 
            array (
                'id' => 245,
                'name' => 'point_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            243 => 
            array (
                'id' => 246,
                'name' => 'point_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            244 => 
            array (
                'id' => 247,
                'name' => 'point_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 31,
            ),
            245 => 
            array (
                'id' => 248,
                'name' => 'ranking_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            246 => 
            array (
                'id' => 249,
                'name' => 'ranking_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            247 => 
            array (
                'id' => 250,
                'name' => 'ranking_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            248 => 
            array (
                'id' => 251,
                'name' => 'ranking_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            249 => 
            array (
                'id' => 252,
                'name' => 'ranking_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            250 => 
            array (
                'id' => 253,
                'name' => 'bonus_join_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            251 => 
            array (
                'id' => 254,
                'name' => 'bonus_join_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            252 => 
            array (
                'id' => 255,
                'name' => 'bonus_join_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            253 => 
            array (
                'id' => 256,
                'name' => 'bonus_join_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            254 => 
            array (
                'id' => 257,
                'name' => 'bonus_join_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 35,
            ),
            255 => 
            array (
                'id' => 258,
                'name' => 'bonus_top_up_group_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            256 => 
            array (
                'id' => 259,
                'name' => 'bonus_top_up_group_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            257 => 
            array (
                'id' => 260,
                'name' => 'bonus_top_up_group_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            258 => 
            array (
                'id' => 261,
                'name' => 'bonus_top_up_group_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            259 => 
            array (
                'id' => 262,
                'name' => 'bonus_top_up_group_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            260 => 
            array (
                'id' => 263,
                'name' => 'bonus_top_up_personal_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 43,
            ),
            261 => 
            array (
                'id' => 264,
                'name' => 'bonus_top_up_personal_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 43,
            ),
            262 => 
            array (
                'id' => 265,
                'name' => 'bonus_top_up_personal_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 43,
            ),
            263 => 
            array (
                'id' => 266,
                'name' => 'bonus_top_up_personal_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 43,
            ),
            264 => 
            array (
                'id' => 267,
                'name' => 'bonus_top_up_personal_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 43,
            ),
            265 => 
            array (
                'id' => 268,
                'name' => 'transaction_agent_top_up_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            266 => 
            array (
                'id' => 269,
                'name' => 'transaction_agent_top_up_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            267 => 
            array (
                'id' => 270,
                'name' => 'transaction_agent_top_up_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            268 => 
            array (
                'id' => 271,
                'name' => 'transaction_agent_top_up_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            269 => 
            array (
                'id' => 272,
                'name' => 'transaction_agent_top_up_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            270 => 
            array (
                'id' => 273,
                'name' => 'user_agreement_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 22,
            ),
            271 => 
            array (
                'id' => 274,
                'name' => 'user_agreement_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 22,
            ),
            272 => 
            array (
                'id' => 275,
                'name' => 'user_agreement_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 22,
            ),
            273 => 
            array (
                'id' => 276,
                'name' => 'user_agreement_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 22,
            ),
            274 => 
            array (
                'id' => 277,
                'name' => 'user_agreement_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 22,
            ),
            275 => 
            array (
                'id' => 278,
                'name' => 'user_entry_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            276 => 
            array (
                'id' => 279,
                'name' => 'user_entry_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            277 => 
            array (
                'id' => 280,
                'name' => 'user_entry_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            278 => 
            array (
                'id' => 281,
                'name' => 'user_entry_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            279 => 
            array (
                'id' => 282,
                'name' => 'user_entry_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            280 => 
            array (
                'id' => 283,
                'name' => 'bonus_personal_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 38,
            ),
            281 => 
            array (
                'id' => 284,
                'name' => 'bonus_personal_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            282 => 
            array (
                'id' => 285,
                'name' => 'bonus_personal_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            283 => 
            array (
                'id' => 286,
                'name' => 'bonus_personal_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            284 => 
            array (
                'id' => 287,
                'name' => 'bonus_personal_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            285 => 
            array (
                'id' => 288,
                'name' => 'bonus_group_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            286 => 
            array (
                'id' => 289,
                'name' => 'bonus_group_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            287 => 
            array (
                'id' => 290,
                'name' => 'bonus_group_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            288 => 
            array (
                'id' => 291,
                'name' => 'bonus_group_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            289 => 
            array (
                'id' => 292,
                'name' => 'bonus_group_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            290 => 
            array (
                'id' => 293,
                'name' => 'point_transaction_log_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            291 => 
            array (
                'id' => 294,
                'name' => 'point_transaction_log_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            292 => 
            array (
                'id' => 295,
                'name' => 'point_transaction_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            293 => 
            array (
                'id' => 296,
                'name' => 'point_transaction_log_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            294 => 
            array (
                'id' => 297,
                'name' => 'point_transaction_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            295 => 
            array (
                'id' => 298,
                'name' => 'point_transfer_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 28,
            ),
            296 => 
            array (
                'id' => 299,
                'name' => 'other_setting_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 104,
            ),
            297 => 
            array (
                'id' => 300,
                'name' => 'bonus_ref_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 40,
            ),
            298 => 
            array (
                'id' => 301,
                'name' => 'bonus_ref_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            299 => 
            array (
                'id' => 302,
                'name' => 'bonus_ref_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            300 => 
            array (
                'id' => 303,
                'name' => 'bonus_ref_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            301 => 
            array (
                'id' => 304,
                'name' => 'bonus_ref_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            302 => 
            array (
                'id' => 305,
                'name' => 'bonus_restock_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            303 => 
            array (
                'id' => 306,
                'name' => 'bonus_restock_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            304 => 
            array (
                'id' => 307,
                'name' => 'bonus_restock_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            305 => 
            array (
                'id' => 308,
                'name' => 'bonus_restock_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            306 => 
            array (
                'id' => 309,
                'name' => 'bonus_restock_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            307 => 
            array (
                'id' => 310,
                'name' => 'bonus_annual_personal_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            308 => 
            array (
                'id' => 311,
                'name' => 'bonus_annual_personal_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            309 => 
            array (
                'id' => 312,
                'name' => 'bonus_annual_personal_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            310 => 
            array (
                'id' => 313,
                'name' => 'bonus_annual_personal_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            311 => 
            array (
                'id' => 314,
                'name' => 'bonus_annual_personal_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            312 => 
            array (
                'id' => 315,
                'name' => 'bonus_annual_group_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            313 => 
            array (
                'id' => 316,
                'name' => 'bonus_annual_group_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            314 => 
            array (
                'id' => 317,
                'name' => 'bonus_annual_group_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            315 => 
            array (
                'id' => 318,
                'name' => 'bonus_annual_group_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            316 => 
            array (
                'id' => 319,
                'name' => 'bonus_annual_group_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 41,
            ),
            317 => 
            array (
                'id' => 320,
                'name' => 'agreement_management_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 22,
            ),
            318 => 
            array (
                'id' => 321,
                'name' => 'agent_agreement_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            319 => 
            array (
                'id' => 322,
                'name' => 'agent_agreement_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            320 => 
            array (
                'id' => 323,
                'name' => 'agent_agreement_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            321 => 
            array (
                'id' => 324,
                'name' => 'agent_agreement_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            322 => 
            array (
                'id' => 325,
                'name' => 'agent_agreement_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            323 => 
            array (
                'id' => 326,
                'name' => 'merchant_agreement_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 25,
            ),
            324 => 
            array (
                'id' => 327,
                'name' => 'merchant_agreement_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            325 => 
            array (
                'id' => 328,
                'name' => 'merchant_agreement_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            326 => 
            array (
                'id' => 329,
                'name' => 'merchant_agreement_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            327 => 
            array (
                'id' => 330,
                'name' => 'merchant_agreement_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            328 => 
            array (
                'id' => 331,
                'name' => 'profile_password_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 111,
            ),
            329 => 
            array (
                'id' => 332,
                'name' => 'product_variant_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:09:08',
                'updated_at' => '2021-08-12 03:09:08',
                'group_id' => 73,
            ),
            330 => 
            array (
                'id' => 333,
                'name' => 'product_variant_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:11:24',
                'updated_at' => '2021-08-12 03:11:24',
                'group_id' => 73,
            ),
            331 => 
            array (
                'id' => 334,
                'name' => 'product_variant_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:11:37',
                'updated_at' => '2021-08-12 03:11:37',
                'group_id' => 73,
            ),
            332 => 
            array (
                'id' => 335,
                'name' => 'product_variant_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:11:48',
                'updated_at' => '2021-08-12 03:11:48',
                'group_id' => 73,
            ),
            333 => 
            array (
                'id' => 336,
                'name' => 'product_variant_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:12:03',
                'updated_at' => '2021-08-12 03:12:03',
                'group_id' => 73,
            ),
            334 => 
            array (
                'id' => 337,
                'name' => 'product_color_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:12:17',
                'updated_at' => '2021-08-12 03:12:17',
                'group_id' => 74,
            ),
            335 => 
            array (
                'id' => 338,
                'name' => 'product_color_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:12:42',
                'updated_at' => '2021-08-12 03:12:42',
                'group_id' => 74,
            ),
            336 => 
            array (
                'id' => 339,
                'name' => 'product_color_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:12:50',
                'updated_at' => '2021-08-12 03:12:50',
                'group_id' => 74,
            ),
            337 => 
            array (
                'id' => 340,
                'name' => 'product_color_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:12:57',
                'updated_at' => '2021-08-12 03:12:57',
                'group_id' => 74,
            ),
            338 => 
            array (
                'id' => 341,
                'name' => 'product_color_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:13:05',
                'updated_at' => '2021-08-12 03:13:05',
                'group_id' => 74,
            ),
            339 => 
            array (
                'id' => 342,
                'name' => 'product_size_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:13:25',
                'updated_at' => '2021-08-12 03:13:25',
                'group_id' => 75,
            ),
            340 => 
            array (
                'id' => 343,
                'name' => 'product_size_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:13:33',
                'updated_at' => '2021-08-12 03:13:33',
                'group_id' => 75,
            ),
            341 => 
            array (
                'id' => 344,
                'name' => 'product_size_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:13:42',
                'updated_at' => '2021-08-12 03:13:42',
                'group_id' => 75,
            ),
            342 => 
            array (
                'id' => 345,
                'name' => 'product_size_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:13:50',
                'updated_at' => '2021-08-12 03:13:50',
                'group_id' => 75,
            ),
            343 => 
            array (
                'id' => 346,
                'name' => 'product_size_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:13:57',
                'updated_at' => '2021-08-12 03:13:57',
                'group_id' => 75,
            ),
            344 => 
            array (
                'id' => 347,
                'name' => 'merchant_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:15:23',
                'updated_at' => '2021-08-12 03:15:23',
                'group_id' => 111,
            ),
            345 => 
            array (
                'id' => 348,
                'name' => 'agent_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:15:32',
                'updated_at' => '2021-08-12 03:15:32',
                'group_id' => 111,
            ),
            346 => 
            array (
                'id' => 349,
                'name' => 'new_top_up_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-13 03:15:32',
                'updated_at' => '2021-08-13 03:15:32',
                'group_id' => 86,
            ),
            347 => 
            array (
                'id' => 350,
                'name' => 'approved_top_up_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-13 03:15:35',
                'updated_at' => '2021-08-13 03:15:35',
                'group_id' => 86,
            ),
            348 => 
            array (
                'id' => 351,
                'name' => 'rejected_top_up_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-13 03:15:41',
                'updated_at' => '2021-08-13 03:15:41',
                'group_id' => 86,
            ),
            349 => 
            array (
                'id' => 352,
                'name' => 'cart_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:43:54',
                'updated_at' => '2021-08-16 03:43:54',
                'group_id' => 89,
            ),
            350 => 
            array (
                'id' => 353,
                'name' => 'cart_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:44:06',
                'updated_at' => '2021-08-16 03:44:06',
                'group_id' => 89,
            ),
            351 => 
            array (
                'id' => 354,
                'name' => 'cart_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:44:16',
                'updated_at' => '2021-08-16 03:44:16',
                'group_id' => 89,
            ),
            352 => 
            array (
                'id' => 355,
                'name' => 'cart_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:44:36',
                'updated_at' => '2021-08-16 03:44:36',
                'group_id' => 89,
            ),
            353 => 
            array (
                'id' => 356,
                'name' => 'cart_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:44:53',
                'updated_at' => '2021-08-16 03:44:53',
                'group_id' => 89,
            ),
            354 => 
            array (
                'id' => 357,
                'name' => 'order_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:08',
                'updated_at' => '2021-08-16 03:45:08',
                'group_id' => 96,
            ),
            355 => 
            array (
                'id' => 358,
                'name' => 'order_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:15',
                'updated_at' => '2021-08-16 03:45:15',
                'group_id' => 96,
            ),
            356 => 
            array (
                'id' => 359,
                'name' => 'order_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:24',
                'updated_at' => '2021-08-16 03:45:24',
                'group_id' => 96,
            ),
            357 => 
            array (
                'id' => 360,
                'name' => 'order_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:32',
                'updated_at' => '2021-08-16 03:45:32',
                'group_id' => 96,
            ),
            358 => 
            array (
                'id' => 361,
                'name' => 'order_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:39',
                'updated_at' => '2021-08-16 03:45:39',
                'group_id' => 96,
            ),
            359 => 
            array (
                'id' => 362,
                'name' => 'order_item_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:46',
                'updated_at' => '2021-08-16 03:45:46',
                'group_id' => 101,
            ),
            360 => 
            array (
                'id' => 363,
                'name' => 'order_item_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:45:57',
                'updated_at' => '2021-08-16 03:45:57',
                'group_id' => 101,
            ),
            361 => 
            array (
                'id' => 364,
                'name' => 'order_item_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:07',
                'updated_at' => '2021-08-16 03:46:07',
                'group_id' => 101,
            ),
            362 => 
            array (
                'id' => 365,
                'name' => 'order_item_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:14',
                'updated_at' => '2021-08-16 03:46:14',
                'group_id' => 101,
            ),
            363 => 
            array (
                'id' => 366,
                'name' => 'order_item_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 101,
            ),
            364 => 
            array (
                'id' => 367,
                'name' => 'user_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            365 => 
            array (
                'id' => 368,
                'name' => 'permission_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            366 => 
            array (
                'id' => 369,
                'name' => 'permission_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            367 => 
            array (
                'id' => 370,
                'name' => 'permission_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            368 => 
            array (
                'id' => 371,
                'name' => 'permission_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            369 => 
            array (
                'id' => 372,
                'name' => 'permission_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 54,
            ),
            370 => 
            array (
                'id' => 373,
                'name' => 'role_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            371 => 
            array (
                'id' => 374,
                'name' => 'role_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            372 => 
            array (
                'id' => 375,
                'name' => 'role_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            373 => 
            array (
                'id' => 376,
                'name' => 'role_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            374 => 
            array (
                'id' => 377,
                'name' => 'role_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 53,
            ),
            375 => 
            array (
                'id' => 378,
                'name' => 'user_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            376 => 
            array (
                'id' => 379,
                'name' => 'user_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            377 => 
            array (
                'id' => 380,
                'name' => 'user_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            378 => 
            array (
                'id' => 381,
                'name' => 'user_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            379 => 
            array (
                'id' => 382,
                'name' => 'user_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 111,
            ),
            380 => 
            array (
                'id' => 383,
                'name' => 'audit_log_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 55,
            ),
            381 => 
            array (
                'id' => 384,
                'name' => 'audit_log_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 55,
            ),
            382 => 
            array (
                'id' => 385,
                'name' => 'admin_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            383 => 
            array (
                'id' => 386,
                'name' => 'admin_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            384 => 
            array (
                'id' => 387,
                'name' => 'admin_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            385 => 
            array (
                'id' => 388,
                'name' => 'admin_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            386 => 
            array (
                'id' => 389,
                'name' => 'admin_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 5,
            ),
            387 => 
            array (
                'id' => 390,
                'name' => 'setting_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 104,
            ),
            388 => 
            array (
                'id' => 391,
                'name' => 'country_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            389 => 
            array (
                'id' => 392,
                'name' => 'country_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            390 => 
            array (
                'id' => 393,
                'name' => 'country_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            391 => 
            array (
                'id' => 394,
                'name' => 'country_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            392 => 
            array (
                'id' => 395,
                'name' => 'country_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 48,
            ),
            393 => 
            array (
                'id' => 396,
                'name' => 'language_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            394 => 
            array (
                'id' => 397,
                'name' => 'language_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            395 => 
            array (
                'id' => 398,
                'name' => 'language_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            396 => 
            array (
                'id' => 399,
                'name' => 'language_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            397 => 
            array (
                'id' => 400,
                'name' => 'language_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 16,
            ),
            398 => 
            array (
                'id' => 401,
                'name' => 'banner_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 9,
            ),
            399 => 
            array (
                'id' => 402,
                'name' => 'banner_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 9,
            ),
            400 => 
            array (
                'id' => 403,
                'name' => 'banner_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 9,
            ),
            401 => 
            array (
                'id' => 404,
                'name' => 'banner_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 9,
            ),
            402 => 
            array (
                'id' => 405,
                'name' => 'banner_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 9,
            ),
            403 => 
            array (
                'id' => 406,
                'name' => 'bank_list_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            404 => 
            array (
                'id' => 407,
                'name' => 'bank_list_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            405 => 
            array (
                'id' => 408,
                'name' => 'bank_list_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            406 => 
            array (
                'id' => 409,
                'name' => 'bank_list_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            407 => 
            array (
                'id' => 410,
                'name' => 'bank_list_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 56,
            ),
            408 => 
            array (
                'id' => 411,
                'name' => 'product_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            409 => 
            array (
                'id' => 412,
                'name' => 'product_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            410 => 
            array (
                'id' => 413,
                'name' => 'product_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            411 => 
            array (
                'id' => 414,
                'name' => 'product_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            412 => 
            array (
                'id' => 415,
                'name' => 'product_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            413 => 
            array (
                'id' => 416,
                'name' => 'product_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 18,
            ),
            414 => 
            array (
                'id' => 417,
                'name' => 'product_category_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            415 => 
            array (
                'id' => 418,
                'name' => 'product_category_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            416 => 
            array (
                'id' => 419,
                'name' => 'product_category_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            417 => 
            array (
                'id' => 420,
                'name' => 'product_category_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            418 => 
            array (
                'id' => 421,
                'name' => 'product_category_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 19,
            ),
            419 => 
            array (
                'id' => 422,
                'name' => 'otp_log_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            420 => 
            array (
                'id' => 423,
                'name' => 'otp_log_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            421 => 
            array (
                'id' => 424,
                'name' => 'otp_log_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            422 => 
            array (
                'id' => 425,
                'name' => 'otp_log_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            423 => 
            array (
                'id' => 426,
                'name' => 'otp_log_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 102,
            ),
            424 => 
            array (
                'id' => 427,
                'name' => 'product_batch_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            425 => 
            array (
                'id' => 428,
                'name' => 'product_batch_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            426 => 
            array (
                'id' => 429,
                'name' => 'product_batch_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            427 => 
            array (
                'id' => 430,
                'name' => 'product_batch_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            428 => 
            array (
                'id' => 431,
                'name' => 'product_batch_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 20,
            ),
            429 => 
            array (
                'id' => 432,
                'name' => 'product_check_qr_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            430 => 
            array (
                'id' => 433,
                'name' => 'product_check_qr_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            431 => 
            array (
                'id' => 434,
                'name' => 'product_check_qr_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            432 => 
            array (
                'id' => 435,
                'name' => 'product_check_qr_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            433 => 
            array (
                'id' => 436,
                'name' => 'product_check_qr_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            434 => 
            array (
                'id' => 437,
                'name' => 'product_redemption_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 17,
            ),
            435 => 
            array (
                'id' => 438,
                'name' => 'point_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:01',
                'updated_at' => '2021-08-02 00:16:01',
                'group_id' => 28,
            ),
            436 => 
            array (
                'id' => 439,
                'name' => 'payout_limit_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            437 => 
            array (
                'id' => 440,
                'name' => 'payout_limit_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            438 => 
            array (
                'id' => 441,
                'name' => 'payout_limit_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            439 => 
            array (
                'id' => 442,
                'name' => 'payout_limit_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            440 => 
            array (
                'id' => 443,
                'name' => 'payout_limit_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 57,
            ),
            441 => 
            array (
                'id' => 444,
                'name' => 'announcement_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            442 => 
            array (
                'id' => 445,
                'name' => 'announcement_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            443 => 
            array (
                'id' => 446,
                'name' => 'announcement_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            444 => 
            array (
                'id' => 447,
                'name' => 'announcement_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            445 => 
            array (
                'id' => 448,
                'name' => 'announcement_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 8,
            ),
            446 => 
            array (
                'id' => 449,
                'name' => 'product_quantity_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            447 => 
            array (
                'id' => 450,
                'name' => 'product_quantity_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            448 => 
            array (
                'id' => 451,
                'name' => 'product_quantity_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            449 => 
            array (
                'id' => 452,
                'name' => 'product_quantity_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            450 => 
            array (
                'id' => 453,
                'name' => 'product_quantity_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 21,
            ),
            451 => 
            array (
                'id' => 454,
                'name' => 'point_convert_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            452 => 
            array (
                'id' => 455,
                'name' => 'point_convert_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            453 => 
            array (
                'id' => 456,
                'name' => 'point_convert_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            454 => 
            array (
                'id' => 457,
                'name' => 'point_convert_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            455 => 
            array (
                'id' => 458,
                'name' => 'point_convert_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            456 => 
            array (
                'id' => 459,
                'name' => 'point_convert_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 30,
            ),
            457 => 
            array (
                'id' => 460,
                'name' => 'point_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 28,
            ),
            458 => 
            array (
                'id' => 461,
                'name' => 'point_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:02',
                'updated_at' => '2021-08-02 00:16:02',
                'group_id' => 28,
            ),
            459 => 
            array (
                'id' => 462,
                'name' => 'point_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 28,
            ),
            460 => 
            array (
                'id' => 463,
                'name' => 'point_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 28,
            ),
            461 => 
            array (
                'id' => 464,
                'name' => 'point_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 28,
            ),
            462 => 
            array (
                'id' => 465,
                'name' => 'report_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 70,
            ),
            463 => 
            array (
                'id' => 466,
                'name' => 'total_revenue_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            464 => 
            array (
                'id' => 467,
                'name' => 'total_revenue_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            465 => 
            array (
                'id' => 468,
                'name' => 'total_revenue_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            466 => 
            array (
                'id' => 469,
                'name' => 'total_revenue_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            467 => 
            array (
                'id' => 470,
                'name' => 'total_revenue_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 61,
            ),
            468 => 
            array (
                'id' => 471,
                'name' => 'total_redemption_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            469 => 
            array (
                'id' => 472,
                'name' => 'total_redemption_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            470 => 
            array (
                'id' => 473,
                'name' => 'total_redemption_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            471 => 
            array (
                'id' => 474,
                'name' => 'total_redemption_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            472 => 
            array (
                'id' => 475,
                'name' => 'total_redemption_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 62,
            ),
            473 => 
            array (
                'id' => 476,
                'name' => 'total_point_balance_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 32,
            ),
            474 => 
            array (
                'id' => 477,
                'name' => 'total_point_balance_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 32,
            ),
            475 => 
            array (
                'id' => 478,
                'name' => 'total_point_balance_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 32,
            ),
            476 => 
            array (
                'id' => 479,
                'name' => 'total_point_balance_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 32,
            ),
            477 => 
            array (
                'id' => 480,
                'name' => 'total_point_balance_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 32,
            ),
            478 => 
            array (
                'id' => 481,
                'name' => 'product_detail_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 60,
            ),
            479 => 
            array (
                'id' => 482,
                'name' => 'product_detail_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:03',
                'updated_at' => '2021-08-02 00:16:03',
                'group_id' => 60,
            ),
            480 => 
            array (
                'id' => 483,
                'name' => 'product_detail_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 60,
            ),
            481 => 
            array (
                'id' => 484,
                'name' => 'product_detail_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 60,
            ),
            482 => 
            array (
                'id' => 485,
                'name' => 'product_detail_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 60,
            ),
            483 => 
            array (
                'id' => 486,
                'name' => 'commission_report_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            484 => 
            array (
                'id' => 487,
                'name' => 'commission_report_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            485 => 
            array (
                'id' => 488,
                'name' => 'commission_report_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            486 => 
            array (
                'id' => 489,
                'name' => 'commission_report_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            487 => 
            array (
                'id' => 490,
                'name' => 'commission_report_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 64,
            ),
            488 => 
            array (
                'id' => 491,
                'name' => 'company_profit_loss_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            489 => 
            array (
                'id' => 492,
                'name' => 'company_profit_loss_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            490 => 
            array (
                'id' => 493,
                'name' => 'company_profit_loss_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            491 => 
            array (
                'id' => 494,
                'name' => 'company_profit_loss_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            492 => 
            array (
                'id' => 495,
                'name' => 'company_profit_loss_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 65,
            ),
            493 => 
            array (
                'id' => 496,
                'name' => 'enquiry_list_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            494 => 
            array (
                'id' => 497,
                'name' => 'enquiry_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            495 => 
            array (
                'id' => 498,
                'name' => 'enquiry_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            496 => 
            array (
                'id' => 499,
                'name' => 'enquiry_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            497 => 
            array (
                'id' => 500,
                'name' => 'enquiry_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            498 => 
            array (
                'id' => 501,
                'name' => 'enquiry_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:04',
                'updated_at' => '2021-08-02 00:16:04',
                'group_id' => 12,
            ),
            499 => 
            array (
                'id' => 502,
                'name' => 'enquiry_reply_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
        ));
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 503,
                'name' => 'enquiry_reply_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            1 => 
            array (
                'id' => 504,
                'name' => 'enquiry_reply_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            2 => 
            array (
                'id' => 505,
                'name' => 'enquiry_reply_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            3 => 
            array (
                'id' => 506,
                'name' => 'enquiry_reply_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 13,
            ),
            4 => 
            array (
                'id' => 507,
                'name' => 'payment_method_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            5 => 
            array (
                'id' => 508,
                'name' => 'payment_method_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            6 => 
            array (
                'id' => 509,
                'name' => 'payment_method_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            7 => 
            array (
                'id' => 510,
                'name' => 'payment_method_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            8 => 
            array (
                'id' => 511,
                'name' => 'payment_method_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 108,
            ),
            9 => 
            array (
                'id' => 512,
                'name' => 'point_package_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            10 => 
            array (
                'id' => 513,
                'name' => 'point_package_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            11 => 
            array (
                'id' => 514,
                'name' => 'point_package_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            12 => 
            array (
                'id' => 515,
                'name' => 'point_package_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            13 => 
            array (
                'id' => 516,
                'name' => 'point_package_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 29,
            ),
            14 => 
            array (
                'id' => 517,
                'name' => 'voucher_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 50,
            ),
            15 => 
            array (
                'id' => 518,
                'name' => 'voucher_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 50,
            ),
            16 => 
            array (
                'id' => 519,
                'name' => 'voucher_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:05',
                'updated_at' => '2021-08-02 00:16:05',
                'group_id' => 50,
            ),
            17 => 
            array (
                'id' => 520,
                'name' => 'voucher_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 50,
            ),
            18 => 
            array (
                'id' => 521,
                'name' => 'voucher_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 50,
            ),
            19 => 
            array (
                'id' => 522,
                'name' => 'voucher_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 50,
            ),
            20 => 
            array (
                'id' => 523,
                'name' => 'material_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            21 => 
            array (
                'id' => 524,
                'name' => 'material_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            22 => 
            array (
                'id' => 525,
                'name' => 'material_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            23 => 
            array (
                'id' => 526,
                'name' => 'material_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            24 => 
            array (
                'id' => 527,
                'name' => 'material_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 66,
            ),
            25 => 
            array (
                'id' => 528,
                'name' => 'admin_setting_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 104,
            ),
            26 => 
            array (
                'id' => 529,
                'name' => 'address_book_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            27 => 
            array (
                'id' => 530,
                'name' => 'address_book_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            28 => 
            array (
                'id' => 531,
                'name' => 'address_book_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            29 => 
            array (
                'id' => 532,
                'name' => 'address_book_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            30 => 
            array (
                'id' => 533,
                'name' => 'address_book_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 26,
            ),
            31 => 
            array (
                'id' => 534,
                'name' => 'transaction_id_log_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 84,
            ),
            32 => 
            array (
                'id' => 535,
                'name' => 'transaction_id_log_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:06',
                'updated_at' => '2021-08-02 00:16:06',
                'group_id' => 84,
            ),
            33 => 
            array (
                'id' => 536,
                'name' => 'transaction_id_log_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 84,
            ),
            34 => 
            array (
                'id' => 537,
                'name' => 'transaction_id_log_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 84,
            ),
            35 => 
            array (
                'id' => 538,
                'name' => 'transaction_id_log_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 84,
            ),
            36 => 
            array (
                'id' => 539,
                'name' => 'personal_code_log_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            37 => 
            array (
                'id' => 540,
                'name' => 'personal_code_log_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            38 => 
            array (
                'id' => 541,
                'name' => 'personal_code_log_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            39 => 
            array (
                'id' => 542,
                'name' => 'personal_code_log_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            40 => 
            array (
                'id' => 543,
                'name' => 'personal_code_log_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 78,
            ),
            41 => 
            array (
                'id' => 544,
                'name' => 'new_order_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            42 => 
            array (
                'id' => 545,
                'name' => 'new_order_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            43 => 
            array (
                'id' => 546,
                'name' => 'new_order_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            44 => 
            array (
                'id' => 547,
                'name' => 'new_order_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            45 => 
            array (
                'id' => 548,
                'name' => 'new_order_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 97,
            ),
            46 => 
            array (
                'id' => 549,
                'name' => 'transaction_redeem_product_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 83,
            ),
            47 => 
            array (
                'id' => 550,
                'name' => 'transaction_redeem_product_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:07',
                'updated_at' => '2021-08-02 00:16:07',
                'group_id' => 83,
            ),
            48 => 
            array (
                'id' => 551,
                'name' => 'transaction_redeem_product_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 83,
            ),
            49 => 
            array (
                'id' => 552,
                'name' => 'transaction_redeem_product_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 83,
            ),
            50 => 
            array (
                'id' => 553,
                'name' => 'transaction_redeem_product_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 83,
            ),
            51 => 
            array (
                'id' => 554,
                'name' => 'shipping_company_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            52 => 
            array (
                'id' => 555,
                'name' => 'shipping_company_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            53 => 
            array (
                'id' => 556,
                'name' => 'shipping_company_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            54 => 
            array (
                'id' => 557,
                'name' => 'shipping_company_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            55 => 
            array (
                'id' => 558,
                'name' => 'shipping_company_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 32,
            ),
            56 => 
            array (
                'id' => 559,
                'name' => 'transaction_bonu_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            57 => 
            array (
                'id' => 560,
                'name' => 'transaction_bonu_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            58 => 
            array (
                'id' => 561,
                'name' => 'transaction_bonu_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            59 => 
            array (
                'id' => 562,
                'name' => 'transaction_bonu_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            60 => 
            array (
                'id' => 563,
                'name' => 'transaction_bonu_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 85,
            ),
            61 => 
            array (
                'id' => 564,
                'name' => 'transaction_point_withdraw_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:08',
                'updated_at' => '2021-08-02 00:16:08',
                'group_id' => 82,
            ),
            62 => 
            array (
                'id' => 565,
                'name' => 'transaction_point_withdraw_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            63 => 
            array (
                'id' => 566,
                'name' => 'transaction_point_withdraw_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            64 => 
            array (
                'id' => 567,
                'name' => 'transaction_point_withdraw_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            65 => 
            array (
                'id' => 568,
                'name' => 'transaction_point_withdraw_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 82,
            ),
            66 => 
            array (
                'id' => 569,
                'name' => 'transaction_point_purchase_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            67 => 
            array (
                'id' => 570,
                'name' => 'transaction_point_purchase_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            68 => 
            array (
                'id' => 571,
                'name' => 'transaction_point_purchase_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            69 => 
            array (
                'id' => 572,
                'name' => 'transaction_point_purchase_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            70 => 
            array (
                'id' => 573,
                'name' => 'transaction_point_purchase_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 81,
            ),
            71 => 
            array (
                'id' => 574,
                'name' => 'shipped_order_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            72 => 
            array (
                'id' => 575,
                'name' => 'shipped_order_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            73 => 
            array (
                'id' => 576,
                'name' => 'shipped_order_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            74 => 
            array (
                'id' => 577,
                'name' => 'shipped_order_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            75 => 
            array (
                'id' => 578,
                'name' => 'shipped_order_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 98,
            ),
            76 => 
            array (
                'id' => 579,
                'name' => 'completed_order_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            77 => 
            array (
                'id' => 580,
                'name' => 'completed_order_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            78 => 
            array (
                'id' => 581,
                'name' => 'completed_order_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            79 => 
            array (
                'id' => 582,
                'name' => 'completed_order_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            80 => 
            array (
                'id' => 583,
                'name' => 'completed_order_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 100,
            ),
            81 => 
            array (
                'id' => 584,
                'name' => 'cancelled_order_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            82 => 
            array (
                'id' => 585,
                'name' => 'cancelled_order_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            83 => 
            array (
                'id' => 586,
                'name' => 'cancelled_order_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            84 => 
            array (
                'id' => 587,
                'name' => 'cancelled_order_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            85 => 
            array (
                'id' => 588,
                'name' => 'cancelled_order_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 99,
            ),
            86 => 
            array (
                'id' => 589,
                'name' => 'new_purchase_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 92,
            ),
            87 => 
            array (
                'id' => 590,
                'name' => 'new_purchase_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:10',
                'updated_at' => '2021-08-02 00:16:10',
                'group_id' => 92,
            ),
            88 => 
            array (
                'id' => 591,
                'name' => 'new_purchase_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 92,
            ),
            89 => 
            array (
                'id' => 592,
                'name' => 'new_purchase_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 92,
            ),
            90 => 
            array (
                'id' => 593,
                'name' => 'new_purchase_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 92,
            ),
            91 => 
            array (
                'id' => 594,
                'name' => 'verified_purchase_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            92 => 
            array (
                'id' => 595,
                'name' => 'verified_purchase_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            93 => 
            array (
                'id' => 596,
                'name' => 'verified_purchase_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            94 => 
            array (
                'id' => 597,
                'name' => 'verified_purchase_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            95 => 
            array (
                'id' => 598,
                'name' => 'verified_purchase_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 93,
            ),
            96 => 
            array (
                'id' => 599,
                'name' => 'failed_purchase_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 94,
            ),
            97 => 
            array (
                'id' => 600,
                'name' => 'failed_purchase_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 94,
            ),
            98 => 
            array (
                'id' => 601,
                'name' => 'failed_purchase_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:11',
                'updated_at' => '2021-08-02 00:16:11',
                'group_id' => 94,
            ),
            99 => 
            array (
                'id' => 602,
                'name' => 'failed_purchase_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 94,
            ),
            100 => 
            array (
                'id' => 603,
                'name' => 'failed_purchase_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 94,
            ),
            101 => 
            array (
                'id' => 604,
                'name' => 'permissions_group_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            102 => 
            array (
                'id' => 605,
                'name' => 'permissions_group_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            103 => 
            array (
                'id' => 606,
                'name' => 'permissions_group_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            104 => 
            array (
                'id' => 607,
                'name' => 'permissions_group_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            105 => 
            array (
                'id' => 608,
                'name' => 'permissions_group_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 71,
            ),
            106 => 
            array (
                'id' => 609,
                'name' => 'point_balance_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            107 => 
            array (
                'id' => 610,
                'name' => 'point_balance_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            108 => 
            array (
                'id' => 611,
                'name' => 'point_balance_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            109 => 
            array (
                'id' => 612,
                'name' => 'point_balance_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:12',
                'updated_at' => '2021-08-02 00:16:12',
                'group_id' => 31,
            ),
            110 => 
            array (
                'id' => 613,
                'name' => 'point_balance_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 31,
            ),
            111 => 
            array (
                'id' => 614,
                'name' => 'ranking_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            112 => 
            array (
                'id' => 615,
                'name' => 'ranking_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            113 => 
            array (
                'id' => 616,
                'name' => 'ranking_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            114 => 
            array (
                'id' => 617,
                'name' => 'ranking_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            115 => 
            array (
                'id' => 618,
                'name' => 'ranking_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 72,
            ),
            116 => 
            array (
                'id' => 619,
                'name' => 'bonus_join_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            117 => 
            array (
                'id' => 620,
                'name' => 'bonus_join_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            118 => 
            array (
                'id' => 621,
                'name' => 'bonus_join_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            119 => 
            array (
                'id' => 622,
                'name' => 'bonus_join_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:13',
                'updated_at' => '2021-08-02 00:16:13',
                'group_id' => 35,
            ),
            120 => 
            array (
                'id' => 623,
                'name' => 'bonus_join_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 35,
            ),
            121 => 
            array (
                'id' => 624,
                'name' => 'bonus_top_up_group_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            122 => 
            array (
                'id' => 625,
                'name' => 'bonus_top_up_group_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            123 => 
            array (
                'id' => 626,
                'name' => 'bonus_top_up_group_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            124 => 
            array (
                'id' => 627,
                'name' => 'bonus_top_up_group_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            125 => 
            array (
                'id' => 628,
                'name' => 'bonus_top_up_group_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 36,
            ),
            126 => 
            array (
                'id' => 629,
                'name' => 'bonus_top_up_personal_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 43,
            ),
            127 => 
            array (
                'id' => 630,
                'name' => 'bonus_top_up_personal_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 43,
            ),
            128 => 
            array (
                'id' => 631,
                'name' => 'bonus_top_up_personal_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:14',
                'updated_at' => '2021-08-02 00:16:14',
                'group_id' => 43,
            ),
            129 => 
            array (
                'id' => 632,
                'name' => 'bonus_top_up_personal_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 43,
            ),
            130 => 
            array (
                'id' => 633,
                'name' => 'bonus_top_up_personal_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 43,
            ),
            131 => 
            array (
                'id' => 634,
                'name' => 'transaction_agent_top_up_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            132 => 
            array (
                'id' => 635,
                'name' => 'transaction_agent_top_up_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            133 => 
            array (
                'id' => 636,
                'name' => 'transaction_agent_top_up_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            134 => 
            array (
                'id' => 637,
                'name' => 'transaction_agent_top_up_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            135 => 
            array (
                'id' => 638,
                'name' => 'transaction_agent_top_up_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 86,
            ),
            136 => 
            array (
                'id' => 639,
                'name' => 'user_agreement_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 22,
            ),
            137 => 
            array (
                'id' => 640,
                'name' => 'user_agreement_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 22,
            ),
            138 => 
            array (
                'id' => 641,
                'name' => 'user_agreement_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:15',
                'updated_at' => '2021-08-02 00:16:15',
                'group_id' => 22,
            ),
            139 => 
            array (
                'id' => 642,
                'name' => 'user_agreement_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 22,
            ),
            140 => 
            array (
                'id' => 643,
                'name' => 'user_agreement_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 22,
            ),
            141 => 
            array (
                'id' => 644,
                'name' => 'user_entry_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            142 => 
            array (
                'id' => 645,
                'name' => 'user_entry_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            143 => 
            array (
                'id' => 646,
                'name' => 'user_entry_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            144 => 
            array (
                'id' => 647,
                'name' => 'user_entry_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            145 => 
            array (
                'id' => 648,
                'name' => 'user_entry_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 112,
            ),
            146 => 
            array (
                'id' => 649,
                'name' => 'bonus_personal_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:16',
                'updated_at' => '2021-08-02 00:16:16',
                'group_id' => 38,
            ),
            147 => 
            array (
                'id' => 650,
                'name' => 'bonus_personal_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            148 => 
            array (
                'id' => 651,
                'name' => 'bonus_personal_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            149 => 
            array (
                'id' => 652,
                'name' => 'bonus_personal_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            150 => 
            array (
                'id' => 653,
                'name' => 'bonus_personal_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 38,
            ),
            151 => 
            array (
                'id' => 654,
                'name' => 'bonus_group_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            152 => 
            array (
                'id' => 655,
                'name' => 'bonus_group_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            153 => 
            array (
                'id' => 656,
                'name' => 'bonus_group_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            154 => 
            array (
                'id' => 657,
                'name' => 'bonus_group_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            155 => 
            array (
                'id' => 658,
                'name' => 'bonus_group_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:17',
                'updated_at' => '2021-08-02 00:16:17',
                'group_id' => 37,
            ),
            156 => 
            array (
                'id' => 659,
                'name' => 'point_transaction_log_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            157 => 
            array (
                'id' => 660,
                'name' => 'point_transaction_log_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            158 => 
            array (
                'id' => 661,
                'name' => 'point_transaction_log_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            159 => 
            array (
                'id' => 662,
                'name' => 'point_transaction_log_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            160 => 
            array (
                'id' => 663,
                'name' => 'point_transaction_log_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 87,
            ),
            161 => 
            array (
                'id' => 664,
                'name' => 'point_transfer_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 28,
            ),
            162 => 
            array (
                'id' => 665,
                'name' => 'other_setting_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 104,
            ),
            163 => 
            array (
                'id' => 666,
                'name' => 'bonus_ref_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:18',
                'updated_at' => '2021-08-02 00:16:18',
                'group_id' => 40,
            ),
            164 => 
            array (
                'id' => 667,
                'name' => 'bonus_ref_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            165 => 
            array (
                'id' => 668,
                'name' => 'bonus_ref_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            166 => 
            array (
                'id' => 669,
                'name' => 'bonus_ref_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            167 => 
            array (
                'id' => 670,
                'name' => 'bonus_ref_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 40,
            ),
            168 => 
            array (
                'id' => 671,
                'name' => 'bonus_restock_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            169 => 
            array (
                'id' => 672,
                'name' => 'bonus_restock_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            170 => 
            array (
                'id' => 673,
                'name' => 'bonus_restock_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            171 => 
            array (
                'id' => 674,
                'name' => 'bonus_restock_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            172 => 
            array (
                'id' => 675,
                'name' => 'bonus_restock_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:19',
                'updated_at' => '2021-08-02 00:16:19',
                'group_id' => 39,
            ),
            173 => 
            array (
                'id' => 676,
                'name' => 'bonus_annual_personal_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            174 => 
            array (
                'id' => 677,
                'name' => 'bonus_annual_personal_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            175 => 
            array (
                'id' => 678,
                'name' => 'bonus_annual_personal_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            176 => 
            array (
                'id' => 679,
                'name' => 'bonus_annual_personal_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            177 => 
            array (
                'id' => 680,
                'name' => 'bonus_annual_personal_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 44,
            ),
            178 => 
            array (
                'id' => 681,
                'name' => 'bonus_annual_group_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            179 => 
            array (
                'id' => 682,
                'name' => 'bonus_annual_group_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            180 => 
            array (
                'id' => 683,
                'name' => 'bonus_annual_group_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            181 => 
            array (
                'id' => 684,
                'name' => 'bonus_annual_group_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:20',
                'updated_at' => '2021-08-02 00:16:20',
                'group_id' => 41,
            ),
            182 => 
            array (
                'id' => 685,
                'name' => 'bonus_annual_group_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 41,
            ),
            183 => 
            array (
                'id' => 686,
                'name' => 'agreement_management_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 22,
            ),
            184 => 
            array (
                'id' => 687,
                'name' => 'agent_agreement_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            185 => 
            array (
                'id' => 688,
                'name' => 'agent_agreement_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            186 => 
            array (
                'id' => 689,
                'name' => 'agent_agreement_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            187 => 
            array (
                'id' => 690,
                'name' => 'agent_agreement_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            188 => 
            array (
                'id' => 691,
                'name' => 'agent_agreement_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 24,
            ),
            189 => 
            array (
                'id' => 692,
                'name' => 'merchant_agreement_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:21',
                'updated_at' => '2021-08-02 00:16:21',
                'group_id' => 25,
            ),
            190 => 
            array (
                'id' => 693,
                'name' => 'merchant_agreement_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            191 => 
            array (
                'id' => 694,
                'name' => 'merchant_agreement_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            192 => 
            array (
                'id' => 695,
                'name' => 'merchant_agreement_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            193 => 
            array (
                'id' => 696,
                'name' => 'merchant_agreement_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 25,
            ),
            194 => 
            array (
                'id' => 697,
                'name' => 'profile_password_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-02 00:16:22',
                'updated_at' => '2021-08-02 00:16:22',
                'group_id' => 111,
            ),
            195 => 
            array (
                'id' => 698,
                'name' => 'product_variant_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:09:08',
                'updated_at' => '2021-08-12 03:09:08',
                'group_id' => 73,
            ),
            196 => 
            array (
                'id' => 699,
                'name' => 'product_variant_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:11:24',
                'updated_at' => '2021-08-12 03:11:24',
                'group_id' => 73,
            ),
            197 => 
            array (
                'id' => 700,
                'name' => 'product_variant_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:11:37',
                'updated_at' => '2021-08-12 03:11:37',
                'group_id' => 73,
            ),
            198 => 
            array (
                'id' => 701,
                'name' => 'product_variant_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:11:48',
                'updated_at' => '2021-08-12 03:11:48',
                'group_id' => 73,
            ),
            199 => 
            array (
                'id' => 702,
                'name' => 'product_variant_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:12:03',
                'updated_at' => '2021-08-12 03:12:03',
                'group_id' => 73,
            ),
            200 => 
            array (
                'id' => 703,
                'name' => 'product_color_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:12:17',
                'updated_at' => '2021-08-12 03:12:17',
                'group_id' => 74,
            ),
            201 => 
            array (
                'id' => 704,
                'name' => 'product_color_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:12:42',
                'updated_at' => '2021-08-12 03:12:42',
                'group_id' => 74,
            ),
            202 => 
            array (
                'id' => 705,
                'name' => 'product_color_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:12:50',
                'updated_at' => '2021-08-12 03:12:50',
                'group_id' => 74,
            ),
            203 => 
            array (
                'id' => 706,
                'name' => 'product_color_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:12:57',
                'updated_at' => '2021-08-12 03:12:57',
                'group_id' => 74,
            ),
            204 => 
            array (
                'id' => 707,
                'name' => 'product_color_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:13:05',
                'updated_at' => '2021-08-12 03:13:05',
                'group_id' => 74,
            ),
            205 => 
            array (
                'id' => 708,
                'name' => 'product_size_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:13:25',
                'updated_at' => '2021-08-12 03:13:25',
                'group_id' => 75,
            ),
            206 => 
            array (
                'id' => 709,
                'name' => 'product_size_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:13:33',
                'updated_at' => '2021-08-12 03:13:33',
                'group_id' => 75,
            ),
            207 => 
            array (
                'id' => 710,
                'name' => 'product_size_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:13:42',
                'updated_at' => '2021-08-12 03:13:42',
                'group_id' => 75,
            ),
            208 => 
            array (
                'id' => 711,
                'name' => 'product_size_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:13:50',
                'updated_at' => '2021-08-12 03:13:50',
                'group_id' => 75,
            ),
            209 => 
            array (
                'id' => 712,
                'name' => 'product_size_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:13:57',
                'updated_at' => '2021-08-12 03:13:57',
                'group_id' => 75,
            ),
            210 => 
            array (
                'id' => 713,
                'name' => 'merchant_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:15:23',
                'updated_at' => '2021-08-12 03:15:23',
                'group_id' => 111,
            ),
            211 => 
            array (
                'id' => 714,
                'name' => 'agent_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:15:32',
                'updated_at' => '2021-08-12 03:15:32',
                'group_id' => 111,
            ),
            212 => 
            array (
                'id' => 715,
                'name' => 'new_top_up_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-13 03:15:32',
                'updated_at' => '2021-08-13 03:15:32',
                'group_id' => 86,
            ),
            213 => 
            array (
                'id' => 716,
                'name' => 'approved_top_up_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-13 03:15:35',
                'updated_at' => '2021-08-13 03:15:35',
                'group_id' => 86,
            ),
            214 => 
            array (
                'id' => 717,
                'name' => 'rejected_top_up_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-13 03:15:41',
                'updated_at' => '2021-08-13 03:15:41',
                'group_id' => 86,
            ),
            215 => 
            array (
                'id' => 718,
                'name' => 'cart_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:43:54',
                'updated_at' => '2021-08-16 03:43:54',
                'group_id' => 89,
            ),
            216 => 
            array (
                'id' => 719,
                'name' => 'cart_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:44:06',
                'updated_at' => '2021-08-16 03:44:06',
                'group_id' => 89,
            ),
            217 => 
            array (
                'id' => 720,
                'name' => 'cart_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:44:16',
                'updated_at' => '2021-08-16 03:44:16',
                'group_id' => 89,
            ),
            218 => 
            array (
                'id' => 721,
                'name' => 'cart_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:44:36',
                'updated_at' => '2021-08-16 03:44:36',
                'group_id' => 89,
            ),
            219 => 
            array (
                'id' => 722,
                'name' => 'cart_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:44:53',
                'updated_at' => '2021-08-16 03:44:53',
                'group_id' => 89,
            ),
            220 => 
            array (
                'id' => 723,
                'name' => 'order_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:08',
                'updated_at' => '2021-08-16 03:45:08',
                'group_id' => 96,
            ),
            221 => 
            array (
                'id' => 724,
                'name' => 'order_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:15',
                'updated_at' => '2021-08-16 03:45:15',
                'group_id' => 96,
            ),
            222 => 
            array (
                'id' => 725,
                'name' => 'order_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:24',
                'updated_at' => '2021-08-16 03:45:24',
                'group_id' => 96,
            ),
            223 => 
            array (
                'id' => 726,
                'name' => 'order_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:32',
                'updated_at' => '2021-08-16 03:45:32',
                'group_id' => 96,
            ),
            224 => 
            array (
                'id' => 727,
                'name' => 'order_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:39',
                'updated_at' => '2021-08-16 03:45:39',
                'group_id' => 96,
            ),
            225 => 
            array (
                'id' => 728,
                'name' => 'order_item_create',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:46',
                'updated_at' => '2021-08-16 03:45:46',
                'group_id' => 101,
            ),
            226 => 
            array (
                'id' => 729,
                'name' => 'order_item_edit',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:45:57',
                'updated_at' => '2021-08-16 03:45:57',
                'group_id' => 101,
            ),
            227 => 
            array (
                'id' => 730,
                'name' => 'order_item_show',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:46:07',
                'updated_at' => '2021-08-16 03:46:07',
                'group_id' => 101,
            ),
            228 => 
            array (
                'id' => 731,
                'name' => 'order_item_delete',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:46:14',
                'updated_at' => '2021-08-16 03:46:14',
                'group_id' => 101,
            ),
            229 => 
            array (
                'id' => 732,
                'name' => 'order_item_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 101,
            ),
            230 => 
            array (
                'id' => 733,
                'name' => 'bonus_self_topup_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 45,
            ),
            231 => 
            array (
                'id' => 734,
                'name' => 'bonus_self_topup_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 45,
            ),
            232 => 
            array (
                'id' => 735,
                'name' => 'bonus_self_topup_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:14',
                'updated_at' => '2021-08-16 03:46:14',
                'group_id' => 45,
            ),
            233 => 
            array (
                'id' => 736,
                'name' => 'bonus_self_topup_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 45,
            ),
            234 => 
            array (
                'id' => 737,
                'name' => 'bonus_self_topup_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 45,
            ),
            235 => 
            array (
                'id' => 738,
                'name' => 'bonus_team_topup_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 46,
            ),
            236 => 
            array (
                'id' => 739,
                'name' => 'bonus_team_topup_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 46,
            ),
            237 => 
            array (
                'id' => 740,
                'name' => 'bonus_team_topup_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:14',
                'updated_at' => '2021-08-16 03:46:14',
                'group_id' => 46,
            ),
            238 => 
            array (
                'id' => 741,
                'name' => 'bonus_team_topup_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 46,
            ),
            239 => 
            array (
                'id' => 742,
                'name' => 'bonus_team_topup_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 46,
            ),
            240 => 
            array (
                'id' => 743,
                'name' => 'point_bonus_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 42,
            ),
            241 => 
            array (
                'id' => 744,
                'name' => 'point_bonus_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 42,
            ),
            242 => 
            array (
                'id' => 745,
                'name' => 'point_bonus_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:14',
                'updated_at' => '2021-08-16 03:46:14',
                'group_id' => 42,
            ),
            243 => 
            array (
                'id' => 746,
                'name' => 'point_bonus_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 42,
            ),
            244 => 
            array (
                'id' => 747,
                'name' => 'point_bonus_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 42,
            ),
            245 => 
            array (
                'id' => 748,
                'name' => 'deposit_bank_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 59,
            ),
            246 => 
            array (
                'id' => 749,
                'name' => 'deposit_bank_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 59,
            ),
            247 => 
            array (
                'id' => 750,
                'name' => 'deposit_bank_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:14',
                'updated_at' => '2021-08-16 03:46:14',
                'group_id' => 59,
            ),
            248 => 
            array (
                'id' => 751,
                'name' => 'deposit_bank_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 59,
            ),
            249 => 
            array (
                'id' => 752,
                'name' => 'deposit_bank_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 59,
            ),
            250 => 
            array (
                'id' => 753,
                'name' => 'order_to_ship',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 96,
            ),
            251 => 
            array (
                'id' => 754,
                'name' => 'order_to_pick_up',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 96,
            ),
            252 => 
            array (
                'id' => 755,
                'name' => 'order_cancel',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 96,
            ),
            253 => 
            array (
                'id' => 756,
                'name' => 'order_complete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 96,
            ),
            254 => 
            array (
                'id' => 757,
                'name' => 'transaction_point_purchase_to_verify',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 81,
            ),
            255 => 
            array (
                'id' => 758,
                'name' => 'transaction_point_purchase_to_reject',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 81,
            ),
            256 => 
            array (
                'id' => 759,
                'name' => 'agent_top_up_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 86,
            ),
            257 => 
            array (
                'id' => 760,
                'name' => 'picked_up_order_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 96,
            ),
            258 => 
            array (
                'id' => 761,
                'name' => 'state_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 76,
            ),
            259 => 
            array (
                'id' => 762,
                'name' => 'state_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 76,
            ),
            260 => 
            array (
                'id' => 763,
                'name' => 'state_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 76,
            ),
            261 => 
            array (
                'id' => 764,
                'name' => 'state_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 76,
            ),
            262 => 
            array (
                'id' => 765,
                'name' => 'state_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:09',
                'updated_at' => '2021-08-02 00:16:09',
                'group_id' => 76,
            ),
            263 => 
            array (
                'id' => 766,
                'name' => 'transaction_point_withdraw_to_approve',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 02:19:15',
                'updated_at' => '2021-08-23 02:19:15',
                'group_id' => 82,
            ),
            264 => 
            array (
                'id' => 767,
                'name' => 'transaction_point_withdraw_to_reject',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 82,
            ),
            265 => 
            array (
                'id' => 768,
                'name' => 'shipping_fee_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 67,
            ),
            266 => 
            array (
                'id' => 769,
                'name' => 'shipping_fee_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 67,
            ),
            267 => 
            array (
                'id' => 770,
                'name' => 'shipping_fee_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 67,
            ),
            268 => 
            array (
                'id' => 771,
                'name' => 'shipping_fee_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 67,
            ),
            269 => 
            array (
                'id' => 772,
                'name' => 'shipping_fee_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 67,
            ),
            270 => 
            array (
                'id' => 773,
                'name' => 'transaction_bonus_given_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 79,
            ),
            271 => 
            array (
                'id' => 774,
                'name' => 'transaction_bonus_given_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 79,
            ),
            272 => 
            array (
                'id' => 775,
                'name' => 'transaction_bonus_given_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 79,
            ),
            273 => 
            array (
                'id' => 776,
                'name' => 'transaction_bonus_given_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 79,
            ),
            274 => 
            array (
                'id' => 777,
                'name' => 'transaction_bonus_given_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 79,
            ),
            275 => 
            array (
                'id' => 778,
                'name' => 'referral_bonus_given_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 40,
            ),
            276 => 
            array (
                'id' => 779,
                'name' => 'personal_topup_bonus_given_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 43,
            ),
            277 => 
            array (
                'id' => 780,
                'name' => 'team_topup_bonus_given_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 46,
            ),
            278 => 
            array (
                'id' => 781,
                'name' => 'personal_annual_bonus_given_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 44,
            ),
            279 => 
            array (
                'id' => 782,
                'name' => 'team_annual_bonus_given_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-16 03:46:22',
                'updated_at' => '2021-08-16 03:46:22',
                'group_id' => 41,
            ),
            280 => 
            array (
                'id' => 783,
                'name' => 'product_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 18,
            ),
            281 => 
            array (
                'id' => 784,
                'name' => 'product_color_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 20:10:11',
                'updated_at' => '2021-08-25 20:10:11',
                'group_id' => 74,
            ),
            282 => 
            array (
                'id' => 785,
                'name' => 'product_category_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 20:10:45',
                'updated_at' => '2021-08-25 20:10:45',
                'group_id' => 19,
            ),
            283 => 
            array (
                'id' => 786,
                'name' => 'product_size_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 20:11:09',
                'updated_at' => '2021-08-25 20:11:09',
                'group_id' => 75,
            ),
            284 => 
            array (
                'id' => 787,
                'name' => 'deposit_bank_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 20:11:35',
                'updated_at' => '2021-08-25 20:11:35',
                'group_id' => 59,
            ),
            285 => 
            array (
                'id' => 788,
                'name' => 'bank_list_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 20:11:57',
                'updated_at' => '2021-08-25 20:11:57',
                'group_id' => 56,
            ),
            286 => 
            array (
                'id' => 789,
                'name' => 'announcement_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 09:00:12',
                'updated_at' => '2021-08-26 09:00:12',
                'group_id' => 8,
            ),
            287 => 
            array (
                'id' => 790,
                'name' => 'banner_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 09:00:45',
                'updated_at' => '2021-08-26 09:00:45',
                'group_id' => 9,
            ),
            288 => 
            array (
                'id' => 791,
                'name' => 'shipping_fee_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 11:30:11',
                'updated_at' => '2021-08-26 11:30:11',
                'group_id' => 67,
            ),
            289 => 
            array (
                'id' => 792,
                'name' => 'point_package_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 11:30:47',
                'updated_at' => '2021-08-26 11:30:47',
                'group_id' => 29,
            ),
            290 => 
            array (
                'id' => 793,
                'name' => 'country_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:30:08',
                'updated_at' => '2021-08-26 14:30:08',
                'group_id' => 48,
            ),
            291 => 
            array (
                'id' => 794,
                'name' => 'state_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:30:56',
                'updated_at' => '2021-08-26 14:30:56',
                'group_id' => 76,
            ),
            292 => 
            array (
                'id' => 795,
                'name' => 'language_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:33:29',
                'updated_at' => '2021-08-26 14:33:29',
                'group_id' => 16,
            ),
            293 => 
            array (
                'id' => 796,
                'name' => 'payment_method_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:33:57',
                'updated_at' => '2021-08-26 14:33:57',
                'group_id' => 108,
            ),
            294 => 
            array (
                'id' => 797,
                'name' => 'shipping_company_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 32,
            ),
            295 => 
            array (
                'id' => 798,
                'name' => 'voucher_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 51,
            ),
            296 => 
            array (
                'id' => 799,
                'name' => 'voucher_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 51,
            ),
            297 => 
            array (
                'id' => 800,
                'name' => 'voucher_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 51,
            ),
            298 => 
            array (
                'id' => 801,
                'name' => 'voucher_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 51,
            ),
            299 => 
            array (
                'id' => 802,
                'name' => 'voucher_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 51,
            ),
            300 => 
            array (
                'id' => 803,
                'name' => 'shipping_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 107,
            ),
            301 => 
            array (
                'id' => 804,
                'name' => 'shipping_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 107,
            ),
            302 => 
            array (
                'id' => 805,
                'name' => 'shipping_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-26 14:40:02',
                'updated_at' => '2021-08-26 14:40:02',
                'group_id' => 107,
            ),
            303 => 
            array (
                'id' => 806,
                'name' => 'shipping_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 107,
            ),
            304 => 
            array (
                'id' => 807,
                'name' => 'shipping_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 107,
            ),
            305 => 
            array (
                'id' => 808,
                'name' => 'user_agreement_log_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 23,
            ),
            306 => 
            array (
                'id' => 809,
                'name' => 'user_agreement_log_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 23,
            ),
            307 => 
            array (
                'id' => 810,
                'name' => 'user_agreement_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 23,
            ),
            308 => 
            array (
                'id' => 811,
                'name' => 'user_agreement_log_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 23,
            ),
            309 => 
            array (
                'id' => 812,
                'name' => 'user_agreement_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 23,
            ),
            310 => 
            array (
                'id' => 813,
                'name' => 'discount_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 68,
            ),
            311 => 
            array (
                'id' => 814,
                'name' => 'discount_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 68,
            ),
            312 => 
            array (
                'id' => 815,
                'name' => 'discount_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 68,
            ),
            313 => 
            array (
                'id' => 816,
                'name' => 'discount_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 68,
            ),
            314 => 
            array (
                'id' => 817,
                'name' => 'discount_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 68,
            ),
            315 => 
            array (
                'id' => 818,
                'name' => 'user_upgrade_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 14,
            ),
            316 => 
            array (
                'id' => 819,
                'name' => 'user_upgrade_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 14,
            ),
            317 => 
            array (
                'id' => 820,
                'name' => 'user_upgrade_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 14,
            ),
            318 => 
            array (
                'id' => 821,
                'name' => 'user_upgrade_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 14,
            ),
            319 => 
            array (
                'id' => 822,
                'name' => 'user_upgrade_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 14,
            ),
            320 => 
            array (
                'id' => 823,
                'name' => 'shipping_package_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 90,
            ),
            321 => 
            array (
                'id' => 824,
                'name' => 'shipping_package_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 90,
            ),
            322 => 
            array (
                'id' => 825,
                'name' => 'shipping_package_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 90,
            ),
            323 => 
            array (
                'id' => 826,
                'name' => 'shipping_package_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 90,
            ),
            324 => 
            array (
                'id' => 827,
                'name' => 'shipping_package_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 90,
            ),
            325 => 
            array (
                'id' => 828,
                'name' => 'transaction_shipping_purchase_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 80,
            ),
            326 => 
            array (
                'id' => 829,
                'name' => 'transaction_shipping_purchase_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 80,
            ),
            327 => 
            array (
                'id' => 830,
                'name' => 'transaction_shipping_purchase_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 80,
            ),
            328 => 
            array (
                'id' => 831,
                'name' => 'transaction_shipping_purchase_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 80,
            ),
            329 => 
            array (
                'id' => 832,
                'name' => 'transaction_shipping_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-25 14:38:43',
                'updated_at' => '2021-08-25 14:38:43',
                'group_id' => 80,
            ),
            330 => 
            array (
                'id' => 833,
                'name' => 'transaction_shipping_purchase_to_verify',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 80,
            ),
            331 => 
            array (
                'id' => 834,
                'name' => 'transaction_shipping_purchase_to_reject',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 80,
            ),
            332 => 
            array (
                'id' => 835,
                'name' => 'new_shipping_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 80,
            ),
            333 => 
            array (
                'id' => 836,
                'name' => 'verified_shipping_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 80,
            ),
            334 => 
            array (
                'id' => 837,
                'name' => 'failed_shipping_purchase_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 80,
            ),
            335 => 
            array (
                'id' => 838,
                'name' => 'product_batch_in_stock',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 20,
            ),
            336 => 
            array (
                'id' => 839,
                'name' => 'product_quantity_in_stock',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 21,
            ),
            337 => 
            array (
                'id' => 840,
                'name' => 'product_batch_generate_qr',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 20,
            ),
            338 => 
            array (
                'id' => 841,
                'name' => 'product_quantity_generate_qr',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 21,
            ),
            339 => 
            array (
                'id' => 842,
                'name' => 'product_quantity_damage',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 21,
            ),
            340 => 
            array (
                'id' => 843,
                'name' => 'point_manager_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 106,
            ),
            341 => 
            array (
                'id' => 844,
                'name' => 'point_manager_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 106,
            ),
            342 => 
            array (
                'id' => 845,
                'name' => 'point_manager_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 106,
            ),
            343 => 
            array (
                'id' => 846,
                'name' => 'point_manager_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 106,
            ),
            344 => 
            array (
                'id' => 847,
                'name' => 'point_manager_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 106,
            ),
            345 => 
            array (
                'id' => 848,
                'name' => 'point_executive_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 105,
            ),
            346 => 
            array (
                'id' => 849,
                'name' => 'point_executive_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 105,
            ),
            347 => 
            array (
                'id' => 850,
                'name' => 'point_executive_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 105,
            ),
            348 => 
            array (
                'id' => 851,
                'name' => 'point_executive_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 105,
            ),
            349 => 
            array (
                'id' => 852,
                'name' => 'point_executive_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 105,
            ),
            350 => 
            array (
                'id' => 853,
                'name' => 'bonus_setting_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 104,
            ),
            351 => 
            array (
                'id' => 854,
                'name' => 'pick_up_location_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 69,
            ),
            352 => 
            array (
                'id' => 855,
                'name' => 'pick_up_location_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 69,
            ),
            353 => 
            array (
                'id' => 856,
                'name' => 'pick_up_location_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 69,
            ),
            354 => 
            array (
                'id' => 857,
                'name' => 'pick_up_location_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 69,
            ),
            355 => 
            array (
                'id' => 858,
                'name' => 'pick_up_location_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 69,
            ),
            356 => 
            array (
                'id' => 859,
                'name' => 'user_status_change',
                'guard_name' => 'admin',
                'created_at' => '2021-09-18 21:16:09',
                'updated_at' => '2021-09-18 21:17:01',
                'group_id' => 111,
            ),
            357 => 
            array (
                'id' => 860,
                'name' => 'user_account_verify',
                'guard_name' => 'admin',
                'created_at' => '2021-09-18 21:20:14',
                'updated_at' => '2021-09-18 21:20:14',
                'group_id' => 111,
            ),
            358 => 
            array (
                'id' => 861,
                'name' => 'user_ssm_verify',
                'guard_name' => 'admin',
                'created_at' => '2021-09-18 21:20:31',
                'updated_at' => '2021-09-18 21:20:31',
                'group_id' => 111,
            ),
            359 => 
            array (
                'id' => 862,
                'name' => 'user_first_payment_verify',
                'guard_name' => 'admin',
                'created_at' => '2021-09-18 21:20:45',
                'updated_at' => '2021-09-18 21:20:45',
                'group_id' => 111,
            ),
            360 => 
            array (
                'id' => 863,
                'name' => 'user_shop_verify',
                'guard_name' => 'admin',
                'created_at' => '2021-09-18 21:20:57',
                'updated_at' => '2021-09-18 21:20:57',
                'group_id' => 111,
            ),
            361 => 
            array (
                'id' => 864,
                'name' => 'transaction_point_withdraw_export',
                'guard_name' => 'admin',
                'created_at' => '2021-08-23 03:09:21',
                'updated_at' => '2021-08-23 03:09:21',
                'group_id' => 82,
            ),
            362 => 
            array (
                'id' => 865,
                'name' => 'withdraw_excel_create',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:37:44',
                'updated_at' => '2021-09-19 22:37:44',
                'group_id' => 109,
            ),
            363 => 
            array (
                'id' => 866,
                'name' => 'withdraw_excel_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:38:02',
                'updated_at' => '2021-09-19 22:38:02',
                'group_id' => 109,
            ),
            364 => 
            array (
                'id' => 867,
                'name' => 'withdraw_excel_show',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:38:21',
                'updated_at' => '2021-09-19 22:38:21',
                'group_id' => 109,
            ),
            365 => 
            array (
                'id' => 868,
                'name' => 'withdraw_excel_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:38:34',
                'updated_at' => '2021-09-19 22:38:34',
                'group_id' => 109,
            ),
            366 => 
            array (
                'id' => 869,
                'name' => 'withdraw_excel_access',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:38:45',
                'updated_at' => '2021-09-19 22:38:45',
                'group_id' => 109,
            ),
            367 => 
            array (
                'id' => 870,
                'name' => 'voucher_log_create',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:42:33',
                'updated_at' => '2021-09-19 22:42:33',
                'group_id' => 110,
            ),
            368 => 
            array (
                'id' => 871,
                'name' => 'voucher_log_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:42:43',
                'updated_at' => '2021-09-19 22:42:43',
                'group_id' => 110,
            ),
            369 => 
            array (
                'id' => 872,
                'name' => 'voucher_log_show',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:42:55',
                'updated_at' => '2021-09-19 22:42:55',
                'group_id' => 110,
            ),
            370 => 
            array (
                'id' => 873,
                'name' => 'voucher_log_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:43:11',
                'updated_at' => '2021-09-19 22:43:11',
                'group_id' => 110,
            ),
            371 => 
            array (
                'id' => 874,
                'name' => 'voucher_log_access',
                'guard_name' => 'admin',
                'created_at' => '2021-09-19 22:43:25',
                'updated_at' => '2021-09-19 22:43:25',
                'group_id' => 110,
            ),

            372 => 
            array (
                'id' => 875,
                'name' => 'cash_voucher_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 113,
            ),
            373 => 
            array (
                'id' => 876,
                'name' => 'cash_voucher_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 113,
            ),
            374 => 
            array (
                'id' => 877,
                'name' => 'cash_voucher_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 113,
            ),
            375 => 
            array (
                'id' => 878,
                'name' => 'cash_voucher_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 113,
            ),
            376 => 
            array (
                'id' => 879,
                'name' => 'cash_voucher_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 113,
            ),

            377 => 
            array (
                'id' => 880,
                'name' => 'pv_balance_create',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 114,
            ),
            378 => 
            array (
                'id' => 881,
                'name' => 'pv_balance_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 114,
            ),
            379 => 
            array (
                'id' => 882,
                'name' => 'pv_balance_show',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 114,
            ),
            380 => 
            array (
                'id' => 883,
                'name' => 'pv_balance_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 114,
            ),
            381 => 
            array (
                'id' => 884,
                'name' => 'pv_balance_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-02 00:16:00',
                'updated_at' => '2021-08-02 00:16:00',
                'group_id' => 114,
            ),
            382 => 
            array (
                'id' => 885,
                'name' => 'bonus_vip_create',
                'guard_name' => 'admin',
                'created_at' => '2021-12-31 00:16:00',
                'updated_at' => '2021-12-31 00:16:00',
                'group_id' => 115,
            ),
            383 => 
            array (
                'id' => 886,
                'name' => 'bonus_vip_edit',
                'guard_name' => 'admin',
                'created_at' => '2021-12-31 00:16:00',
                'updated_at' => '2021-12-31 00:16:00',
                'group_id' => 115,
            ),
            384 => 
            array (
                'id' => 887,
                'name' => 'bonus_vip_show',
                'guard_name' => 'admin',
                'created_at' => '2021-12-31 00:16:00',
                'updated_at' => '2021-12-31 00:16:00',
                'group_id' => 115,
            ),
            385 => 
            array (
                'id' => 888,
                'name' => 'bonus_vip_delete',
                'guard_name' => 'admin',
                'created_at' => '2021-12-31 00:16:00',
                'updated_at' => '2021-12-31 00:16:00',
                'group_id' => 115,
            ),
            386 => 
            array (
                'id' => 889,
                'name' => 'bonus_vip_access',
                'guard_name' => 'admin',
                'created_at' => '2021-12-31 00:16:00',
                'updated_at' => '2021-12-31 00:16:00',
                'group_id' => 115,
            ),
            387 => 
            array (
                'id' => 890,
                'name' => 'vip_access',
                'guard_name' => 'admin',
                'created_at' => '2021-08-12 03:15:23',
                'updated_at' => '2021-08-12 03:15:23',
                'group_id' => 111,
            ),
            388 => 
            array (
                'id' => 891,
                'name' => 'vip_access',
                'guard_name' => 'user',
                'created_at' => '2021-08-12 03:15:23',
                'updated_at' => '2021-08-12 03:15:23',
                'group_id' => 111,
            ),
        ));
        
        
    }
}