<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ちんくんと学ぼう！</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body { font-family: 'Hiragino Kaku Gothic ProN', sans-serif; text-align: center; background-color: #f0f9ff; margin: 0; padding: 20px; }
        .game-container { max-width: 500px; margin: 0 auto; }
        
        /* キャラクターを配置するステージ */
        .stage { 
            position: relative; 
            width: 300px; 
            height: 400px; 
            margin: 20px auto; 
            background: white; 
            border-radius: 30px; 
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* ちんくん本体のアニメーション（ぽよんぽよん） */
        .chinkun-body {
            width: 200px;
            animation: poyon 3s infinite ease-in-out;
            z-index: 1;
        }

        /* お鼻のアニメーション（ぷらぷら） */
        /* ※今はまだ画像がないので、一旦赤い丸で代用 */
        .chinkun-nose {
            position: absolute;
            top: 180px; /* 位置は後で調整 */
            left: 50%;
            width: 20px;
            height: 40px;
            background: #ffb6c1; 
            border-radius: 10px;
            transform-origin: top center;
            animation: purapura 2s infinite ease-in-out;
            z-index: 2;
        }

        @keyframes poyon {
            0%, 100% { transform: scale(1, 1); }
            50% { transform: scale(1.03, 0.97); }
        }

        @keyframes purapura {
            0%, 100% { transform: rotate(-10deg); }
            50% { transform: rotate(10deg); }
        }

        /* 水着（星）のスタイル */
        .mizugi {
            position: absolute;
            top: 230px;
            z-index: 3;
            font-size: 80px;
            filter: drop-shadow(0 4px 5px rgba(0,0,0,0.2));
        }

        .btn-green {
            background-color: #4ade80;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 0 #22c55e;
        }
        .btn-green:active { transform: translateY(3px); box-shadow: none; }
    </style>
</head>
<body>

    <div class="game-container" x-data="{ isCovered: false }">
        <h1>だいじなところ、かくせるかな？</h1>

        <div class="stage">
            <img src="{{ asset('images/chinkun.jpg') }}" class="chinkun-body">
            
            <div class="chinkun-nose"></div>

            <div class="mizugi" x-show="isCovered" x-transition>
                ⭐
            </div>
        </div>

        <button class="btn-green" @click="isCovered = !isCovered">
            <span x-text="isCovered ? 'ぬがせる' : 'みずぎをきる！'"></span>
        </button>

        <p style="margin-top: 30px;"><a href="/">トップへもどる</a></p>
    </div>

</body>
</html>