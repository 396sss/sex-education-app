<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic; // これを忘れずに追加！

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        Topic::create([
            'title' => 'なぜ性教育って必要なの？',
            'description' => '自分と相手を大切にする「人権」の話であることを伝える。',
        ]);

        Topic::create([
            'title' => 'プライベートゾーン',
            'description' => '水着で隠れる場所は自分だけの宝物。人に見せない、触らせない。',
        ]);

        Topic::create([
            'title' => 'コミュニケーションツール',
            'description' => '嫌な時は「イヤ」と言っていい。相手の「イヤ」も尊重する。',
        ]);
    }
}
