<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
          $table->id();
          $table->text('text');
          $table->integer('rating')->nullable()->comment('Оценка от 1 до 10');
          $table->foreignId('film_id')->constrained()->onDelete('cascade');
          $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
          $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
          $table->boolean('from_external')->default(false)->comment('Комментарий из внешнего источника');
          $table->string('external_author')->nullable()->comment('Имя автора из внешнего источника');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
