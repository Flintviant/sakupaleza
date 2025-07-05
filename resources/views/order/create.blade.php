@extends('layouts.app')

@section('title', 'Pemesanan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/order.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/order.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

@endpush

<?php
// Koneksi ke database (ganti dengan informasi koneksi Anda)
$host = "localhost";
$user = "root";
$password = "";
$database = "sakupaleza";
$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query data
$sql = "SELECT id_kecamatan, nama_kecamatan FROM kecamatan";
$result = mysqli_query($conn, $sql);

$kecamatans = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $kecamatans[] = $row;
        }
    }

?>

@section('content')
<header class="site-header">
    <div class="container">
        <nav class="navbar">
            <div class="logo">SAKUPALEZA</div>
            <button class="hamburger" id="hamburger" aria-label="Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-links" id="navLinks">
                <li><a href="{{ url('/') }}">HOME</a></li>
                <li><a href="{{ url('/tentang') }}">TENTANG</a></li>
                <li><a href="{{ route('berita.landing') }}">BERITA</a></li>
                <li><a href="{{ route('galeri.landing') }}">GALERI</a></li>
                <li><a href="{{ route('menu.index') }}">MENU</a></li>
                <li><a href="{{ route('order.create') }}">ORDER</a></li>
                <li><a href="{{ route('kontak.landing') }}">KONTAK</a></li>

                @auth('member')
                    <li>
                        <a href="{{ route('member.dashboard') }}">
                            Hi, {{ Auth::guard('member')->user()->name }}
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('member.form') }}">Login</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<div class="container">
    <h2>Form Pemesanan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('order.payment.preview') }}">
        @csrf

        <table class="order-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
    @php
        $total = 0;
    @endphp
    @foreach($cart as $i => $item)
        @php
            $subtotal = $item['harga'] * $item['jumlah'];
            $total += $subtotal;
        @endphp
        <tr class="item-row" data-index="{{ $i }}">
            <td>
                {{ $item['nama'] }}
                <input type="hidden" name="menu[]" value="{{ $item['nama'] }}">
                <input type="hidden" name="harga[]" value="{{ $item['harga'] }}">
            </td>
            <td>
                Rp {{ number_format($item['harga'], 0, ',', '.') }}
            </td>
            <td>
                <button type="button" class="btn-kurang" data-index="{{ $i }}">-</button>
                <input
                    type="number"
                    name="jumlah[]"
                    class="jumlah-input"
                    id="jumlah-{{ $i }}"
                    data-index="{{ $i }}"
                    data-harga="{{ $item['harga'] }}"
                    value="{{ $item['jumlah'] }}"
                    min="1"
                    style="width:60px; text-align:center;"
                >
                <button type="button" class="btn-tambah" data-index="{{ $i }}">+</button>
            </td>
            <td>
                Rp <span class="subtotal" id="subtotal-{{ $i }}">{{ number_format($subtotal, 0, ',', '.') }}</span>
            </td>
        </tr>
    @endforeach
    <tr>
    <td colspan="3"><strong>Total</strong></td>
        <td><strong>Rp <span id="total-harga">{{ number_format($total, 0, ',', '.') }}</span></strong></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Ongkir</strong></td>
        <td><strong>Rp <span id="ongkir">0</span></strong></td>
    </tr>
    <tr>
        <td colspan="3"><strong>Grand Total</strong></td>
        <td><strong>Rp <span id="grand-total">{{ number_format($total, 0, ',', '.') }}</span></strong></td>
    </tr>
    <a href="{{ route('menu.index') }}" class="btn-order" style="background:#6c757d;">
        + Tambah Menu Lagi
    </a>

</tbody>

        </table>

        <div class="form-fields">
        <input type="text" name="nama_pemesan" placeholder="Nama Lengkap" required>
        <input type="text" name="telepon" placeholder="Nomor Telepon" required>
        <input type="text" name="alamat" placeholder="Alamat Pengiriman" required>
        <select name="kecamatan" id="kecamatan">
            <option value=""> Pilih Kecamatan </option>
            <?php foreach($kecamatans as $kecamatan): ?>
                <option value="<?php echo $kecamatan['id_kecamatan']; ?>"><?php echo $kecamatan['nama_kecamatan']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="kelurahan">Kelurahan:</label>
            <select id="kelurahan" name="kelurahan">
                <option value="">Pilih Kelurahan</option>
            </select>
        </div>

        <!-- <input type="number" name="jarak" id="jarak" placeholder="Jarak (km)" min="1" required> -->

        <input type="hidden" name="ongkir" id="input-ongkir" value="0">

        <div class="button-group" style="margin-top:20px;">
           
            <button type="submit" class="btn-order">
                Pesan Sekarang
            </button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kecamatan').change(function() {
            var kecamatan_id = $(this).val();
            if (kecamatan_id !== '') {
                $.ajax({
                    url: '{{ route("get.kelurahan") }}',
                    type: 'POST',
                    data: {
                        id_kecamatan: kecamatan_id,
                        _token: '{{ csrf_token() }}' // penting!
                    },
                    success: function(response) {
                        $('#kelurahan').html(response.html);
                    }
                });
            } else {
                $('#kelurahan').html('<option value="">Pilih Kelurahan</option>');
            }
        });
    });

    $('#kelurahan').on('change', function () {
        var selectedOption = $(this).find('option:selected');
        var jarak = selectedOption.data('jarak') || 0;
        var tarifPerKm = 1000; // Misal ongkir per km

        var ongkir = jarak * tarifPerKm;

        $('#ongkir').text(ongkir.toLocaleString('id-ID'));
        $('#input-ongkir').val(ongkir);

        // Update grand total
        var total = parseInt($('#total-harga').text().replace(/\./g, '')) || 0;
        var grandTotal = total + ongkir;
        $('#grand-total').text(grandTotal.toLocaleString('id-ID'));
    });

</script>

<script>
    function updateSubtotal(index) {
        const jumlahInput = document.querySelector(`#jumlah-${index}`);
        const quantity = parseInt(jumlahInput.value);
        const harga = parseInt(jumlahInput.dataset.harga);
        const subtotal = harga * quantity;

        document.querySelector(`#subtotal-${index}`).innerText = subtotal.toLocaleString('id-ID');

        updateTotalHarga();
    }

    function updateTotalHarga() {
        let total = 0;
        document.querySelectorAll('.jumlah-input').forEach((input, i) => {
            const harga = parseInt(input.dataset.harga);
            const jumlah = parseInt(input.value);
            total += harga * jumlah;
        });

        document.getElementById('total-harga').innerText = total.toLocaleString('id-ID');

        const ongkir = parseInt(document.getElementById('input-ongkir').value || 0);
        const grandTotal = total + ongkir;
        document.getElementById('grand-total').innerText = grandTotal.toLocaleString('id-ID');
    }

    // Tambah & Kurang tombol
    document.querySelectorAll('.btn-tambah').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = this.dataset.index;
            const input = document.querySelector(`#jumlah-${index}`);
            input.value = parseInt(input.value) + 1;
            updateSubtotal(index);
        });
    });

    document.querySelectorAll('.btn-kurang').forEach(btn => {
        btn.addEventListener('click', function () {
            const index = this.dataset.index;
            const input = document.querySelector(`#jumlah-${index}`);
            const current = parseInt(input.value);
            if (current > 1) {
                input.value = current - 1;
                updateSubtotal(index);
            }
        });
    });

    // Onchange langsung
    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.addEventListener('change', function () {
            updateSubtotal(this.dataset.index);
        });
    });
</script>



@endsection
