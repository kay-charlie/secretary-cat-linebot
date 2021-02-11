<?php
function getNearbyRestaurant($latitude, $longitude) {
    require_once('api_key.php');
    $key = getApiKey('hotpepper');
    $url = "https://webservice.recruit.co.jp/hotpepper/gourmet/v1/?key=$key&lat=$latitude&lng=$longitude&range=5&order=4&format=json";
    $ch = curl_init();//curlセッション初期化
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);//curl_exec()の返り値を文字列で返す。
    $response = curl_exec($ch);//URLの情報を取得し、ブ ラウザに渡す
    $results = json_decode($response, true);//取得したURLのjsonコードをデコードする
    $shop = $results['results']['shop'];
    curl_close($ch);//セッション終了
    if (isset($shop[0])) {
        $messages = [
            [
                'type' => 'template',
                'altText' => '周辺の店舗情 報',
                'template' => [
                    'type' => 'carousel',
                    'columns' => [
                        [
                            'thumbnailImageUrl' => $shop[0]['photo']['pc']['l'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => '店舗情報①',
                            'text' => $shop[0]['name'] . "\n",
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => 'ホットペッパーサイトへ',
                                    'uri' => $shop[0]['urls']['pc']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $shop[1]['photo']['pc']['l'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => '店舗情報②',
                            'text' => $shop[1]['name'] . "\n",
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => 'ホットペッパーサイトへ',
                                    'uri' => $shop[1]['urls']['pc']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $shop[2]['photo']['pc']['l'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => '店舗情報③',
                            'text' => $shop[2]['name'] . "\n",
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => 'ホットペッパーサイトへ',
                                    'uri' => $shop[2]['urls']['pc']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $shop[3]['photo']['pc']['l'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => '店舗情報④',
                            'text' => $shop[3]['name'] . "\n",
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => 'ホットペッパーサイトへ',
                                    'uri' => $shop[3]['urls']['pc']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $shop[4]['photo']['pc']['l'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => '店舗情報⑤',
                            'text' => $shop[4]['name'] . "\n",
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => 'ホットペッパーサイトへ',
                                    'uri' => $shop[4]['urls']['pc']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    } else {
        $messages = [
            [
            'type' => 'text',
            'text' => 'お近くに該当する店舗が見つかりませんでした'
            ]
        ];
    }
    return $messages;
}
