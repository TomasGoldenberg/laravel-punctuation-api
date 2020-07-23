<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(ProductSeeder::class);
        $this->call(CategorySeeder::class);

    }
}
