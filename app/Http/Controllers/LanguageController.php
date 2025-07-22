<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    /**
     * Switch the application language.
     */
    public function switch(Request $request, string $locale): RedirectResponse
    {
        // Validate that the locale is supported
        $supportedLocales = ['en', 'fr'];
        
        if (!in_array($locale, $supportedLocales)) {
            abort(404);
        }
        
        // Store the locale in the session
        session(['locale' => $locale]);
        
        // Redirect back to the previous page
        return redirect()->back();
    }
} 