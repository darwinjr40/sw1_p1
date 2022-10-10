<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAparecesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apareces', function (Blueprint $table) {
            // $table->id();
            $table->integer('paper_id')->unsigned();
            $table->integer('paper_file_id')->unsigned();
            $table->string('url');
            $table->string('urlP');

            $table->foreign('paper_id')->references('id')->on('papers')->cascadeOnUpdate()->cascadeOnDelete(); 
            $table->foreign('paper_file_id')->references('id')->on('paper_files')->cascadeOnUpdate()->cascadeOnDelete();            
            $table->primary(['paper_id','paper_file_id']);
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
        Schema::dropIfExists('apareces');
    }
}
