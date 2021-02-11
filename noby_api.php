<?php
function getNoby($message) {
    require_once('api_key.php');
    $app_key = getApiKey('noby');
    $ending = 'にゃん';
    $url = 'https://app.cotogoto.ai/webapi/noby.json?appkey=' . $app_key . '&persona=3&text=' . $message . '&ending=' . $ending;
    $ch = curl_init();
    $options = array (
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);
    return $result['text'];
}
