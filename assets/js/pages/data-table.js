// //[Data Table Javascript]

// //Project:	CRMi - Responsive Admin Template
// //Primary use:   Used only for the Data Table

// $(function () {
//     "use strict";

//     $('#example1').DataTable();
//     $('#example2').DataTable({
//       'paging'      : true,
//       'lengthChange': false,
//       'searching'   : false,
//       'ordering'    : true,
//       'info'        : true,
//       'autoWidth'   : false
//     });
	
	
// 	$('#example1').DataTable( {
// 		dom: 'Bfrtip',
// 		buttons: [
// 			'copy', 'excel', 'pdf', 'print'
// 		],
//         'paging'      : true,
//         'lengthChange': true,
//         'searching'   : true,
//         'ordering'    : true,
//         'info'        : true,
//         'autoWidth'   : true,
  
// 	} );
	
// 	$('#tickets').DataTable({
// 	  'paging'      : true,
// 	  'lengthChange': true,
// 	  'searching'   : true,
// 	  'ordering'    : true,
// 	  'info'        : true,
// 	  'autoWidth'   : false,
// 	});
	
// 	$('#productorder').DataTable({
// 	  'paging'      : true,
// 	  'lengthChange': true,
// 	  'searching'   : true,
// 	  'ordering'    : true,
// 	  'info'        : true,
// 	  'autoWidth'   : false,
// 	});
	

// 	$('#complex_header').DataTable();
	
// 	//--------Individual column searching
	
//     // Setup - add a text input to each footer cell
//     $('#example5 tfoot th').each( function () {
//         var title = $(this).text();
//         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
//     } );
 
//     // DataTable
//     var table = $('#example6').DataTable();
 
//     // Apply the search
//     table.columns().every( function () {
//         var that = this;
 
//         $( 'input', this.footer() ).on( 'keyup change', function () {
//             if ( that.search() !== this.value ) {
//                 that
//                     .search( this.value )
//                     .draw();
//             }
//         } );
//     } );
	
	
// 	//---------------Form inputs
// 	var table = $('#example').DataTable();
 
//     $('#data-update').click( function() {
//         var data = table.$('input, select').serialize();
//         alert(
//             "The following data would have been submitted to the server: \n\n"+
//             data.substr( 0, 120 )+'...'
//         );
//         return false;
//     } );
	
	
	
	
//   }); // End of use strict
$(function () {
    "use strict";

    // Initialize DataTable
    var table = $('#example').DataTable({
        'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true
    });

    // Add a date range filter
    $('#dateRangePicker').daterangepicker({
        opens: 'left',
        locale: {
            format: 'YYYY-MM-DD'
        }
    });

    // Apply the date range filter
    $('#dateRangePicker').on('apply.daterangepicker', function(ev, picker) {
        table.columns(0).search(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD')).draw();
    });

    // Clear the date range filter
    $('#clearDateRange').click(function() {
        $('#dateRangePicker').val('');
        table.columns(0).search('').draw();
    });

    // Your other DataTable configurations...

});
