<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    @if (auth()->user()->level === 'user')
                        <div class="table-responsive">
                            <table class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penyakit</th>
                                        <th>Persentase</th>
                                        <th>Tanggal<br>Diagnosa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($consultations as $consultation)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $consultation->highestConsultation->disease->nama }}</td>
                                            <td>{{ $consultation->highestConsultation->percentage . ' %' }}</td>
                                            <td>{{ $consultation->created_at->format('d-m-Y') }}<br>{{ $consultation->created_at->format('H:i') . ' WIB' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('consultation.detail', $consultation) }}"
                                                    class="btn btn-sm btn-info" title="Detail">
                                                    <i class="fas fa-align-center me-2"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <th colspan="5" class="text-center">-- Tidak ada data --</th>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @else
                        @forelse ($consultations as $keyUser => $user)
                            <div class="row d-flex justify-content-between mb-3">
                                <div class="{{ auth()->user()->level == 'admin' ? 'col-md-12' : 'col-md-10' }}">
                                    <button class="alert col-12 alert-primary mb-2 fw-bold h4 text-start" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse-{{ $keyUser }}"
                                        aria-expanded="false" aria-controls="collapse-{{ $keyUser }}">
                                        <div>{{ $user->name }}</div>
                                    </button>
                                </div>
                                @can('pimpinan')
                                    <div class="col-md-2 ps-md-0 mb-2 d-flex align-items-center">
                                        <a href="{{ route('report.consultation', $user) }}" target="_blank"
                                            class="btn btn-sm btn-success text-white col-12 fs-6 d-flex justify-content-center align-items-center {{ $user->logs->count() == 0 ? 'disabled' : '' }}"
                                            style="height: 100%">
                                            <i class="fas fa-print me-2"></i>Cetak Laporan
                                        </a>
                                    </div>
                                @endcan
                            </div>
                            <div class="collapse" id="collapse-{{ $keyUser }}">
                                <div class="table-responsive">
                                    <table class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Penyakit</th>
                                                <th>Persentase</th>
                                                <th>Tanggal<br>Diagnosa</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($user->logs as $consultation)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $consultation->highestConsultation->disease->nama }}
                                                    </td>
                                                    <td>{{ $consultation->highestConsultation->percentage . ' %' }}
                                                    </td>
                                                    <td>{{ $consultation->created_at->format('d-m-Y') }}<br>{{ $consultation->created_at->format('H:i') . ' WIB' }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('consultation.detail', $consultation) }}"
                                                            class="btn btn-sm btn-info" title="Detail">
                                                            <i class="fas fa-align-center me-2"></i> Detail
                                                        </a>
                                                        <form
                                                            action="{{ route('consultation.delete', $consultation) }}"
                                                            method="post" class="delete-form d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button
                                                                class="btn btn-sm btn-warning text-white delete-button p-2">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <th colspan="5" class="text-center fs-5">-- Tidak ada data --
                                                    </th>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <h2>-- Belum ada user yang melakukan diagnosa --</h2>
                        @endforelse
                    @endif
                </div>
            </div>
        </div>

    </div>

</x-layout>
