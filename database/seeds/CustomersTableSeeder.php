<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'João Almeida', 'email' => 'joaoalmeida@gmail.com', 'telephone' => '(31) 00000-0000'),
            array('name' => 'Maria Gabriel', 'email' => 'mariagabriel@gmail.com', 'telephone' => '(31) 00000-0000')
        );

        //insert data
        foreach ($data as $datas) {
            DB::table('customers')->insert($datas);
        }
    }
}
