@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="container">
    <h2>Instruksi Pembayaran</h2>

    <div style="margin-bottom: 20px;">
        <strong>Total Bayar:</strong>
        <h3 style="color: green;">Rp {{ number_format($grandTotal, 0, ',', '.') }}</h3>

        <strong>Waktu tersisa untuk bayar:</strong>
        <h3 id="countdown" style="color: red;">Memuat...</h3>
    </div>

    <form method="POST" action="{{ route('order.payment.confirm') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="total_bayar" value="{{ $grandTotal }}">

        <div class="form-group">
            <label>Pilih Metode Pembayaran:</label>
            <select name="metode_pembayaran" class="form-control" required onchange="showInstruksi(this.value)">
                <option value="">-- Pilih Metode --</option>
                <option value="bca">Transfer Bank (BCA)</option>
                <option value="ovo">OVO</option>
                <option value="gopay">GoPay</option>
                <option value="shopeepay">ShopeePay</option>
                <option value="qris">QRIS</option>
            </select>
        </div>

        <div id="instruksi-pembayaran" style="margin-top: 20px;"></div>

        <div class="form-group" style="margin-top: 20px;">
            <label for="bukti_pembayaran">Upload Bukti Pembayaran (JPG, PNG)</label>
            <input type="file" name="bukti_pembayaran" accept="image/*" required class="form-control">
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Konfirmasi Pembayaran</button>
    </form>
</div>

{{-- Timer countdown --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let remaining = {{ $remaining ?? 0 }};
        const countdownEl = document.getElementById('countdown');

        if (remaining <= 0) {
            countdownEl.textContent = 'Waktu habis!';
            alert('Waktu pembayaran telah habis.');
            window.location.href = "{{ route('order.create') }}";
            return;
        }

        const timer = setInterval(function () {
            if (remaining <= 0) {
                clearInterval(timer);
                countdownEl.textContent = 'Waktu habis!';
                alert('Waktu pembayaran telah habis.');
                window.location.href = "{{ route('order.create') }}";
            } else {
                let minutes = Math.floor(remaining / 60);
                let seconds = remaining % 60;
                countdownEl.textContent =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                remaining--;
            }
        }, 1000);
    });
</script>

{{-- Instruksi Pembayaran --}}
<script>
    function showInstruksi(metode) {
        const container = document.getElementById('instruksi-pembayaran');
        let html = '';

        switch (metode) {
            case 'transfer_bank':
                html = `
                    <h4>Transfer ke Rekening:</h4>
                    <p>Bank: <strong>BCA</strong><br>
                    No. Rekening: <strong>1234567890</strong><br>
                    Atas Nama: <strong>PT Sakupaleza</strong></p>
                `;
                break;

            case 'ovo':
                html = `
                    <h4>Pembayaran via OVO:</h4>
                    <p>No. OVO: <strong>0812-3456-7890</strong><br>
                    Nama: <strong>PT Sakupaleza</strong></p>
                `;
                break;

            case 'gopay':
                html = `
                    <h4>Pembayaran via GoPay:</h4>
                    <p>Nomor: <strong>0895-3330-26460</strong></p>
                    <p>Atau scan QR:</p>
                    <img src="{{ asset('image/qris_gopay.jpeg') }}" alt="QR GoPay" style="width:150px;">
                `;
                break;

            case 'shopeepay':
                html = `
                    <h4>Pembayaran via ShopeePay:</h4>
                    <p>Scan QR berikut:</p>
                    <img src="{{ asset('images/qris_shopeepay.png') }}" alt="QR ShopeePay" style="width:150px;">
                `;
                break;

            case 'qris':
                html = `
                    <h4>Pembayaran via QRIS:</h4>
                    <p>Scan QR ini dengan aplikasi GoPay, OVO, DANA, ShopeePay:</p>
                    <img src="{{ asset('images/qris_universal.png') }}" alt="QRIS" style="width:150px;">
                `;
                break;
        }

        container.innerHTML = html;
    }
</script>
@endsection
