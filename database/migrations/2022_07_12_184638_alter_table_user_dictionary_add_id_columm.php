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
        if(!Schema::hasColumn('dictionary_user', 'id')) {
            Schema::table('dictionary_user', function ($table) {
                $table->bigIncrements('id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('dictionary_user', 'id')) {
            Schema::dropColumns('dictionary_user', ['id']);
        }
    }
};
