<?php

use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('payment' => 'Dinheiro'),
            array('payment' => 'Cartão de Débito'),
            array('payment' => 'Cartão de Crédito'),
            array('payment' => 'Depósito'),
        );

        //insert data
        foreach ($data as $datas) {
            DB::table('payments')->insert($datas);
        }
    }
}
