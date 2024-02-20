<?php
namespace App\Constants;

enum UserRoles: int
{
    case User = 0;
    case Student = 1;
    case Parent = 2;
    case Teacher = 3;
    case Coordinator = 4;
    case Manager = 5;
    case Methodist = 6;
    case Director = 7;
    case System = 9;
    case Admin = 10;
}
