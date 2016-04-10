$(document).ready(function() {

if ($('#marital_status').val() =='')
      { 	$('#div_age_y').show();
		   $('#div_age_m').hide();
		   $('#div_age_d').hide(); }
else if (  $('#marital_status').val() =='6')
	  	{ 
		  $('#div_age_y').show();
		  $('#div_age_m').show();
		  $('#div_age_d').show(); }
else if ( $('#marital_status').val() =='7')
	  	{ 
		  $('#div_age_y').hide();
		  $('#div_age_m').show();
		  $('#div_age_d').show();  }
else 
	  	{
		  
		  $('#div_age_y').show();
		  $('#div_age_m').hide();
		  $('#div_age_d').hide(); }

$('#marital_status').change(function() {
	
	var selectvalue = $(this).val();
	
	if (selectvalue =='')
      {   $('#div_age_y').show();
		  $('#div_age_m').hide();
		  $('#div_age_d').hide(); }
else if (selectvalue =='6')
	  	{ 
		   $('#div_age_y').show();
		   $('#div_age_m').show();
		   $('#div_age_d').show(); }
else if (selectvalue =='7')
	  	{
		   $('#div_age_y').hide();
		   $('#div_age_m').show();
		   $('#div_age_d').show();  }
else 
	  	{
		   $('#div_age_y').show();
		   $('#div_age_m').hide();
		   $('#div_age_d').hide();  }
})

		/*------------ Autocomplete for state -------------*/    		
		$('#state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){ 
		  			$( "#district").val("");  
					if (ui.item == null) 
					  { $('#state').val("");
					    $('#hidden_state').val("");
						return false; }
				   else
					  { $('#state').val(ui.item.value);
					    $('#hidden_state').val(ui.item.state_id);
					    return false; } }
		}).focus(function() {
                $(this).autocomplete("search");
            });
		  
		/*--------- Autocomplete for District ----------*/    		
		$("#district").autocomplete({
		minLength:0,
		scroll:true,
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_state").val() },
					 success: function(data) { response(data); }
				}); },
		 change: function (event, ui){ 
		 		  if (ui.item == null) 
				     { $('#district').val("");
					   $('#hidden_district').val("");
					   return false; }
				  else 
				     { $('#district').val(ui.item.value);
					   $('#hidden_district').val(ui.item.district_id);
					   return false; }
			}
        }).focus(function() {
                $(this).autocomplete("search");
            });
	
	/*--------------- show/hide of Source --------------------*/
	$("#src_walkin, #src_staff, #src_others").click(function () {
	  
		$("#referred_by").val("");
		$('#hidden_referred_by').val("");
		$('#hidden_source_id').val("");
		
	  //Others
	  if ($('input[name=src_type][value=O]').prop("checked")) { 
	  
	   $('#div_refBy').show();	  
	   $("#referred_by").autocomplete({
				source: "autocomplete_reffered_by.php",
				minLength:0,
				scroll:true, 
				change: function (event, ui){   
				          if (ui.item == null) 
						     { 
							    $("#referred_by").val("");
							    $('#hidden_referred_by').val("");
								$('#hidden_source_id').val("");
							    return false;}
					     else  
					         { $("#referred_by").val(ui.item.value);  
							   $('#hidden_referred_by').val(ui.item.referred_id);
							   $('#hidden_source_id').val(ui.item.source_id);
							   return false;} },
				  }).focus(function() {
                $(this).autocomplete("search");
            });
	    }  
	  
	  
	  //Staff
	  if ($('input[name=src_type][value=S]').prop("checked")) { 
	         $('#div_refBy').show(); 
	         $("#referred_by").autocomplete({
				source: "autocomplete_staff.php",
				minLength:0,
				scroll:true,
				change: function (event, ui){   
				          if (ui.item == null) 
						     { 
							    $("#referred_by").val("");
							    $('#hidden_referred_by').val("");
								$('#hidden_source_id').val("");
							    return false;}
					     else  
					         { $("#referred_by").val(ui.item.value);  
							   $('#hidden_referred_by').val(ui.item.referred_id);
							   $('#hidden_source_id').val(ui.item.source_id);
							   return false;} },
				  }).focus(function() {
                $(this).autocomplete("search");
            });
		} 
	  
	  
	  //Walkin	  
	if ($('input[name=src_type][value=W]').prop("checked")) { 
		$('#div_refBy').hide();
		$("#referred_by").val("");
		$('#hidden_referred_by').val("");
		$('#hidden_source_id').val("");
		return true;
		}  
   });
	
	//Not on Click
	if ($('input[name=src_type][value=W]').prop("checked")) { $('#div_refBy').hide();}
	if ($('input[name=src_type][value=S]').prop("checked")) { $('#div_refBy').show();}
	if ($('input[name=src_type][value=O]').prop("checked")) { $('#div_refBy').show();}
	  

/*--------------- show/hide of Dr.name  --------------------------*/
$("#dr_letter_yes, #dr_letter_no").click(function () {
	  if ($('input[name=dr_letter][value=Y]').prop("checked")) { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=N]').prop("checked")) { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val("");}
   });      

	  if ($('input[name=dr_letter][value=Y]').prop("checked")) { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=N]').prop("checked")) { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val(""); }


/*--------------- Doctor autocomplete ------------------*/
 $('#dr_name').autocomplete({		   
		  source:'autocomplete_dr.php', 
		  minLength:0,
		  scroll:true,
		  change: function (event, ui){   
				 if (ui.item == null) 
					{ $("#dr_name").val("");
					  $('#hidden_dr_id').val("");
					  return false;}
			  else 
				   { $("#dr_name").val(ui.item.value);  
					 $('#hidden_dr_id').val(ui.item.dr_id);
					 return false; }}
		}).focus(function() {
                $(this).autocomplete("search");
            });

/*-------------- autocomplete - 1ST Test ----------------*/    		
 $('#test_name').autocomplete({               
	    source:'autocomplete_test.php', 
		minLength:0,
		scroll:true,		  
		change: function (event, ui){   
				if (ui.item == null) 
				{ $('#test_name').val("");
				  $('#hidden_test_id').val("");
				  $('#hidden_dept_id').val("");
				  $('#test_price').val("");
				  $('#total_amt').val("");
				  calculateDue_amount();
				  calculateBalwithPaid();
				  return false; }
		     else   
		        { $('#test_name').val(ui.item.value);
				  $('#hidden_test_id').val(ui.item.test_id);
				  $('#hidden_dept_id').val(ui.item.dept_id);
				  $('#test_price').val(ui.item.test_price);
				  //$('#total_amt').val(ui.item.total_amt);
				  $('#test_name').attr('readonly', true);
				  
				 
				  total_e = Number($('#total_amt').val()); 				
			      test_price_f = Number($('#test_price').val());	   
			      new_total_f = total_e + test_price_f;
			      new_total = new_total_f.toFixed(2);
				  	
				  $('#total_amt').val(new_total);
				  calculateDue_amount();
			      calculateBalwithPaid();
				  $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function () {
					calculateDue_amount();
					calculateBalwithPaid();
				  });
				  return false; }
		        },		
	}).focus(function() {
                $(this).autocomplete("search");
            });	

/*----------------------------- START Clone ----------------------*/    		
$(function () {	
    $('#btnAdd').click(function () {
        var num     = $('.clonedInput').length; 
		var newNum  = new Number(num + 1);   
		
        newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); 

        newElem.find('.sl_no').attr('id', 'ID' + newNum + '_sl_no').attr('name', 'ID' + newNum + '_sl_no').html(newNum +'.'); 
        newElem.find('.label_test_name').attr('for', 'ID' + newNum + '_test_name');
        newElem.find('.test_name').attr('id', 'ID' + newNum + '_test_name').attr('name', 'test_name[' + num + ']').val('');		
		newElem.find('.test_id').attr('id', 'ID' + newNum + '_test_id').attr('name', 'test_id[]').val('');        
		newElem.find('.dept_id').attr('id', 'ID' + newNum + '_dept_id').attr('name', 'dept_id[]').val('');        
        newElem.find('.label_test_price').attr('for', 'ID' + newNum + '_test_price');   
        newElem.find('.test_price').attr('id', 'ID' + newNum + '_test_price').attr('name', 'test_price[' + num + ']').val('');   
        
        $('#entry' + num).after(newElem);	     // insert the new element after the last "duplicatable" input field	
        //$('#ID' + newNum + '_test_name').focus();	
		$('#test_price_store').val(newNum);	
		
/*---------------------------------- START autocomplete for added tests ----------------------------------------------*/    		
	$('#ID' + newNum + '_test_name').autocomplete({ 
		source:'autocomplete_test.php', 
		minLength:0,
		scroll:true,	
		
		change: function (event, ui) {  
		if (ui.item == null) 
			{ $('#ID' + newNum + '_test_name').val("");   
			  $('#ID' + newNum + '_test_id').val("");
			  $('#ID' + newNum + '_dept_id').val("");
			  $('#ID' + newNum + '_test_price').val("");
			  return false; }
		else
		    { $('#ID' + newNum + '_test_name').val(ui.item.value);   
			  $('#ID' + newNum + '_test_id').val(ui.item.test_id);
			  $('#ID' + newNum + '_dept_id').val(ui.item.dept_id);
			  $('#ID' + newNum + '_test_price').val(ui.item.test_price);			  
			  $('#ID' + newNum + '_test_name').attr('readonly', true);
			  		
			  total_earlier = Number($('#total_amt').val()); 				
			  added_price = Number($('#ID' + newNum + '_test_price').val());	   
			  new_total = total_earlier + added_price;
			  new_total_fixed = new_total.toFixed(2);
			  $("#total_amt").val(new_total_fixed); 			  
			  calculateDue_amount();
			  calculateBalwithPaid();
			  $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function () {
				calculateDue_amount();
				calculateBalwithPaid();
			   });
			  return false;}
          },
   }).focus(function() {
                $(this).autocomplete("search");
            });
			
	  $('#ID' + newNum + '_test_name').attr('readonly', false);  // Enable added cloned input  
	  $('#btnDel').attr('disabled', false); 	 // Enable the "remove" button
});

/*-------------------------- START delete clone section ----------------------------------------------*/    
$('#btnDel').click(function () {    
   var num = $('.clonedInput').length; 
        
		if (confirm('Are you sure to remove the last investigation [ Sl.No. ' + num + ' ] ?'))
		   {  var del_total = Number($('#total_amt').val());
			  $('#patient_registration', 'div','#entry' + num).each(function(i,o){ 
				  var price = Number($(o).find('#ID' + num + '_test_price').val());
				  if(!isNaN(del_total) && del_total.length != 0)
					 { del_total = (del_total-price).toFixed(2); }
				  });
					 
              $('#entry' + num).slideUp('fast', function () {$(this).remove()
				 { $("#total_amt").val(del_total);
					 calculateDue_amount();
					 calculateBalwithPaid();
				   $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function () {
					 calculateDue_amount();
					 calculateBalwithPaid();					
					 }); }
			
         if (num -1 === 1)					     // if only one element remains, disable the "remove" button
			  $('#btnDel').attr('disabled', true);
			  $('#btnAdd').attr('disabled', false);				
		});
     }
     return false;
     $('#btnAdd').attr('disabled', false);  // enable the "add" button
   }); 
   $('#btnDel').attr('disabled', true);
});   

/*---------------- show/hide - Tax /Discount -----------------*/
  var tax_per = Number($('#tax').val()); 
  var disc_per = Number($('#disc_per').val());
  var disc_amt = Number($('#disc_amt').val()); 
  var paid_amt = Number($('#paid_amount').val());

  var amt_0 = $('input[name=disc_amt]').val();
  var per_0 = $('input[name=disc_per]').val();  
  
  $('#label_tax').hide();
  $('#div_tax').hide();  
   
   if ($('input[name=disc_radio][value=2]').prop("checked")) {
		      $('#discount').hide();
			  }
	if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 == '') {

			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();			 
		   }
			  
 if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 != '') {
			  
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();
				
		   }
if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 != '' && per_0 == '') {
			  
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			 
			  $('#label_disc_amt').show();
			  $('#div_disc_amt').show();
			  
			  $('#label_disc_per').hide();
			  $('#div_disc_per').hide();				
		   }  
     
 /*---------------- CLICK - Tax -----------------*/ 
  $("#tax_no, #tax_yes").click(function () {
	  if ($('input[name=tax_radio][value=2]').prop("checked")) 
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
	  if ($('input[name=disc_radio][value=2]').prop("checked")) {
		      $('#discount').hide();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
	         }
	  if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 == '') {
			  
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
	  if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 != '') {
			  
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
	 if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 != '' && per_0 == '') {
			  
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
  
if ($('input[name=tax_radio][value=2]').prop("checked") && $('input[name=disc_radio][value=2]').prop("checked")) 
   {
	   $('#label_tax').hide();
	   $('#div_tax').hide();
	   $('#discount').hide();
	   $('#net_amount').val(total_amt.toFixed(2));
	   $('#due_amount').val(total_amt.toFixed(2));
	}
  else if ($('input[name=tax_radio][value=2]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked") && amt_0 != '' && per_0 == '') 
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
	else if ($('input[name=tax_radio][value=2]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 != '') 
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
	else if ($('input[name=tax_radio][value=1]').prop("checked") && $('input[name=disc_radio][value=2]').prop("checked"))  
			{ $('#label_tax').show();
			  $('#div_tax').show();
			  $('#discount').hide();
			  var tax = (tax_per/100) * total_amt;	   
			  var net_amount = total_amt + tax;
			  
			  $('#net_amount').val(net_amount.toFixed(2));
			  $('#due_amount').val(net_amount.toFixed(2)); 
			 }
	else if ($('input[name=tax_radio][value=1]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 != '')  
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
else if ($('input[name=tax_radio][value=1]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked") && amt_0 != '' && per_0 == '')  
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
	else if ($('input[name=tax_radio][value=1]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 == '')  
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
	
/*---------------------- Submit - confirmation --------------------*/

$("#patient_submit").click(function(event) {
        if( !confirm('Are you sure to submit ?')) 
            event.preventDefault();
			$('form').submit(function () {
  			if ($(this).valid()) {
			  //$(':submit', this).attr('disabled', 'disabled');
			  $('#div_main').hide();
			  $('#divWait').show();
			  //$('#divWait').fadeOut(2000);
			}
		  });
	});
	
$("#patient_registration").validate({
	//debug: true, 
	ignore: "",
	errorContainer: ".err",
	errorLabelContainer: '.span-error',
	onkeyup: true,
	onblur: true,
	
	invalidHandler: function(event, validator) {
				//errorClass: "control-group error"
				errorContainer: ".error"
				errorLabelContainer: '#submit-error'	
					
				var errors = validator.numberOfInvalids();
				if (errors) 
					{ var message = errors == 1
					  ? 'You missed 1 field. It has been highlighted'
					  : 'You missed ' + errors + ' fields. They have been highlighted';
					  $("div.error").show().delay(3000).fadeOut("medium");
					  $("div.error span").html(message);
					  $("div.err").hide();
					  $("div.err span").hide();
					  $("#page_date").hide();
					  return false;
					  
					  /*$("div.errors").hide();
					  $("div.errors span").hide();*/  } 
				else { $("div.error").hide(); $("div.error span").hide(); return true;}
			},
	
rules: {
		patient_name: { required: true,
						minlength: 3,
						maxlength: 50 },
		patient_sex: "required",
		marital_status: { required: true,},
		patient_age_y: { required: function(){
			 				       var marital_id = $('#marital_status').val();
								   if (marital_id == '1' || marital_id == '2' || marital_id == '3' || marital_id == '4' || marital_id == '5' || marital_id == '6')
								   {  return true; } else if (marital_id == '7' || marital_id == '') { return false;}
						},
					     digits: true,
						},
		patient_age_m: { required: function(){
			 				       var marital_id = $('#marital_status').val();
								   if (marital_id == '6' || marital_id == '7')
								   {  return true;} else  { return false;}
						},
					     digits: true,
						 },
	patient_age_d: { required: function(){
			 				       var marital_id = $('#marital_status').val();
								   if (marital_id == '6' || marital_id == '7')
								   {  return true; } else { return false;}
						},
					     digits: true,
						  },
						
							
		patient_phone: { required: true,
						digits: true,
						minlength: 10,
						maxlength: 10 },	
		patient_address: { required: true,
						minlength: 3,
						maxlength: 100 },
		state: { required: true,
						minlength: 2,
						maxlength: 50 },
		district: { required: true,
						minlength: 3,
						maxlength: 50 },
		/*patient_pin: {  required: true,
						digits: true,
						minlength: 6,
						maxlength: 6 },*/
		dr_letter: "required",	
		
		
		dr_name: {   required: function(){
						var dr_letter = $('#dr_letter').val();
						var hidden_dr_id = $('#hidden_dr_id').val();
						if ($('input[name=dr_letter][value=Y]').prop("checked") && hidden_dr_id =="")
						 {
							 return true;
						  }else  {
							 return false;
						 }
                   },
					     minlength: 3,
					     maxlength: 100 },
		
		src_type: {   required: true,
					},	
					
		referred_by: {   required: function(){
			 				       //var src_type = $('#src_type').val();
								   var referred_by = $('#referred_by').val();
								   if ($('input[name=src_type][value=W]').prop("checked") && referred_by =='' || referred_by !='')
								   {
									   return false;
								   }else {
									   return true;
								   }
						},
					     minlength: 3,
					     maxlength: 100 },
						 
		patient_history: {  
							required: false,
							maxlength: 100 },	
		
		test_remark: { required: false,
					   maxlength: 50 },	
						 
		'test_name[]': "required",
		'test_price[]': "required",
						
		tax_radio: { required: true,},
		tax: { required: function(){
						 if ($('input[name=tax_radio][value=1]').prop("checked")) { return true; }  // yes
					  else if ($('input[name=tax_radio][value=2]').prop("checked")) { return false; }  // no
					  },
				number: function(){
					
						   if ($('input[name=tax_radio][value=1]').prop("checked"))  {  return true; } 
					      if ($('input[name=tax_radio][value=2]').prop("checked"))  {  return false;}
				      },
			 },
		disc_radio: { required: true,},
		disc_code:  { required: function(){
						   if ($('input[name=disc_radio][value=1]').prop("checked")) { return true; }  // yes
					  else if ($('input[name=disc_radio][value=2]').prop("checked")) { return false; }  // no
					  },
			 },
		
		paid_amount: { required: true,
						number: true,
						minlength: 1,
					    maxlength: 10
						},
},

messages: {
			patient_name: { required: "",
							minlength: "Name should be at least 3 characters",
							maxlength: "Name should be max.of 50 characters" },
			patient_sex: { required:""},
			marital_status: { required: "",},
			
			patient_age_y:{required: "",
							digits:"Years should be only digits",							
							},
			patient_age_m:{required: "",
							digits:"Months should be only digits",
							
							
							},
			patient_age_d:{required: "",
							digits:"Days should be only digits",			
							},
			patient_phone: { required: "",
							  digits: "Oops ! Phone no. should be digits only",
							  minlength: "Phone no. should be at least 10 digits",
							  maxlength: "Phone no. should be max.of 10 digits" },
			patient_address: { required: "",
							minlength: "Address should be at least 3 characters",
							maxlength: "Address should be max.of 100 characters" },	
			state: {required: "",
							minlength: "State should be at least 2 characters",
							maxlength: "State should be max.of 50 characters"},	
			district: {required: "",
							minlength: "District should be at least 3 characters",
							maxlength: "District should be max.of 50 characters"},	
			/*patient_pin: { required: "",
							digits: "Oops ! PIN should be digits only",
							minlength: "PIN should be at least 6 characters",
							maxlength: "PIN should be max.of 6 characters" },*/	
			dr_letter: "",	
			
			dr_name: { required: "",
							minlength: "Dr.Name should be at least 3 characters",
							maxlength: "Dr.Name should be max.of 100 characters" },							
			
			src_type: { required: "",},						
						
			referred_by: { required: "",
							minlength: "Referred By should be at least 3 characters",
							maxlength: "Referred By should be max.of 100 characters" },
							
			patient_history: {   maxlength:"Patient History should be max.of 100 characters" },	
		
		    test_remark: {   maxlength: "Lab Notes should be max.of 50 characters" },
		
			'test_name[]': "",
			'test_price[]': "",
			
			tax_radio: { required: ''},
			tax: { required: '',
				   number: "Oops ! Tax should be numbers only" },			 
			disc_radio: { required: ''},
			disc_code:  { required: ''},
			paid_amount: { required: "",
						   number: "Oops ! Paid Amount should be numbers only",
						    minlength: "Paid Amount should be at least 1 characters",
							maxlength: "Paid Amount should be max.of 10 characters" },						

	},

errorPlacement: function(error, element) {
                 error.appendTo('.err');
             },

 	highlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-success');
        $(element).parents('div.form-control-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).parents('div.form-control-group').removeClass('has-error');
        $(element).parents('div.form-control-group').addClass('has-success');
    }
	
	});
  });