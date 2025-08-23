<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Akun - Harfelly Hall</title>
    <style>
        body, html { height: 100%; }
        body { background-color: #f8f9fa; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="card shadow" style="width: 28rem;">
        <div class="card-body p-5">
            <h5 class="card-title text-center mb-4 fs-3">Daftar Akun</h5>

            <ul class="nav nav-tabs nav-fill mb-4" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="email-tab" data-bs-toggle="tab" data-bs-target="#email-tab-pane" type="button" role="tab" aria-controls="email-tab-pane" aria-selected="true">Daftar dengan Email</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="phone-tab" data-bs-toggle="tab" data-bs-target="#phone-tab-pane" type="button" role="tab" aria-controls="phone-tab-pane" aria-selected="false">Daftar via WhatsApp</button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="email-tab-pane" role="tabpanel" aria-labelledby="email-tab" tabindex="0">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name_email" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Daftar</button>
                        </div>
                    </form>
                </div>

                <div class="tab-pane fade" id="phone-tab-pane" role="tabpanel" aria-labelledby="phone-tab" tabindex="0">
                     <p class="text-center text-muted mb-4 small">Isi data diri Anda. Akun akan dibuatkan oleh admin dan dikirim melalui WhatsApp.</p>
                    <form>
                        <div class="mb-3">
                            <label for="name_phone" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name_phone" class="form-control" required placeholder="Masukkan nama Anda">
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="form-label">Nomor Telepon (WhatsApp)</label>
                            <input type="tel" name="phone" id="phone" class="form-control" required placeholder="Contoh: 081234567890">
                        </div>
                        <div class="d-grid">
                            <button type="button" id="register-button-wa" class="btn btn-success">Kirim Permintaan via WhatsApp</button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center mt-4">
                Sudah punya akun? <a href="/login">Login di sini</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Logika untuk tombol WhatsApp
        const registerButtonWa = document.getElementById('register-button-wa');
        const nameInputWa = document.getElementById('name_phone');
        const phoneInputWa = document.getElementById('phone');

        registerButtonWa.addEventListener('click', function() {
            const name = nameInputWa.value.trim();
            const phone = phoneInputWa.value.trim();

            if (name === '' || phone === '') {
                alert('Nama dan Nomor Telepon wajib diisi.');
                return;
            }

            // --- Ganti dengan nomor WhatsApp Admin Anda ---
            const adminPhoneNumber = '6283133094736'; // Awali dengan 62

            const message = `Halo Admin, saya ingin mendaftar akun baru.\n\nNama: ${name}\nNomor HP: ${phone}\n\nTerima kasih.`;
            const whatsappURL = `https://wa.me/${adminPhoneNumber}?text=${encodeURIComponent(message)}`;

            window.open(whatsappURL, '_blank');
        });
    </script>

</body>
</html>