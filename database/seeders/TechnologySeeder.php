<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Metodo truncate() per ripopolare da zero il seeder (Type in questo caso) ogni volta che viene rilanciato
        Schema::disableForeignKeyConstraints();
        Technology::truncate();
        Schema::enableForeignKeyConstraints();

        $technologies = [
            'Html',
            'CSS',
            'PHP',
            'VueJS',
            'Laravel',
            'JavaScript',
            'Python',
            'C++',
            'Swift',
        ];

        foreach ($technologies as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology;
            $new_technology->slug = Str::slug($new_technology->name, '-');
            $new_technology->save();
        }
    }
}
