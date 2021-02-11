<?php
function getRecipe($category) {
    require_once('api_key.php');
    $app_key = getApiKey('recipe');
    $elements = 'recipeTitle,recipeUrl,foodImageUrl,recipeDescription';
    switch ($category) {
        case '人気メニュー':
            $category_id = 30;
            break;
        case '定番の肉料理':
            $category_id = 31;
            break;
        case '定番の魚料理':
            $category_id = 32;
            break;
        case '卵料理':
            $category_id = 33;
            break;
        case 'ご飯もの':
            $category_id = 14;
            break;
        case 'パスタ':
            $category_id = 15;
            break;
        case '麺・粉物料理':
            $category_id = 16;
            break;
        case '汁物・スープ':
            $category_id = 17;
            break;
        case '鍋料理':
            $category_id = 23;
            break;
        case 'サラダ':
            $category_id = 18;
            break;
        case 'パン':
            $category_id = 22;
            break;
        case 'お菓子':
            $category_id = 21;
            break;
        case '肉':
            $category_id = 10;
            break;
        case '魚':
            $category_id = 11;
            break;
        case '野菜':
            $category_id = 12;
            break;
        case '果物':
            $category_id = 34;
            break;
        case 'ソース・調味料・ドレッシング':
            $category_id = 19;
            break;
        case '飲み物':
            $category_id = 27;
            break;
        case '大豆・豆腐':
            $category_id = 35;
            break;
        case 'その他の食材':
            $category_id = 13;
            break;
        case 'お弁当':
            $category_id = 20;
            break;
        case '簡単料理・時短':
            $category_id = 36;
            break;
        case '節約料理':
            $category_id = 37;
            break;
        case '今日の献立':
            $category_id = 38;
            break;
        case '健康料理':
            $category_id = 39;
            break;
        case 'その他の目的・シーン':
            $category_id = 26;
            break;
        case '中華料理':
            $category_id = 41;
            break;
        case '韓国料理':
            $category_id = 42;
            break;
        case 'イタリア料理':
            $category_id = 43;
            break;
        case 'フランス料理':
            $category_id = 44;
            break;
        case '西洋料理':
            $category_id = 25;
            break;
        case 'エスニック料理・中南米':
            $category_id = 46;
            break;
        case '沖縄料理':
            $category_id = 47;
            break;
        case '日本各地の郷土料理':
            $category_id = 48;
            break;
        case '行事・イベント':
            $category_id = 24;
            break;
        case 'おせち料理':
            $category_id = 49;
            break;
        case 'クリスマス':
            $category_id = 50;
            break;
        case 'ひな祭り':
            $category_id = 51;
            break;
        case '春レシピ':
            $category_id = 52;
            break;
        case '夏レシピ':
            $category_id = 53;
            break;
        case '秋レシピ':
            $category_id = 54;
            break;
        case '冬レシピ':
            $category_id = 55;
            break;
    }
    $url = 'https://app.rakuten.co.jp/services/api/Recipe/CategoryRanking/20170426?applicationId=' . $app_key . '&categoryId=' . $category_id  . '&elements=' . $elements;
    $ch = curl_init();
    $options = array (
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $recipe = $result['result'];
    curl_close($ch);
    $messages = [
        [
            'type' => 'template',
            'altText' => 'レシピ',
            'template' => [
                'type' => 'carousel',
                'columns' => [
                    [
                        'thumbnailImageUrl' => $recipe[0]['foodImageUrl'],
                        'imageBackgroundColor' => '#FFFFFF',
                        'title' => mb_substr($recipe[0]['recipeTitle'], 0, 40, "UTF-8"),
                        'text' => mb_substr($recipe[0]['recipeDescription'], 0, 60, "UTF-8"),
                        'actions' => [
                            [
                                'type' => 'uri',
                                'label' => 'レシピを見に行く',
                                'uri' => $recipe[0]['recipeUrl']
                            ]
                        ]
                    ],
                    [
                        'thumbnailImageUrl' => $recipe[1]['foodImageUrl'],
                        'imageBackgroundColor' => '#FFFFFF',
                        'title' => mb_substr($recipe[1]['recipeTitle'], 0, 40, "UTF-8"),
                        'text' => mb_substr($recipe[1]['recipeDescription'], 0, 60, "UTF-8"),
                        'actions' => [
                            [
                                'type' => 'uri',
                                'label' => 'レシピを見に行く',
                                'uri' => $recipe[1]['recipeUrl']
                            ]
                        ]
                    ],
                    [
                        'thumbnailImageUrl' => $recipe[2]['foodImageUrl'],
                        'imageBackgroundColor' => '#FFFFFF',
                        'title' => mb_substr($recipe[2]['recipeTitle'], 0, 40, "UTF-8"),
                        'text' => mb_substr($recipe[2]['recipeDescription'], 0, 60, "UTF-8"),
                        'actions' => [
                            [
                                'type' => 'uri',
                                'label' => 'レシピを見に行く',
                                'uri' => $recipe[2]['recipeUrl']
                            ]
                        ]
                    ],
                    [
                        'thumbnailImageUrl' => $recipe[3]['foodImageUrl'],
                        'imageBackgroundColor' => '#FFFFFF',
                        'title' => mb_substr($recipe[3]['recipeTitle'], 0, 40, "UTF-8"),
                        'text' => mb_substr($recipe[3]['recipeDescription'], 0, 60, "UTF-8"),
                        'actions' => [
                            [
                                'type' => 'uri',
                                'label' => 'レシピを見に行く',
                                'uri' => $recipe[3]['recipeUrl']
                            ]
                        ]
                    ],
                ]
            ]
        ]
    ];

    return $messages;
}
