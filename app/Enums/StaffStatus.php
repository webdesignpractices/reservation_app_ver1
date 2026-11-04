<?php

namespace App\Enums;

enum StaffStatus :string
{
    case Active = 'active', //在籍
    case Leave = 'leave', //休職
    case Retired = 'retired', //退職

}