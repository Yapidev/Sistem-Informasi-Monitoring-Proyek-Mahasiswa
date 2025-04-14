<div>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed"
        data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px);">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/login-security.svg"
                                alt="" class="img-fluid" width="500">
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                <h2 class="mb-3 fs-7 fw-bolder">Login ke MiPens 😍</h2>
                                <form wire:submit="login">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            aria-describedby="emailHelp" wire:model.blur='email'>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            wire:model.blur='password'>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" name="remember"
                                                id="flexCheckChecked" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Ingat Saya
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="btn btn-primary w-100 py-8 mb-4 rounded-2">Masuk</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sweet Alert for error login --}}
    @script
        <script>
            $wire.on("notify", (data) => {
                Swal.fire({
                    icon: data.icon,
                    title: data.title,
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                });
            });
        </script>
    @endscript
</div>
