$(document).ready(function () {
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    // const form = document.getElementById("myForm");

    radioButtons.forEach((radio) => {
        radio.addEventListener("click", function () {
            if (this.checked) {
                if (this.dataset.wasChecked === "true") {
                    this.checked = false;
                    this.dataset.wasChecked = "";
                } else {
                    this.dataset.wasChecked = "true";
                }
            } else {
                this.dataset.wasChecked = "";
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

    // Variable to track if a radio button was already checked
    let alreadyChecked = false;
    let firstChecked = null;

    // Set CSRF token in AJAX request header
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    // Function to handle the AJAX request
    function triggerAjax(data_value) {
        // Your AJAX request here
        $.ajax({
            url: "/consultation/findSymptoms", // URL tujuan
            method: "POST", // Metode pengiriman
            data: {
                // Data yang ingin dikirim
                data_value: data_value,
                message: "Select option changed",
            },
            success: function (response) {
                console.log("AJAX request successful");
                // console.log(response);

                // Kode untuk menambahkan gejala ke dalam tabel di sini
                let obj = response.symptoms;
                let symptoms = Object.values(obj);

                // Kosongkan tabel gejala terlebih dahulu
                $("#dataInTable").empty();

                // Loop untuk setiap gejala dan tambahkan ke tabel
                symptoms.forEach(function (symptom, index) {
                    let row = `
                        <tr>
                            <td>${symptom.gejala}</td>
                            <td>
                                <div class="form-group">
                                    <select class="form-select no-arrow" name="gejala[${index}]">
                                        <option value="-">Pilih Jika Sesuai</option>
                                        <option value="${symptom.id}-_-0">Tidak Tahu</option>
                                        <option value="${symptom.id}-_-0.2">Tidak Yakin</option>
                                        <option value="${symptom.id}-_-0.4">Mungkin</option>
                                        <option value="${symptom.id}-_-0.6">Kemungkinan Besar</option>
                                        <option value="${symptom.id}-_-0.8">Hampir Pasti</option>
                                        <option value="${symptom.id}-_-1">Pasti</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    `;

                    $("#dataInTable").append(row);
                });

                // Jika ada nilai yang sudah dipilih pertama kali, periksa kembali radio button yang sesuai
                if (firstChecked !== null) {
                    $('select option[value="' + firstChecked + '"]').prop('selected', true);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log("AJAX request failed");
                console.log(textStatus, errorThrown);
            },
        });
    }

    // Event listener for radio button changes
    $('select[name^="gejala"]').change(function () {
        if (this.value !== "-") {
            if (!alreadyChecked) {
                alreadyChecked = true;
                firstChecked = this.value;
                triggerAjax(this.value);
            }
        } else {
            if (this.value === firstChecked) {
                alreadyChecked = false;
                firstChecked = null;
                triggerAjax(this.value);
            }
        }
    });
});
