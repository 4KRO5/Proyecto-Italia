<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lection;

class LectionSeeder extends Seeder
{
    public function run(): void
    {
        Lection::factory()
        ->count(50)
        ->create();
    }
}
