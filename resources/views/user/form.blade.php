<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route('users.index') }}">
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="{{ isset($user) ? route('users.update', $user) : route('users.store') }}">
                        @if (isset($user))
                            @method('put')
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="name">Nama User</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" id="name"
                                    value="{{ old('name', isset($user) ? $user->name : '') }}" placeholder="Nama User"
                                    required autofocus />
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if (request()->routeIs('users.create'))
                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="username">Username</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror"
                                        name="username" id="username"
                                        value="{{ old('username', isset($user) ? $user->username : '') }}"
                                        placeholder="Username" required />
                                    @error('username')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="level">Penyakit</label>
                                <div class="col-md-6">
                                    <select id="level" name="level"
                                        class="form-select form-control @error('level') is-invalid @enderror">
                                        <option value="pimpinan">Pimpinan</option>
                                        <option value="user">User</option>
                                    </select>
                                    @error('level')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label"
                                for="password">{{ isset($user) ? 'Reset Password' : 'Password' }}</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password" id="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        @if (request()->routeIs('users.create'))
                            <div class="row mb-3">
                                <label class="col-md-2 col-form-label" for="password_confirmation">Konfirmasi
                                    Password</label>
                                <div class="col-md-6">
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    @error('password_confirmation')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="row justify-content-end">
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-primary rounded">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('image').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image-preview');
                output.src = reader.result;
                document.getElementById('preview-container').style.display = 'flex';
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

</x-layout>
