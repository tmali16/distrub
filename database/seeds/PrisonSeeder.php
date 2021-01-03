<?php

use Illuminate\Database\Seeder;
use App\Models\Prisions;

class PrisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gsin_prisons = array(
            array('id' => '1','code' => '861','number' => '1','name' => 'ИК-1','type' => '1','rejim' => '1'),
            array('id' => '2','code' => '862','number' => '2','name' => 'ИК-2','type' => '1','rejim' => '1'),
            array('id' => '3','code' => '863','number' => '3','name' => 'ИК-3','type' => '1','rejim' => '1'),
            array('id' => '4','code' => '864','number' => '8','name' => 'ИК-8','type' => '1','rejim' => '1'),
            array('id' => '5','code' => '865','number' => '10','name' => 'ИК-10','type' => '1','rejim' => '1'),
            array('id' => '6','code' => '866','number' => '14','name' => 'ВК-14','type' => '1','rejim' => '1'),
            array('id' => '7','code' => '867','number' => '16','name' => 'ИК-16','type' => '1','rejim' => '1'),
            array('id' => '8','code' => '868','number' => '19','name' => 'ИК-19','type' => '1','rejim' => '1'),
            array('id' => '9','code' => '869','number' => '27','name' => 'ИК-27','type' => '1','rejim' => '1'),
            array('id' => '10','code' => '870','number' => '31','name' => 'ИК-31','type' => '1','rejim' => '1'),
            array('id' => '11','code' => '871','number' => '47','name' => 'ИК-47','type' => '1','rejim' => '1'),
            array('id' => '12','code' => '872','number' => '1','name' => 'СИЗО-1','type' => '1','rejim' => '1'),
            array('id' => '13','code' => '873','number' => '3','name' => 'СИЗО-3','type' => '1','rejim' => '1'),
            array('id' => '14','code' => '874','number' => '4','name' => 'СИЗО-4','type' => '1','rejim' => '1'),
            array('id' => '15','code' => '875','number' => '5','name' => 'СИЗО-5','type' => '1','rejim' => '1'),
            array('id' => '16','code' => '876','number' => '50','name' => 'СИЗО-50','type' => '1','rejim' => '1'),
            array('id' => '17','code' => '877','number' => '14','name' => 'СИЗО при ВК-14','type' => '1','rejim' => '1'),
            array('id' => '18','code' => '878','number' => '53','name' => 'СИЗО-53','type' => '1','rejim' => '1'),
            array('id' => '19','code' => '879','number' => '26','name' => 'КП-26','type' => '1','rejim' => '1'),
            array('id' => '20','code' => '880','number' => '29','name' => 'КП-29','type' => '1','rejim' => '1'),
            array('id' => '21','code' => '881','number' => '32','name' => 'КП-32','type' => '1','rejim' => '1'),
            array('id' => '22','code' => '882','number' => '35','name' => 'КП-35','type' => '1','rejim' => '1'),
            array('id' => '23','code' => '883','number' => '37','name' => 'КП-37','type' => '1','rejim' => '1'),
            array('id' => '24','code' => '884','number' => '38','name' => 'КП-38','type' => '1','rejim' => '1'),
            array('id' => '25','code' => '885','number' => '39','name' => 'КП-39','type' => '1','rejim' => '1'),
            array('id' => '26','code' => '886','number' => '42','name' => 'КП-42','type' => '1','rejim' => '1'),
            array('id' => '27','code' => '887','number' => '43','name' => 'КП-43','type' => '1','rejim' => '1'),
            array('id' => '28','code' => '888','number' => '44','name' => 'КП-44','type' => '1','rejim' => '1'),
            array('id' => '29','code' => '889','number' => '45','name' => 'КП-45','type' => '1','rejim' => '1'),
            array('id' => '30','code' => '890','number' => '48','name' => 'КП-48','type' => '1','rejim' => '1'),
            array('id' => '31','code' => '891','number' => '51','name' => 'КП-51','type' => '1','rejim' => '1'),
            array('id' => '32','code' => '892','number' => '52','name' => 'КП-52','type' => '1','rejim' => '1'),
            array('id' => '188','code' => '13','number' => '21','name' => 'СИЗО-21','type' => '1','rejim' => '1')
        );

        foreach ($gsin_prisons as $key => $v) {
            Prisions::create([
                'name'=>$v['name']
            ]);
        }

    }
}
