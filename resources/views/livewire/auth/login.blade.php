<div class="d-flex align-items-center justify-content-center min-vh-100" style="background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);">
    <div class="card shadow-lg border-0" style="max-width: 400px; width: 100%; border-radius: 20px; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px);">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <img src="{{ asset('img/bulog.webp') }}" alt="Bulog Logo" style="height: 80px; width: auto;" class="mb-3">
                <h4 class="fw-bold text-dark mb-1">Selamat Datang</h4>
                <p class="text-muted small">Silakan login untuk mengakses sistem</p>
            </div>

            <form wire:submit.prevent="login">
                <div class="mb-3">
                    <label for="email" class="form-label small fw-semibold text-muted">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                        <input wire:model="email" type="email" class="form-control bg-light border-0 @error('email') is-invalid @enderror" id="email" placeholder="admin@bulog.co.id">
                    </div>
                    @error('email') <div class="invalid-feedback d-block small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label small fw-semibold text-muted">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-muted"></i></span>
                        <input wire:model="password" type="password" class="form-control bg-light border-0 @error('password') is-invalid @enderror" id="password" placeholder="••••••••">
                    </div>
                    @error('password') <div class="invalid-feedback d-block small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input wire:model="remember" class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small text-muted" for="remember">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100 fw-bold py-2 shadow-sm text-white" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border: none; border-radius: 10px;">
                    <span wire:loading.remove>Login Ke Sistem</span>
                    <span wire:loading class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
            </form>
        </div>
    </div>
</div>
