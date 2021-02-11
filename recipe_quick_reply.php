<?php
function recipeQuickReply($reply) {
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
                           'label' => '人気メニュー',
                           'text' => '人気メニュー'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '定番の魚料理',
                           'text' => '定番の魚料理'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '定番の肉料理',
                           'text' => '定番の肉料理'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '卵料理',
                           'text' => '卵料理'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => 'ご飯もの',
                           'text' => 'ご飯もの'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => 'パスタ',
                           'text' => 'パスタ'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '麺・粉物料理',
                           'text' => '麺・粉物料理'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '鍋料理',
                           'text' => '鍋料理'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => 'サラダ',
                           'text' => 'サラダ'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '野菜',
                           'text' => '野菜'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '大豆・豆腐',
                           'text' => '大豆・豆腐'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '簡単料理・時短',
                           'text' => '簡単料理・時短'
                       ]
                   ],
                   [
                       'type' => 'action',
                       'action' => [
                           'type' => 'message',
                           'label' => '行事・イベント',
                           'text' => '行事・イベント'
                       ]
                   ],
               ]
           ]
       ]
   ];
   return $messages;
}
