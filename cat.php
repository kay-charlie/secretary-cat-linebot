<?php
function getCatImage() {
    $url = 'https://aws.random.cat/meow';
    $ch = curl_init();
    $options = array (
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true
    );
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    $result = json_decode($response, true);
    $cat_image = $result['file'];
    curl_close($ch);
    $image = getimagesize($cat_image);
    switch (exif_imagetype($cat_image)) {
        case IMAGETYPE_JPEG:
        case IMAGETYPE_PNG:
            $messages = [
                [
                    'type' => 'template',
                    'altText' => '癒しの画像',
                    'template' => [
                        'type' => 'image_carousel',
                        'columns' => [
                            [
                                'imageUrl' => $cat_image,
                                'action' => [
                                    'type' => 'message',
                                    'label' => 'もっと癒して',
                                    'text' => '[癒して]'
                                ]
                            ]
                        ]
                    ]
                ]
            ];
            break;
        default:
            $messages = [
                [
                    'type' => 'text',
                    'text' => 'もう一回言ってにゃ'
                ]
            ];
            break;
    }
    return $messages;
}
