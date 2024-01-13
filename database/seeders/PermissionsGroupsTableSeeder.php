<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions_groups')->delete();
        
        \DB::table('permissions_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'user_management',
                'created_at' => '2021-09-14 15:47:14',
                'updated_at' => '2021-09-14 15:47:14',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'point_purchase',
                'created_at' => '2021-09-14 15:47:40',
                'updated_at' => '2021-09-14 15:47:40',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'point_withdraw',
                'created_at' => '2021-09-14 15:48:09',
                'updated_at' => '2021-09-14 15:48:09',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'admin_management',
                'created_at' => '2021-09-14 15:48:48',
                'updated_at' => '2021-09-14 15:48:48',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'admins',
                'created_at' => '2021-09-14 15:49:05',
                'updated_at' => '2021-09-14 15:49:05',
                'deleted_at' => NULL,
                'parent_id' => 4,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'product_management',
                'created_at' => '2021-09-14 15:51:54',
                'updated_at' => '2021-09-14 15:51:54',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'app_settings',
                'created_at' => '2021-09-14 16:09:16',
                'updated_at' => '2021-09-14 16:09:16',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'announcements',
                'created_at' => '2021-09-14 16:10:03',
                'updated_at' => '2021-09-14 16:10:03',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'banners',
                'created_at' => '2021-09-14 16:10:17',
                'updated_at' => '2021-09-14 16:10:17',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'agreement_management',
                'created_at' => '2021-09-14 19:26:33',
                'updated_at' => '2021-09-14 19:26:45',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'enquiry_management',
                'created_at' => '2021-09-14 19:47:41',
                'updated_at' => '2021-09-14 19:47:41',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'enquiries',
                'created_at' => '2021-09-14 19:47:42',
                'updated_at' => '2021-09-14 19:47:42',
                'deleted_at' => NULL,
                'parent_id' => 11,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'enquiry_replies',
                'created_at' => '2021-09-14 19:48:00',
                'updated_at' => '2021-09-14 19:48:00',
                'deleted_at' => NULL,
                'parent_id' => 11,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'user_upgrade',
                'created_at' => '2021-09-14 19:53:45',
                'updated_at' => '2021-09-14 19:53:45',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'system_variables',
                'created_at' => '2021-09-14 20:04:37',
                'updated_at' => '2021-09-14 20:04:37',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'languages',
                'created_at' => '2021-09-14 20:08:05',
                'updated_at' => '2021-09-14 20:08:05',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'product_qr',
                'created_at' => '2021-09-14 23:37:32',
                'updated_at' => '2021-09-14 23:37:32',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'products',
                'created_at' => '2021-09-14 23:37:50',
                'updated_at' => '2021-09-14 23:37:50',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'product_categories',
                'created_at' => '2021-09-14 23:37:52',
                'updated_at' => '2021-09-14 23:37:52',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'product_batches',
                'created_at' => '2021-09-14 23:41:08',
                'updated_at' => '2021-09-14 23:41:08',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'product_quantities',
                'created_at' => '2021-09-14 23:41:53',
                'updated_at' => '2021-09-14 23:41:53',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'user_agreements',
                'created_at' => '2021-09-14 23:42:33',
                'updated_at' => '2021-09-14 23:42:33',
                'deleted_at' => NULL,
                'parent_id' => 10,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'user_agreement_logs',
                'created_at' => '2021-09-14 23:52:04',
                'updated_at' => '2021-09-14 23:52:04',
                'deleted_at' => NULL,
                'parent_id' => 10,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'agent_agreements',
                'created_at' => '2021-09-14 23:57:40',
                'updated_at' => '2021-09-14 23:57:40',
                'deleted_at' => NULL,
                'parent_id' => 10,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'merchant_agreements',
                'created_at' => '2021-09-14 23:58:00',
                'updated_at' => '2021-09-14 23:58:00',
                'deleted_at' => NULL,
                'parent_id' => 10,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'address_books',
                'created_at' => '2021-09-15 00:48:01',
                'updated_at' => '2021-09-15 00:48:01',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'point_management',
                'created_at' => '2021-09-15 00:49:48',
                'updated_at' => '2021-09-15 00:49:48',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'points',
                'created_at' => '2021-09-15 00:49:54',
                'updated_at' => '2021-09-15 00:50:06',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'point_packages',
                'created_at' => '2021-09-15 00:53:49',
                'updated_at' => '2021-09-15 00:53:49',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'point_convert',
                'created_at' => '2021-09-15 00:56:02',
                'updated_at' => '2021-09-15 00:56:02',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'point_balance',
                'created_at' => '2021-09-15 00:58:32',
                'updated_at' => '2021-09-15 00:58:32',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'shipping_company',
                'created_at' => '2021-09-15 00:58:50',
                'updated_at' => '2021-09-15 00:58:50',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'point_bonus',
                'created_at' => '2021-09-15 01:03:39',
                'updated_at' => '2021-09-15 01:03:39',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'bonus_management',
                'created_at' => '2021-09-15 01:03:52',
                'updated_at' => '2021-09-15 01:03:52',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'bonus_join',
                'created_at' => '2021-09-15 01:04:19',
                'updated_at' => '2021-09-15 01:04:19',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'top_up_bonus_group',
                'created_at' => '2021-09-15 01:04:32',
                'updated_at' => '2021-09-15 12:00:46',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'group_bonus',
                'created_at' => '2021-09-15 01:05:01',
                'updated_at' => '2021-09-15 11:57:23',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'personal_bonus',
                'created_at' => '2021-09-15 01:05:13',
                'updated_at' => '2021-09-15 11:57:38',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'restock_bonus',
                'created_at' => '2021-09-15 01:11:45',
                'updated_at' => '2021-09-15 11:57:53',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'referral_bonus',
                'created_at' => '2021-09-15 01:12:40',
                'updated_at' => '2021-09-15 11:58:04',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'annual_bonus_group',
                'created_at' => '2021-09-15 01:14:58',
                'updated_at' => '2021-09-15 11:59:23',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'point_bonus_balance',
                'created_at' => '2021-09-15 01:19:45',
                'updated_at' => '2021-09-15 01:19:45',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'top_up_bonus_personal',
                'created_at' => '2021-09-15 11:59:09',
                'updated_at' => '2021-09-15 12:00:33',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'annual_bonus_personal',
                'created_at' => '2021-09-15 11:59:44',
                'updated_at' => '2021-09-15 11:59:44',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'top_up_bonus_self',
                'created_at' => '2021-09-15 12:00:13',
                'updated_at' => '2021-09-15 12:00:13',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'top_up_bonus_team',
                'created_at' => '2021-09-15 12:01:11',
                'updated_at' => '2021-09-15 12:01:11',
                'deleted_at' => NULL,
                'parent_id' => 34,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'transaction_management',
                'created_at' => '2021-09-15 12:05:51',
                'updated_at' => '2021-09-15 12:05:51',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'countries',
                'created_at' => '2021-09-15 12:08:14',
                'updated_at' => '2021-09-15 12:08:14',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'voucher_management',
                'created_at' => '2021-09-15 12:11:31',
                'updated_at' => '2021-09-15 12:11:31',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'vouchers',
                'created_at' => '2021-09-15 12:11:45',
                'updated_at' => '2021-09-15 12:11:45',
                'deleted_at' => NULL,
                'parent_id' => 49,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'voucher_balance',
                'created_at' => '2021-09-15 12:12:00',
                'updated_at' => '2021-09-15 12:12:00',
                'deleted_at' => NULL,
                'parent_id' => 49,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'role_and_permission_management',
                'created_at' => '2021-09-15 12:16:52',
                'updated_at' => '2021-09-15 12:18:11',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'roles',
                'created_at' => '2021-09-15 12:17:26',
                'updated_at' => '2021-09-15 12:17:26',
                'deleted_at' => NULL,
                'parent_id' => 52,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'permissions',
                'created_at' => '2021-09-15 12:17:43',
                'updated_at' => '2021-09-15 12:17:54',
                'deleted_at' => NULL,
                'parent_id' => 52,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'audit_logs',
                'created_at' => '2021-09-15 12:20:17',
                'updated_at' => '2021-09-15 12:20:17',
                'deleted_at' => NULL,
                'parent_id' => 4,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'bank_lists',
                'created_at' => '2021-09-15 12:21:20',
                'updated_at' => '2021-09-15 12:21:20',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'payout_limit',
                'created_at' => '2021-09-15 12:21:37',
                'updated_at' => '2021-09-15 12:21:37',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'report_management',
                'created_at' => '2021-09-15 12:22:43',
                'updated_at' => '2021-09-15 12:22:43',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'deposit_banks',
                'created_at' => '2021-09-15 12:26:04',
                'updated_at' => '2021-09-15 12:26:04',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'product_details',
                'created_at' => '2021-09-15 12:27:16',
                'updated_at' => '2021-09-15 12:27:16',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'total_revenue',
                'created_at' => '2021-09-15 12:27:52',
                'updated_at' => '2021-09-15 12:27:52',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'total_redemption',
                'created_at' => '2021-09-15 12:28:09',
                'updated_at' => '2021-09-15 12:28:09',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'total_point_balance',
                'created_at' => '2021-09-15 12:28:35',
                'updated_at' => '2021-09-15 12:28:35',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'commission',
                'created_at' => '2021-09-15 12:29:00',
                'updated_at' => '2021-09-15 12:29:00',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'company_profit_loss',
                'created_at' => '2021-09-15 12:34:40',
                'updated_at' => '2021-09-15 12:34:40',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'material',
                'created_at' => '2021-09-15 12:39:12',
                'updated_at' => '2021-09-15 12:39:12',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'shipping_fee',
                'created_at' => '2021-09-15 12:39:26',
                'updated_at' => '2021-09-15 12:39:26',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'discount',
                'created_at' => '2021-09-15 12:39:42',
                'updated_at' => '2021-09-15 12:39:42',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'pick_up_location',
                'created_at' => '2021-09-15 12:42:40',
                'updated_at' => '2021-09-15 12:42:40',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'reports',
                'created_at' => '2021-09-15 12:45:30',
                'updated_at' => '2021-09-15 12:45:30',
                'deleted_at' => NULL,
                'parent_id' => 58,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'permission_groups',
                'created_at' => '2021-09-15 12:47:23',
                'updated_at' => '2021-09-15 12:47:23',
                'deleted_at' => NULL,
                'parent_id' => 52,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'ranking',
                'created_at' => '2021-09-15 12:48:20',
                'updated_at' => '2021-09-15 12:48:20',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'product_variant',
                'created_at' => '2021-09-15 12:49:58',
                'updated_at' => '2021-09-15 12:49:58',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'product_color',
                'created_at' => '2021-09-15 12:50:18',
                'updated_at' => '2021-09-15 12:50:18',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'product_size',
                'created_at' => '2021-09-15 12:50:32',
                'updated_at' => '2021-09-15 12:50:32',
                'deleted_at' => NULL,
                'parent_id' => 6,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'state',
                'created_at' => '2021-09-15 12:53:32',
                'updated_at' => '2021-09-15 12:53:32',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'shipping_point_management',
                'created_at' => '2021-09-15 12:58:38',
                'updated_at' => '2021-09-15 12:58:38',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'personal_code_log',
                'created_at' => '2021-09-15 13:21:23',
                'updated_at' => '2021-09-15 13:21:23',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'transaction_bonus_given',
                'created_at' => '2021-09-15 14:10:39',
                'updated_at' => '2021-09-15 14:10:39',
                'deleted_at' => NULL,
                'parent_id' => 47,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'shipping_purchase',
                'created_at' => '2021-09-15 14:12:21',
                'updated_at' => '2021-09-15 14:12:21',
                'deleted_at' => NULL,
                'parent_id' => 77,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'point_purchases',
                'created_at' => '2021-09-15 14:13:53',
                'updated_at' => '2021-09-15 14:13:53',
                'deleted_at' => NULL,
                'parent_id' => 2,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'point_withdraws',
                'created_at' => '2021-09-15 14:14:10',
                'updated_at' => '2021-09-15 14:14:10',
                'deleted_at' => NULL,
                'parent_id' => 3,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'product_redemption',
                'created_at' => '2021-09-15 14:14:44',
                'updated_at' => '2021-09-15 14:14:44',
                'deleted_at' => NULL,
                'parent_id' => 47,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'transaction_id_log',
                'created_at' => '2021-09-15 14:19:24',
                'updated_at' => '2021-09-15 14:19:24',
                'deleted_at' => NULL,
                'parent_id' => 47,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'transaction_bonus',
                'created_at' => '2021-09-15 14:20:38',
                'updated_at' => '2021-09-15 14:20:38',
                'deleted_at' => NULL,
                'parent_id' => 47,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'agent_top_up',
                'created_at' => '2021-09-15 14:24:02',
                'updated_at' => '2021-09-15 14:24:02',
                'deleted_at' => NULL,
                'parent_id' => 47,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'point_transaction_log',
                'created_at' => '2021-09-15 14:27:03',
                'updated_at' => '2021-09-15 14:27:03',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'cart_management',
                'created_at' => '2021-09-15 14:30:43',
                'updated_at' => '2021-09-15 14:30:43',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'carts',
                'created_at' => '2021-09-15 14:31:06',
                'updated_at' => '2021-09-15 14:31:06',
                'deleted_at' => NULL,
                'parent_id' => 88,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'shipping_package',
                'created_at' => '2021-09-15 14:31:08',
                'updated_at' => '2021-09-15 14:31:08',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            90 => 
            array (
                'id' => 92,
                'name' => 'new_purchase',
                'created_at' => '2021-09-15 15:09:53',
                'updated_at' => '2021-09-15 15:09:53',
                'deleted_at' => NULL,
                'parent_id' => 2,
            ),
            91 => 
            array (
                'id' => 93,
                'name' => 'verified_purchase',
                'created_at' => '2021-09-15 15:10:18',
                'updated_at' => '2021-09-15 15:10:18',
                'deleted_at' => NULL,
                'parent_id' => 2,
            ),
            92 => 
            array (
                'id' => 94,
                'name' => 'failed_purchase',
                'created_at' => '2021-09-15 15:10:36',
                'updated_at' => '2021-09-15 15:10:36',
                'deleted_at' => NULL,
                'parent_id' => 2,
            ),
            93 => 
            array (
                'id' => 95,
                'name' => 'order_management',
                'created_at' => '2021-09-15 15:14:26',
                'updated_at' => '2021-09-15 15:14:26',
                'deleted_at' => NULL,
                'parent_id' => NULL,
            ),
            94 => 
            array (
                'id' => 96,
                'name' => 'orders',
                'created_at' => '2021-09-15 15:14:41',
                'updated_at' => '2021-09-15 15:14:41',
                'deleted_at' => NULL,
                'parent_id' => 95,
            ),
            95 => 
            array (
                'id' => 97,
                'name' => 'new_order',
                'created_at' => '2021-09-15 15:15:00',
                'updated_at' => '2021-09-15 15:15:00',
                'deleted_at' => NULL,
                'parent_id' => 95,
            ),
            96 => 
            array (
                'id' => 98,
                'name' => 'shipped_order',
                'created_at' => '2021-09-15 15:15:28',
                'updated_at' => '2021-09-15 15:15:28',
                'deleted_at' => NULL,
                'parent_id' => 95,
            ),
            97 => 
            array (
                'id' => 99,
                'name' => 'cancelled_order',
                'created_at' => '2021-09-15 15:15:50',
                'updated_at' => '2021-09-15 15:15:50',
                'deleted_at' => NULL,
                'parent_id' => 95,
            ),
            98 => 
            array (
                'id' => 100,
                'name' => 'completed_order',
                'created_at' => '2021-09-15 15:16:18',
                'updated_at' => '2021-09-15 15:16:18',
                'deleted_at' => NULL,
                'parent_id' => 95,
            ),
            99 => 
            array (
                'id' => 101,
                'name' => 'order_item',
                'created_at' => '2021-09-15 15:19:38',
                'updated_at' => '2021-09-15 15:19:38',
                'deleted_at' => NULL,
                'parent_id' => 95,
            ),
            100 => 
            array (
                'id' => 102,
                'name' => 'otp_log',
                'created_at' => '2021-09-15 15:53:48',
                'updated_at' => '2021-09-15 15:53:48',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            101 => 
            array (
                'id' => 104,
                'name' => 'setting_access',
                'created_at' => '2021-09-15 15:58:34',
                'updated_at' => '2021-09-15 15:58:34',
                'deleted_at' => NULL,
                'parent_id' => 7,
            ),
            102 => 
            array (
                'id' => 105,
                'name' => 'point_executive_balance',
                'created_at' => '2021-09-15 16:03:11',
                'updated_at' => '2021-09-15 16:03:11',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            103 => 
            array (
                'id' => 106,
                'name' => 'point_manager_balance',
                'created_at' => '2021-09-15 16:03:31',
                'updated_at' => '2021-09-15 16:03:31',
                'deleted_at' => NULL,
                'parent_id' => 27,
            ),
            104 => 
            array (
                'id' => 107,
                'name' => 'shipping_balance',
                'created_at' => '2021-09-15 16:10:48',
                'updated_at' => '2021-09-15 16:10:48',
                'deleted_at' => NULL,
                'parent_id' => 77,
            ),
            105 => 
            array (
                'id' => 108,
                'name' => 'payment_methods',
                'created_at' => '2021-09-15 16:11:07',
                'updated_at' => '2021-09-15 16:21:40',
                'deleted_at' => NULL,
                'parent_id' => 15,
            ),
            106 => 
            array (
                'id' => 109,
                'name' => 'withdraw_excel',
                'created_at' => '2021-09-15 16:11:07',
                'updated_at' => '2021-09-15 16:21:40',
                'deleted_at' => NULL,
                'parent_id' => 3,
            ),
            107 => 
            array (
                'id' => 110,
                'name' => 'voucher_log',
                'created_at' => '2021-09-15 16:11:07',
                'updated_at' => '2021-09-15 16:21:40',
                'deleted_at' => NULL,
                'parent_id' => 49,
            ),
            108 => 
            array (
                'id' => 111,
                'name' => 'users',
                'created_at' => '2021-09-23 12:11:25',
                'updated_at' => '2021-09-23 12:11:25',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            109 => 
            array (
                'id' => 112,
                'name' => 'user_entry',
                'created_at' => '2021-09-23 12:11:52',
                'updated_at' => '2021-09-23 12:11:52',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            110 => 
            array (
                'id' => 113,
                'name' => 'cash_voucher_balance',
                'created_at' => '2021-09-23 12:11:52',
                'updated_at' => '2021-09-23 12:11:52',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            111 => 
            array (
                'id' => 114,
                'name' => 'pv_balance',
                'created_at' => '2021-09-23 12:11:52',
                'updated_at' => '2021-09-23 12:11:52',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
            112 => 
            array (
                'id' => 115,
                'name' => 'vip_bonus',
                'created_at' => '2021-09-23 12:11:52',
                'updated_at' => '2021-09-23 12:11:52',
                'deleted_at' => NULL,
                'parent_id' => 1,
            ),
        ));
        
        
    }
}