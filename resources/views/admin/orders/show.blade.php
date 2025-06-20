@extends('layouts.backend.master')

@section('title', 'Detail Pesanan — Namarasa')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>📋 • Detail Pesanan #{{ $order->order_id }}</h5>
                        <div class="card-header-right">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fa fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <!-- Informasi Pesanan -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>📝 Informasi Pesanan</h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td><strong>Order ID:</strong></td>
                                                <td>{{ $order->order_id }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tanggal Pesanan:</strong></td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Pembayaran:</strong></td>
                                                <td><strong class="text-success">Rp {{ number_format($order->total_amount * 1000, 0, ',', '.') }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Pembayaran:</strong></td>
                                                <td>
                                                    @if($order->payment_status == 'completed')
                                                        <span class="badge badge-success">Lunas</span>
                                                    @elseif($order->payment_status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @else
                                                        <span class="badge badge-danger">Dibatalkan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Reservasi -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>👤 Informasi Pelanggan</h6>
                                    </div>
                                    <div class="card-body">
                                        @if($order->reservation)
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong>Nama:</strong></td>
                                                    <td>{{ $order->reservation->first_name }} {{ $order->reservation->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email:</strong></td>
                                                    <td>{{ $order->reservation->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Telepon:</strong></td>
                                                    <td>{{ $order->reservation->tel_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Tanggal Reservasi:</strong></td>
                                                    <td>{{ $order->reservation->res_date->format('d/m/Y H:i') }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Meja:</strong></td>
                                                    <td>{{ $order->reservation->table->name ?? 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Jumlah Tamu:</strong></td>
                                                    <td>{{ $order->reservation->guest_number }} orang</td>
                                                </tr>
                                            </table>
                                        @else
                                            <div class="alert alert-info">
                                                <i class="fa fa-info-circle"></i>
                                                Pesanan ini tidak terkait dengan reservasi meja
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Item Pesanan -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>🍽️ Detail Item Pesanan</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Menu</th>
                                                        <th>Harga Satuan</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $no = 1; $grandTotal = 0; @endphp
                                                    @foreach($order->order_items as $item)
                                                        @php 
                                                            $subtotal = $item['price'] * $item['quantity'];
                                                            $grandTotal += $subtotal;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $no++ }}</td>
                                                            <td>{{ $item['name'] }}</td>
                                                            <td>Rp {{ number_format($item['price'] * 1000, 0, ',', '.') }}</td>
                                                            <td>{{ $item['quantity'] }}</td>
                                                            <td>Rp {{ number_format($subtotal * 1000, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr class="table-success">
                                                        <th colspan="4" class="text-right">Total Keseluruhan:</th>
                                                        <th>Rp {{ number_format($grandTotal * 1000, 0, ',', '.') }}</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Status -->
                        @if($order->payment_status != 'completed')
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h6>⚙️ Update Status Pembayaran</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="payment_status">Status Pembayaran:</label>
                                                        <select name="payment_status" id="payment_status" class="form-control">
                                                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="completed" {{ $order->payment_status == 'completed' ? 'selected' : '' }}>Lunas</option>
                                                            <option value="cancelled" {{ $order->payment_status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" class="btn btn-primary form-control">
                                                            <i class="fa fa-save"></i> Update Status
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
