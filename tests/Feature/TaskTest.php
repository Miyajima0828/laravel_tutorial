<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    private User $user;
    /**
     * 各テストメソッドの実行前に呼ばれる
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->seed('UsersTableSeeder');
        $this->user = User::first();
        // テストケース実行前にフォルダデータを作成する
        $this->seed('FoldersTableSeeder');
    }
    /**
     * @test
     */
    public function 期限日が日付であること()
    {
        $response = $this->actingAs($this->user)->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => 123, // 不正なデータ（数値）
        ]);
        $response->assertSessionHasErrors([
            'due_date' => '期限日には有効な日付を指定してください。',
        ]);
    }

    /**
     * 期限日が過去日付の場合はバリデーションエラー
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->actingAs($this->user)->post('/folders/1/tasks/create', [
            'title' => 'Sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'), // 不正なデータ（昨日の日付）
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力してください。',
        ]);
    }

    /**
     * 状態が定義された値ではない場合はバリデーションエラー
     * @test
     */
    public function status_should_be_within_defined_numbers()
    {

        $this->seed('TasksTableSeeder');

        $response = $this->actingAs($this->user)->post('/folders/1/tasks/1/edit', [
            'title' => 'Sample task',
            'due_date' => Carbon::today()->format('Y/m/d'),
            'status' => 999,
        ]);

        $response->assertSessionHasErrors([
            'status' => '状態 には 未着手、着手中、完了 のいずれかを指定してください。',
        ]);
    }
}
