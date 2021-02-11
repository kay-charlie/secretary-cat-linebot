<?php
function getRichMenu($message) {
    switch ($message) {
        case '[人気レシピ]':
            $reply = 'レシピカテゴリーを選んでにゃ～';
            break;
        case '[近くの飲食店]':
            $reply = '近くの飲食店を検索するにゃん！位置情報を送ると近くのお店を5件教えるにゃ！' . "\n" . '位置情報を確認の仕方：' . "\n\n" . '①「位置情報」マークを押す' . "\n" . '②地図真ん中の「この位置を送信」を押す';
            break;
        case '[その他使い方ガイド]':
            $reply = '知りたい情報のボタンをおしてにゃ～';
            break;
        case '[現在の天気]':
            $reply = '今の天気を知りたかったら、都市名をアルファベットで書いてニャン！' . "\n" . '例）大阪→Osaka';
            break;
        case '[Youtube]':
            $reply = 'Youtubeで動画を検索したいにゃんか？最初に/(スラッシュ)を入力して、その後に検索ワードを入力するにゃ！5つまで動画をゲットできるにゃ！' . "\n" . '例）/カフェミュージック';
            break;
        case '[Wikipedia]':
            $reply = 'Wikipediaでワードを検索したいにゃんか？最初に:(コロン)を入力して、その後に検索ワードを入力するにゃ！' . "\n" . '例）:大阪城';
            break;
    }
    if ($message == '[近くの飲食店]') {
       $messages = [
          [ 
               'type' => 'text',
               'text' => $reply,
               'quickReply' => [
                   'items' => [
                       [
                           'type' => 'action',
                           'action' => [
                               'type' => 'location',
                               'label' => '位置情報'
                           ]
                       ]
                   ]
               ]
           ]
       ];
    } elseif ($message == '[人気レシピ]') {
        require_once('recipe_quick_reply.php');
        $messages = recipeQuickReply($reply);
    } elseif ($message == '[その他使い方ガイド]') {
       $messages = [
          [ 
               'type' => 'text',
               'text' => $reply,
               'quickReply' => [
                   'items' => [
                       [
                           'type' => 'action',
                           'action' => [
                               'type' => 'message',
                               'label' => '今の天気',
                               'text' => '[現在の天気]'
                           ]
                       ],
                       [
                           'type' => 'action',
                           'action' => [
                               'type' => 'message',
                               'label' => 'Youtube',
                               'text' => '[Youtube]'
                           ]
                       ],
                       [
                           'type' => 'action',
                           'action' => [
                               'type' => 'message',
                               'label' => 'ウィキペディア検索',
                               'text' => '[Wikipedia]'
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
                'text' => $reply
            ]
        ];
    }
    return $messages;
}
