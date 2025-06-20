<x-guest-layout>

    <!-- ------------------------ Cart Hero Section ------------------------ -->
    <section>
        <div class="container">
            <div class="mt-4 mb-3 bg-warning text-white rounded-3">
                <div class="p-4">
                    <h1 class="h2 mb-0">Keranjang Pesanan</h1>
                    <p class="mb-0">
                        Berikut adalah daftar menu yang telah Anda pilih untuk dipesan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ------------------------ Cart Content Section ------------------------ -->
    <section>
        <div class="container" style="margin-bottom: 100px">
            <div class="row g-3">
                <div class="col-md-12">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php
                        $total = 0;
                        foreach ($cartItems as $item) {
                            $total += $item['price'] * $item['quantity'];
                        }
                    @endphp

                    @if(count($cartItems) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $key => $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                </div>
                                            </td>
                                            <td>Rp.{{ $item['price'] }}.000,00</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <form action="{{ route('cart.update', [$key, 'decrement']) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary me-2" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </form>
                                                    <span class="me-2">{{ $item['quantity'] }}</span>
                                                    <form action="{{ route('cart.update', [$key, 'increment']) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                            <td>Rp.{{ $item['price'] * $item['quantity'] }}.000,00</td>
                                            <td>
                                                <form action="{{ route('cart.remove', $key) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini dari keranjang?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Total:</td>
                                        <td class="fw-bold">
                                            Rp.{{ $total }}.000,00
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Pembayaran -->
                        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-success text-white">
                                        <h5 class="modal-title" id="paymentModalLabel">
                                            <i class="fas fa-money-bill-wave me-2"></i>
                                            Pembayaran Pesanan
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Detail Pembayaran</h5>
                                                <p class="mb-0"><strong>Total Pesanan:</strong> Rp {{ number_format($total * 1000, 0, ',', '.') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h5>Informasi Pembayaran</h5>
                                                <p>Silakan membayar pesanan Anda melaui midtrans.</p>
                                                <p>Setelah pembayaran berhasil, pesanan Anda akan segera diproses.</p>
                                                <p>Terima kasih atas pesanan Anda!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-success" id="pay-button">
                                            <i class="fas fa-check me-2"></i>
                                            Bayar Dengan Midtrans
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('menus.index') }}" class="btn btn-outline-success">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Menu
                            </a>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                <i class="fas fa-money-bill-wave me-2"></i>Lanjutkan Pembayaran
                            </button>
                        </div>
                    @else
                        <div class="alert alert-info text-center">
                            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                            <h4 class="mb-3">Keranjang Anda Kosong</h4>
                            <p>Tambahkan menu favorit Anda ke keranjang!</p>
                            <a href="{{ route('menus.index') }}" class="btn btn-warning">Lihat Menu</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
    document.getElementById('pay-button').onclick = function () {
        fetch("{{ route('midtrans.token') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ total: {{ $total * 1000 }} })
        })
        .then(response => response.json())
        .then(data => {
            window.snap.pay(data.token, {
                onSuccess: function(result){
                    // Call payment success handler
                    fetch("{{ route('payment.success') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            order_id: data.order_id,
                            transaction_status: result.transaction_status
                        })
                    })
                    .then(response => {
                        alert("Pembayaran berhasil!");
                        // Redirect to home page after successful payment
                        window.location.href = "{{ url('/') }}";
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Pembayaran berhasil, tapi terjadi kesalahan saat menyimpan data!");
                        window.location.href = "{{ url('/') }}";
                    });
                },
                onPending: function(result){ alert("Menunggu pembayaran!"); },
                onError: function(result){ alert("Pembayaran gagal!"); }
            });
        });
    };
    </script>
</x-guest-layout>
