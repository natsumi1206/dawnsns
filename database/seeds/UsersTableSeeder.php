<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::connection('mysql')->table('users')->insert([
          [
            'username' => 'なつみ',
            'mail'     => 'natsumi@gmail.com',
            'password' => 'natsumi1206',
          ],
          [
            'username' => 'さくや',
            'mail'     => 'sakuya@gmail.com',
            'password' => 'sakuya00',
          ],
          [
            'username' => 'いたる',
            'mail'     => 'itaru@gmail.com',
            'password' => 'itaru00',
          ],
        ]);
    }
}
