<x-guest-layout>

    <!-- ------------------------ Cart Hero Section ------------------------ -->
    <section>
        <div class="container">
            <div class="mt-4 mb-3 bg-warning text-white rounded-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 p-5 my-auto align-center">
                            <h1 class="display-5 fw-bold">Keranjang Belanja Anda</h1>
                            <p class="col-md-10">
                                Berikut adalah daftar menu yang telah Anda pilih untuk dipesan.
                            </p>
                        </div>
                        <div class="col-md-4 my-auto p-0">
                            <img src="{{ url('images/landing-page/shopping-cart.png') }}"
                                class="img-fluid img-jumbotron d-none d-md-block" />
                        </div>
                    </div>
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
                @foreach($cartItems as $id => $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://via.placeholder.com/50x50?text={{ substr($item['name'], 0, 2) }}" 
                                     alt="{{ $item['name'] }}" 
                                     class="img-thumbnail" 
                                     style="width: 50px; height: 50px; object-fit: cover;">
                                <div class="ms-3">
                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                </div>
                            </div>
                        </td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>
                            {{ $item['quantity'] }}
                        </td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#paymentModal">
                            <i class="fas fa-money-bill-wave"></i> Lanjutkan Pembayaran
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
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
                            <p class="mb-0"><strong>Total Pesanan:</strong> Rp {{ number_format($total, 0, ',', '.') }}</p>
                            <p class="mb-0"><strong>Metode Pembayaran:</strong> Tunai</p>
                            <p><strong>Status:</strong> Menunggu Pembayaran</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Informasi Pembayaran</h5>
                            <p>Silakan membayar pesanan Anda ke kasir.</p>
                            <p>Setelah pembayaran berhasil, pesanan Anda akan segera diproses.</p>
                            <p>Terima kasih atas pesanan Anda!</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success" onclick="alert('Terima kasih! Pesanan Anda akan segera diproses.')">
                        <i class="fas fa-check me-2"></i>
                        Konfirmasi Pembayaran
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
