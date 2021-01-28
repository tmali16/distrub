<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use \Database\factories\DistrubFactory;
use App\Models\Distrub;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {        
        $this->call(RankSeeder::class);
        $this->call(PrisonSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(\Database\factories\DistrubFactory::class);
        factory(Distrub::class, 50)->create();
    }
}
