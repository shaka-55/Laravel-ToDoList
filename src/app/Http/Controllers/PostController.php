<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    //
    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request)
    {
      $validated= ([
            // ログインユーザーのIDを保存
            'user_id' => Auth::id(),

            // 投稿タイトル
            'title' => $request->title,

            // 投稿本文
            'body' => $request->body,
        ]);
        $post = Post::create($validated);
        return redirect()->route('blog.index')->with('message','保存しました');
    }

    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // データベースから最新順（作成日時が新しい順）にTodoを取得
        $posts = Post::with('user')
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(5);

        // 後で作る views/practices/index.blade.php へデータを渡して画面を表示
        return view('blog.index', compact('posts', 'keyword'));
        
    }
    //依存注入
    public function show(Post $post)
    {
        return view('blog.show',compact('post'));
    }

    public function edit(Post $post)
    {   
        // 本人以外は編集できないように権限を設定する
        if($post->user_id !== auth()->id()){
            abort(403,'権限がありません');
        }
        return view('blog.edit',compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title'=> 'required|max:20',
            'body' => 'required|max:400',
        ]);
        $validated['user_id'] = auth()->id();
        $post->update($validated);
        return redirect()->route('blog.index')->with('message','更新しました');
    }

    public function destroy(Post $post)
    {if($post->user_id !== auth()->id()){
            abort(403,'権限がありません');
        }
        $post->delete();
        return redirect()->route('blog.index')->with('message','削除しました');
    }
}
