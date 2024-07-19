<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route('diseases.index') }}">
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data"
                        action="{{ isset($disease) ? route('diseases.update', $disease) : route('diseases.store') }}">
                        @if (isset($disease))
                            @method('put')
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="nama">Nama Penyakit</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama"
                                    value="{{ old('nama', isset($disease) ? $disease->nama : '') }}"
                                    placeholder="Nama Penyakit" autofocus />
                                @error('nama')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="solusi">Solusi</label>
                            <div class="col-md-6">
                                <input id="solusi" type="hidden" name="solusi"
                                    value="{{ old('solusi', isset($disease) ? $disease->solusi : '') }}">
                                <trix-editor input="solusi"
                                    class="form-control @error('solusi') is-invalid @enderror"></trix-editor>
                                @error('solusi')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="image">Gambar Penyakit</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" id="image" />
                                @error('image')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div id="preview-container" class="row mb-3 justify-content-end"
                            style="display: {{ isset($disease) ? 'flex' : 'none' }}">
                            <div class="col-md-10">
                                <div class="col-md-4">
                                    <img id="image-preview" class="card-img-top rounded"
                                        src="{{ isset($disease) ? asset('storage/' . $disease->image) : '#' }}"
                                        alt="Image Preview" />
                                </div>
                            </div>
                        </div>

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

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        })
    </script>

</x-layout>
