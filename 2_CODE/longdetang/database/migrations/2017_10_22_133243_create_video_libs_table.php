<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoLibsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_libs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 32);
            $table->string('pic', 256)->comment('视频图');
            $table->string('url', 256)->comment('视频地址');
            $table->integer('views')->comment('查看数')->default(0);
            $table->dateTime('publish_time')->nullable();
            $table->tinyInteger('status')->comment('状态（0：待发布，1：已发布，2：已下架）');
            $table->dateTime('last_publish_time')->nullable()->comment('最近发布日期');
            $table->string('description', 256)->nullable()->comment('描述');
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
        Schema::dropIfExists('video_libs');
    }
}
