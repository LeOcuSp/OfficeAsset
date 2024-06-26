<?php

namespace Database\Seeders;

use App\Models\AssetCategory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssetCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AssetCategory::factory(10)->create();
    }
}
