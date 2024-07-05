<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        {{ $title }}</h4>
                    <a href="{{ route('knowledgebases.index') }}">
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="{{ isset($knowledgebase) ? route('knowledgebases.update', $knowledgebase) : route('knowledgebases.store') }}">
                        @if (isset($knowledgebase))
                            @method('put')
                        @endif
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="disease_id">Penyakit</label>
                            <div class="col-md-6">
                                <select id="disease_id" name="disease_id"
                                    class="form-select form-control @error('disease_id') is-invalid @enderror">
                                    @forelse ($diseases as $disease)
                                        <option value="{{ $disease->id }}" @selected(old('disease_id', isset($knowledgebase) ? $knowledgebase->disease_id : '') == $disease->id)>
                                            {{ $disease->nama }}</option>
                                    @empty
                                        <option value="0">-- Tidak ada data --</option>
                                    @endforelse
                                </select>
                                @error('disease_id')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="symptom_id">Gejala</label>
                            <div class="col-md-6">
                                <select id="symptom_id" name="symptom_id"
                                    class="form-select form-control @error('symptom_id') is-invalid @enderror">
                                    @forelse ($symptoms as $symptom)
                                        <option value="{{ $symptom->id }}" @selected(old('symptom_id', isset($knowledgebase) ? $knowledgebase->symptom_id : '') == $symptom->id)>
                                            {{ $symptom->kode . ' - ' . $symptom->gejala }}</option>
                                    @empty
                                        <option value="0">-- Tidak ada data --</option>
                                    @endforelse
                                </select>
                                @error('symptom_id')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-2 col-form-label" for="cfpakar">Nilai CF Pakar</label>
                            <div class="col-md-6">
                                <input type="number" step="0.1" min="0" max="1"
                                    class="form-control @error('cfpakar') is-invalid @enderror" name="cfpakar"
                                    id="cfpakar"
                                    value="{{ old('cfpakar', isset($knowledgebase) ? $knowledgebase->cfpakar : 1) }}"
                                    placeholder="Nilai CF Pakar" autofocus />
                                @error('cfpakar')
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
