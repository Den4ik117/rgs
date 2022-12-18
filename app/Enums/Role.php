<?php

namespace App\Enums;

enum Role: int
{
    case User = 1;
    case Sponsor = 2;
    case Admin = 3;
    case Banned = 4;

    const ROLES = [
        self::User,
        self::Sponsor,
        self::Admin,
        self::Banned,
    ];
}
