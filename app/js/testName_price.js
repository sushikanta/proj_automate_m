$(document).ready(function() {	
    
 $('#test_name_price_table').dataTable( {		       		

        "bJQueryUI": true,
		"bPaginate": true,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bAutoWidth": false,
		    			
		"fnPreDrawCallback": function( oSettings ) {		
		  $('.dataTables_filter input').addClass('form-control input-sm');
		  $('.dataTables_filter input').attr('placeholder', 'Search');	
		  $('.dataTables_filter input').css('height', '33px');
		  $('.dataTables_length select').addClass('form-control input-sm');
		  $('.dataTables_length select').css('height', '33px');	
		  $('.dataTables_length select').css('margin-right', '3px');	
		  $('.dataTables_length select').css('margin-bottom', '10px');
		  $('.dataTables_length select').css('float', 'left');
		  }
		  			
     }).makeEditable({
		 
        sAddURL:              "ajax_testName_price_add.php",
        sDeleteURL:           "ajax_testName_price_delete.php",
		sUpdateURL: 		   "ajax_testName_price_update.php",
		
		sAddNewRowFormId:     "formName_price",	
		sAddDeleteToolbarSelector: ".dataTables_length",
		   
		oAddNewRowButtonOptions: { 
				label: "Add...",
				icons: {primary:'ui-icon-plus'}
				},
	    oDeleteRowButtonOptions: { 
				label: "Remove",
				icons: {primary:'ui-icon-trash'}
				},
		oAddNewRowOkButtonOptions: {
				label: "Confirm",
                icons: { primary: 'ui-icon-check' },
				name: "action",
				value: "add-new"
				},
        oAddNewRowCancelButtonOptions: { 
				label: "Close",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new record',
				autoOpen: false,
				modal: true,
				resizable: false,
				draggable: true,
				hide: 'fade', 
				width:'auto',
				height: 'auto',	
				cssclass: 'required',			
				}, 
		
	
		aoColumns: [
					null,
					{
					  
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  tooltip: 'Click to update investigation',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'OK',
					  event: 'click',
					  width: '80%', 
					 // bAutoWidth: false,					 
					
					},
					{
					  
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  tooltip: 'Click to update short-form',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'OK',
					  event: 'click',
					  width: '50%', 
					
					},
					{
					  
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  tooltip: 'Click to update price',
					  type: 'text',
					  onblur: 'cancel',
					  submit: 'OK',
					  event: 'click',
					  width: '50%', 
					 
					},
					{
					  
					  tooltip: 'Click to update category',
					  loadtext: 'loading...',
					  indicator: 'saving...',
					  cssclass: 'required',
					  width: '80%', 
					  bAutoWidth: false, 
					  type: 'select',
					  onblur: 'cancel',
					  submit: 'OK',
					  event: 'click',
     				  loadurl: "ajax_custom_category_list.php",
					 // sUpdateURL: "ajax_testName_price_update.php",	 
  
  					  
					},	
					null,					
					null,				
				  ],
					
	fnShowError: function (message, action) {
                        switch (action) {
                            case "update":
                                jAlert(message, "Update failed");
                                break;
                            case "delete":
                                jAlert(message, "Delete failed");
                                break;
                            case "add":
                                $("#lblAddError").html(message);
                                $("#lblAddError").show();
                                break;
                        }
                    },
   fnStartProcessingMode: function () {
                        $("#processing_message").dialog();
						
                    },
   fnEndProcessingMode: function () {
                        $("#processing_message").dialog("close");    
						//window.location.reload();
						
                    },
					
    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    },
	fnOnEditing: function(input)
				  {  
				  cell= input.parents("tr")
					 .children("td:first")
					 .text();
				  return true
				  },
	oUpdateParameters: {
				  cell: function(){ return cell; } 
		  },
    } );

 var oTable = $('#test_name_price_table').dataTable();

//oTable.fnReloadAjax();
//alert("After");
  //oTable.fnSetColumnVis( 0, false );    // Hide the first column after initialisation
 //alert("Before");
//  oTable.fnReloadAjax();
 

});
