<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ServicoSeeder::class);
        //$this->call(SetorSeeder::class);
        //$this->call(EmpresarioSeeder::class);
        //$this->call(EmpresaSeeder::class);        
    }
}
