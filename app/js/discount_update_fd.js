$(document).ready(function() {
/*------------------------------- show/hide & CLICK on Tax button/Discount buttons ---------------------------*/    

  var tax_per = Number($('#tax').val()); 
  var disc_per = Number($('#disc_per').val());
  var disc_amt = Number($('#disc_amt').val()); 
  var paid_amt = Number($('#paid_amount').val());

  var amt_0 = $('input[name=disc_amt]').val();
  var per_0 = $('input[name=disc_per]').val();
  
  
  $('#label_tax').hide();
  $('#div_tax').hide();	
  $('#discount').hide();
  
  $("#tax_no, #tax_yes").click(function () {
	  if ($('input[name=tax_radio][value=N]').prop("checked")) 
	     { $('#label_tax').hide();
		   $('#div_tax').hide(); 
		   calculateDue_amount();
		   calculateBalwithPaid(); }
	  else
	     { $('#label_tax').show();
		   $('#div_tax').show(); 
		   calculateDue_amount();
		   calculateBalwithPaid(); }
      });      
  
  /*---------------- CLICK - DISCOUNT -----------------*/ 
   $("#disc_no, #disc_yes").click(function () {
	  if ($('input[name=disc_radio][value=N]').prop("checked")) {
		      $('#discount').hide();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
	         }
	  if ($('input[name=disc_radio][value=Y]').prop("checked") && amt_0 == '' && per_0 == '') {
			  
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();

			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
		   }
	  if ($('input[name=disc_radio][value=Y]').prop("checked") && amt_0 == '' && per_0 != '') {
			  
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();
			  
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			 
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
		   }
	 if ($('input[name=disc_radio][value=Y]').prop("checked") && amt_0 != '' && per_0 == '') {
			  
			  $('#label_disc_per').hide();
			  $('#div_disc_per').hide();
			  
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			 
			  $('#label_disc_amt').show();
			  $('#div_disc_amt').show();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
		   }
  });
  
/*---------------- Due amount on changing PAID amount ---------------*/    
calculateDue_amount();
calculateBalwithPaid(); 
$('#paid_amount').on('keyup', function() {
		calculateDue_amount();
		calculateBalwithPaid();		
		});		
		
$('#tax').on('keyup', function() {
	calculateDue_amount();
	calculateBalwithPaid();
	});

  
/*------------------------------ function Definitions ------------------------------------*/
function calculateDue_amount(){
var total_amt = Number($('#total_amt').val());
if(total_amt == ""){
	$('#net_amount').val("");
	$('#due_amount').val(""); } 
else {
  var tax_per = Number($('#tax').val());     // global declaration
  var disc_per = Number($('#disc_per').val());
  var disc_amt = Number($('#disc_amt').val()); 
  var paid_amt = Number($('#paid_amount').val());

  var amt_0 = $('input[name=disc_amt]').val();
  var per_0 = $('input[name=disc_per]').val();
  
if ($('input[name=tax_radio][value=N]').prop("checked") && $('input[name=disc_radio][value=N]').prop("checked")) 
   {
	   $('#label_tax').hide();
	   $('#div_tax').hide();
	   $('#discount').hide();
	   $('#net_amount').val(total_amt.toFixed(2));
	   $('#due_amount').val(total_amt.toFixed(2));
	}
  else if ($('input[name=tax_radio][value=N]').prop("checked") && $('input[name=disc_radio][value=Y]').prop("checked") && amt_0 != '' && per_0 == '') 
  {
	          $('#label_tax').hide();
	          $('#div_tax').hide();
	  
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').hide();
			  $('#div_disc_per').hide();
			  $('#label_disc_amt').show();
			  $('#div_disc_amt').show();
			  
	   var temp_amount = total_amt - disc_amt; 
	   $('#net_amount').val(temp_amount.toFixed(2));
	   $('#due_amount').val(temp_amount.toFixed(2));
		}
	else if ($('input[name=tax_radio][value=N]').prop("checked") && $('input[name=disc_radio][value=Y]').prop("checked") && amt_0 == '' && per_0 != '') 
  {
			 $('#label_tax').hide();
	          $('#div_tax').hide();
	  
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();
			  
	   var per = (disc_per/100) * total_amt;	   
	   var net_amount = total_amt - per;
	   
	   $('#net_amount').val(net_amount.toFixed(2));
	   $('#due_amount').val(net_amount.toFixed(2));
	}
	else if ($('input[name=tax_radio][value=Y]').prop("checked") && $('input[name=disc_radio][value=N]').prop("checked"))  
			{ $('#label_tax').show();
			  $('#div_tax').show();
			  $('#discount').hide();
			  var tax = (tax_per/100) * total_amt;	   
			  var net_amount = total_amt + tax;
			  
			  $('#net_amount').val(net_amount.toFixed(2));
			  $('#due_amount').val(net_amount.toFixed(2)); 
			 }
	else if ($('input[name=tax_radio][value=Y]').prop("checked") && $('input[name=disc_radio][value=Y]').prop("checked") && amt_0 == '' && per_0 != '')  
			{ $('#label_tax').show();
			  $('#div_tax').show();
			  $('#discount').show();	
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();
			  var tax = (tax_per/100) * total_amt;
			  var temp_amount = total_amt + tax;
			  var per = (disc_per/100) * temp_amount;
			  var net_amount = temp_amount - per;
			  $('#net_amount').val(net_amount.toFixed(2));
			  $('#due_amount').val(net_amount.toFixed(2));	   
			}
else if ($('input[name=tax_radio][value=Y]').prop("checked") && $('input[name=disc_radio][value=Y]').prop("checked") && amt_0 != '' && per_0 == '')  
	        { $('#label_tax').show();
			  $('#div_tax').show();
			  $('#discount').show();	
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').hide();
			  $('#div_disc_per').hide();
			  $('#label_disc_amt').show();
			  $('#div_disc_amt').show();
			  var tax = (tax_per/100) * total_amt;
			  var temp_amount = total_amt + tax;	   
			  var net_amount = temp_amount - disc_amt;
			  $('#net_amount').val(net_amount.toFixed(2));
			  $('#due_amount').val(net_amount.toFixed(2));	   
			 }
	else if ($('input[name=tax_radio][value=Y]').prop("checked") && $('input[name=disc_radio][value=Y]').prop("checked") && amt_0 == '' && per_0 == '')  
	        {
			  $('#label_tax').show();
			  $('#div_tax').show();
			  $('#discount').show();	
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').hide();
			  $('#div_disc_per').hide();
			  $('#label_disc_amt').show();
			  $('#div_disc_amt').show();
			 var tax = (tax_per/100) * total_amt;
			 var temp_amount = total_amt + tax;	   
			 $('#net_amount').val(temp_amount.toFixed(2));
			 $('#due_amount').val(temp_amount.toFixed(2));	   
		    }
   }
}  

function calculateBalwithPaid(){
	    var net_amount = Number($('#net_amount').val());
		var paid_amount = Number($('#paid_amount').val());
		var due_amount_fixed = net_amount - paid_amount;
		var due_amount = due_amount_fixed.toFixed(2);
		if (net_amount !="" && paid_amount !="") 
		   { $('#due_amount').val(due_amount); }
   else if (net_amount !="" && paid_amount =="") 
		   { $('#due_amount').val(net_amount.toFixed(2)); }
   else if (net_amount =="" && paid_amount =="" || paid_amount !="") 
           { $('#due_amount').val(""); }
	}

});