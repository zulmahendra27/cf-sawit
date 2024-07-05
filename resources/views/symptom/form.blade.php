<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        {{ $title }}</h4>
                    <a href="{{ route('symptoms.index') }}">
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="{{ isset($symptom) ? route('symptoms.update', $symptom) : route('symptoms.store') }}">
                        @if (isset($symptom))
                            @method('put')
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="kode">Kode</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    name="kode" id="kode"
                                    value="{{ old('kode', isset($symptom) ? $symptom->kode : '') }}" placeholder="Kode"
                                    autofocus />
                                @error('kode')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="gejala">Gejala</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('gejala') is-invalid @enderror"
                                    name="gejala" id="gejala"
                                    value="{{ old('gejala', isset($symptom) ? $symptom->gejala : '') }}"
                                    placeholder="Gejala" autofocus />
                                @error('gejala')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
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

</x-layout>
