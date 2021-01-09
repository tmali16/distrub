<?php
namespace Database\Seeders;
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
            array('number' => '1','name' => 'ИК-1','type' => '1','rejim' => '1'),
            array('number' => '2','name' => 'ИК-2','type' => '1','rejim' => '1'),
            array('number' => '3','name' => 'ИК-3','type' => '1','rejim' => '1'),
            array('number' => '8','name' => 'ИК-8','type' => '1','rejim' => '1'),
            array('number' => '10','name' => 'ИК-10','type' => '1','rejim' => '1'),
            array('number' => '14','name' => 'ВК-14','type' => '1','rejim' => '1'),
            array('number' => '16','name' => 'ИК-16','type' => '1','rejim' => '1'),
            array('number' => '19','name' => 'ИК-19','type' => '1','rejim' => '1'),
            array('number' => '27','name' => 'ИК-27','type' => '1','rejim' => '1'),
            array('number' => '31','name' => 'ИК-31','type' => '1','rejim' => '1'),
            array('number' => '47','name' => 'ИК-47','type' => '1','rejim' => '1'),
            array('number' => '1','name' => 'СИЗО-1','type' => '1','rejim' => '1'),
            array('number' => '3','name' => 'СИЗО-3','type' => '1','rejim' => '1'),
            array('number' => '4','name' => 'СИЗО-4','type' => '1','rejim' => '1'),
            array('number' => '5','name' => 'СИЗО-5','type' => '1','rejim' => '1'),
            array('number' => '50','name' => 'СИЗО-50','type' => '1','rejim' => '1'),
            array('number' => '53','name' => 'СИЗО-53','type' => '1','rejim' => '1'),
            array('number' => '26','name' => 'КП-26','type' => '1','rejim' => '1'),
            array('number' => '32','name' => 'КП-32','type' => '1','rejim' => '1'),
            array('number' => '38','name' => 'КП-38','type' => '1','rejim' => '1'),
            array('number' => '39','name' => 'КП-39','type' => '1','rejim' => '1'),
            array('number' => '42','name' => 'КП-42','type' => '1','rejim' => '1'),
            array('number' => '43','name' => 'КП-43','type' => '1','rejim' => '1'),
            array('number' => '44','name' => 'КП-44','type' => '1','rejim' => '1'),
            array('number' => '45','name' => 'КП-45','type' => '1','rejim' => '1'),
            array('number' => '51','name' => 'КП-51','type' => '1','rejim' => '1'),
            array('number' => '52','name' => 'КП-52','type' => '1','rejim' => '1'),
        );

        foreach ($gsin_prisons as $key => $v) {
            $prison = Prisions::where("name", $v['name'])->first();
            if($prison === null){
                Prisions::create([
                    'name'=>$v['name']
                ]);
            }
        }

    }
}
