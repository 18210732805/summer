<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //通过Post小工，找到了Post模型工厂，生成了100条由faker骗子生成的数据
        factory(\App\Post::class, 100)->create();
    }
}
