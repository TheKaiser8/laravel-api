<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // crea vincolo tra le 2 tabelle tramite la foreign key
        Schema::table('projects', function (Blueprint $table) {
            // il progetto può non avere categoria per cui la setto a nullable() e se la categoria è presente e viene cancellata la setto a null ->onDelete('set null')
            $table->foreignId('type_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('type_id'); // sintassi compatta, sintassi lunga: ('projects_category_id_foreign)
            $table->dropColumn('type_id');
        });
    }
};
