<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


         $company_id = fake()->uuid();
         Company::factory()->create([
             'uuid' => $company_id,
             'name' => 'adminSystem SA.',
             'document' => "10034389970",
         ]);
         User::factory()->create([
             'name' => 'Test User',
             'email' => 'admin@teste.com',
             'company_id' => $company_id,
             'password' => Hash::make('31310801'),
         ]);
         Website::factory()->create([
             'uuid' => fake()->uuid(),
             'name' => 'web teste',
             'domain' => 'teste.com.br',
             'company_id' => $company_id,
         ]);

//      STACKHOUSE
        $company_id = fake()->uuid();
        Company::factory()->create([
            'uuid' => $company_id,
            'name' => 'STARK HOUSE',
            'document' => "9999999999",
        ]);
        User::factory()->create([
            'name' => 'admin starkhouse',
            'email' => 'contato@starkhouse.com.br',
            'company_id' => $company_id,
            'password' => Hash::make('admin123'),
        ]);
        Website::factory()->create([
            'uuid' => fake()->uuid(),
            'name' => 'stark house',
            'domain' => 'starkhouse.com.br',
            'company_id' => $company_id,
        ]);


    }
}
