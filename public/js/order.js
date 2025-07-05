document.addEventListener('DOMContentLoaded', function() {
    const jarakInput = document.getElementById('jarak');
    const ongkirSpan = document.getElementById('ongkir');
    const totalSpan = document.getElementById('total-harga');
    const grandTotalSpan = document.getElementById('grand-total');
    const ongkirInput = document.getElementById('input-ongkir');

    const tarifPerKm = 2000;

    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    function hitungSubtotalDanGrandTotal() {
        let total = 0;
        // Hitung total belanja
        document.querySelectorAll('.subtotal').forEach(sub => {
            const val = parseInt(sub.textContent.replace(/\./g, '')) || 0;
            total += val;
        });

        // Hitung ongkir
        const jarak = parseFloat(jarakInput.value) || 0;
        const ongkir = tarifPerKm * jarak;

        // Update tampilan
        ongkirSpan.textContent = formatRupiah(ongkir);
        grandTotalSpan.textContent = formatRupiah(total + ongkir);

        // Update input hidden
        if (ongkirInput) {
            ongkirInput.value = ongkir;
        }
    }

    // Saat jarak diubah
    jarakInput.addEventListener('input', hitungSubtotalDanGrandTotal);

    // Saat jumlah barang diubah
    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            const hargaRaw = row.querySelector('input[name="harga[]"]').value;
            const harga = parseInt(hargaRaw) || 0;
            const jumlah = parseInt(this.value) || 1;

            // Hitung subtotal per baris
            const subtotal = harga * jumlah;
            row.querySelector('.subtotal').innerText = formatRupiah(subtotal);

            // Hitung total & ongkir
            hitungSubtotalDanGrandTotal();
        });
    });

    // Jalankan pertama kali untuk memastikan nilai awal benar
    hitungSubtotalDanGrandTotal();
});
