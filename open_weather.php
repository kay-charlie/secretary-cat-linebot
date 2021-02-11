<?php
function getCurrentWeather($city) {
    //受け取った位置情報から天気返す
    require_once('api_key.php');
    $api_id = getApikey('weather');
    $weather_json = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city . '&units=metric&lang=ja&appid=' . $api_id);
    $weather_response = json_decode($weather_json, true);
    //天気
    $weather = $weather_response['weather'][0]['main'];
    //気温（四捨五入）
    $temp = round($weather_response['main']['temp'], 1);
    //湿度
    $humidity = $weather_response['main']['humidity'];
    if (!empty($weather) && !empty($temp) && !empty($humidity)) {
        require_once('weather_functions.php');
        $messages = [
            [
            'type' => 'text',
            'text' => '今の天気をテキトーに言うにゃ！' . weatherTranslate($weather) . 'にゃ！気温は' . $temp . '度で、湿度が' . $humidity . '％にゃ！以上だにゃ～'
            ]
        ];
    } else {
        $messages = [
            [
            'type' => 'text',
            'text' => 'その町はわからないにゃ～'
            ]
        ];
    }
    return $messages;
}
