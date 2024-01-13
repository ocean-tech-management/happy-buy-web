<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Afghanistan',
                'short_code' => 'af',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Albania',
                'short_code' => 'al',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Algeria',
                'short_code' => 'dz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'American Samoa',
                'short_code' => 'as',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Andorra',
                'short_code' => 'ad',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Angola',
                'short_code' => 'ao',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Anguilla',
                'short_code' => 'ai',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Antarctica',
                'short_code' => 'aq',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Antigua and Barbuda',
                'short_code' => 'ag',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Argentina',
                'short_code' => 'ar',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Armenia',
                'short_code' => 'am',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Aruba',
                'short_code' => 'aw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Australia',
                'short_code' => 'au',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Austria',
                'short_code' => 'at',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Azerbaijan',
                'short_code' => 'az',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Bahamas',
                'short_code' => 'bs',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Bahrain',
                'short_code' => 'bh',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Bangladesh',
                'short_code' => 'bd',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Barbados',
                'short_code' => 'bb',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Belarus',
                'short_code' => 'by',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Belgium',
                'short_code' => 'be',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Belize',
                'short_code' => 'bz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Benin',
                'short_code' => 'bj',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Bermuda',
                'short_code' => 'bm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Bhutan',
                'short_code' => 'bt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Bolivia',
                'short_code' => 'bo',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Bosnia and Herzegovina',
                'short_code' => 'ba',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Botswana',
                'short_code' => 'bw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Brazil',
                'short_code' => 'br',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'British Indian Ocean Territory',
                'short_code' => 'io',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'British Virgin Islands',
                'short_code' => 'vg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Brunei',
                'short_code' => 'bn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Bulgaria',
                'short_code' => 'bg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Burkina Faso',
                'short_code' => 'bf',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Burundi',
                'short_code' => 'bi',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Cambodia',
                'short_code' => 'kh',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Cameroon',
                'short_code' => 'cm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Canada',
                'short_code' => 'ca',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Cape Verde',
                'short_code' => 'cv',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Cayman Islands',
                'short_code' => 'ky',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Central African Republic',
                'short_code' => 'cf',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Chad',
                'short_code' => 'td',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Chile',
                'short_code' => 'cl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'China',
                'short_code' => 'cn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Christmas Island',
                'short_code' => 'cx',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Cocos Islands',
                'short_code' => 'cc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Colombia',
                'short_code' => 'co',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Comoros',
                'short_code' => 'km',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Cook Islands',
                'short_code' => 'ck',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Costa Rica',
                'short_code' => 'cr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Croatia',
                'short_code' => 'hr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Cuba',
                'short_code' => 'cu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Curacao',
                'short_code' => 'cw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Cyprus',
                'short_code' => 'cy',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Czech Republic',
                'short_code' => 'cz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Democratic Republic of the Congo',
                'short_code' => 'cd',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Denmark',
                'short_code' => 'dk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Djibouti',
                'short_code' => 'dj',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Dominica',
                'short_code' => 'dm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Dominican Republic',
                'short_code' => 'do',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'East Timor',
                'short_code' => 'tl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Ecuador',
                'short_code' => 'ec',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Egypt',
                'short_code' => 'eg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'El Salvador',
                'short_code' => 'sv',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Equatorial Guinea',
                'short_code' => 'gq',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Eritrea',
                'short_code' => 'er',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Estonia',
                'short_code' => 'ee',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Ethiopia',
                'short_code' => 'et',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Falkland Islands',
                'short_code' => 'fk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Faroe Islands',
                'short_code' => 'fo',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Fiji',
                'short_code' => 'fj',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Finland',
                'short_code' => 'fi',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'France',
                'short_code' => 'fr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'French Polynesia',
                'short_code' => 'pf',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Gabon',
                'short_code' => 'ga',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Gambia',
                'short_code' => 'gm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Georgia',
                'short_code' => 'ge',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Germany',
                'short_code' => 'de',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Ghana',
                'short_code' => 'gh',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Gibraltar',
                'short_code' => 'gi',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Greece',
                'short_code' => 'gr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Greenland',
                'short_code' => 'gl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Grenada',
                'short_code' => 'gd',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Guam',
                'short_code' => 'gu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'Guatemala',
                'short_code' => 'gt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Guernsey',
                'short_code' => 'gg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Guinea',
                'short_code' => 'gn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Guinea-Bissau',
                'short_code' => 'gw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Guyana',
                'short_code' => 'gy',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Haiti',
                'short_code' => 'ht',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Honduras',
                'short_code' => 'hn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Hong Kong',
                'short_code' => 'hk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Hungary',
                'short_code' => 'hu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Iceland',
                'short_code' => 'is',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'India',
                'short_code' => 'in',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Indonesia',
                'short_code' => 'id',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Iran',
                'short_code' => 'ir',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Iraq',
                'short_code' => 'iq',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Ireland',
                'short_code' => 'ie',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Isle of Man',
                'short_code' => 'im',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Israel',
                'short_code' => 'il',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Italy',
                'short_code' => 'it',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Ivory Coast',
                'short_code' => 'ci',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Jamaica',
                'short_code' => 'jm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Japan',
                'short_code' => 'jp',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Jersey',
                'short_code' => 'je',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Jordan',
                'short_code' => 'jo',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Kazakhstan',
                'short_code' => 'kz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Kenya',
                'short_code' => 'ke',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Kiribati',
                'short_code' => 'ki',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Kosovo',
                'short_code' => 'xk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Kuwait',
                'short_code' => 'kw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Kyrgyzstan',
                'short_code' => 'kg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Laos',
                'short_code' => 'la',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Latvia',
                'short_code' => 'lv',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Lebanon',
                'short_code' => 'lb',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Lesotho',
                'short_code' => 'ls',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Liberia',
                'short_code' => 'lr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Libya',
                'short_code' => 'ly',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'Liechtenstein',
                'short_code' => 'li',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Lithuania',
                'short_code' => 'lt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Luxembourg',
                'short_code' => 'lu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Macau',
                'short_code' => 'mo',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Macedonia',
                'short_code' => 'mk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'Madagascar',
                'short_code' => 'mg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Malawi',
                'short_code' => 'mw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Malaysia',
                'short_code' => 'my',
                'status' => '1',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Maldives',
                'short_code' => 'mv',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Mali',
                'short_code' => 'ml',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'Malta',
                'short_code' => 'mt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Marshall Islands',
                'short_code' => 'mh',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Mauritania',
                'short_code' => 'mr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Mauritius',
                'short_code' => 'mu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'Mayotte',
                'short_code' => 'yt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'Mexico',
                'short_code' => 'mx',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'Micronesia',
                'short_code' => 'fm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'Moldova',
                'short_code' => 'md',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'Monaco',
                'short_code' => 'mc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'Mongolia',
                'short_code' => 'mn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'Montenegro',
                'short_code' => 'me',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'Montserrat',
                'short_code' => 'ms',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'Morocco',
                'short_code' => 'ma',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'Mozambique',
                'short_code' => 'mz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'Myanmar',
                'short_code' => 'mm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'Namibia',
                'short_code' => 'na',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
                'name' => 'Nauru',
                'short_code' => 'nr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
                'name' => 'Nepal',
                'short_code' => 'np',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'Netherlands',
                'short_code' => 'nl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'Netherlands Antilles',
                'short_code' => 'an',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'New Caledonia',
                'short_code' => 'nc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'New Zealand',
                'short_code' => 'nz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'Nicaragua',
                'short_code' => 'ni',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'Niger',
                'short_code' => 'ne',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'Nigeria',
                'short_code' => 'ng',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'Niue',
                'short_code' => 'nu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'North Korea',
                'short_code' => 'kp',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'Northern Mariana Islands',
                'short_code' => 'mp',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'name' => 'Norway',
                'short_code' => 'no',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'Oman',
                'short_code' => 'om',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'Pakistan',
                'short_code' => 'pk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'Palau',
                'short_code' => 'pw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'Palestine',
                'short_code' => 'ps',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'Panama',
                'short_code' => 'pa',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'Papua New Guinea',
                'short_code' => 'pg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'Paraguay',
                'short_code' => 'py',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'Peru',
                'short_code' => 'pe',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'Philippines',
                'short_code' => 'ph',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'Pitcairn',
                'short_code' => 'pn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'Poland',
                'short_code' => 'pl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'Portugal',
                'short_code' => 'pt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'Puerto Rico',
                'short_code' => 'pr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'Qatar',
                'short_code' => 'qa',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'Republic of the Congo',
                'short_code' => 'cg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'Reunion',
                'short_code' => 're',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 175,
                'name' => 'Romania',
                'short_code' => 'ro',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 176,
                'name' => 'Russia',
                'short_code' => 'ru',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 177,
                'name' => 'Rwanda',
                'short_code' => 'rw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 178,
                'name' => 'Saint Barthelemy',
                'short_code' => 'bl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 179,
                'name' => 'Saint Helena',
                'short_code' => 'sh',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 180,
                'name' => 'Saint Kitts and Nevis',
                'short_code' => 'kn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 181,
                'name' => 'Saint Lucia',
                'short_code' => 'lc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 182,
                'name' => 'Saint Martin',
                'short_code' => 'mf',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 183,
                'name' => 'Saint Pierre and Miquelon',
                'short_code' => 'pm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 184,
                'name' => 'Saint Vincent and the Grenadines',
                'short_code' => 'vc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 185,
                'name' => 'Samoa',
                'short_code' => 'ws',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 186,
                'name' => 'San Marino',
                'short_code' => 'sm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 187,
                'name' => 'Sao Tome and Principe',
                'short_code' => 'st',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 188,
                'name' => 'Saudi Arabia',
                'short_code' => 'sa',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 189,
                'name' => 'Senegal',
                'short_code' => 'sn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 190,
                'name' => 'Serbia',
                'short_code' => 'rs',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 191,
                'name' => 'Seychelles',
                'short_code' => 'sc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 192,
                'name' => 'Sierra Leone',
                'short_code' => 'sl',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 193,
                'name' => 'Singapore',
                'short_code' => 'sg',
                'status' => '1',
                'created_at' => NULL,
                'updated_at' => '2021-09-11 18:31:06',
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 194,
                'name' => 'Sint Maarten',
                'short_code' => 'sx',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 195,
                'name' => 'Slovakia',
                'short_code' => 'sk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 196,
                'name' => 'Slovenia',
                'short_code' => 'si',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 197,
                'name' => 'Solomon Islands',
                'short_code' => 'sb',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 198,
                'name' => 'Somalia',
                'short_code' => 'so',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 199,
                'name' => 'South Africa',
                'short_code' => 'za',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 200,
                'name' => 'South Korea',
                'short_code' => 'kr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 201,
                'name' => 'South Sudan',
                'short_code' => 'ss',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 202,
                'name' => 'Spain',
                'short_code' => 'es',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 203,
                'name' => 'Sri Lanka',
                'short_code' => 'lk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 204,
                'name' => 'Sudan',
                'short_code' => 'sd',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 205,
                'name' => 'Suriname',
                'short_code' => 'sr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 206,
                'name' => 'Svalbard and Jan Mayen',
                'short_code' => 'sj',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 207,
                'name' => 'Swaziland',
                'short_code' => 'sz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 208,
                'name' => 'Sweden',
                'short_code' => 'se',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 209,
                'name' => 'Switzerland',
                'short_code' => 'ch',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 210,
                'name' => 'Syria',
                'short_code' => 'sy',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 211,
                'name' => 'Taiwan',
                'short_code' => 'tw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 212,
                'name' => 'Tajikistan',
                'short_code' => 'tj',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 213,
                'name' => 'Tanzania',
                'short_code' => 'tz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 214,
                'name' => 'Thailand',
                'short_code' => 'th',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 215,
                'name' => 'Togo',
                'short_code' => 'tg',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 216,
                'name' => 'Tokelau',
                'short_code' => 'tk',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 217,
                'name' => 'Tonga',
                'short_code' => 'to',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 218,
                'name' => 'Trinidad and Tobago',
                'short_code' => 'tt',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 219,
                'name' => 'Tunisia',
                'short_code' => 'tn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 220,
                'name' => 'Turkey',
                'short_code' => 'tr',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 221,
                'name' => 'Turkmenistan',
                'short_code' => 'tm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 222,
                'name' => 'Turks and Caicos Islands',
                'short_code' => 'tc',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 223,
                'name' => 'Tuvalu',
                'short_code' => 'tv',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 224,
                'name' => 'U.S. Virgin Islands',
                'short_code' => 'vi',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 225,
                'name' => 'Uganda',
                'short_code' => 'ug',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 226,
                'name' => 'Ukraine',
                'short_code' => 'ua',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 227,
                'name' => 'United Arab Emirates',
                'short_code' => 'ae',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 228,
                'name' => 'United Kingdom',
                'short_code' => 'gb',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 229,
                'name' => 'United States',
                'short_code' => 'us',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 230,
                'name' => 'Uruguay',
                'short_code' => 'uy',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 231,
                'name' => 'Uzbekistan',
                'short_code' => 'uz',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 232,
                'name' => 'Vanuatu',
                'short_code' => 'vu',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 233,
                'name' => 'Vatican',
                'short_code' => 'va',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 234,
                'name' => 'Venezuela',
                'short_code' => 've',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 235,
                'name' => 'Vietnam',
                'short_code' => 'vn',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 236,
                'name' => 'Wallis and Futuna',
                'short_code' => 'wf',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 237,
                'name' => 'Western Sahara',
                'short_code' => 'eh',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 238,
                'name' => 'Yemen',
                'short_code' => 'ye',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 239,
                'name' => 'Zambia',
                'short_code' => 'zm',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 240,
                'name' => 'Zimbabwe',
                'short_code' => 'zw',
                'status' => '2',
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}