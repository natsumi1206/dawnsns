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
        DB::connection('mysql')->table('posts')->insert([
          [
            'user_id' => '1',
            'post' => 'はじめまして。私はなつみです。'
          ],
          [
            'user_id' => '2',
            'post' => 'はじめまして。僕はさくやです。'
          ],
          [
            'user_id' => '1',
            'post' => 'なつみの呟きです。'
          ],
          [
            'user_id' => '3',
            'post' => 'はじめまして。僕はいたるです。'
          ],
          [
            'user_id' => '3',
            'post' => 'いたるの呟きです。'
          ],
        ]);
    }
}
