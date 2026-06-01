<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // add foreign keys to new tables
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            $table->unsignedBigInteger('type_id')->nullable()->after('category_id');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');

            // remove old string columns
            if (Schema::hasColumn('books', 'categorie')) {
                $table->dropColumn('categorie');
            }
            if (Schema::hasColumn('books', 'type')) {
                $table->dropColumn('type');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('categorie')->default('Nouveau');
            $table->string('type')->default('Texte');

            $table->dropForeign(['category_id']);
            $table->dropForeign(['type_id']);
            $table->dropColumn(['category_id', 'type_id']);
        });
    }
};
