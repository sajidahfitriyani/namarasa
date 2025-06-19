@extends('layouts.guest')

@section('content')
    <!-- ------------------------ Cart Section ------------------------ -->
    <section class="my-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold">Keranjang Belanja</h2>
                        <a href="{{ url('/') }}" class="text-decoration-none text-warning">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>

                    @if($carts->isEmpty())
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-cart fa-4x text-warning mb-3"></i>
                            <h3 class="fw-bold mb-3">Keranjang Kosong</h3>
                            <p class="text-muted">Tidak ada item di keranjang Anda. Mulai belanja sekarang!</p>
                            <a href="{{ url('/menus') }}" class="btn btn-warning text-white px-4">
                                <i class="fas fa-shopping-bag me-2"></i>
                                Mulai Belanja
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Menu</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td>
                                                <img src="{{ Storage::url($cart->menu->image) }}" 
                                                     alt="{{ $cart->menu->name }}"
                                                     class="img-thumbnail" 
                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <h5 class="mb-0">{{ $cart->menu->name }}</h5>
                                                <small class="text-muted">{{ $cart->menu->description }}</small>
                                            </td>
                                            <td>Rp.{{ number_format($cart->menu->price, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="input-group">
                                                        <input type="number" 
                                                               name="quantity" 
                                                               value="{{ $cart->quantity }}" 
                                                               class="form-control" 
                                                               min="1" 
                                                               max="100">
                                                        <button type="submit" class="btn btn-warning text-white">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>Rp.{{ number_format($cart->menu->price * $cart->quantity, 0, ',', '.') }}</td>
                                            <td>
                                                <form action="{{ route('cart.remove', $cart->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold mb-3">Ringkasan Pesanan</h4>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Total Item</span>
                                            <span>{{ $carts->sum('quantity') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Total Harga</span>
                                            <span>Rp.{{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Total yang Harus Dibayar</span>
                                            <span class="fw-bold">Rp.{{ number_format($total, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title fw-bold mb-3">Pembayaran</h4>
                                        <p class="mb-3">Silakan lakukan pembayaran melalui metode berikut:</p>
                                        <div class="d-flex gap-3">
                                            <button class="btn btn-warning text-white w-100">
                                                <i class="fab fa-cc-visa me-2"></i>
                                                Kartu Kredit
                                            </button>
                                            <button class="btn btn-warning text-white w-100">
                                                <i class="fab fa-google-wallet me-2"></i>
                                                E-Wallet
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
