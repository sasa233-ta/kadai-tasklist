<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 20; $i++) {
            DB::table('tasks')->insert([
                'status' => 'status ' . $i,
                'content' => 'test content ' . $i,
                'user_id' => '2'
            ]);
        }
    }
}
