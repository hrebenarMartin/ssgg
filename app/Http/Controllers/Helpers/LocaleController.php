<?php

namespace App\Http\Controllers\Helpers;

use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
    public function setLocale($locale)
    {
        session(['locale' => $locale]);

        return redirect()->back();
    }
}
