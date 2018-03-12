<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Cartão de visita 4x1', 'description' => 'Cartões de visita com verniz 4x1', 'price' => '30.80', 'status_id' => 1),
            array('name' => 'Cartão de visita 4x4', 'description' => 'Cartões de visita com verniz 4x4', 'price' => '60.00', 'status_id' => 1),
            array('name' => 'Banner Metro Quadrado', 'description' => 'Banner em lona metro quadrado', 'price' => '29.00', 'status_id' => 1)
        );

        //insert data
        foreach ($data as $datas) {
            DB::table('products')->insert($datas);
        }
    }
}
