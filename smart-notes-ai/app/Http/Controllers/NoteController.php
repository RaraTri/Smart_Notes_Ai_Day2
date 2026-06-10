<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index');
    }

    // Fungsi Sakti buat Aliran AI Streaming Response
    public function summarize(Request $request)
    {
        $content = $request->input('content', 'catatan');

        return new StreamedResponse(function () use ($content) {
            // Set header wajib agar browser tahu ini adalah data aliran (streaming)
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');
            header('Connection: keep-alive');

            // Teks teks simulasi hasil ringkasan AI
            $responseText = "Berikut adalah Ringkasan AI untuk catatan \"" . $content . "\": Materi ini menekankan pentingnya pemahaman konsep dasar secara mendalam. Dengan menguasai struktur inti, proses implementasi ke dalam proyek nyata akan menjadi jauh lebih mudah, terstruktur, dan efisien untuk dikembangkan ke depannya.";

            // Pecah teks jadi per kata untuk disimulasikan sebagai ketikan real-time
            $words = explode(' ', $responseText);
            foreach ($words as $word) {
                echo $word . " ";
                
                // Paksa server mengirimkan potongan kata saat ini juga tanpa nunggu selesai
                ob_flush();
                flush();
                
                // Jeda waktu 150ms per kata biar efek ngetiknya berasa alami
                usleep(150000); 
            }
        });
    }
}