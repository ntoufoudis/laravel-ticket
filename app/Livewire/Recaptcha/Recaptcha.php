<?php

namespace App\Livewire\Recaptcha;

use Illuminate\Support\Facades\Blade;
use RuntimeException;

class Recaptcha
{
    public static function directive(): string
    {
        return Blade::render(file_get_contents(__DIR__.'/directive.recaptcha.v3.blade.php')
            ?: throw new RuntimeException('Unable to render recaptcha.v3.blade.php'),
            [
                'siteKey' => config('services.google.recaptcha.site_key'),
                'theme' => config('services.google.recaptcha.theme'),
                'size' => config('services.google.recaptcha.size'),
            ]);
    }
}
