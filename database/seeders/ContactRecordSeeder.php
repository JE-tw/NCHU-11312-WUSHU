<?php

namespace Database\Seeders;

use App\Models\ContactRecord;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ContactRecord::factory()->count(10)->create();
    }
}
