<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ route('consultation.result') }}">
                        <span class="badge badge-warning p-2">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="fw-bold mb-4">
                            <h1 class="mb-0">{{ $consultation->percentage . ' %' }}</h1>
                            <h2>{{ $consultation->disease->nama }}</h2>
                        </div>
                        <h5>Tanaman sawit anda terinfeksi penyakit {{ $consultation->disease->nama }} dengan persentase
                            {{ $consultation->percentage . ' %' }}.</h5>
                        <h6>Berikut solusi yang disarankan</h6>
                    </div>
                    <div class="text-center ">
                        <a href="{{ route('consultation.index') }}" class="btn btn-info">
                            <i class="fas fa-check-double me-2"></i>Ulangi Diagnosa
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</x-layout>
