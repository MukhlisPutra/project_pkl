<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Chat - PT SYAKIRASYA WISATA MANDIRI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        :root {
            /* Palet Warna Syakirasya (Diperkaya) */
            --primary-navy: #003366; /* Navy Blue - Kuat & Profesional */
            --accent-gold: #ffc107; /* Kuning Emas - Aksen */
            --background-light: #f8f9fa; /* Latar Belakang Chat Lembut */
            --card-bg: #ffffff; /* Latar Belakang Kartu */
            --user-message-bg: var(--primary-navy);
            --user-message-color: #ffffff;
            --admin-message-bg: #e0e6ed; /* Biru Sangat Lembut */
            --admin-message-color: #212529; /* Hitam Penuh */
            --border-color-soft: #dee2e6; /* Border halus */
        }

        body {
            background-color: var(--background-light);
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333333;
        }

        /* CARD CONTAINER */
        .chat-container {
            max-width: 580px; /* Sedikit lebih lebar */
            margin: 40px auto;
            border-radius: 12px; /* Sudut lebih lembut */
            background-color: var(--card-bg);
            box-shadow: 0 10px 30px rgba(0, 51, 102, 0.15); /* Shadow Profesional */
            overflow: hidden;
            border: none; /* Hilangkan border eksternal */
            display: flex;
            flex-direction: column;
            min-height: 70vh; /* Agar terlihat lebih penuh di desktop */
        }

        /* HEADER */
        .chat-header {
            background-color: var(--primary-navy);
            color: white;
            padding: 20px 25px;
            text-align: left;
            border-bottom: 3px solid var(--accent-gold);
        }
        .chat-header h5 {
            font-weight: 700;
            margin-bottom: 2px;
            display: flex;
            align-items: center;
        }
        .chat-header small {
            opacity: 0.8;
            font-size: 0.85rem;
        }

        /* CHAT BOX */
        .chat-box {
            height: 480px; /* Lebih tinggi lagi */
            overflow-y: auto;
            padding: 25px;
            background-color: var(--background-light);
            flex-grow: 1;
        }
        /* Scrollbar kustom yang lebih elegan */
        .chat-box::-webkit-scrollbar {
            width: 8px;
        }
        .chat-box::-webkit-scrollbar-thumb {
            background-color: #b0bec7;
            border-radius: 4px;
        }

        /* MESSAGE STYLING */
        .message-wrapper {
            margin-bottom: 15px;
            display: flex;
        }
        .message {
            padding: 12px 16px;
            border-radius: 18px; /* Sudut lebih membulat */
            max-width: 80%;
            word-wrap: break-word;
            line-height: 1.5;
            font-size: 0.95rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        /* USER MESSAGE (RIGHT) */
        .from-user-wrapper {
            justify-content: flex-end;
        }
        .from-user {
            background-color: var(--user-message-bg);
            color: var(--user-message-color);
            border-bottom-right-radius: 4px; /* Sudut Lancip */
        }
        
        /* ADMIN MESSAGE (LEFT) */
        .from-admin-wrapper {
            justify-content: flex-start;
        }
        .from-admin {
            background-color: var(--admin-message-bg);
            color: var(--admin-message-color);
            border-bottom-left-radius: 4px; /* Sudut Lancip */
        }
        
        /* FOOTER & INPUT */
        .chat-footer {
            padding: 20px 25px;
            border-top: 1px solid var(--border-color-soft);
            background-color: var(--card-bg);
        }
        .input-group-chat {
            align-items: center;
        }
        .form-control-chat {
            border-radius: 25px; /* Input berbentuk pil yang lebih besar */
            border: 1px solid #ced4da;
            padding: 12px 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.05) !important;
            transition: border-color 0.2s;
        }
        .form-control-chat:focus {
            border-color: var(--primary-navy);
        }
        
        /* SEND BUTTON */
        .btn-kirim-minimalis {
            background-color: var(--primary-navy);
            border-color: var(--primary-navy);
            border-radius: 50%;
            width: 48px; /* Lebih besar */
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin-left: 12px;
            transition: background-color 0.2s, transform 0.2s;
            box-shadow: 0 2px 5px rgba(0, 51, 102, 0.3);
        }
        .btn-kirim-minimalis:hover {
            background-color: #004d99;
            border-color: #004d99;
            transform: translateY(-2px); /* Efek melayang */
        }
        .btn-kirim-minimalis i {
            font-size: 1.2rem;
            color: white;
        }

        /* BACK BUTTON */
        .btn-kembali-minimalis {
            color: #6c757d;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.2s;
            padding: 5px 10px;
            border-radius: 6px;
        }
        .btn-kembali-minimalis:hover {
            color: var(--primary-navy);
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">
        <h5 class="mb-0">
            <i class="fas fa-headset me-2"></i> Live Chat Support
        </h5>
        <small>PT SYAKIRASYA WISATA MANDIRI</small>
    </div>

    <div class="chat-box" id="chatBox">
        {{-- Pesan Awal (Opsional - Memberi Konteks) --}}
        <div class="message-wrapper from-admin-wrapper">
            <div class="message from-admin">
                Selamat datang di layanan Live Chat. Silakan sampaikan pertanyaan Anda, kami siap membantu!
            </div>
        </div>

        {{-- Loop Pesan Existing --}}
        @foreach ($messages as $msg)
            <div class="message-wrapper {{ $msg->sender_id == Auth::id() ? 'from-user-wrapper' : 'from-admin-wrapper' }}">
                <div class="message {{ $msg->sender_id == Auth::id() ? 'from-user' : 'from-admin' }}">
                    {{ $msg->message }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="chat-footer">
        <form action="{{ route('jamaah.chat.send') }}" method="POST" class="d-flex input-group-chat">
            @csrf
            <input type="text" name="message" class="form-control form-control-chat flex-grow-1" 
                   placeholder="Ketik pesan Anda..." required autocomplete="off">
            <button class="btn btn-kirim-minimalis flex-shrink-0" type="submit" title="Kirim Pesan">
                <i class="fas fa-paper-plane"></i>
            </button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ url()->previous() }}" class="btn-kembali-minimalis">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>

<script>
    // Scroll otomatis ke bawah saat halaman dimuat
    const chatBox = document.getElementById('chatBox');
    // Tambahkan sedikit delay agar rendering selesai dan memastikan scroll ke bawah
    setTimeout(() => {
        chatBox.scrollTop = chatBox.scrollHeight;
    }, 150);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>