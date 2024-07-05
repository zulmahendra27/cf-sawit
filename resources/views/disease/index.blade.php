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
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyakit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diseases as $disease)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $disease->nama }}</td>
                                        <td>
                                            <a href="{{ route('diseases.edit', $disease) }}"
                                                class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('diseases.destroy', $disease) }}" method="post"
                                                class="delete-form d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="delete-button btn btn-sm btn-warning text-white"
                                                    title="Hapus">
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
