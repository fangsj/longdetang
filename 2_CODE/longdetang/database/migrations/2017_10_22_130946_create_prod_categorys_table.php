<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdCategorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod_categorys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('code', 32);
            $table->string('bg_color', 32)->comment('背景色')->nullable();
            $table->string('pinyin', 32)->nullable();
            $table->string('thumbnail', 256)->nullable();
            $table->string('pic', 256)->nullable();
            $table->string('explain', 128)->nullable()->comment('说明');
            $table->string('ad_slogan', 128)->nullable()->comment('广告语');
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
        Schema::dropIfExists('prod_categorys');
    }
}
