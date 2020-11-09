<?php

use Illuminate\Database\Seeder;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('follows')->insert([

          [
            'follow_id' => '1',
            'user_id' => '3'
          ],

        ]);
    }
}
