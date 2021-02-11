<?php
//GoogleAPIライブラリを読み込む
require_once (dirname(__FILE__) . '/google/vendor/autoload.php');
require_once('api_key.php');
const API_KEY = getApiKey('youtube');

//認証を行う
function getClient() 
{
    $client = new Google_Client();
    $client->setApplicationName("youtube-api-test");
    $client->setDeveloperKey(API_KEY);
    return $client;
}

//動画を取得する.
function getVideos($search) 
{
    $youtube = new Google_Service_YouTube(getClient());
    //ここに好きなYouTubeのチャンネルIDを入れる
    $params['type'] = 'video';
    $params['maxResults'] = 5;
    $params['order'] = 'viewCount';
    $params['q'] = $search;
    try {
        $response = $youtube->search->listSearch('snippet', $params);
    } catch (Google_Service_Exception $e) {
        echo htmlspecialchars($e->getMessage());
        exit;
    } catch (Google_Exception $e) {
        echo htmlspecialchars($e->getMessage());
        exit;
    }
    $video = $response['items'];
    $url = 'https://www.youtube.com/watch?v=';
    if ($video) {
        $messages = [
            [
                'type' => 'template',
                'altText' => '動画情報',
                'template' => [
                    'type' => 'carousel',
                    'columns' => [
                        [
                            'thumbnailImageUrl' => $video[0]['snippet']['thumbnails']['high']['url'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => mb_substr($video[0]['snippet']['title'], 0, 40, "UTF-8"),
                            'text' => mb_substr($video[0]['snippet']['description'], 0, 60, "UTF-8"),
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => '動画を見に行く',
                                    'uri' => $url . $video[0]['id']['videoId']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $video[1]['snippet']['thumbnails']['high']['url'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => mb_substr($video[1]['snippet']['title'], 0, 40, "UTF-8"),
                            'text' => mb_substr($video[1]['snippet']['description'], 0, 60, "UTF-8"),
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => '動画を見に行く',
                                    'uri' => $url . $video[1]['id']['videoId']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $video[2]['snippet']['thumbnails']['high']['url'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => mb_substr($video[2]['snippet']['title'], 0, 40, "UTF-8"),
                            'text' => mb_substr($video[2]['snippet']['description'], 0, 60, "UTF-8"),
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => '動画を見に行く',
                                    'uri' => $url . $video[2]['id']['videoId']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $video[3]['snippet']['thumbnails']['high']['url'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => mb_substr($video[3]['snippet']['title'], 0, 40, "UTF-8"),
                            'text' => mb_substr($video[3]['snippet']['description'], 0, 60, "UTF-8"),
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => '動画を見に行く',
                                    'uri' => $url . $video[3]['id']['videoId']
                                ]
                            ]
                        ],
                        [
                            'thumbnailImageUrl' => $video[4]['snippet']['thumbnails']['high']['url'],
                            'imageBackgroundColor' => '#FFFFFF',
                            'title' => mb_substr($video[4]['snippet']['title'], 0, 40, "UTF-8"),
                            'text' => mb_substr($video[4]['snippet']['description'], 0, 60, "UTF-8"),
                            'actions' => [
                                [
                                    'type' => 'uri',
                                    'label' => '動画を見に行く',
                                    'uri' => $url . $video[4]['id']['videoId']
                                ]
                            ]
                        ],
                    ]
                ]
            ]
        ];
    }
    return $messages;
}
