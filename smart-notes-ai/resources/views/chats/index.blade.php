<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Notes AI - Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 flex flex-col h-screen font-sans dark:bg-slate-900">

    <header class="bg-white shadow-sm p-4 flex justify-between items-center dark:bg-slate-800">
        <h1 class="text-xl font-bold text-slate-800 dark:text-white">🤖 Smart Chat AI</h1>
        <a href="/dashboard" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Kembali</a>
    </header>

    <main id="chat-container" class="flex-1 overflow-y-auto p-4 sm:p-6 space-y-4 max-w-4xl mx-auto w-full">
        @foreach($chats as $chat)
            <div class="flex justify-end mb-4">
                <div class="bg-blue-600 text-white p-3 rounded-2xl rounded-tr-sm max-w-[80%] shadow-sm">{{ $chat->prompt }}</div>
            </div>
            <div class="flex justify-start mb-4">
                <div class="bg-white border text-slate-700 p-3 rounded-2xl rounded-tl-sm max-w-[80%] shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200">{{ $chat->response }}</div>
            </div>
        @endforeach
    </main>

    <footer class="bg-white p-4 border-t dark:bg-slate-800 dark:border-slate-700 mt-auto">
        <form id="chat-form" class="max-w-4xl mx-auto flex gap-3">
            <input type="text" id="prompt-input" placeholder="Tanya sesuatu ke AI..." required
                class="flex-1 border rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-white dark:border-slate-600">
            <button type="submit" id="submit-btn" class="bg-blue-600 text-white px-6 py-3 rounded-xl hover:bg-blue-700 font-semibold shadow-md transition">
                Kirim
            </button>
        </form>
    </footer>

    <script>
        const form = document.getElementById('chat-form');
        const input = document.getElementById('prompt-input');
        const chatContainer = document.getElementById('chat-container');
        const submitBtn = document.getElementById('submit-btn');

        // Fungsi scroll ke bawah otomatis
        const scrollToBottom = () => chatContainer.scrollTop = chatContainer.scrollHeight;
        scrollToBottom();

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const promptText = input.value;
            if (!promptText) return;

            chatContainer.innerHTML += `
                <div class="flex justify-end mb-4">
                    <div class="bg-blue-600 text-white p-3 rounded-2xl rounded-tr-sm max-w-[80%] shadow-sm">${promptText}</div>
                </div>
            `;
            input.value = '';
            scrollToBottom();

            const aiBubbleId = 'ai-' + Date.now();
            chatContainer.innerHTML += `
                <div class="flex justify-start mb-4">
                    <div id="${aiBubbleId}" class="bg-white border text-slate-700 p-3 rounded-2xl rounded-tl-sm max-w-[80%] shadow-sm dark:bg-slate-800 dark:border-slate-700 dark:text-slate-200">
                        <span class="animate-pulse text-slate-400">Mengetik...</span>
                    </div>
                </div>
            `;
            scrollToBottom();

            const aiBubble = document.getElementById(aiBubbleId);
            submitBtn.disabled = true; 

            try {
                const response = await fetch("{{ route('chat.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ prompt: promptText })
                });

                const reader = response.body.getReader();
                const decoder = new TextDecoder("utf-8");
                aiBubble.innerHTML = ''; 

                while (true) {
                    const { done, value } = await reader.read();
                    if (done) break;
                    
                    aiBubble.innerHTML += decoder.decode(value);
                    scrollToBottom();
                }
            } catch (error) {
                aiBubble.innerHTML = "Maaf, terjadi kesalahan koneksi.";
            }

            submitBtn.disabled = false;
        });
    </script>
</body>
</html>