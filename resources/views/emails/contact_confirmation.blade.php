@component('mail::message')
# Terima kasih, {{ $message->name }}

Kami telah menerima pesan Anda. Berikut ringkasan pesan yang kami terima:

- Nama: {{ $message->name }}
- Email: {{ $message->email }}
- Subjek: {{ $message->subject ?? '-' }}
- No. HP: {{ $message->phone ?? '-' }}

---

{{ $message->message }}

---

Kami akan menghubungi Anda sesegera mungkin.

Hormat kami,
Tim BumiAsri
@endcomponent
