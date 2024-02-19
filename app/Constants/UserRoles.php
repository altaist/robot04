<?php
namespace App\Constants;

enum UserRoles: int
{
    case User = 0;
    case Student = 1;
    case Teacher = 2;
    case Coordinator = 3;
    case Manager = 4;
    case Methodist = 5;
    case Director = 6;
    case Parent = 7;
    case System = 9;
    case Admin = 10;
}
