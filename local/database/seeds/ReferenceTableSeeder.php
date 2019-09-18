<?php

use Illuminate\Database\Seeder;

class ReferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reference_table')->insert([
            ['id' => 1 , 'name' => 'Registered Rhinos'],
            ['id' => 2 , 'name' => 'Registered Contractors']
            
        ]);
    }
}
