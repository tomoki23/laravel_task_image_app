<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()
            ->count(3)
            ->state(new Sequence(
                ['name' => '仕事'],
                ['name' => 'プライベート'],
                ['name' => 'その他']
            ))
            ->create();
    }
}
