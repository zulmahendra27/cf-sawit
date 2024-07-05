<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div>
                        <a href="{{ route('symptoms.create') }}">
                            <span class="badge badge-primary p-2">
                                <i class="fas fa-plus me-2"></i>Tambah Data
                            </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Gejala</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($symptoms as $symptom)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $symptom->kode }}</td>
                                        <td>{{ $symptom->gejala }}</td>
                                        <td>
                                            <a href="{{ route('symptoms.edit', $symptom) }}"
                                                class="badge badge-primary p-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('symptoms.destroy', $symptom) }}" method="post"
                                                class="delete-form d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="delete-button badge badge-warning p-2">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
