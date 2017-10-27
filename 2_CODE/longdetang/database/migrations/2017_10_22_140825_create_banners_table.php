<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 32);
            $table->string('pic', 256)->comment('图片地址')->nullable();
            $table->boolean('drillable')->comment('是否可钻取')->nullable();
            $table->string('drill_module', 16)->comment('钻取模块')->nullable();
            $table->string('drill_display', 16)->comment('钻取展示：0：列表，1：明细')->nullable();
            $table->string('drill_value', 256)->comment('钻取值')->nullable();
            $table->tinyInteger('status')->comment('状态(0:未上架，1:已上架)');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('banners');
    }
}
