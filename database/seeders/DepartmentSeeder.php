<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear table

        DB::table('departments')->truncate();

        // Departments

        DB::table('departments')->insert([
            'department_code' => '401',
            'center_code' => '4501',
            'color_id' => 'blue',
            'color' => '#0054a6',
            'department_name' => 'interní oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '402',
            'center_code' => '4502',
            'color_id' => 'azure',
            'color' => '#4299e1',
            'department_name' => 'endokrinologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '403',
            'center_code' => '4503',
            'color_id' => 'azure',
            'color' => '#4299e1',
            'department_name' => 'příjmová interní ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '404',
            'center_code' => '4507',
            'color_id' => 'azure',
            'color' => '#4299e1',
            'department_name' => 'gastroenterologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '405',
            'center_code' => '4507',
            'color_id' => 'azure',
            'color' => '#4299e1',
            'department_name' => 'interní odborné ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '407',
            'center_code' => '4512',
            'color_id' => 'purple',
            'color' => '#ae3ec9',
            'department_name' => 'neurologické oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '408',
            'center_code' => '4513',
            'color_id' => 'purple',
            'color' => '#ae3ec9',
            'department_name' => 'neurologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '410',
            'center_code' => '4501',
            'color_id' => 'lime',
            'color' => '#74b816',
            'department_name' => 'odělení chirurgie páteře',
        ]);

        DB::table('departments')->insert([
            'department_code' => '411',
            'center_code' => '4521',
            'color_id' => 'lime',
            'color' => '#74b816',
            'department_name' => 'JIP oddělení chirurgie páteře a ortopedie',
        ]);

        DB::table('departments')->insert([
            'department_code' => '412',
            'center_code' => '4524',
            'color_id' => 'lime',
            'color' => '#74b816',
            'department_name' => 'ambulance chirurgie páteře',
        ]);

        DB::table('departments')->insert([
            'department_code' => '413',
            'center_code' => '4551',
            'color_id' => 'green',
            'color' => '#2fb344',
            'department_name' => 'rehabilitační oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '414',
            'center_code' => '4552',
            'color_id' => 'green',
            'color' => '#2fb344',
            'department_name' => 'rehabilitační ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '415',
            'center_code' => '4558',
            'color_id' => 'cyan',
            'color' => '#17a2b8',
            'department_name' => 'oddělení pracovního lékařství',
        ]);

        DB::table('departments')->insert([
            'department_code' => '417',
            'center_code' => '4547',
            'color_id' => 'pink',
            'color' => '#d6336c',
            'department_name' => 'OKB',
        ]);

        DB::table('departments')->insert([
            'department_code' => '418',
            'center_code' => '4549',
            'color_id' => 'red',
            'color' => '#d63939',
            'department_name' => 'RDG',
        ]);

        DB::table('departments')->insert([
            'department_code' => '419',
            'center_code' => '4522',
            'color_id' => 'lime',
            'color' => '#74b816',
            'department_name' => 'operační sály',
        ]);

        DB::table('departments')->insert([
            'department_code' => '420',
            'center_code' => '4110',
            'color_id' => 'yellow',
            'color' => '#f59f00',
            'department_name' => 'ředitelství',
        ]);

        DB::table('departments')->insert([
            'department_code' => '421',
            'center_code' => '4120',
            'color_id' => 'orange',
            'color' => '#f76707',
            'department_name' => 'stravovací provoz - kantýna',
        ]);

        DB::table('departments')->insert([
            'department_code' => '422',
            'center_code' => '4130',
            'color_id' => 'muted',
            'color' => '#49566c',
            'department_name' => 'úklid',
        ]);

        DB::table('departments')->insert([
            'department_code' => '424',
            'center_code' => '4528',
            'color_id' => 'lime',
            'color' => '#74b816',
            'department_name' => 'anesteziologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '425',
            'center_code' => '4504',
            'color_id' => 'azure',
            'color' => '#4299e1',
            'department_name' => 'diabetologická ambulance',
        ]);

        DB::table('departments')->insert([
            'department_code' => '426',
            'center_code' => '4141',
            'color_id' => 'teal',
            'color' => '#0ca678',
            'department_name' => 'lékárna KHN',
        ]);

        DB::table('departments')->insert([
            'department_code' => '427',
            'center_code' => '4510',
            'color_id' => 'indigo',
            'color' => '#4263eb',
            'department_name' => 'mezioborová JIP',
        ]);

        DB::table('departments')->insert([
            'department_code' => '428',
            'center_code' => '4524',
            'color_id' => 'muted',
            'color' => '#49566c',
            'department_name' => 'provozní úsek',
        ]);

        DB::table('departments')->insert([
            'department_code' => '429',
            'center_code' => '4150',
            'color_id' => 'muted',
            'color' => '#49566c',
            'department_name' => 'údržba',
        ]);

        DB::table('departments')->insert([
            'department_code' => '432',
            'center_code' => '4507',
            'color_id' => 'azure',
            'color' => '#4299e1',
            'department_name' => 'ambulance infuzní terapie',
        ]);

        DB::table('departments')->insert([
            'department_code' => '433',
            'center_code' => '4524',
            'color_id' => 'lime',
            'color' => '#74b816',
            'department_name' => 'mamologická poradna',
        ]);

        DB::table('departments')->insert([
            'department_code' => '434',
            'center_code' => '4525',
            'color_id' => 'orange',
            'color' => '#f76707',
            'department_name' => 'ortopedické oddělení',
        ]);

        DB::table('departments')->insert([
            'department_code' => '436',
            'center_code' => '4143',
            'color_id' => 'teal',
            'color' => '#0ca678',
            'department_name' => 'lékárna KHN v Ráji',
        ]);

        DB::table('departments')->insert([
            'department_code' => '437',
            'center_code' => '4560',
            'color_id' => 'orange',
            'color' => '#f76707',
            'department_name' => 'oddělení následné péče',
        ]);

        DB::table('departments')->insert([
            'department_code' => '999',
            'center_code' => '9999',
            'color_id' => 'muted',
            'color' => '#49566c',
            'department_name' => 'externí pracovník',
        ]);
    }
}
