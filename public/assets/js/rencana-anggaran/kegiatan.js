// public/js/dynamic-input.js
document.addEventListener('DOMContentLoaded', function () {
    var inputKegiatan = document.getElementById('inputKegiatan');
    var addInputButton = document.getElementById('addInput');
    var form = document.getElementById('dynamicForm');
    var inputIndex = 1;

    // Function to fetch kegiatan options from the server
    function fetchKegiatanOptions(selectElement) {
        fetch('/get-kegiatan')
            .then(response => response.json())
            .then(options => {
                // Clear existing options
                selectElement.innerHTML = '';

                // Add def  ault option
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Kegiatan Program';
                selectElement.appendChild(defaultOption);

                // Add options from the server
                for (var key in options) {
                    // console.log(options[key].kode);
                    var option = document.createElement('option');
                    option.value = options[key].id;
                    option.text =options[key].kode + ' - ' + options[key].deskripsi;
                    selectElement.appendChild(option);
                }
            })
            .catch(error => console.error('Error fetching kegiatan options:', error));
    }

    // Initial fetch for the first row
    fetchKegiatanOptions(document.querySelector('#inputKegiatan select[name="kegiatan_program[]"]'));

    addInputButton.addEventListener('click', function () {
        var row = document.createElement('div');
        row.className = 'row';

        var kegiatanCol = document.createElement('div');
        kegiatanCol.className = 'form-group col-md-6';

        var kegiatanLabel = document.createElement('label');
        kegiatanLabel.innerHTML = 'Pilih Kegiatan Program';

        var kegiatanSelect = document.createElement('select');
        kegiatanSelect.name = 'kegiatan_program[]';
        kegiatanSelect.className = 'form-control xp-select2-single';


        // Fetch kegiatan options for each new row
        fetchKegiatanOptions(kegiatanSelect);

        setTimeout(function () {
            $('.xp-select2-single').select2();
        }, 100);
        
        var paguCol = document.createElement('div');
        paguCol.className = 'form-group col-md-5';

        var paguLabel = document.createElement('label');
        paguLabel.innerHTML = 'Pagu';

        var paguInput = document.createElement('input');
        paguInput.type = 'text';
        paguInput.name = 'pagu_kegiatan[]';
        paguInput.className = 'form-control';
        paguInput.placeholder = 'Masukkan Pagu';

       
        var deleteCol = document.createElement('div');
        deleteCol.className = 'form-group col-md-1';

       
         var deleteLabel = document.createElement('label');
         deleteLabel.innerHTML = '';


         var deleteButton = document.createElement('button');
         deleteButton.type = 'button';
         deleteButton.className = 'btn btn-sm btn-danger mt-4';
         deleteButton.innerHTML = '<i class="fa fa-trash"></i>';

         deleteButton.addEventListener('click', function () {
             // Hapus baris saat tombol Hapus ditekan
             inputKegiatan.removeChild(row);
         });

        kegiatanCol.appendChild(kegiatanLabel);
        kegiatanCol.appendChild(kegiatanSelect);

        paguCol.appendChild(paguLabel);
        paguCol.appendChild(paguInput);

        deleteCol.appendChild(deleteLabel);
        deleteCol.appendChild(deleteButton);
 
        row.appendChild(kegiatanCol);
        row.appendChild(paguCol);
        row.appendChild(deleteCol);

        inputKegiatan.appendChild(row);
    });

   
});
