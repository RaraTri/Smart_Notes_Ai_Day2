<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::where('user_id', 1)->orderBy('created_at', 'asc')->get();
        return view('chats.index', compact('chats'));
    }

    public function store(Request $request)
    {
        $prompt = $request->input('prompt');
        $apiKey = env('GEMINI_API_KEY');
        $responseText = "";

        if (!$apiKey) {
            $responseText = "API Key Gemini belum disetting di file .env nih cuy!";
        } else {
            try {
                // INI YANG DITAMBAHIN: withoutVerifying() biar XAMPP nggak rewel
                $response = Http::withoutVerifying()->withHeaders([
                    'Content-Type' => 'application/json',
                ])->post("https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ]
                ]);

                $result = $response->json();

                // Ambil jawaban dari struktur JSON Gemini
                if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {
                    $responseText = $result['candidates'][0]['content']['parts'][0]['text'];
                } else {
                    // INI JUGA DIUBAH: Biar error aslinya dari Google kelihatan di layar
                    $responseText = "Error dari Google: " . json_encode($result);
                }
            } catch (\Exception $e) {
                $responseText = "Waduh, koneksi error: " . $e->getMessage();
            }
        }

        Chat::create([
            'user_id' => 1,
            'prompt' => $prompt,
            'response' => $responseText,
        ]);

        return new StreamedResponse(function () use ($responseText) {
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            header('Connection: keep-alive');

            $cleanText = str_replace(['**', '*'], '', $responseText);
            
            $words = explode(' ', $cleanText);
            foreach ($words as $word) {
                echo $word . " ";
                ob_flush();
                flush();
                usleep(100000); 
            }
        });
    }
}