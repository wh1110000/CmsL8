<?php

namespace wh1110000\CmsL8\Database\Seeder;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('languages')->delete();
        
        \DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'English',
                'code' => 'en',
                'icon' => 'gb',
                'priority' => 1,
                'active' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Afar',
                'code' => 'aa',
                'icon' => 'aa',
                'priority' => 0,
                'active' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Abkhazian',
                'code' => 'ab',
                'icon' => 'ab',
                'priority' => 0,
                'active' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Afrikaans',
                'code' => 'af',
                'icon' => 'af',
                'priority' => 0,
                'active' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Amharic',
                'code' => 'am',
                'icon' => 'am',
                'priority' => 0,
                'active' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Arabic',
                'code' => 'ar',
                'icon' => 'ar',
                'priority' => 0,
                'active' => 0,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Assamese',
                'code' => 'as',
                'icon' => 'as',
                'priority' => 0,
                'active' => 0,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Aymara',
                'code' => 'ay',
                'icon' => 'ay',
                'priority' => 0,
                'active' => 0,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Azerbaijani',
                'code' => 'az',
                'icon' => 'az',
                'priority' => 0,
                'active' => 0,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Bashkir',
                'code' => 'ba',
                'icon' => 'ba',
                'priority' => 0,
                'active' => 0,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Belarusian',
                'code' => 'be',
                'icon' => 'be',
                'priority' => 0,
                'active' => 0,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Bulgarian',
                'code' => 'bg',
                'icon' => 'bg',
                'priority' => 0,
                'active' => 0,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Bihari',
                'code' => 'bh',
                'icon' => 'bh',
                'priority' => 0,
                'active' => 0,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Bislama',
                'code' => 'bi',
                'icon' => 'bi',
                'priority' => 0,
                'active' => 0,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Bengali/Bangla',
                'code' => 'bn',
                'icon' => 'bn',
                'priority' => 0,
                'active' => 0,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Tibetan',
                'code' => 'bo',
                'icon' => 'bo',
                'priority' => 0,
                'active' => 0,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Breton',
                'code' => 'br',
                'icon' => 'br',
                'priority' => 0,
                'active' => 0,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Catalan',
                'code' => 'ca',
                'icon' => 'ca',
                'priority' => 0,
                'active' => 0,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Corsican',
                'code' => 'co',
                'icon' => 'co',
                'priority' => 0,
                'active' => 0,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Czech',
                'code' => 'cs',
                'icon' => 'cs',
                'priority' => 0,
                'active' => 0,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Welsh',
                'code' => 'cy',
                'icon' => 'cy',
                'priority' => 0,
                'active' => 0,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Danish',
                'code' => 'da',
                'icon' => 'da',
                'priority' => 0,
                'active' => 0,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'German',
                'code' => 'de',
                'icon' => 'de',
                'priority' => 0,
                'active' => 0,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Bhutani',
                'code' => 'dz',
                'icon' => 'dz',
                'priority' => 0,
                'active' => 0,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Greek',
                'code' => 'el',
                'icon' => 'el',
                'priority' => 0,
                'active' => 0,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Esperanto',
                'code' => 'eo',
                'icon' => 'eo',
                'priority' => 0,
                'active' => 0,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Spanish',
                'code' => 'es',
                'icon' => 'es',
                'priority' => 0,
                'active' => 0,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Estonian',
                'code' => 'et',
                'icon' => 'et',
                'priority' => 0,
                'active' => 0,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Basque',
                'code' => 'eu',
                'icon' => 'eu',
                'priority' => 0,
                'active' => 0,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Persian',
                'code' => 'fa',
                'icon' => 'fa',
                'priority' => 0,
                'active' => 0,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Finnish',
                'code' => 'fi',
                'icon' => 'fi',
                'priority' => 0,
                'active' => 0,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Fiji',
                'code' => 'fj',
                'icon' => 'fj',
                'priority' => 0,
                'active' => 0,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Faeroese',
                'code' => 'fo',
                'icon' => 'fo',
                'priority' => 0,
                'active' => 0,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'French',
                'code' => 'fr',
                'icon' => 'fr',
                'priority' => 0,
                'active' => 0,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Frisian',
                'code' => 'fy',
                'icon' => 'fy',
                'priority' => 0,
                'active' => 0,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Irish',
                'code' => 'ga',
                'icon' => 'ga',
                'priority' => 0,
                'active' => 0,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Scots/Gaelic',
                'code' => 'gd',
                'icon' => 'gd',
                'priority' => 0,
                'active' => 0,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Galician',
                'code' => 'gl',
                'icon' => 'gl',
                'priority' => 0,
                'active' => 0,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Guarani',
                'code' => 'gn',
                'icon' => 'gn',
                'priority' => 0,
                'active' => 0,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'Gujarati',
                'code' => 'gu',
                'icon' => 'gu',
                'priority' => 0,
                'active' => 0,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Hausa',
                'code' => 'ha',
                'icon' => 'ha',
                'priority' => 0,
                'active' => 0,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Hindi',
                'code' => 'hi',
                'icon' => 'hi',
                'priority' => 0,
                'active' => 0,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Croatian',
                'code' => 'hr',
                'icon' => 'hr',
                'priority' => 0,
                'active' => 0,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Hungarian',
                'code' => 'hu',
                'icon' => 'hu',
                'priority' => 0,
                'active' => 0,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Armenian',
                'code' => 'hy',
                'icon' => 'hy',
                'priority' => 0,
                'active' => 0,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Interlingua',
                'code' => 'ia',
                'icon' => 'ia',
                'priority' => 0,
                'active' => 0,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Interlingue',
                'code' => 'ie',
                'icon' => 'ie',
                'priority' => 0,
                'active' => 0,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Inupiak',
                'code' => 'ik',
                'icon' => 'ik',
                'priority' => 0,
                'active' => 0,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Indonesian',
                'code' => 'in',
                'icon' => 'in',
                'priority' => 0,
                'active' => 0,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Icelandic',
                'code' => 'is',
                'icon' => 'is',
                'priority' => 0,
                'active' => 0,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Italian',
                'code' => 'it',
                'icon' => 'it',
                'priority' => 0,
                'active' => 0,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Hebrew',
                'code' => 'iw',
                'icon' => 'iw',
                'priority' => 0,
                'active' => 0,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Japanese',
                'code' => 'ja',
                'icon' => 'ja',
                'priority' => 0,
                'active' => 0,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Yiddish',
                'code' => 'ji',
                'icon' => 'ji',
                'priority' => 0,
                'active' => 0,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Javanese',
                'code' => 'jw',
                'icon' => 'jw',
                'priority' => 0,
                'active' => 0,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Georgian',
                'code' => 'ka',
                'icon' => 'ka',
                'priority' => 0,
                'active' => 0,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Kazakh',
                'code' => 'kk',
                'icon' => 'kk',
                'priority' => 0,
                'active' => 0,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Greenlandic',
                'code' => 'kl',
                'icon' => 'kl',
                'priority' => 0,
                'active' => 0,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Cambodian',
                'code' => 'km',
                'icon' => 'km',
                'priority' => 0,
                'active' => 0,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Kannada',
                'code' => 'kn',
                'icon' => 'kn',
                'priority' => 0,
                'active' => 0,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Korean',
                'code' => 'ko',
                'icon' => 'ko',
                'priority' => 0,
                'active' => 0,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Kashmiri',
                'code' => 'ks',
                'icon' => 'ks',
                'priority' => 0,
                'active' => 0,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Kurdish',
                'code' => 'ku',
                'icon' => 'ku',
                'priority' => 0,
                'active' => 0,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'Kirghiz',
                'code' => 'ky',
                'icon' => 'ky',
                'priority' => 0,
                'active' => 0,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'Latin',
                'code' => 'la',
                'icon' => 'la',
                'priority' => 0,
                'active' => 0,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'Lingala',
                'code' => 'ln',
                'icon' => 'ln',
                'priority' => 0,
                'active' => 0,
            ),
            66 => 
            array (
                'id' => 67,
                'name' => 'Laothian',
                'code' => 'lo',
                'icon' => 'lo',
                'priority' => 0,
                'active' => 0,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'Lithuanian',
                'code' => 'lt',
                'icon' => 'lt',
                'priority' => 0,
                'active' => 0,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'Latvian/Lettish',
                'code' => 'lv',
                'icon' => 'lv',
                'priority' => 0,
                'active' => 0,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'Malagasy',
                'code' => 'mg',
                'icon' => 'mg',
                'priority' => 0,
                'active' => 0,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'Maori',
                'code' => 'mi',
                'icon' => 'mi',
                'priority' => 0,
                'active' => 0,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'Macedonian',
                'code' => 'mk',
                'icon' => 'mk',
                'priority' => 0,
                'active' => 0,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'Malayalam',
                'code' => 'ml',
                'icon' => 'ml',
                'priority' => 0,
                'active' => 0,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'Mongolian',
                'code' => 'mn',
                'icon' => 'mn',
                'priority' => 0,
                'active' => 0,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'Moldavian',
                'code' => 'mo',
                'icon' => 'mo',
                'priority' => 0,
                'active' => 0,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'Marathi',
                'code' => 'mr',
                'icon' => 'mr',
                'priority' => 0,
                'active' => 0,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'Malay',
                'code' => 'ms',
                'icon' => 'ms',
                'priority' => 0,
                'active' => 0,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'Maltese',
                'code' => 'mt',
                'icon' => 'mt',
                'priority' => 0,
                'active' => 0,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'Burmese',
                'code' => 'my',
                'icon' => 'my',
                'priority' => 0,
                'active' => 0,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'Nauru',
                'code' => 'na',
                'icon' => 'na',
                'priority' => 0,
                'active' => 0,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'Nepali',
                'code' => 'ne',
                'icon' => 'ne',
                'priority' => 0,
                'active' => 0,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'Dutch',
                'code' => 'nl',
                'icon' => 'nl',
                'priority' => 0,
                'active' => 0,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'Norwegian',
                'code' => 'no',
                'icon' => 'no',
                'priority' => 0,
                'active' => 0,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'Occitan',
                'code' => 'oc',
                'icon' => 'oc',
                'priority' => 0,
                'active' => 0,
            ),
            84 => 
            array (
                'id' => 85,
            'name' => '(Afan)/Oromoor/Oriya',
                'code' => 'om',
                'icon' => 'om',
                'priority' => 0,
                'active' => 0,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'Punjabi',
                'code' => 'pa',
                'icon' => 'pa',
                'priority' => 0,
                'active' => 0,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'Polish',
                'code' => 'pl',
                'icon' => 'pl',
                'priority' => 2,
                'active' => 0,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'Pashto/Pushto',
                'code' => 'ps',
                'icon' => 'ps',
                'priority' => 0,
                'active' => 0,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'Portuguese',
                'code' => 'pt',
                'icon' => 'pt',
                'priority' => 0,
                'active' => 0,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'Quechua',
                'code' => 'qu',
                'icon' => 'qu',
                'priority' => 0,
                'active' => 0,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'Rhaeto-Romance',
                'code' => 'rm',
                'icon' => 'rm',
                'priority' => 0,
                'active' => 0,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'Kirundi',
                'code' => 'rn',
                'icon' => 'rn',
                'priority' => 0,
                'active' => 0,
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'Romanian',
                'code' => 'ro',
                'icon' => 'ro',
                'priority' => 0,
                'active' => 0,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'Russian',
                'code' => 'ru',
                'icon' => 'ru',
                'priority' => 0,
                'active' => 0,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'Kinyarwanda',
                'code' => 'rw',
                'icon' => 'rw',
                'priority' => 0,
                'active' => 0,
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'Sanskrit',
                'code' => 'sa',
                'icon' => 'sa',
                'priority' => 0,
                'active' => 0,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'Sindhi',
                'code' => 'sd',
                'icon' => 'sd',
                'priority' => 0,
                'active' => 0,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'Sangro',
                'code' => 'sg',
                'icon' => 'sg',
                'priority' => 0,
                'active' => 0,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'Serbo-Croatian',
                'code' => 'sh',
                'icon' => 'sh',
                'priority' => 0,
                'active' => 0,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'Singhalese',
                'code' => 'si',
                'icon' => 'si',
                'priority' => 0,
                'active' => 0,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'Slovak',
                'code' => 'sk',
                'icon' => 'sk',
                'priority' => 0,
                'active' => 0,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'Slovenian',
                'code' => 'sl',
                'icon' => 'sl',
                'priority' => 0,
                'active' => 0,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'Samoan',
                'code' => 'sm',
                'icon' => 'sm',
                'priority' => 0,
                'active' => 0,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'Shona',
                'code' => 'sn',
                'icon' => 'sn',
                'priority' => 0,
                'active' => 0,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'Somali',
                'code' => 'so',
                'icon' => 'so',
                'priority' => 0,
                'active' => 0,
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'Albanian',
                'code' => 'sq',
                'icon' => 'sq',
                'priority' => 0,
                'active' => 0,
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'Serbian',
                'code' => 'sr',
                'icon' => 'sr',
                'priority' => 0,
                'active' => 0,
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'Siswati',
                'code' => 'ss',
                'icon' => 'ss',
                'priority' => 0,
                'active' => 0,
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'Sesotho',
                'code' => 'st',
                'icon' => 'st',
                'priority' => 0,
                'active' => 0,
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'Sundanese',
                'code' => 'su',
                'icon' => 'su',
                'priority' => 0,
                'active' => 0,
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'Swedish',
                'code' => 'sv',
                'icon' => 'sv',
                'priority' => 0,
                'active' => 0,
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'Swahili',
                'code' => 'sw',
                'icon' => 'sw',
                'priority' => 0,
                'active' => 0,
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'Tamil',
                'code' => 'ta',
                'icon' => 'ta',
                'priority' => 0,
                'active' => 0,
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'Telugu',
                'code' => 'te',
                'icon' => 'te',
                'priority' => 0,
                'active' => 0,
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'Tajik',
                'code' => 'tg',
                'icon' => 'tg',
                'priority' => 0,
                'active' => 0,
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'Thai',
                'code' => 'th',
                'icon' => 'th',
                'priority' => 0,
                'active' => 0,
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'Tigrinya',
                'code' => 'ti',
                'icon' => 'ti',
                'priority' => 0,
                'active' => 0,
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'Turkmen',
                'code' => 'tk',
                'icon' => 'tk',
                'priority' => 0,
                'active' => 0,
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'Tagalog',
                'code' => 'tl',
                'icon' => 'tl',
                'priority' => 0,
                'active' => 0,
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'Setswana',
                'code' => 'tn',
                'icon' => 'tn',
                'priority' => 0,
                'active' => 0,
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'Tonga',
                'code' => 'to',
                'icon' => 'to',
                'priority' => 0,
                'active' => 0,
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'Turkish',
                'code' => 'tr',
                'icon' => 'tr',
                'priority' => 0,
                'active' => 0,
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'Tsonga',
                'code' => 'ts',
                'icon' => 'ts',
                'priority' => 0,
                'active' => 0,
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'Tatar',
                'code' => 'tt',
                'icon' => 'tt',
                'priority' => 0,
                'active' => 0,
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'Twi',
                'code' => 'tw',
                'icon' => 'tw',
                'priority' => 0,
                'active' => 0,
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'Ukrainian',
                'code' => 'uk',
                'icon' => 'uk',
                'priority' => 0,
                'active' => 0,
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'Urdu',
                'code' => 'ur',
                'icon' => 'ur',
                'priority' => 0,
                'active' => 0,
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'Uzbek',
                'code' => 'uz',
                'icon' => 'uz',
                'priority' => 0,
                'active' => 0,
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'Vietnamese',
                'code' => 'vi',
                'icon' => 'vi',
                'priority' => 0,
                'active' => 0,
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'Volapuk',
                'code' => 'vo',
                'icon' => 'vo',
                'priority' => 0,
                'active' => 0,
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'Wolof',
                'code' => 'wo',
                'icon' => 'wo',
                'priority' => 0,
                'active' => 0,
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'Xhosa',
                'code' => 'xh',
                'icon' => 'xh',
                'priority' => 0,
                'active' => 0,
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'Yoruba',
                'code' => 'yo',
                'icon' => 'yo',
                'priority' => 0,
                'active' => 0,
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'Chinese',
                'code' => 'zh',
                'icon' => 'zh',
                'priority' => 0,
                'active' => 0,
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'Zulu',
                'code' => 'zu',
                'icon' => 'zu',
                'priority' => 0,
                'active' => 0,
            ),
        ));
        
        
    }
}