<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('apps')->insert([
            'name' => 'Exemplo A',
            'bundle_id' => 'xto1',
        ]);
        \DB::table('apps')->insert([
            'name' => 'Exemplo B',
            'bundle_id' => 'xto2',
        ]);
        \DB::table('apps')->insert([
            'name' => 'Exemplo C',
            'bundle_id' => 'xto3',
        ]);
    }
}
