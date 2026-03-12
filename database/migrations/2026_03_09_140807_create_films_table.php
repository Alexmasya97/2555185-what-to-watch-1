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
      $table->string('name');
      $table->string('poster_image')->nullable();
      $table->string('preview_image')->nullable();
      $table->string('background_image')->nullable();
      $table->string('background_color', 9)->nullable();
      $table->string('video_link')->nullable();
      $table->string('preview_video_link')->nullable();
      $table->text('description')->nullable();
      $table->decimal('rating', 3, 1)->default(0);
      $table->integer('scores_count')->default(0);
      $table->string('director')->nullable();
      $table->json('starring')->nullable();
      $table->integer('run_time')->nullable()->comment('Продолжительность в минутах');
      $table->integer('released')->nullable()->comment('Год выпуска');
      $table->string('imdb_id')->unique();
      $table->enum('status', ['pending', 'moderate', 'ready'])->default('pending');
      $table->boolean('is_promo')->default(false);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('films');
  }
}
