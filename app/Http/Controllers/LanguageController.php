<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    /**
     * Switch the application locale and redirect back.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $supported = ['en', 'ml'];

        if (!in_array($locale, $supported)) {
            abort(404);
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        return redirect()->back()->withHeaders([
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }
}
