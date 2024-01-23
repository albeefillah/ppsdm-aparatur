// public/js/dynamic-input.js
document.addEventListener('DOMContentLoaded', function () {
    var inputMataAnggaran = document.getElementById('inputMataAnggaran');
    var addInputButton = document.getElementById('addInput');
    var form = document.getElementById('dynamicForm');
    var inputIndex = 1;

    // Function to fetch mata anggaran options from the server
    function fetchMatangOptions(selectElement) {
        fetch('/get-matang')
            .then(response => response.json())
            .then(options => {
                // Clear existing options
                selectElement.innerHTML = '';

                // Add default option
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih Mata Anggaran';
                selectElement.appendChild(defaultOption);

                // Add options from the server
                for (var key in options) {
                    // console.log(options[key].kode);
                    var option = document.createElement('option');
                    option.value = options[key].id;
                    option.text =options[key].akun + ' - ' + options[key].jenis_belanja;
                    selectElement.appendChild(option);
                }
            })
            .catch(error => console.error('Error fetching mata anggaran options:', error));
    }

    // Initial fetch for the first row
    fetchMatangOptions(document.querySelector('#inputMataAnggaran select[name="mata_anggaran[]"]'));

    addInputButton.addEventListener('click', function () {
        var row = document.createElement('div');
        row.className = 'row';

        var matangCol = document.createElement('div');
        matangCol.className = 'form-group col-md-6';

        var matangLabel = document.createElement('label');
        matangLabel.innerHTML = 'Pilih Mata Anggaran';

        var matangSelect = document.createElement('select');
        matangSelect.name = 'mata_anggaran[]';
        matangSelect.className = 'form-control xp-select2-single';


        // Fetch mata anggaran options for each new row
        fetchMatangOptions(matangSelect);

        setTimeout(function () {
            $('.xp-select2-single').select2();
        }, 100);
        
        var paguCol = document.createElement('div');
        paguCol.className = 'form-group col-md-5';

        var paguLabel = document.createElement('label');
        paguLabel.innerHTML = 'Pagu';

        var paguInput = document.createElement('input');
        paguInput.type = 'number';
        paguInput.name = 'pagu_mata_anggaran[]';
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
             inputMataAnggaran.removeChild(row);
         });

        matangCol.appendChild(matangLabel);
        matangCol.appendChild(matangSelect);

        paguCol.appendChild(paguLabel);
        paguCol.appendChild(paguInput);

        deleteCol.appendChild(deleteLabel);
        deleteCol.appendChild(deleteButton);
 
        row.appendChild(matangCol);
        row.appendChild(paguCol);
        row.appendChild(deleteCol);

        inputMataAnggaran.appendChild(row);
    });

   
});
