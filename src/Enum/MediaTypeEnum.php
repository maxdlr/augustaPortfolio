<?php

namespace App\Enum;

enum MediaTypeEnum: string
{
    case MOTION = 'MOTION';
    case SHOWREEL_THUMBNAIL = 'SHOWREEL';
    case ILLUSTRATION = 'ILLUSTRATION';
    case AVATAR = 'AVATAR';
    case MEUF = 'MEUF';
    case CONTACT = 'CONTACT';
    case CURSOR = 'CURSOR';
}
