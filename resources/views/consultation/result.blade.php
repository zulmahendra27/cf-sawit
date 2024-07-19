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
                            <button class="alert alert-primary fw-bold h4 col-12 text-start" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse-{{ $keyUser }}"
                                aria-expanded="false" aria-controls="collapse-{{ $keyUser }}">
                                {{ $user->name }}
                            </button>
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
