<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("device_id")->unsigned()->nullable();
            $table->string("title")->default("untitled");
            $table->text("description");
            $table->boolean("resolved")->default(false);
            $table->timestamps();

            $table->foreign("device_id")->references("id")->on("devices");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
}