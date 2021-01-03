<?php

use Illuminate\Database\Seeder;
use App\Models\Rank;


class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ranks = array(
            array('id' => '1','name' => 'Рядовой','created_at' => NULL,'updated_at' => NULL),
            array('id' => '2','name' => 'Младший сержант','created_at' => NULL,'updated_at' => NULL),
            array('id' => '3','name' => 'Сержант','created_at' => NULL,'updated_at' => NULL),
            array('id' => '4','name' => 'Старший сержант','created_at' => NULL,'updated_at' => NULL),
            array('id' => '5','name' => 'Старшина','created_at' => NULL,'updated_at' => NULL),
            array('id' => '6','name' => 'Прапорщик','created_at' => NULL,'updated_at' => NULL),
            array('id' => '7','name' => 'Старший прапорщик','created_at' => NULL,'updated_at' => NULL),
            array('id' => '8','name' => 'Младший лейтенант','created_at' => NULL,'updated_at' => NULL),
            array('id' => '9','name' => 'Лейтенант','created_at' => NULL,'updated_at' => NULL),
            array('id' => '10','name' => 'Старший лейтенант','created_at' => NULL,'updated_at' => NULL),
            array('id' => '11','name' => 'Капитан','created_at' => NULL,'updated_at' => NULL),
            array('id' => '12','name' => 'Майор','created_at' => NULL,'updated_at' => NULL),
            array('id' => '13','name' => 'Подполковник','created_at' => NULL,'updated_at' => NULL),
            array('id' => '14','name' => 'Полковник','created_at' => NULL,'updated_at' => NULL),
            array('id' => '15','name' => 'Генерал-майор','created_at' => NULL,'updated_at' => NULL)
          );
        foreach ($ranks as $key => $i) {
            Rank::create([
                'name'=>$i['name']
            ]);
        }

    }
}
