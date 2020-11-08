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
        DB::connection('dawnSNS')->table('follows')->insert([
          [
            'user_id' => '1',
            'follow_id' => '2'
          ],
          [
            'user_id' => '1',
            'follow_id' => '3'
          ],
          [
            'user_id' => '3',
            'follow_id' => '1'
          ],
        ]);
    }
}
