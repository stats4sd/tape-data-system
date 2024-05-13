<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('crops', function (Blueprint $table) {
            $table->unsignedInteger('total_max')->nullable();
            $table->unsignedInteger('sold_max')->nullable();
            $table->unsignedInteger('farmgate_max')->nullable();
            $table->unsignedInteger('gift_max')->nullable();
            $table->decimal('land_use_max', 8, 2)->nullable();
            $table->unsignedInteger('varieties_max')->nullable();
        });

        Schema::table('crop_products', function (Blueprint $table) {
            $table->unsignedInteger('total_max')->nullable();
            $table->string('unit_defeault')->nullable();
            $table->unsignedInteger('sold_max')->nullable();
            $table->unsignedInteger('farmgate_max')->nullable();
            $table->unsignedInteger('given_max')->nullable();
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->unsignedInteger('raised_max')->nullable();
            $table->unsignedInteger('breeds_max')->nullable();
            $table->unsignedInteger('born_max')->nullable();
            $table->unsignedInteger('died_max')->nullable();
            $table->unsignedInteger('slaughtered_max')->nullable();
            $table->unsignedInteger('purchased_max')->nullable();
            $table->unsignedInteger('sold_max')->nullable();
            $table->unsignedInteger('farmgate_max')->nullable();
            $table->unsignedInteger('given_max')->nullable();
            $table->unsignedInteger('expenditures_feed_max')->nullable();
            $table->unsignedInteger('expenditures_vet_max')->nullable();
        });

        Schema::table('animal_products', function (Blueprint $table) {
            $table->unsignedInteger('total_max')->nullable();
            $table->string('unit_default')->nullable();
            $table->unsignedInteger('quantity_sold_max')->nullable();
            $table->unsignedInteger('farmgate_max')->nullable();
            $table->unsignedInteger('quantity_given_max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crops', function (Blueprint $table) {
            $table->dropColumn('total_max');
            $table->dropColumn('sold_max');
            $table->dropColumn('farmgate_max');
            $table->dropColumn('gift_max');
            $table->dropColumn('land_use_max');
            $table->dropColumn('varieties_max');
        });

        Schema::table('crop_products', function (Blueprint $table) {
            $table->dropColumn('total_max');
            $table->dropColumn('unit_defeault');
            $table->dropColumn('sold_max');
            $table->dropColumn('farmgate_max');
            $table->dropColumn('given_max');
        });

        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn('raised_max');
            $table->dropColumn('breeds_max');
            $table->dropColumn('born_max');
            $table->dropColumn('died_max');
            $table->dropColumn('slaughtered_max');
            $table->dropColumn('purchased_max');
            $table->dropColumn('sold_max');
            $table->dropColumn('farmgate_max');
            $table->dropColumn('given_max');
            $table->dropColumn('expenditures_feed_max');
            $table->dropColumn('expenditures_vet_max');
        });

        Schema::table('animal_products', function (Blueprint $table) {
            $table->dropColumn('total_max');
            $table->dropColumn('unit_default');
            $table->dropColumn('quantity_sold_max');
            $table->dropColumn('farmgate_max');
            $table->dropColumn('quantity_given_max');
        });
    }
};
