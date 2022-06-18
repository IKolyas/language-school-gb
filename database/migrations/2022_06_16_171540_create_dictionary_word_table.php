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
        Schema::create('dictionary_word', function (Blueprint $table) {
            $table->foreignId('word_id')->constrained('words')->cascadeOnDelete();
            $table->foreignId('dictionary_id')->constrained('dictionaries')->cascadeOnDelete();
            $table->index(['word_id', 'dictionary_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words_dictionaries');
    }
};
