<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //想要给posts表进行模拟数据的填充
        //1. 创建一个 Post 模型         php artisan make:model Post             在 app/Post.php
        //2. 创建一个 Post 模型工厂     php artisan make:factory PostFactory     在database/factories/PostFactory.php
        //3. 使用Laravel 给提供 Faker 类完善 PostFactory 模型工厂
                /*
                    return [
                        'title' => $faker->sentence(5,true),
                        'content' => $faker->paragraph(10,true),
                        'user_id' => $faker->randomDigitNotNull,
                    ];
                */
        //4. 生成一个执行模型工厂内容创建的文件 PostsTableSeeder.php     php artisan make:seeder PostsTableSeeder
        //5. 书写执行模型工厂创建的句子：   factory(\App\Post::class, 100)->create();
        //6. 在 DatabaseSeeder.php 当中调用一下用于创建的文件 PostsTableSeeder.php      $this->call(PostsTableSeeder::class);
        //7. 运行填充：php artisan db:seed
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',100)->default('')->comment('文章标题');
            $table->text('content')->comment('文章内容');
            $table->integer('user_id')->default(0)->comment('外键：发帖人id');
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
        Schema::dropIfExists('posts');
    }
}
