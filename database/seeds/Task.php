<?php

use Illuminate\Database\Seeder;

class Task extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'title' => 'Second task',
            'body' => 'Task body',
        ]);
    }
}
