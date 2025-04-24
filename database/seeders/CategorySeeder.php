<?php

namespace Database\Seeders;


use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::create(['name'=>'吠陀占星']);
        Category::create(['name'=>'中醫']);
        Category::create(['name'=>'古典魔法']);
        Category::create(['name'=>'其他術數']);
    }
}
