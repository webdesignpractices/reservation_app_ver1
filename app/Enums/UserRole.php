<?php

namespace App\Enums;

enum UserRole :string
{
    case Admin = 'admin'; //管理者
    case Staff = 'staff'; //スタッフ
    case Customer = 'customer'; //顧客

}