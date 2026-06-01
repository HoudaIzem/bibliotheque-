<?php

namespace App\Http\Controllers;


class LocaleController extends Controller
{
    public function change($locale)
    {
        $supported_locales = ['en', 'fr'];
        if (!in_array($locale, $supported_locales)) {
            return redirect()->back()->with('error', 'Langue non supportée');
        }
        session(['locale' => $locale]);
        app()->setLocale($locale);

        return redirect()->back();
    }
}
