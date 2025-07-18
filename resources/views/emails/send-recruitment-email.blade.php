<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Pendaftaran Event {{ $data['event'] }}</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
<div style="max-width: 600px; margin: auto;">
    <h2>Halo {{ $data['student_name'] }} ({{ $data['student_code'] }})!</h2>

    @if($data['status'] === 'accepted')
        <p>Selamat! Kamu telah <strong>DITERIMA</strong> sebagai bagian dari divisi <strong>{{ $data['event_division'] }}</strong> pada event <strong>{{ $data['event'] }}</strong>.</p>
        <p>Silakan bergabung ke grup WhatsApp melalui tautan berikut:</p>
        <p><a href="{{ $data['link_group_wa'] }}" style="color: #1a73e8;">Join WhatsApp Group</a></p>
        <p>Pastikan kamu segera bergabung untuk mendapatkan informasi selanjutnya.</p>
    @elseif($data['status'] === 'rejected')
        <p>Terima kasih telah mendaftar di event <strong>{{ $data['event'] }}</strong>.</p>
        <p>Mohon maaf, kamu belum diterima di divisi <strong>{{ $data['event_division'] }}</strong> untuk event ini.</p>
        <p>Jangan berkecil hati, tetap semangat dan sampai jumpa di kesempatan berikutnya!</p>
    @endif

    <hr>
    <p style="font-size: 14px;">Email ini dikirim secara otomatis oleh sistem. Mohon untuk tidak membalas email ini.</p>
</div>
</body>
</html>
