@extends('layouts.backend.master')

@section('title', 'Detail Reservasi & Pesanan — Namarasa')
@section('content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="card card-absolute mt-5 mt-md-4">
                <div class="card-header bg-primary">
                    <h5 class="text-white">📋 • Detail Reservasi & Pesanan</h5>
                </div>
                <div class="card-body">
                    <p>
                        Detail lengkap reservasi dan pesanan dari pelanggan.
                        <a href="{{ route('admin.reservations.index') }}">← Kembali ke daftar reservasi</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Informasi Reservasi -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>📅 Informasi Reservasi</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Nama Lengkap:</strong></td>
                                <td>{{ $reservation->first_name }} {{ $reservation->last_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $reservation->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. Telepon:</strong></td>
                                <td>{{ $reservation->tel_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal & Waktu:</strong></td>
                                <td>{{ $reservation->res_date->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Meja:</strong></td>
                                <td>{{ $reservation->table->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Tamu:</strong></td>
                                <td>{{ $reservation->guest_number }} orang</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Informasi Pesanan -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5>🍽️ Detail Pesanan</h5>
                    </div>
                    <div class="card-body">
                        @if($reservation->orders->count() > 0)
                            @foreach($reservation->orders as $order)
                                <div class="mb-4 p-3 border rounded">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Order ID: {{ $order->order_id }}</h6>
                                        <span class="badge badge-success">{{ ucfirst($order->payment_status) }}</span>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Menu</th>
                                                    <th>Qty</th>
                                                    <th>Harga</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->order_items as $item)
                                                    <tr>
                                                        <td>{{ $item['name'] }}</td>
                                                        <td>{{ $item['quantity'] }}</td>
                                                        <td>Rp {{ number_format($item['price'] * 1000, 0, ',', '.') }}</td>
                                                        <td>Rp {{ number_format($item['price'] * $item['quantity'] * 1000, 0, ',', '.') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr class="table-active">
                                                    <th colspan="3">Total</th>
                                                    <th>Rp {{ number_format($order->total_amount * 1000, 0, ',', '.') }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    
                                    <small class="text-muted">
                                        Dipesan pada: {{ $order->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i>
                                Belum ada pesanan untuk reservasi ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary -->
        @if($reservation->orders->count() > 0)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>📊 Ringkasan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-3">
                                    <div class="card bg-primary text-white">
                                        <div class="card-body">
                                            <h4>{{ $reservation->orders->count() }}</h4>
                                            <p class="mb-0">Total Order</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-success text-white">
                                        <div class="card-body">
                                            <h4>{{ $reservation->orders->sum(function($order) { return collect($order->order_items)->sum('quantity'); }) }}</h4>
                                            <p class="mb-0">Total Item</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-warning text-white">
                                        <div class="card-body">
                                            <h4>Rp {{ number_format($reservation->orders->sum('total_amount') * 1000, 0, ',', '.') }}</h4>
                                            <p class="mb-0">Total Pembayaran</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card bg-info text-white">
                                        <div class="card-body">
                                            <h4>{{ $reservation->guest_number }}</h4>
                                            <p class="mb-0">Jumlah Tamu</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
