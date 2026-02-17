<?php

use App\Models\Topic;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. 画面を表示する
Route::get('/', function () {
    $topics = Topic::all(); 
    return view('welcome', ['topics' => $topics]);
});

// 2. 新しくトピックを作る（YouTube URLも保存！）
Route::post('/topics', function (Request $request) {
    $topic = new Topic();
    $topic->title = $request->title;
    $topic->description = $request->description;
    $topic->youtube_url = $request->youtube_url; // YouTubeの棚
    $topic->is_completed = false;
    $topic->save();

    return redirect('/');
});

// 3. 完了状態にする
Route::post('/topics/{id}/complete', function ($id) {
    $topic = Topic::findOrFail($id);
    $topic->is_completed = true;
    $topic->save();

    return redirect('/');
});

// 4. 未完了に戻す（やり直す）
Route::post('/topics/{id}/restore', function ($id) {
    $topic = Topic::findOrFail($id);
    $topic->is_completed = false;
    $topic->save();

    return redirect('/');
});

// 5. 完全に消去する
Route::post('/topics/{id}/delete', function ($id) {
    $topic = Topic::findOrFail($id);
    $topic->delete();

    return redirect('/');

// 6. ゲーム画面を表示する
Route::get('/game', function () {
    return view('game');
});
});Route::get('/game', function () { return view('game'); });
