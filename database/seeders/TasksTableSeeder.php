<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            foreach(range(1, 3) as $num){
                DB::table('tasks')->insert([
                    'folder_id' => 1,
                    'title' => "サンプルタスク {$num}",
                    'status' => $num,
                    'due_date' => Carbon::now()->addDay($num),
                    'created_at' => Carbon::now()->now(),
                    'updated_at' => Carbon::now()->now(),
                ]);
            }
    }
}
