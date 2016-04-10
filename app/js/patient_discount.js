$(document).ready(function() {			

$('#patient_id').autocomplete({     //START autocomplete - PATIENT_id
		source:'autocomplete_patient_id.php', 
		minLength:1,
		focus: function( event, ui ) {
            $( "#patient_id" ).val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$("#patient_id").val( ui.item.value );
			$('#hidden_lab_id').val( ui.item.lab_id );
			return false;
		    }
		});	    //END patient_id autocomplete
		
		
if($('#disc_type_per').is(':checked'))   // show/Hide div if button is checked 
  {
	$('#div_per').show();
	$('#div_amount').hide();		 
	     }
		 else
		 {
	$('#div_per').hide();
	$('#div_amount').show();
  }			
 			
 
$("#disc_type_per, #disc_type_amt").click(function () {
        if ($('input[name=disc_type][value=per]').prop("checked")) {
            $('#div_per').show();
			$('#div_amount').hide();			
		}
        else if ($('input[name=disc_type][value=amt]').prop("checked")) {
				 $('#div_per').hide();
			     $('#div_amount').show();
		}
    });     

}); 