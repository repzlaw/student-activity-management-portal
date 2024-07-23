<?php

namespace App\Enums;

enum ActivityType: string
{
    case TYPEA = 'TypeA';
    case TYPEB = 'TypeB';
    case TYPEC = 'TypeC';

    public function getColor(): string
    {
        return match ($this) {
            self::TYPEA => 'primary',
            self::TYPEB => 'success',
            self::TYPEC => 'danger',
        };
    }
}