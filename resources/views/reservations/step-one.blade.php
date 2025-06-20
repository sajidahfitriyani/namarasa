<x-guest-layout>

    <!-- ------------------------   Reservation Step One Form Section ------------------------ -->
    <section class="my-5">
        <div class="container">
            <div class="row my-4 mx-1">
                <div
                    class="
                col-md-12
                mx-auto
                bg-warning
                text-white
                p-md-5 p-4
                shadow-lg
                rounded-3
              ">
                    <small>RESERVASI NAMARASA</small>
                    <h1 class="fw-bold">Reservasi tempat meja di Namarasa</h1>
                    <p>Isi form dibawah dengan benar untuk reservasi di Namarasa</p>
                    <hr />
                    <form method="POST" action="{{ route('reservations.store.step.one') }}" class="row g-3">
                        @csrf
                        <div class="col-md-6">
                            <label for="nama_depan_input" class="form-label">Nama Depan</label>
                            <input type="text" name="first_name" value="{{ $reservation->first_name ?? '' }}"
                                placeholder="Masukkan nama depan anda" class="form-control" id="nama_depan_input" />
                            @error('first_name')
                                <p class="register_text_error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nama_belakang_input" class="form-label">Nama Belakang</label>
                            <input type="text" name="last_name" value="{{ $reservation->last_name ?? '' }}"
                                placeholder="Masukkan nama belakang anda" class="form-control"
                                id="nama_belakang_input" />
                            @error('last_name')
                                <p class="register_text_error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="email_input" class="form-label">Email</label>
                            <input type="text" name="email" value="{{ $reservation->email ?? '' }}"
                                placeholder="contoh : namarasa@example.com" class="form-control" id="email_input" />
                            @error('email')
                                <p class="register_text_error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nomor_telepon_input" class="form-label">Nomor Telepon</label>
                            <input type="number" name="tel_number" value="{{ $reservation->tel_number ?? '' }}"
                                placeholder="Masukkan nomor telepon anda" class="form-control"
                                id="nomor_telepon_input" />
                            @error('tel_number')
                                <p class="register_text_error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="nomor_telepon_input" class="form-label">Tanggal Reservasi</label>
                            <input type="datetime-local" id="res_date" name="res_date"
                                min="{{ $min_date->format('Y-m-d\TH:i:s') }}"
                                max="{{ $max_date->format('Y-m-d\TH:i:s') }}"
                                value="{{ $reservation ? $reservation->res_date->format('Y-m-d\TH:i:s') : '' }}"
                                class="form-control" />
                            <span class="mt-1 fs-12">Dimohon untuk memilih jam 17:00-23:00.</span>
                            @error('res_date')
                                <p class="register_text_error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="jenis_kelamin_input" class="form-label">Jumlah Tamu</label>
                            <select name="guest_number" id="jenis_kelamin_input" class="form-select">
                                <option value="" selected>Jumlah Tamu ...</option>
                                <option value="1" {{ ($reservation->guest_number ?? '') == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ ($reservation->guest_number ?? '') == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ ($reservation->guest_number ?? '') == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ ($reservation->guest_number ?? '') == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ ($reservation->guest_number ?? '') == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ ($reservation->guest_number ?? '') == '6' ? 'selected' : '' }}>6</option>
                                <option value="7" {{ ($reservation->guest_number ?? '') == '7' ? 'selected' : '' }}>7</option>
                                <option value="8" {{ ($reservation->guest_number ?? '') == '8' ? 'selected' : '' }}>8</option>
                                <option value="9" {{ ($reservation->guest_number ?? '') == '9' ? 'selected' : '' }}>9</option>
                                <option value="10" {{ ($reservation->guest_number ?? '') == '10' ? 'selected' : '' }}>10</option>
                            </select>
                            @error('guest_number')
                                <p class="register_text_error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-12 mx-auto mt-4 text-center">
                            <p class="text-center col-md-8 mx-auto">
                                Tahap selanjutnya adalah memilih meja yang akan anda tempati, harap konfirmasi data dan
                                nomor telepon yang telah diisi
                            </p>
                            <button type="submit" class="btn btn-outline-light text-white px-5 py-2 fw-bold">
                                Selanjutnya &nbsp; <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</x-guest-layout>
