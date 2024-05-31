<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolder;
use App\Models\Folder;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\View\View;

class FolderController extends Controller
{
    public function __construct(
        private AuthManager $authManager
    ) {
    }
    public function showCreateForm(): View
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        $folder->user_id = $this->authManager->guard()->user()->id;
        // インスタンスの状態をデータベースに書き込む
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }
}
