<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{

    // 一括代入（create()やupdate()）を許可するカラム

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'create_at'
    ];

    //リレーションの設定
    // Postテーブルのuser_idとUsersテーブルのidを紐づける

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
