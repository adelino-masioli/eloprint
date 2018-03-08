<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('status' => 'Ativo'),
            array('status' => 'Inativo'),
            array('status' => 'Criação'),
            array('status' => 'Financeiro'),
            array('status' => 'Aguardando'),
            array('status' => 'Produção'),
            array('status' => 'Correção'),
            array('status' => 'Expedição'),
        );

        //insert data
        foreach ($data as $datas) {
            DB::table('status')->insert($datas);
        }
    }
}
