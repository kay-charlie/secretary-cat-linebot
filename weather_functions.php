<?php
function weatherTranslate($weather) {
    switch ($weather) {
        case 'Clear':
            return '晴れ';
            break;
        case 'Clouds':
            return '曇り';
            break;
        case 'Rain':
            return '雨';
            break;
        case 'Drizzle':
            return '霧雨';
            break;
        case 'Thunderstorm':
            return '雷雨';
            break;
        case 'Snow':
            return '雪';
            break;
    }
}
