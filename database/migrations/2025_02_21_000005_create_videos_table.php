<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            // id definido como string para manter o valor original do JSON
            $table->string('id')->primary();
            $table->string('title');
            $table->timestamp('created_at')->nullable();
            $table->string('category'); // guarda o id da categoria (como string)
            $table->string('hls_path');
            $table->text('description')->nullable();
            $table->string('thumbnail');
            $table->string('site_id');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('likes')->default(0);
            $table->timestamp('updated_at')->nullable();

            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
            // Caso deseje relacionar a categoria com a tabela categories, pode definir:
            // $table->foreign('category')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
