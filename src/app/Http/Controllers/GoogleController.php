<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes([
                'openid',
                'profile',
                'email',
                'https://www.googleapis.com/auth/calendar',
            ])
            ->redirect();
    }

    public function callback()
    {
        // Googleユーザー情報を取得
        $googleUser = Socialite::driver('google')->user();

        // Googleクライアントを作成
        $client = new Client();
        $client->setAccessToken($googleUser->token);

        // Calendarサービスを作成
        $service = new Calendar($client);

        // イベント作成
        $event = new Event([
            'summary' => 'Laravelから登録した予定',
            'description' => 'Google Calendar API テスト',
            'start' => [
                'dateTime' => '2026-07-01T10:00:00+09:00',
                'timeZone' => 'Asia/Tokyo',
            ],
            'end' => [
                'dateTime' => '2026-07-01T11:00:00+09:00',
                'timeZone' => 'Asia/Tokyo',
            ],
        ]);

        // Googleカレンダーへ登録
        $service->events->insert('primary', $event);

        return redirect()->route('dashboard')
            ->with('message', 'Googleカレンダーに予定を登録しました！');
    }
}
