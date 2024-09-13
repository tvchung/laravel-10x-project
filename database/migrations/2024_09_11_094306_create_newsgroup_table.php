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
        Schema::create('newsgroup', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('NAME',500)->nullable();
            $table->text('NOTES')->nullable();
            $table->string('ICON',250)->nullable();
            $table->string('SLUG',160)->nullable();
            $table->string('META_TITLE',160)->nullable();
            $table->string('META_KEYWORD',500)->nullable();
            $table->string('META_DESCRIPTION',500)->nullable();
            $table->bigInteger('CREATED_BY')->nullable();
            $table->bigInteger('UPDATED_BY')->nullable();
            $table->tinyInteger('ISDELETE')->nullable();
            $table->tinyInteger('ISACTIVE')->nullable();
            $table->bigInteger('IDPARENT')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsgroup');
    }
};
