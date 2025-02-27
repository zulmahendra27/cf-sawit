<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <style>
        select.no-arrow {
            text-align-last: center;
            -moz-text-align-last: center;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background: none;
            padding-right: 1rem;
        }
    </style>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form id="myForm" method="POST" action="{{ route('consultation.diagnose') }}">
                            <table class="display table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th style="width: 80%;">Gejala</th=>
                                        <th>Pilihan</th>
                                    </tr>
                                </thead>
                                @csrf
                                <tbody id="dataInTable">
                                    @foreach ($symptoms as $symptom)
                                        <tr>
                                            <td>{{ $symptom->gejala }}</td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-select no-arrow" name="gejala[]">
                                                        <option value="-">Pilih Jika Sesuai</option>
                                                        <option value="{{ $symptom->id }}-_-0">Tidak Tahu</option>
                                                        <option value="{{ $symptom->id }}-_-0.2">Tidak Yakin</option>
                                                        <option value="{{ $symptom->id }}-_-0.4">Mungkin</option>
                                                        <option value="{{ $symptom->id }}-_-0.6">Kemungkinan Besar
                                                        </option>
                                                        <option value="{{ $symptom->id }}-_-0.8">Hampir Pasti</option>
                                                        <option value="{{ $symptom->id }}-_-1">Pasti</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="selectgroup w-100">
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->id }}-_-0" class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Tidak Tahu</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->id }}-_-0.2"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Tidak
                                                            Yakin</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->id }}-_-0.4"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Mungkin</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->id }}-_-0.6"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Kemungkinan
                                                            Besar</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->id }}-_-0.8"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Hampir
                                                            Pasti</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->id }}-_-1"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Pasti</span>
                                                    </label>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fas fa-search-plus me-2"></i>Diagnosa
                                            </button>
                                            <a href="{{ route('consultation.index') }}"
                                                class="btn btn-warning text-white">
                                                <i class="fas fa-recycle me-2"></i>Clear
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout>
