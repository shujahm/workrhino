<?php

use Illuminate\Database\Seeder;

class CashPaymentOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')
            ->where('id', 1)
            ->update(['payment_option' => 'Cash']);
    }
}
