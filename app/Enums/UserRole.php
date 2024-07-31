<?php

namespace App\Enums;

class UserRole extends Enum
{
    const STUDENT = "student";
    const ADMIN = "admin";

    public static function label($value): string
    {
        switch($value){
            case static::STUDENT:
                return __("Aluno");
            case static::ADMIN:
                return __("Administrador");
            default:
                return $value;
        }
    }
}
