<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32)->comment('商品名称');
            $table->string('code', 16)->comment('商品编码，系统内部唯一');
            $table->string('pic', 256)->comment('商品图')->nullable();
            $table->decimal('price', 8,2)->comment('商品价格');
            $table->integer('artist_id')->comment('艺人Id')->nullable();
            $table->integer('category_id')->comment('大类ID')->nullable();
            $table->integer('second_category_id')->comment('二级分类ID')->nullable();
            $table->string('bar_pic', 256)->comment('二维码')->nullable();
            $table->string('texture', 16)->comment('材质，字典配置')->nullable();
            $table->integer('capacity')->nullable()->comment('容量默认单位cc');
            $table->string('details', 256)->comment('简要描述')->nullable();
            $table->mediumText('brief')->comment('商品详情')->nullable();
            $table->boolean('is_essence')->comment('是否精选')->default(false);
            $table->integer('views')->comment('浏览数')->default(0);
            $table->tinyInteger('status')->comment('状态(0:待上架，1:已上架,2:已下架)');
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
        Schema::dropIfExists('prods');
    }
}
