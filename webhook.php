<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');
require_once('api_key.php');

$channelAccessToken = getApiKey('access_line');
$channelSecret = getApiKey('secret_line');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);

function replyMessage($client, $reply_token, $messages) {
    return $client->replyMessage([
            'replyToken' => $reply_token,
            'messages' => $messages
    ]);
}

foreach ($client->parseEvents() as $event) {
	if ($event['type'] == 'message') {
		$message = $event['message'];
        require_once('search_recipe.php');
        $recipe_word = searchRecipe($message['text']);
        switch ($message['type']) {
            case 'text':
                $text = $message['text'];
                if ($text == '[今後の予定]') {
                    require_once('google_calendar_api.php');
                    $messages = getMySchedule();
                } elseif (strtolower($text) == '[zoom]') {
                    require_once('zoom.php');
                    $messages = createMeeting();
                } elseif (substr($text, 0, 1) === "/") {
                    require_once('youtube.php');
                    $messages = getVideos(substr($text, 1));
                } elseif (substr($text, 0, 1) === ":") {
                    require_once('wiki.php');
                    $messages = getWord(substr($text, 1));
                } elseif ($text == $recipe_word) {
                    require_once('rakuten_recipe.php');
                    $messages = getRecipe($text);
                } elseif (ctype_alpha($text)) {
                    require_once('open_weather.php');
                    $messages = getCurrentWeather($text);
                } elseif ($text == '[癒して]') {
                    require_once('cat.php');
                    $messages = getCatImage();
                } elseif (substr($text, 0, 1) == '[') {
                    require_once('rich_menu.php');
                    $messages = getRichMenu($text);
                } else {
                    require_once('noby_api.php');
                    $messages = [
                        [
                            'type' => 'text',
                            'text' => getNoby($text) 
                        ]
                    ];
                }
                replyMessage($client, $event['replyToken'], $messages);
                break;
			case 'location':
                require_once('hotpepper.php');
				$latitude = $message['latitude'];
				$longitude = $message['longitude'];
                $messages = getNearbyRestaurant($latitude, $longitude);
                replyMessage($client, $event['replyToken'], $messages);
                break;
        }
    }
};
