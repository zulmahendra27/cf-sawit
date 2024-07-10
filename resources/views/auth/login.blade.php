<x-auth-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <body>
        <div class="container">
            <div class="row vh-100 mx-2">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto my-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <h2 class="text-center fw-bold mb-5">Silahkan Login</h2>
                            <form action="{{ route('auth.login') }}" method="POST">
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username" placeholder="Username" autofocus required>
                                    <label for="username">Username</label>
                                    @error('username')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        required>
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-primary btn-login text-uppercase fw-bold"
                                        type="submit">Login</button>
                                </div>
                                <hr class="mt-4 mb-2">
                                <p>Belum punya akun? <a href="{{ route('auth.registerview') }}">Daftar sekarang.</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</x-auth-layout>
