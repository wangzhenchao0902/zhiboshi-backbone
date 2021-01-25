<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->tinyInteger('status')->comment('状态, 1开启，2关闭');
            $table->integer('category_id')->comment('分类ID');
            $table->string('cover')->default('')->comment('封面');
            $table->tinyInteger('recommend')->default(0)->comment('是否推荐首页');
            $table->integer('order_number')->default(0)->comment('排序，倒序');
            $table->string('title')->commennt('标题');
            $table->text('content')->comment('文本内容');
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
