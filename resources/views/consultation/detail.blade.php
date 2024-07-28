<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route('consultation.result') }}">
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="text-center mb-2">

                        <div class="fw-bold mb-2">
                            <h1 class="mb-0">{{ $consultations->consultations->first()->percentage . ' %' }}</h1>
                            <h2>{{ $consultations->consultations->first()->disease->nama }}</h2>
                        </div>
                        <img class="img-thumbnail mb-3" style="width: 400px;"
                            src="{{ asset('storage/' . $consultations->consultations->first()->disease->image) }}"
                            alt="{{ $consultations->consultations->first()->disease->nama }}">
                        <h5>Tanaman sawit anda terinfeksi penyakit
                            {{ $consultations->consultations->first()->disease->nama }}
                            dengan persentase
                            {{ $consultations->consultations->first()->percentage . ' %' }}.</h5>
                    </div>

                </div>
            </div>
            <div class="card mb-2">
                <h4 class="card-header">Solusi</h4>
                <div class="card-body">
                    <h6 class="mb-4">
                        {!! $consultations->consultations->first()->disease->solusi ?? '<h5>-- Belum ada data solusi --</h5>' !!}
                    </h6>
                </div>
            </div>
            <div class="card mb-2">
                <h4 class="card-header">Gejala yang Dialami</h4>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table">
                            <thead>
                                <th>Kode</th>
                                <th>Gejala</th>
                                <th>Nilai CF User</th>
                            </thead>
                            <tbody>
                                @foreach ($consultations->consultations->first()->cfusers as $userSymptom)
                                    <tr>
                                        <td>{{ $userSymptom->symptom->kode }}</td>
                                        <td>{{ $userSymptom->symptom->gejala }}</td>
                                        <td>{{ $userSymptom->cfuser }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <h4 class="card-header">Diagnosa Lain</h4>
                <div class="card-body">
                    <div class="table-responsive mb-3">
                        <table class="display table">
                            <thead>
                                <tr>
                                    <th>Nama Penyakit</th>
                                    <th>Persentase</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($consultations->consultations->count() > 1)
                                    @php
                                        $exist = false;
                                    @endphp
                                    @foreach ($consultations->consultations->skip(1) as $other)
                                        @if ($other->percentage != 100)
                                            @php
                                                $exist = true;
                                            @endphp
                                            <tr>
                                                <td>{{ $other->disease->nama }}</td>
                                                <td>{{ $other->percentage . ' %' }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                    @if (!$exist)
                                        <tr>
                                            <th colspan="2" class="text-center">-- Tidak ada diagnosa lain --</th>
                                        </tr>
                                    @endif
                                @else
                                    <tr>
                                        <th colspan="2" class="text-center">-- Tidak ada diagnosa lain --</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('consultation.index') }}" class="btn btn-info">
                            <i class="fas fa-check-double me-2"></i>Ulangi Diagnosa
                        </a>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>

</x-layout>
