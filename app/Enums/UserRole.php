<?php

namespace App\Enums;

enum UserRole: int
{
    case SuperAdministrator = 1;
    case Moderator = 2;
    case Student = 3;
    case SiteUser = 4;
}
?>