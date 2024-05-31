<?php

namespace Database\Seeders;

use App\Models\Folder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $titles = ['プライベート', '仕事', '旅行'];

        foreach($titles as $title){
            Folder::create([
                'title' => $title,
                'user_id' => User::first()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
