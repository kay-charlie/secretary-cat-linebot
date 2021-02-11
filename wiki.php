<?php
function getWord($word) {
    $url = 'https://ja.wikipedia.org/w/api.php?indexpageids&format=json&action=query&prop=extracts&exintro&explaintext&redirects=1&titles=' . urlencode($word);
    $ch = curl_init();
    $options = array (
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    curl_close($ch);
    $pages_id = $result['query']['pageids'][0];
    $content = $result['query']['pages'][$pages_id];
    if (!empty($content['extract'])) {
        $search_word = '検索ワード：' . $content['title'];
        $search_result = '内容：' . $content['extract'];
        $page_link = 'URL：https://ja.wikipedia.org/wiki/' . $word;
        $messages = [
            [
                'type' => 'text',
                'text' => $search_word . "\n" . $search_result . "\n\n" . $page_link
            ]
        ];
    } else {
        $messages = [
            [
                'type' => 'text',
                'text' => '検索結果が見つからなかったにゃん！'
            ]
        ];
    }
    return $messages;
}
