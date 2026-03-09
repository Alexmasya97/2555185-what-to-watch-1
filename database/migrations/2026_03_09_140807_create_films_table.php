<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
  public function up()
  {
    Schema::create('films', function (Blueprint $table) {
      $table->id();
      $table->string('imdb_id')->unique();
      $table->string('title');
      $table->string('year');
      $table->text('plot')->nullable();
      $table->string('poster')->nullable();
      $table->json('genre')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('films');
  }
}
