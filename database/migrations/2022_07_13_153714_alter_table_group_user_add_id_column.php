<?php

use Illuminate\Database\Migrations\Migration;
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
        if(!Schema::hasColumn('group_user', 'id')) {
            Schema::table('group_user', function ($table) {
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
        if(Schema::hasColumn('group_user', 'id')) {
            Schema::dropColumns('group_user', ['id']);
        }
    }
};
