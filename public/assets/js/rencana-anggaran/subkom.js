// public/js/dynamic-input.js
document.addEventListener('DOMContentLoaded', function () {
    var inputSubkom = document.getElementById('inputSubkom');
    var addInputButton = document.getElementById('addInputSubkom');

    // Function to fetch kegiatan options from the server
        function fetchKegiatanOptions(selectElement) {
            fetch('/get-subkom')
                .then(response => response.json())
                .then(options => {
                    console.log(options); 
                    // Clear existing options
                    selectElement.innerHTML = '';

                    // Add default option
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.text = 'Pilih Sub Komponen';
                    selectElement.appendChild(defaultOption);

                    // Add options from the server
                    for (var key in options) {
                        var option = document.createElement('option');
                        option.value = options[key].id;    
                        option.text = options[key].rincian_output.kro.kegiatan_program.kode+ '.'  + options[key].rincian_output.kro.kode + '.'  + options[key].rincian_output.kode + '.'  + options[key].kode + ' - ' + options[key].deskripsi;
                        
                        selectElement.appendChild(option);
                    }
                })
                .catch(error => console.error('Error fetching kegiatan options:', error));
        }

    // Initial fetch for the first row
    fetchKegiatanOptions(document.querySelector('#inputSubkom select[name="subkom[]"]'));

    addInputButton.addEventListener('click', function () {
        var row = document.createElement('div');
        row.className = 'row';

        var subkomCol = document.createElement('div');
        subkomCol.className = 'form-group col-md-6';

        var subkomLabel = document.createElement('label');
        subkomLabel.innerHTML = 'Pilih Sub Komponen';

        var subkomSelect = document.createElement('select');
        subkomSelect.name = 'subkom[]';
        subkomSelect.className = 'form-control xp-select2-single';

        // Fetch kegiatan options for each new row
        fetchKegiatanOptions(subkomSelect);

        setTimeout(function () {
            $('.xp-select2-single').select2();
        }, 100);
        

        var paguCol = document.createElement('div');
        paguCol.className = 'form-group col-md-5';

        var paguLabel = document.createElement('label');
        paguLabel.innerHTML = 'Pagu';

        var paguInput = document.createElement('input');
        paguInput.type = 'text';
        paguInput.name = 'pagu_subkom[]';
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
             inputSubkom.removeChild(row);
         });

        subkomCol.appendChild(subkomLabel);
        subkomCol.appendChild(subkomSelect);

        paguCol.appendChild(paguLabel);
        paguCol.appendChild(paguInput);

        deleteCol.appendChild(deleteLabel);
        deleteCol.appendChild(deleteButton);
 
        row.appendChild(subkomCol);
        row.appendChild(paguCol);
        row.appendChild(deleteCol);

        inputSubkom.appendChild(row);
    });

   
});
