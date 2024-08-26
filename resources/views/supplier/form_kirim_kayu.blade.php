@extends('supplier.master')

@section('title', 'Form kirim kayu')

@section('content')

<div class="card p-4">
    <h2 class="text-center mb-4 font-weight-bold">Form pengisian data kayu</h2>

        <div class="table-responsive">
            <table class="table table-bordered" id="form-table">
                <thead>
                    <tr>
                        <th class="text-center">Nomor</th>
                        <th class="text-center">Jenis Kayu</th>
                        <th colspan="3" class="text-center">Ukuran (T, L, P)</th>
                        <th class="text-center">Isi Kayu</th>
                        <th class="text-center">Volume (M3)</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="form-1">
                        <td class="nomor text-center">1</td>
                        <td>
                            <select class="custom-select" name="jenis_kayu[]">
                                <option value="Kayu Albasia" selected>Kayu Albasia</option>
                                <option value="Kayu Campuran Keras">Kayu Campuran Keras</option>
                                <option value="Kayu Campuran Lunak">Kayu Campuran Lunak</option>
                              </select>
                        </td>
                        {{-- <td><input type="text" class="form-control" name="jenis_kayu[]"></td> --}}
                        <td><input type="number" class="form-control ukuran" name="tebal_kayu[]" placeholder="Tebal (CM)"></td>
                        <td><input type="number" class="form-control ukuran" name="lebar_kayu[]" placeholder="Lebar (CM)"></td>
                        <td><input type="number" class="form-control ukuran" name="panjang_kayu[]" placeholder="Panjang (CM)"></td>
                        <td><input type="number" class="form-control ukuran" name="isi_kayu[]"></td>
                        <td><input type="number" class="form-control m3" name="m3[]" readonly></td>
                        <td><input type="text" class="form-control" name="keterangan[]"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <button type="button" class="btn btn-primary w-100" onclick="addForm()">
                    <i class="fa fa-plus-circle"></i> Tambah Form
                </button>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <button type="button" class="btn btn-danger w-100" onclick="removeForm()">
                    <i class="fa fa-minus-circle"></i> Kurangi Form
                </button>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <button type="button" class="btn btn-success w-100" data-toggle="modal" data-target="#ValidasiSimpan">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ValidasiSimpan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data yang akan disimpan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <form action="/supplier/simpan_kayu" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="validation-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nomor</th>
                                        <th class="text-center">Jenis Kayu</th>
                                        <th colspan="3" class="text-center">Ukuran (T, L, P)</th>
                                        <th class="text-center">Isi Kayu</th>
                                        <th class="text-center">Volume (M3)</th>
                                        <th class="text-center">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan diisi oleh JavaScript -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="RefreshModal">Refresh</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    
        <script>
            let formCount = 1;
            let selectedJenisKayu = 'alba'; // Default value

            function updateSelectedJenisKayu() {
                const firstSelect = document.querySelector('select[name="jenis_kayu[]"]');
                selectedJenisKayu = firstSelect.value;

                // Update all selects with the new value
                const selects = document.querySelectorAll('select[name="jenis_kayu[]"]');
                selects.forEach((select, index) => {
                    if (index > 0) { // Skip the first select (which is the one being changed)
                        select.value = selectedJenisKayu;
                    }
                });
            }

            function addForm() {
                formCount++;
                const formTable = document.getElementById('form-table').getElementsByTagName('tbody')[0];

                const newRow = document.createElement('tr');
                newRow.id = 'form-' + formCount;

                newRow.innerHTML = `
                    <td class="nomor text-center">${formCount}</td>
                    <td>
                        <select class="custom-select" name="jenis_kayu[]" disabled>
                            <option value="Kayu Albasia" ${selectedJenisKayu === 'Kayu Albasia' ? 'selected' : ''}>Kayu Albasia</option>
                            <option value="Kayu Campuran Keras" ${selectedJenisKayu === 'Kayu Campuran Keras' ? 'selected' : ''}>Kayu Campuran keras</option>
                            <option value="Kayu Campuran Lunak" ${selectedJenisKayu === 'Kayu Campuran Lunak' ? 'selected' : ''}>Kayu Campuran Lunak</option>
                        </select>
                    </td>
                    <td><input type="number" class="form-control ukuran" name="tebal_kayu[]" placeholder="Tebal (CM)"></td>
                    <td><input type="number" class="form-control ukuran" name="lebar_kayu[]" placeholder="Lebar (CM)"></td>
                    <td><input type="number" class="form-control ukuran" name="panjang_kayu[]" placeholder="Panjang (CM)"></td>
                    <td><input type="number" class="form-control ukuran" name="isi_kayu[]"></td>
                    <td><input type="number" class="form-control m3" name="m3[]" readonly></td>
                    <td><input type="text" class="form-control" name="keterangan[]"></td>
                `;

                formTable.appendChild(newRow);
            }

            // Event listener to update selectedJenisKayu when the first form is changed
            document.addEventListener('change', function(e) {
                if (e.target && e.target.name === 'jenis_kayu[]') {
                    updateSelectedJenisKayu();
                }
            });

            function removeForm() {
                if (formCount > 1) {
                    const formTable = document.getElementById('form-table').getElementsByTagName('tbody')[0];
                    formTable.removeChild(formTable.lastElementChild);
                    formCount--;
                }
            }

            document.addEventListener('input', function(event) {
                if (event.target.classList.contains('ukuran')) {
                    let row = event.target.closest('tr');
                    let tebal = parseFloat(row.querySelector('input[name="tebal_kayu[]"]').value) || 0;
                    let lebar = parseFloat(row.querySelector('input[name="lebar_kayu[]"]').value) || 0;
                    let panjang = parseFloat(row.querySelector('input[name="panjang_kayu[]"]').value) || 0;
                    let isi_kayu = parseFloat(row.querySelector('input[name="isi_kayu[]"]').value) || 0;
                    let volume_awal = 1000000 / (tebal * lebar * panjang);
                    let volume = isi_kayu / volume_awal;
                    row.querySelector('input[name="m3[]"]').value = volume.toPrecision(6); 
                    console.log(`Tebal: ${tebal}, Lebar: ${lebar}, Panjang: ${panjang}, Volume: ${volume}`);
                }
            });


            document.getElementById('RefreshModal').addEventListener('click', function() {
                updateModalContent();
            });


            function updateModalContent() {
                const formTable = document.getElementById('form-table').getElementsByTagName('tbody')[0];
                const validationTable = document.getElementById('validation-table').getElementsByTagName('tbody')[0];

                // Hapus data sebelumnya
                validationTable.innerHTML = '';

                // Salin data dari form table ke validation table
                for (let row of formTable.rows) {
                    const newRow = validationTable.insertRow();
                    for (let cell of row.cells) {
                        const newCell = newRow.insertCell();
                        if (cell.querySelector('input')) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = cell.querySelector('input').name;
                            input.value = cell.querySelector('input').value;
                            newCell.appendChild(input);
                            newCell.innerHTML += cell.querySelector('input').value;
                        } else if (cell.querySelector('select')) {
                            const selectedOption = cell.querySelector('select').options[cell.querySelector('select').selectedIndex];
                            console.log('Selected Option:', selectedOption.text); // Baris debugging
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = cell.querySelector('select').name;
                            input.value = selectedOption.value;
                            newCell.appendChild(input);
                            newCell.innerHTML += selectedOption.text;
                        } else {
                            newCell.innerHTML = cell.innerHTML;
                        }
                    }
                }
            }

        </script>

</div>
    
@endsection