<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = [
            ['name' => 'General', 'enabled' => true],
            ['name' => 'Motors', 'enabled' => true],
            ['name' => 'Jobs', 'enabled' => true],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
