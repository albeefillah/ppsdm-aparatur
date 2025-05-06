"use strict";
$(document).ready(function () {
    /* -----  Table - Datatable  ----- */
    $("#datatable").DataTable();

    $("#new-xp-default-datatable").DataTable({
        // "order": [[ 3, "desc" ]]
    });

    var table = $("#datatable-buttons").DataTable({
        lengthChange: false,
        buttons: ["copy", "csv", "excel", "pdf", "print"],
    });

    table
        .buttons()
        .container()
        .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
});

// ("use strict");
// $(document).ready(function () {
//     // Matikan dulu inisialisasi default yang tidak perlu
//     if ($.fn.DataTable.isDataTable("#xp-default-datatable")) {
//         $("#xp-default-datatable").DataTable().destroy();
//     }

//     // Inisialisasi ulang pakai AJAX + filter + pagination (nanti aku bantu setup lengkapnya)
//     $("#xp-default-datatable").DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: "{{ route('os.data') }}", // ini route ke controller baru buat datatables
//             data: function (d) {
//                 d.tanggal = $("#filter-tanggal").val();
//                 d.bulan = $("#filter-bulan").val();
//                 d.job = $("#filter-job").val();
//             },
//         },
//         columns: [
//             {
//                 data: "DT_RowIndex",
//                 name: "DT_RowIndex",
//                 orderable: false,
//                 searchable: false,
//             },
//             { data: "tanggal", name: "tanggal" },
//             { data: "nama", name: "nama" },
//             { data: "pekerjaan", name: "pekerjaan" },
//             { data: "aksi", name: "aksi", orderable: false, searchable: false },
//         ],
//     });

//     // Realtime filter (misal onchange atau onkeyup)
//     $("#filter-tanggal, #filter-bulan, #filter-job").on(
//         "change keyup",
//         function () {
//             $("#xp-default-datatable").DataTable().ajax.reload();
//         }
//     );
// });
