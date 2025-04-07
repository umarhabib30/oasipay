<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FullPageTranslationController extends Controller
{
    public function translate(Request $request)
    {
        $request->validate([
            'html' => 'required|string',
            'lang' => 'required|string'
        ]);

        $html = $request->input('html');
        $targetLang = $request->input('lang');

        // Extract text from HTML (naively, better with DOM parsing in real use)
        $textOnly = strip_tags($html);

        $response = Http::post('https://libretranslate.com/translate', [
            'q' => $textOnly,
            'source' => 'en',
            'target' => $targetLang,
            'format' => 'text',
            'api_key' => '', // Optional
        ]);

        if (!$response->successful()) {
            return response()->json(['error' => 'Translation failed.'], 500);
        }

        $translatedText = $response->json()['translatedText'];

        // Replace original text with translated text (simple version)
        $translatedHtml = str_replace($textOnly, $translatedText, $html);

        return response()->json([
            'html' => $translatedHtml
        ]);
    }
}
