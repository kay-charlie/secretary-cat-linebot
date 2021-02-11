<?php
function getMySchedule() {
    /*
    * 共通の記述
    */
    // composerでインストールしたライブラリを読み込む
    require_once __DIR__.'/google/vendor/autoload.php';

    // サービスアカウント作成時にダウンロードしたjsonファイル
    $aimJsonPath = __DIR__ . '/my-calendar-20210124-900d6d1aae8a.json';

    // サービスオブジェクトを作成
    $client = new Google_Client();

    // このアプリケーション名
    $client->setApplicationName('カレンダー イベントの取得');

    // 予定を取得する時は Google_Service_Calendar::CALENDAR_READONLY
    // 予定を追加する時は Google_Service_Calendar::CALENDAR_EVENTS
    $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);

    // ユーザーアカウントのjsonを指定
    $client->setAuthConfig($aimJsonPath);

    // サービスオブジェクトの用意
    $service = new Google_Service_Calendar($client);

    require_once('api_key.php');
    $calendarId = getApiKey('google');

    // 取得時の詳細設定
    $optParams = array(
      'maxResults' => 5,
      'orderBy' => 'startTime',
      'singleEvents' => true,
      'timeMin' => date('c',strtotime("yesterday")) //現在時刻以降の予定を取得対象
    );
    $results = $service->events->listEvents($calendarId, $optParams);
    $events = $results->getItems();
    date_default_timezone_set('Asia/Tokyo');
    if ($events) {
        $messages = [
            [
                'type' => 'template',
                'altText' => 'My Calendar',
                'template' => [
                    'type' => 'carousel',
                    'columns' => [
                        [
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => $events[0]['summary'],
                            'text' => '説明：' . $events[0]['description'] . "\n" . '時間：' . date('m/d h:i', strtotime($events[0]['start']['dateTime'])) . "-" . date('h:i', strtotime($events[0]['end']['dateTime'])),
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => '詳細へ',
                                    'uri' => $events[0]['htmlLink']
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        if ($events[1]) {
            $messages[0]['template']['columns'][] = [
                'imageBackgroundColor' => '#FFFFFF',
                'title' => $events[1]['summary'],
                'text' => '説明：' . $events[1]['description'] . "\n" . '時間：' . date('m/d h:i', strtotime($events[1]['start']['dateTime'])) . "-" . date('h:i', strtotime($events[1]['end']['dateTime'])),
                'actions' => [
                    [
                        'type' => 'uri',
                        'label' => '詳細へ',
                        'uri' => $events[1]['htmlLink']
                    ]
                ]
            ];
        }
        if ($events[2]) {
            $messages[0]['template']['columns'][] = [
                'imageBackgroundColor' => '#FFFFFF',
                'title' => $events[2]['summary'],
                'text' => '説明：' . $events[2]['description'] . "\n" . '時間：' . date('m/d h:i', strtotime($events[2]['start']['dateTime'])) . "-" . date('h:i', strtotime($events[2]['end']['dateTime'])),
                'actions' => [
                    [
                        'type' => 'uri',
                        'label' => '詳細へ',
                        'uri' => $events[2]['htmlLink']
                    ]
                ]
            ];
        }
        if ($events[3]) {
            $messages[0]['template']['columns'][] = [
                'imageBackgroundColor' => '#FFFFFF',
                'title' => $events[3]['summary'],
                'text' => '説明：' . $events[3]['description'] . "\n" . '時間：' . date('m/d h:i', strtotime($events[3]['start']['dateTime'])) . "-" . date('h:i', strtotime($events[3]['end']['dateTime'])),
                'actions' => [
                    [
                        'type' => 'uri',
                        'label' => '詳細へ',
                        'uri' => $events[3]['htmlLink']
                    ]
                ]
            ];
        }
        if ($events[4]) {
            $messages[0]['template']['columns'][] = [
                'imageBackgroundColor' => '#FFFFFF',
                'title' => $events[4]['summary'],
                'text' => '説明：' . $events[4]['description'] . "\n" . '時間：' . date('m/d h:i', strtotime($events[4]['start']['dateTime'])) . "-" . date('h:i', strtotime($events[4]['end']['dateTime'])),
                'actions' => [
                    [
                        'type' => 'uri',
                        'label' => '詳細へ',
                        'uri' => $events[4]['htmlLink']
                    ]
                ]
            ];
        }
    } else {
        $messages = [
            [
                'type' => 'text',
                'text' => '今のところ予定はないにゃん！'
            ]
        ];
    }
    return $messages;
}
