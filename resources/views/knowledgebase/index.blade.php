<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div>
                        <a href="{{ route('knowledgebases.create') }}">
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
                                    <th>Penyakit</th>
                                    <th>Gejala</th>
                                    <th>CF Pakar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($knowledgebases as $knowledgebase)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $knowledgebase->disease->nama }}</td>
                                        <td>{{ $knowledgebase->symptom->kode . ' - ' . $knowledgebase->symptom->gejala }}
                                        <td>{{ $knowledgebase->cfpakar }}
                                        </td>
                                        <td>
                                            <a href="{{ route('knowledgebases.edit', $knowledgebase) }}"
                                                class="badge badge-primary p-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('knowledgebases.destroy', $knowledgebase) }}"
                                                method="post" class="delete-form d-inline">
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
