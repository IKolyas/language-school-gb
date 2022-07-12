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
        if(!Schema::hasColumn('dictionary_word', 'id')) {
            Schema::table('dictionary_word', function ($table) {
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
        if(Schema::hasColumn('dictionary_word', 'id')) {
            Schema::dropColumns('dictionary_word', ['id']);
        }
    }
};
