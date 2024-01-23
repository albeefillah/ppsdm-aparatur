// public/js/dynamic-input.js
document.addEventListener('DOMContentLoaded', function () {
    var inputKRO = document.getElementById('inputKRO');
    var addInputButton = document.getElementById('addInputKRO');
    var form = document.getElementById('dynamicForm');
    var inputIndex = 1;

    // Function to fetch kegiatan options from the server
        function fetchKegiatanOptions(selectElement) {
            fetch('/get-kro')
                .then(response => response.json())
                .then(options => {
                    // console.log(options); 
                    // Clear existing options
                    selectElement.innerHTML = '';

                    // Add default option
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.text = 'Pilih KRO';
                    selectElement.appendChild(defaultOption);

                    // Add options from the server
                    for (var key in options) {
                        var option = document.createElement('option');
                        option.value = options[key].id;    
                        option.text = options[key].kegiatan_program.kode+ '.'  + options[key].kode + ' - ' + options[key].deskripsi;
                        
                        
                        selectElement.appendChild(option);
                    }
                })
                .catch(error => console.error('Error fetching kegiatan options:', error));
        }

    // Initial fetch for the first row
    fetchKegiatanOptions(document.querySelector('#inputKRO select[name="kro[]"]'));

    addInputButton.addEventListener('click', function () {
        var row = document.createElement('div');
        row.className = 'row';

        var kroCol = document.createElement('div');
        kroCol.className = 'form-group col-md-6';

        var kroLabel = document.createElement('label');
        kroLabel.innerHTML = 'Pilih KRO';

        var kroSelect = document.createElement('select');
        kroSelect.name = 'kro[]';
        kroSelect.className = 'form-control xp-select2-single';

        // Fetch kegiatan options for each new row
        fetchKegiatanOptions(kroSelect);

        setTimeout(function () {
            $('.xp-select2-single').select2();
        }, 100);
        

        var paguCol = document.createElement('div');
        paguCol.className = 'form-group col-md-5';

        var paguLabel = document.createElement('label');
        paguLabel.innerHTML = 'Pagu';

        var paguInput = document.createElement('input');
        paguInput.type = 'text';
        paguInput.name = 'pagu_kro[]';
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
             inputKRO.removeChild(row);
         });

        kroCol.appendChild(kroLabel);
        kroCol.appendChild(kroSelect);

        paguCol.appendChild(paguLabel);
        paguCol.appendChild(paguInput);

        deleteCol.appendChild(deleteLabel);
        deleteCol.appendChild(deleteButton);
 
        row.appendChild(kroCol);
        row.appendChild(paguCol);
        row.appendChild(deleteCol);

        inputKRO.appendChild(row);
    });

   
});
