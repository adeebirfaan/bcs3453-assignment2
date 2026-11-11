<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Seed 100 fake customers using CustomerFactory.
     */
    public function run(): void
    {
        Customer::factory()->count(100)->create();
    }
}
