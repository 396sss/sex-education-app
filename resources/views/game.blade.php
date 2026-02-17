<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>だいじなところ、かくそうね！</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Hiragino Kaku Gothic ProN', sans-serif; text-align: center; background-color: #f0f9ff; margin: 0; padding: 20px; }
        .main-title { color: #0369a1; font-size: 1.5rem; margin-bottom: 20px; }
        
        .game-wrapper { 
            display: flex; 
            justify-content: center; 
            gap: 15px; 
            flex-wrap: wrap; 
        }

        .character-box {
            background: white;
            padding: 15px;
            border-radius: 25px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            width: 280px;
        }

        .stage { 
            position: relative; 
            width: 240px; 
            height: 380px; 
            margin: 0 auto; 
            background: #fafafa;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: visible; 
        }

        /* 画像の共通設定（パパの絵を綺麗に見せる） */
        .character-img {
            height: auto;
            filter: contrast(180%) brightness(110%);
            mix-blend-mode: multiply;
        }

        .body-img { width: 220px; z-index: 1; }
        
        /* ぷらぷら動く大事なところ（ゆるキャラ） */
        .yuru-chara {
            position: absolute;
            transform-origin: top center;
            animation: purapura 2s infinite ease-in-out;
            z-index: 2;
        }

        @keyframes purapura {
            0%, 100% { transform: rotate(-6deg); }
            50% { transform: rotate(6deg); }
        }

        /* 上から被せる水着（服）の画像 */
        .mizugi-overlay {
            position: absolute;
            z-index: 10;
            width: 220px; /* 体と同じサイズにして重ねる */
            pointer-events: none; /* 下のボタンを邪魔しない */
        }

        .btn-action {
            padding: 12px 24px;
            border-radius: 50px;
            border: none;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            color: white;
            width: 100%;
        }
        .btn-boy { background-color: #60a5fa; box-shadow: 0 4px 0 #2563eb; }
        .btn-girl { background-color: #f472b6; box-shadow: 0 4px 0 #db2777; }
        .btn-action:active { transform: translateY(2px); box-shadow: none; }
    </style>
</head>
<body>

    <h1 class="main-title">だいじなところ、かくせるかな？</h1>

    <div class="game-wrapper" x-data="{ boyClothes: false, girlClothes: false }">
        
        <div class="character-box">
            <div class="stage">
                <img src="{{ asset('images/chinkun_body.png') }}" class="character-img body-img">
                
                <img src="{{ asset('images/chinkun_nose.png') }}" class="character-img yuru-chara" style="top: 170px; width: 70px;">
                
                <img src="{{ asset('images/mizugi_boy.png') }}" class="character-img mizugi-overlay" x-show="boyClothes" x-transition>
            </div>
            <button class="btn-action btn-boy" @click="boyClothes = !boyClothes">
                <span x-text="boyClothes ? 'ぬがせる' : 'みずぎをきる！'"></span>
            </button>
        </div>

        <div class="character-box">
            <div class="stage">
                <img src="{{ asset('images/rinchan_body.png') }}" class="character-img body-img">
                
                <img src="{{ asset('images/rinchan_breast.png') }}" class="character-img yuru-chara" style="top: 110px; width: 100px;">
                <img src="{{ asset('images/rinchan_under.png') }}" class="character-img yuru-chara" style="top: 220px; width: 70px;">

                <img src="{{ asset('images/mizugi_girl.png') }}" class="character-img mizugi-overlay" x-show="girlClothes" x-transition>
            </div>
            <button class="btn-action btn-girl" @click="girlClothes = !girlClothes">
                <span x-text="girlClothes ? 'ぬがせる' : 'みずぎをきる！'"></span>
            </button>
        </div>

    </div>

    <p style="margin-top: 30px;"><a href="/">トップへもどる</a></p>

</body>
</html>