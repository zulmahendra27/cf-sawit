<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 30%;">Gejala</th=>
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
                                <form id="myForm" method="POST" action="{{ route('consultation.diagnose') }}">
                                    @csrf
                                    @foreach ($symptoms as $symptom)
                                        <tr>
                                            <td>{{ $symptom->gejala }}</td>
                                            <td>
                                                <div class="selectgroup w-100">
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->kode }}-_-0"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Tidak Tahu</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->kode }}-_-0.2"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Tidak Yakin</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->kode }}-_-0.4"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Mungkin</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->kode }}-_-0.6"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Kemungkinan
                                                            Besar</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->kode }}-_-0.8"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Hampir Pasti</span>
                                                    </label>
                                                    <label class="selectgroup-item col-2">
                                                        <input type="radio" name="gejala[{{ $loop->index }}]"
                                                            value="{{ $symptom->kode }}-_-1"
                                                            class="selectgroup-input" />
                                                        <span class="selectgroup-button text-dark">Pasti</span>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">
                                            <button class="btn btn-success" type="submit">
                                                <i class="fas fa-search-plus me-2"></i>Diagnosa
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const radioButtons = document.querySelectorAll('input[type="radio"]');
            const form = document.getElementById('myForm');

            radioButtons.forEach((radio) => {
                radio.addEventListener('click', function() {
                    if (this.checked) {
                        if (this.dataset.wasChecked === 'true') {
                            this.checked = false;
                            this.dataset.wasChecked = '';
                        } else {
                            this.dataset.wasChecked = 'true';
                        }
                    } else {
                        this.dataset.wasChecked = '';
                    }
                });
            });

            // form.addEventListener('submit', function(event) {
            //     event.preventDefault();

            //     const dataGroups = document.querySelectorAll('.selectgroup');
            //     const results = [];

            //     dataGroups.forEach(group => {
            //         const radios = group.querySelectorAll('input[type="radio"]');
            //         let selectedValue = null;

            //         radios.forEach(radio => {
            //             if (radio.checked) {
            //                 selectedValue = radio.value;
            //             }
            //         });

            //         results.push(selectedValue);
            //     });

            //     console.log(results);
            //     // Array berisi nilai dari setiap grup data atau null jika tidak ada yang dipilih
            // });
        });
    </script>

</x-layout>
