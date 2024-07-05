<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route('diseases.create') }}">
                        <span class="badge badge-primary p-2">
                            <i class="fas fa-plus me-2"></i>Tambah Data
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>Gejala</th=>
                                    <th>Pilihan</th>
                                </tr>
                                {{-- <tr>
                                    <th>Tidak<br>Tahu</th>
                                    <th>Tidak<br>Yakin</th>
                                    <th>Mungkin</th>
                                    <th>Kemungkinan<br>Besar</th>
                                    <th>Hampir<br>Pasti</th>
                                    <th>Pasti</th>
                                </tr> --}}
                            </thead>
                            <tbody>
                                @foreach ($symptoms as $symptom)
                                    <tr>
                                        <td>{{ $symptom->gejala }}</td>
                                        <td>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item col-2">
                                                    <input type="radio" name="gejala-{{ $loop->index }}"
                                                        value="50" class="selectgroup-input" checked="" />
                                                    <span class="selectgroup-button text-dark">Tidak Tahu</span>
                                                </label>
                                                <label class="selectgroup-item col-2">
                                                    <input type="radio" name="gejala-{{ $loop->index }}"
                                                        value="100" class="selectgroup-input" />
                                                    <span class="selectgroup-button text-dark">Tidak Yakin</span>
                                                </label>
                                                <label class="selectgroup-item col-2">
                                                    <input type="radio" name="gejala-{{ $loop->index }}"
                                                        value="150" class="selectgroup-input" />
                                                    <span class="selectgroup-button text-dark">Mungkin</span>
                                                </label>
                                                <label class="selectgroup-item col-2">
                                                    <input type="radio" name="gejala-{{ $loop->index }}"
                                                        value="200" class="selectgroup-input" />
                                                    <span class="selectgroup-button text-dark">Kemungkinan Besar</span>
                                                </label>
                                                <label class="selectgroup-item col-2">
                                                    <input type="radio" name="gejala-{{ $loop->index }}"
                                                        value="200" class="selectgroup-input" />
                                                    <span class="selectgroup-button text-dark">Hampir Pasti</span>
                                                </label>
                                                <label class="selectgroup-item col-2">
                                                    <input type="radio" name="gejala-{{ $loop->index }}"
                                                        value="200" class="selectgroup-input" />
                                                    <span class="selectgroup-button text-dark">Pasti</span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout>
