<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
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
        Type::truncate();
        Schema::enableForeignKeyConstraints();

        $types = [
            'Business implementation',
            'Foundational (business improvement)',
            'IT infrastructure improvement',
            'Product development (IT)',
            'Product development (non-IT)',
            'Physical engineering/construction',
            'Physical infrastructure improvement',
            'Procurement',
            'Regulatory/compliance',
            'Research and Development (R&D)',
            'Service development',
            'Transformation/reengineering'
        ];

        foreach ($types as $type) {
            $new_type = new Type();
            $new_type->name = $type;
            $new_type->slug = Str::slug($new_type->name, '-');
            $new_type->save();
        }
    }
}
