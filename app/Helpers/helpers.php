<?php

use App\Helpers\FormatHelper;

    if (!function_exists('phone_format')) {
        function phone_format($phone)
        {
            return FormatHelper::phone($phone);
        }
    }
