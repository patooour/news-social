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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('desc');
            $table->string('slug');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();

            //       $table->bigInteger('num_of_views')->nullable()->default(0);
            $table->boolean('status')->default(1);
            $table->boolean('comment_able')->default(1);
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
