<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>性教育チェックアプリ</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="性教育パパママ">
    <style>
        body { 
            font-family: 'Helvetica Neue', Arial, sans-serif; 
            padding: 15px; 
            background: #f8f9fa; 
            color: #333;
            line-height: 1.6;
        }
        h1 { font-size: 1.5rem; text-align: center; color: #2c3e50; margin-bottom: 20px; }
        h2 { font-size: 1.2rem; margin-top: 30px; color: #666; }
        
        .card { 
            background: white; 
            padding: 20px; 
            margin-bottom: 15px; 
            border-radius: 12px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
            border: 1px solid #eee;
        }
        
        .title { font-weight: bold; font-size: 1.1em; color: #007bff; margin-bottom: 8px; }

        button {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: opacity 0.2s;
            border: none;
            margin-top: 10px;
        }
        button:active { opacity: 0.7; }

        input, textarea {
            font-size: 16px !important;
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .video-container {
            margin: 12px 0;
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            overflow: hidden;
            border-radius: 12px;
        }
        .video-container iframe {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%; border: 0;
        }

        /* --- ここからアニメーションの魔法 --- */
        
        /* トロフィーが光って回る */
        @keyframes shine-rotate {
            0% { transform: scale(1) rotate(0deg); filter: drop-shadow(0 0 5px gold); }
            50% { transform: scale(1.2) rotate(10deg); filter: drop-shadow(0 0 20px gold); }
            100% { transform: scale(1) rotate(0deg); filter: drop-shadow(0 0 5px gold); }
        }
        .trophy {
            display: inline-block;
            font-size: 4rem;
            animation: shine-rotate 2s infinite ease-in-out;
        }

        /* 文字がぴょんぴょん跳ねる */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        .bounce-text {
            display: inline-block;
            animation: bounce 2s infinite;
        }

        /* キャラクターがひょっこり現れる */
        @keyframes peek-a-boo {
            0%, 100% { transform: translateY(50px); }
            40%, 60% { transform: translateY(0); }
        }
        .character {
            font-size: 3rem;
            display: block;
            margin-top: 10px;
            animation: peek-a-boo 3s infinite ease-in-out;
        }
    </style>
</head>
<body>
    <h1>🔥 元体育教師パパの性教育トピック</h1>

    <div class="card" style="background: #e3f2fd; border: 1px solid #90caf9;">
        <h3 style="margin-top: 0;">🆕 新しいトピックを追加</h3>
        <form action="/topics" method="POST">
            @csrf
            <input type="text" name="title" placeholder="トピックのタイトル" required>
            <textarea name="description" placeholder="詳しい説明をここに..." rows="3" required></textarea>
            <input type="url" name="youtube_url" placeholder="YouTubeのURL（あれば）">
            <button type="submit" style="background: #007bff; color: white;">トピックを保存する</button>
        </form>
    </div>

    @php
        $pendingTopics = $topics->where('is_completed', false)->sortByDesc('created_at');
        $completedTopics = $topics->where('is_completed', true)->sortByDesc('updated_at');
    @endphp

    @if($pendingTopics->count() > 0)
        @foreach ($pendingTopics as $topic)
            <div class="card">
                <div class="title">{{ $topic->title }}</div>
                <p>{{ $topic->description }}</p>
                @if($topic->youtube_url)
                    <div class="video-container">
                        @php
                            $videoId = '';
                            if (strpos($topic->youtube_url, 'v=') !== false) {
                                $videoId = explode('v=', $topic->youtube_url)[1];
                                $videoId = explode('&', $videoId)[0];
                            } elseif (strpos($topic->youtube_url, 'youtu.be/') !== false) {
                                $videoId = explode('youtu.be/', $topic->youtube_url)[1];
                                $videoId = explode('?', $videoId)[0];
                            }
                        @endphp
                        @if($videoId)
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}" allowfullscreen></iframe>
                        @endif
                    </div>
                @endif
                <form action="/topics/{{ $topic->id }}/complete" method="POST">
                    @csrf
                    <button type="submit" style="background: #28a745; color: white;">完了！</button>
                </form>
            </div>
        @endforeach
    @else
        <div class="card" style="text-align: center; background: #fff3cd; border: 2px dashed #ffc107; padding: 40px 20px; overflow: hidden;">
            <div class="trophy">🏆</div>
            <h3 class="bounce-text" style="color: #856404; margin-bottom: 10px;">全トピック達成！</h3>
            <p style="color: #856404;">
                お疲れ様です！<br>
                子供たちの未来を守る知識が、また一つ積み上がりましたね。<br>
                <strong>最高のチーム・パパママです！</strong>
            </p>
            <span class="character">😊✨</span>
        </div>
    @endif

    <hr style="margin-top: 40px; border: 0; border-top: 1px solid #ccc;">
    <h2>✅ 完了したトピック</h2>
    @foreach ($completedTopics as $topic)
        <div class="card" style="opacity: 0.6; background: #e9ecef;">
            <div class="title" style="text-decoration: line-through; color: #666;">{{ $topic->title }}</div>
            <form action="/topics/{{ $topic->id }}/restore" method="POST">
                @csrf
                <button type="submit" style="background: #6c757d; color: white;">やり直す</button>
            </form>
            <form action="/topics/{{ $topic->id }}/delete" method="POST" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                <button type="submit" style="background: #dc3545; color: white;">完全に削除</button>
            </form>
        </div>
    @endforeach

</body>
</html>