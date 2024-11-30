$(function(e) {
	var table = $('#example').DataTable( {
//                dom: 'Bfrtip',
		lengthChange: false,
                stateSave: false,
                paging:   true,
                // scrollY: '50vh',
                scrollCollapse: true,
                scrollX: true,
		buttons: [ 'print',{extend: 'excelHtml5',footer: true,exportOptions: {columns: ':visible'}},{extend: 'pdfHtml5',footer: true,exportOptions: {columns: ':visible'},orientation: 'landscape',pageSize: 'LEGAL'}, 'colvis' ],
//                buttons: [ 'print',{extend: 'excelHtml5',footer: true,exportOptions: {columns: ':visible'}},'colvis' ],
	} );
        

	table.buttons().container()
		.appendTo( '#example_wrapper .col-md-6:eq(0)' );
	$('#example-2').DataTable();
	$('#example-1').DataTable( {
		"order": [[ 3, "desc" ]]
	});
});