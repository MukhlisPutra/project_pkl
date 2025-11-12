<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat Admin Panel - PT SYAKIRASYA WISATA MANDIRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        :root {
            /* Palet Warna Syakirasya Premium */
            --primary-navy: #003366; /* Deep Blue - Warna utama Syakirasya */
            --accent-gold: #ffc107; /* Kuning Emas - Aksen */
            --secondary-bg: #f2f5f9; /* Latar belakang area chat yang lebih lembut */
            --light-bg: #ffffff; 
            
            /* Warna Pesan */
            --admin-message-bg: var(--primary-navy); 
            --user-message-bg: #ffffff; 
            
            --border-soft: #e2e8f0;
        }

        body { 
            background: var(--secondary-bg); 
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex; 
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }
        .chat-layout {
            display: flex; 
            height: 90vh; /* Sedikit lebih pendek */
            width: 90%; 
            max-width: 1400px;
            border-radius: 16px; 
            overflow: hidden; 
            box-shadow: 0 20px 50px rgba(0, 51, 102, 0.25); /* Shadow lebih dalam */
            background: var(--light-bg);
            border: 1px solid var(--border-soft);
        }
        
        /* --- SIDEBAR CHAT LIST --- */
        .chat-list { 
            width: 320px; 
            min-width: 300px;
            background: var(--light-bg); 
            border-right: 1px solid var(--border-soft); 
            overflow-y: auto; 
            display: flex;
            flex-direction: column;
        }
        .chat-list-header {
            background: var(--primary-navy);
            color: white;
            padding: 20px 25px;
            font-size: 1.3rem;
            font-weight: 800; /* Lebih tebal */
            flex-shrink: 0; 
            border-bottom: 3px solid var(--accent-gold); /* Aksen emas yang kuat */
        }
        .list-group {
            flex-grow: 1;
            overflow-y: auto;
            border-radius: 0;
        }
        .chat-item {
            display: block; 
            padding: 18px 25px; /* Padding lebih besar */
            text-decoration: none;
            color: #34495e;
            transition: background 0.3s, color 0.3s, border-left 0.3s;
            border-bottom: 1px solid var(--border-soft);
            position: relative;
        }
        .chat-item:hover {
            background: #e9eff5; /* Warna hover lebih jelas */
            color: var(--primary-navy);
        }
        .chat-item.active { 
            background: var(--secondary-bg); /* Latar belakang yang kontras */
            color: var(--primary-navy) !important; 
            font-weight: 700;
            border-left: 6px solid var(--accent-gold); /* Border emas tebal */
        }
        .chat-item .name {
            font-size: 1.1rem;
        }
        
        /* --- CHAT MESSAGES AREA --- */
        .chat-messages { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
        }
        .chat-header-main { 
            background: var(--light-bg); 
            padding: 20px 25px; 
            border-bottom: 1px solid var(--border-soft); 
            font-size: 1.3rem;
            color: var(--primary-navy);
            font-weight: 700;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08); /* Shadow yang lebih jelas */
            flex-shrink: 0;
        }
        .message-box { 
            flex: 1; 
            padding: 30px; 
            overflow-y: auto;
            background: var(--secondary-bg);
        }

        /* MESSAGE BUBBLE */
        .message { 
            margin-bottom: 20px; 
            display: flex;
            align-items: flex-end;
            clear: both;
        }
        
        .message .bubble { 
            display: inline-block; 
            padding: 15px 22px; /* Padding lebih besar */
            border-radius: 25px; /* Lebih membulat */
            max-width: 65%; 
            line-height: 1.5;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); /* Shadow lebih tegas */
        }
        
        /* Bubble Admin (KANAN) */
        .message.admin { 
            justify-content: flex-end; 
        }
        .message.admin .bubble { 
            background: var(--admin-message-bg); 
            color: white; 
            border-bottom-right-radius: 8px; /* Sudut ekor yang lebih besar */
        }
        
        /* Bubble User (KIRI) */
        .message.user { 
            justify-content: flex-start; 
        }
        .message.user .bubble { 
            background: var(--user-message-bg); 
            color: #333;
            border: 1px solid var(--border-soft);
            border-bottom-left-radius: 8px; /* Sudut ekor yang lebih besar */
        }
        
        /* --- FOOTER/INPUT --- */
        .chat-input-area {
            border-top: 1px solid var(--border-soft);
            background: var(--light-bg);
            padding: 20px 25px;
            flex-shrink: 0;
        }
        .form-control-chat {
            border-radius: 28px; /* Lebih membulat lagi */
            padding: 14px 25px; /* Lebih besar untuk kenyamanan mengetik */
            border-color: #ced4da;
            box-shadow: none !important;
        }
        .form-control-chat:focus {
            border-color: var(--accent-gold); /* Fokus pada warna aksen */
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25) !important;
        }
        .btn-kirim-chat {
            border-radius: 28px;
            background-color: var(--primary-navy);
            border-color: var(--primary-navy);
            font-weight: 600;
            padding: 12px 28px;
            transition: background-color 0.2s, transform 0.2s;
        }
        .btn-kirim-chat:hover {
            background-color: #004d99;
            border-color: #004d99;
            transform: translateY(-2px); /* Efek melayang */
        }
    </style>
</head>
<body class="p-0">
    <div class="chat-layout">
        {{-- Sidebar - Daftar Jamaah --}}
        <div class="chat-list">
            <div class="chat-list-header">
                <i class="fas fa-headset me-2"></i> Live Chat Support
            </div>
            <div class="list-group list-group-flush">
                @foreach ($jamaahs as $j)
                    {{-- LOGIKA BLADE/PHP TIDAK DIUBAH --}}
                    <a href="{{ route('admin.chat.show', $j->id) }}" 
                       class="chat-item {{ isset($user) && $user->id === $j->id ? 'active' : '' }}">
                        <div class="name">{{ $j->name }}</div>
                        {{-- <small class="last-message">...</small> --}}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Area Chat Utama --}}
        <div class="chat-messages">
            @if(isset($user))
                <div class="chat-header-main">
                    <i class="fas fa-user-circle me-2 text-primary-navy"></i> Chat dengan: {{ $user->name }}
                </div>
                
                {{-- Message Box --}}
                <div id="message-box" class="message-box">
                    @foreach($messages as $m)
                        {{-- LOGIKA BLADE/PHP TIDAK DIUBAH --}}
                        <div class="message {{ $m->sender_id == Auth::id() ? 'admin' : 'user' }}">
                            <div class="bubble">{{ $m->message }}</div>
                        </div>
                    @endforeach
                    <div class="clearfix"></div> 
                </div>

                {{-- Input Form (LOGIKA JAVASCRIPT DAN ROUTING TIDAK DIUBAH) --}}
                <form id="chatForm" class="d-flex chat-input-area">
                    @csrf
                    <input type="hidden" id="receiver_id" value="{{ $user->id }}">
                    <input type="text" id="message" class="form-control form-control-chat me-3" 
                           placeholder="Ketik balasan Anda di sini..." required autocomplete="off">
                    <button class="btn btn-primary btn-kirim-chat flex-shrink-0" type="submit">
                        <i class="fas fa-paper-plane me-1"></i> Kirim
                    </button>
                </form>
            @else
                {{-- Placeholder saat belum ada chat yang dipilih --}}
                <div class="d-flex align-items-center justify-content-center flex-grow-1 text-muted bg-secondary-bg">
                    <div class="text-center p-5">
                        <i class="fas fa-comments fa-5x mb-4 text-primary-navy opacity-50"></i>
                        <p class="h4 text-primary-navy fw-bold">Selamat Datang di Admin Live Chat Panel</p>
                        <p class="text-secondary mt-3">Silakan pilih salah satu jamaah dari daftar di sebelah kiri untuk melihat riwayat chat dan membalas pesan.</p>
                        <p class="small mt-4">PT SYAKIRASYA WISATA MANDIRI</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT AJAX (TIDAK ADA PERUBAHAN LOGIKA) --}}
    <script>
        const userId = {{ Auth::id() }};
        const receiverId = {{ isset($user) ? $user->id : 'null' }};
        const messageBox = document.getElementById('message-box');

        // Kirim pesan pakai AJAX
        document.getElementById('chatForm')?.addEventListener('submit', async e => {
            e.preventDefault();
            const messageInput = document.getElementById('message');
            const message = messageInput.value;
            const receiver_id = document.getElementById('receiver_id').value;
            
            if (!message.trim()) return; // Pastikan pesan tidak kosong
            
            // Tambahkan pesan ke UI langsung (Optimistic Update)
            if(messageBox) {
                const tempDiv = document.createElement('div');
                tempDiv.classList.add('message', 'admin');
                tempDiv.innerHTML = `<div class="bubble">${message}</div>`;
                messageBox.appendChild(tempDiv);
                messageBox.scrollTop = messageBox.scrollHeight;
            }

            // URL kirim pesan: menggunakan route yang sudah ada
            await fetch(`{{ route('admin.chat.send') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ receiver_id, message })
            });

            messageInput.value = '';
        });

        // 🔁 Interval refresh tiap 2 detik
        @if(isset($user))
        async function loadMessages() {
            const isScrolledToBottom = messageBox.scrollHeight - messageBox.clientHeight <= messageBox.scrollTop + 20; // Tambah toleransi 20px
            
            // URL ambil pesan: menggunakan route yang sudah ada
            const res = await fetch(`/admin/chat/fetch/{{ $user->id }}`);
            const data = await res.json();
            
            // Periksa jika ada perubahan data sebelum merender ulang
            const renderedMessages = messageBox.querySelectorAll('.message');
            const currentMessagesCount = renderedMessages.length; 
            
            if (data.length === currentMessagesCount) return; 
            
            messageBox.innerHTML = '';
            data.forEach(m => {
                const div = document.createElement('div');
                div.classList.add('message', m.sender_id == userId ? 'admin' : 'user'); 
                div.innerHTML = `<div class="bubble">${m.message}</div>`;
                messageBox.appendChild(div);
            });
            
            // Scroll jika sudah di bawah atau ada pesan baru
            if (isScrolledToBottom || data.length > currentMessagesCount) {
                 messageBox.scrollTop = messageBox.scrollHeight;
            }
        }

        // Jalankan saat pertama kali dimuat
        if(messageBox) {
             messageBox.scrollTop = messageBox.scrollHeight;
        }

        // Atur interval
        setInterval(loadMessages, 2000);
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>