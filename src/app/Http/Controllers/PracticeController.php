<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Practice;

class PracticeController extends Controller
{
    // 1. 一覧表示処理
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        // データベースから最新順（作成日時が新しい順）にTodoを取得
        $practices = Practice::query()
            ->when($keyword, function ($query, $keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(5);

        // 後で作る views/practices/index.blade.php へデータを渡して画面を表示
        return view('practices.index', compact('practices', 'keyword'));
    }
    //タスクを保存するためのメソッド
    public function store(Request $request)
    {
       

        $validated = $request->validate([
            'title'=>'required|max:255'
        ]);

        Practice::create($validated);
        $request->session()->flash('message','追加しました');
        return back();

        
    }
    //編集画面で一覧表示するためのメソッド
    public function edit(Practice $practice)
    {
        return view('practices.edit', compact('practice'));
    }
    //更新するためのメソッド
    public function update(Request $request, Practice $practice)

    {
        $validated = $request->validate([
            'title'=>'required|max:255'
        ]);
        
        $practice->update($validated);

        $request->session()->flash('message','更新しました');
        return redirect()->route('practices.index');
    }

    public function destroy(Request $request, Practice $practice)

    {
        $practice->delete();
        $request->session()->flash('message','削除しました');
        return redirect()->route('practices.index');

    }


    public function toggle(Practice $practice)
    {
        $practice->update([
            'is_completed' => ! $practice->is_completed,
        ]);
        return back();
    }
}
