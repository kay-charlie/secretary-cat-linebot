<?php
require('zoom/vendor/autoload.php');

use GuzzleHttp\Client;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Builder;

const BASE_URI = 'https://api.zoom.us/v2/';

function createJwtToken()
{
    require_once('api_key.php');
    $api_key = getApiKey('zoom');
    $api_secret = getApiKey('secret_zoom');
    $signer = new Sha256;
    $key = new Key($api_secret);
    $time = time();
    $jwt_token = (new Builder())->setIssuer($api_key)
        ->expiresAt($time + 3600)
        ->sign($signer, $key)
        ->getToken();
    return $jwt_token;
}

function getUserId() 
{
    $method = 'GET';
    $path = 'users';
    $client_params = [
        'base_uri' => BASE_URI,
    ];
    $result = sendRequest($method, $path, $client_params);
    $user_id = $result['users'][0]['id'];
    return $user_id;
}

function createMeeting() 
{
    $user_id = getUserId();
    $params = [
        'topic' => 'テスト',
        'type' => 1,
        'time_zone' => 'Asia/Tokyo',
        'agenda' => 'ズームAPIを試す',
        'settings' => [
            'host_video' => true,
            'participant_video' => true,
            'approval_type' => 0,
            'audio' => 'both',
            'enforce_login' => false,
            'waiting_room' => false,
            'registrants_email_notification' => false
        ]
    ];
    $method = 'POST';
    $path = 'users/'. $user_id .'/meetings';
    $client_params = [
        'base_uri' => BASE_URI,
        'json' => $params
    ];
    $result = sendRequest($method, $path, $client_params);
    $text = 'zoom会議を準備したにゃん！たのしんでにゃ～ん';
    $messages = [
        [
        'type' => 'text',
        'text' => $text . "\n" . $result['join_url']
        ]
    ];
    return $messages;
}

function sendRequest($method, $path, $client_params)
{
    $client = new Client($client_params);
    $jwt_token = createJwtToken();
    $response = $client->request($method, 
            $path, 
            [
            'headers' => [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $jwt_token,
            ]
            ]);
    $result_json = $response->getBody()->getContents();
    $result = json_decode($result_json, true);
    return $result;
}
