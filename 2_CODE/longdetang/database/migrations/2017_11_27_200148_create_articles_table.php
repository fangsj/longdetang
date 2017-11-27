<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 128)->comment('标题')->nullable();
            $table->string('pic', 256)->comment('文章图')->nullable();
            $table->string('author', 32)->comment('作者')->nullable();
            $table->string('preface', 256)->comment('介绍')->nullable();
            $table->longText('content')->comment('内容')->nullable();
            $table->dateTime('publish_time')->nullable();
            $table->dateTime('last_publish_time')->nullable()->comment('最近发布日期');
            $table->tinyInteger('status')->comment('状态（0：待发布，1：已发布，2：已下架）');
            $table->integer('views')->comment('阅读数')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
