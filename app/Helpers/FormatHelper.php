<?php

namespace App\Helpers;

class FormatHelper
{
    public static function phone($phone)
    {
        $raw = preg_replace('/\D/', '', $phone);

        if (preg_match('/^998(\d{2})(\d{3})(\d{2})(\d{2})$/', $raw, $matches)) {
            return "+998 ({$matches[1]}) {$matches[2]} {$matches[3]} {$matches[4]}";
        }

        return $phone;
    }
}
