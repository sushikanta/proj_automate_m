$(document).ready(function() {	
	  
/*-------------------------------------------- START Autocomplete for state -----------------------------------*/    		
		$('#state').autocomplete({
		  source:'autocomplete_state.php', 
		  minLength:1,
		  focus: function( event, ui ) {
				  $( "#state" ).val("");
				  return false; },
		  change: function (event, ui){ 
		  			$( "#district").val("");  
					//$( "#patient_pin").val("");  
					if (ui.item == null) 
					  { $('#hidden_state').val("");
						return false; }
				   else
					  { $('#state').val(ui.item.value);
					    $('#hidden_state').val(ui.item.state_id);
					    return false; } }
		});
		  
/*-------------------------------------------- START Autocomplete for District -----------------------------------*/    		
		$("#district").autocomplete({    
          source: function(request, response) {
          $.ajax({
						 url: "autocomplete_district.php",
					dataType: "json",
						data: { term: request.term,
								state: $("#hidden_state").val() },
					 success: function(data) { response(data); }
				}); },
		  focus: function( event, ui ) {
                  $( "#district").val("");
                  return false; },
		 change: function (event, ui){ 
		 		  //$( "#patient_pin").val("");    
				  if (ui.item == null) 
				     { $('#hidden_district').val("");
					   return false; }
				  else 
				     { $('#district').val(ui.item.value);
					   $('#hidden_district').val(ui.item.district_id);
					   return false; } }
        });  

/*--------------------------------------------  START Autocomplete for patient_pin -----------------------------------*/    		
	/*$("#patient_pin").autocomplete({    
        source: function(request, response) {
				$.ajax({
								url: "autocomplete_pin.php",
						   dataType: "json",
							   data: { term: request.term,
									   district: $("#hidden_district").val(), },
							success: function(data) { response(data); }
				 }); },
		 focus: function( event, ui ) {
                 $( "#patient_pin").val("");
                 return false; },
		change: function (event, ui){   
				if (ui.item == null) 
				   { $('#hidden_patient_pin').val("");
					 return false;}
			    else 
			       {  $('#patient_pin').val(ui.item.value);
				      $('#hidden_patient_pin').val(ui.item.pin_id);
					  return false;}}
    });   
	*/

/*--------------- show/hide of Dr.name  --------------------------*/
$("#dr_letter_yes, #dr_letter_no").click(function () {
	  if ($('input[name=dr_letter][value=1]').prop("checked")) 
	     { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=2]').prop("checked")) 
	     { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val(""); }
      });      

if ($('input[name=dr_letter][value=1]').prop("checked")) 
	     { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=2]').prop("checked")) 
	     { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val(""); }


/*--------------- Doctor autocomplete --------------------------*/

 $('#dr_name').autocomplete({		   
		  source:'autocomplete_dr.php', 
		  minLength:1,
		  focus: function( event, ui ) {
				 $("#dr_name").val("");
				 return false; },
		  change: function (event, ui){   
				 if (ui.item == null) 
					{ $('#hidden_dr_id').val("");
					  return false;}
			  else 
				   { $("#dr_name").val(ui.item.value);  
					 $('#hidden_dr_id').val(ui.item.dr_id);
					 return false; }}
		});






/*-------------------------------------------- START source search autocomplete ------------------------------------*/    		
	$('#source').autocomplete({    
		source:'autocomplete_source.php', 
		minLength:1,
		focus: function( event, ui ) {
				$("#source").val("");
				return false; },
	   change: function (event, ui){  
	   			$( "#referred_by" ).val("");
				if (ui.item == null) 
				    { 
					  $('#hidden_source').val("");					
					  return false;}
				else 
				    { $("#source").val(ui.item.value);
					  $("#hidden_source").val(ui.item.source_id);
					  return false; }}
	 });


/*-------------------------------------------- SHOW/HIDE referral div while blur source ----------------------------------------------*/    			
 $('#source').blur(function() {
   
   var source_id = $("#hidden_source").val();
   if (source_id == '3') 				//if source = self
       {		 		
	     $('#label_referred_by').hide();
		 $('#div_refBy').hide(); 
	   } 			     
  else {		 		
	    $('#label_referred_by').show();
	    $('#div_refBy').show(); 
		} 
	}) 




/*-------------------------------------------- autocomplete of referral ----------------------------------------------*/    			
 $("#referred_by").autocomplete({    			// START Autocomplete for referred person in referred_tbl (OTHER sources)
				source: function(request, response) {
				$.ajax({
				     url: "autocomplete_reffered_by.php",
				dataType: "json",
				    data: { term: request.term,
						    source_id: $("#hidden_source").val(), },
				 success: function(data) { response(data); }
				      }); },
				   focus: function( event, ui ) {
						  $("#referred_by").val("");
						  return false; },
				  change: function (event, ui){   
				          if (ui.item == null) 
						     { $('#hidden_referred_by').val("");
							    return false;}
					     else  
					         { $("#referred_by").val(ui.item.value);  
							   $('#hidden_referred_by').val(ui.item.referred_id);
							   return false;} },
				  })
/*-------------------------------------------- autocomplete - 1ST Test ----------------------------------------------*/    		
 $('#test_name').autocomplete({               
	    source:'autocomplete_test.php', 
		minLength:1,		
		focus: function( event, ui ) 
				{ $('#test_name').val(""); 
				  $('#test_price').val("");
				  return false; },
		  
		change: function (event, ui){   
				if (ui.item == null) 
				{ $('#test_name').val("");
				  $('#hidden_test_id').val("");
				  $('#hidden_dept_id').val("");
				  $('#test_price').val("");
				  $('#total_amt').val("");
				  calculateDue_amount();
				  return false; }
		     else   
		        { $('#test_name').val(ui.item.value);
				  $('#hidden_test_id').val(ui.item.test_id);
				  $('#hidden_dept_id').val(ui.item.dept_id);
				  $('#test_price').val(ui.item.test_price);
				  $('#total_amt').val(ui.item.test_price);
				  
				  first_price = Number($('#total_amt').val());		
				  new_total = first_price.toFixed(2);	
				  $('#total_amt').val(new_total);
				  calculateDue_amount();
				  $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function () {
					calculateDue_amount();
					calculateBalwithPaid();
				  });
				  return false; }
		        },		
	});	

/*-------------------------------------------- START Clone ----------------------------------------------*/    		
$(function () {	
    $('#btnAdd').click(function () {
        var num     = $('.clonedInput').length; 
		var newNum  = new Number(num + 1);   
		
        newElem = $('#entry' + num).clone().attr('id', 'entry' + newNum).fadeIn('slow'); 

        newElem.find('.sl_no').attr('id', 'ID' + newNum + '_sl_no').attr('name', 'ID' + newNum + '_sl_no').html(newNum +'.'); 
        newElem.find('.label_test_name').attr('for', 'ID' + newNum + '_test_name');
        newElem.find('.test_name').attr('id', 'ID' + newNum + '_test_name').attr('name', 'test_name[]').val('');		
		newElem.find('.test_id').attr('id', 'ID' + newNum + '_test_id').attr('name', 'test_id[]').val('');        
		newElem.find('.dept_id').attr('id', 'ID' + newNum + '_dept_id').attr('name', 'dept_id[]').val('');        
        newElem.find('.label_test_price').attr('for', 'ID' + newNum + '_test_price');   
        newElem.find('.test_price').attr('id', 'ID' + newNum + '_test_price').attr('name', 'test_price[]').val('');   
        
        $('#entry' + num).after(newElem);	     // insert the new element after the last "duplicatable" input field	
        $('#ID' + newNum + '_test_name').focus();	
		$('#test_price_store').val(newNum);	
		
/*---------------------------------- START autocomplete for added tests ----------------------------------------------*/    		
	$('#ID' + newNum + '_test_name').autocomplete({ 
		autoFill: false,	
		source:'autocomplete_test.php', 
		minLength:1,	
		focus: function( event, ui ) {
				$('#ID' + newNum + '_test_name').val("");
				$('#ID' + newNum + '_test_price').val("");
				return false;    
               },
		
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
			   }); }
          },
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
  
   $("#disc_no, #disc_yes").click(function () {
	  if ($('input[name=disc_radio][value=2]').prop("checked")) {
		      $('#discount').hide();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
	         }
	  else if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 == '') {
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
		   }
	  else if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 == '' && per_0 != '') {
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').show();
			  $('#div_disc_per').show();
			  $('#label_disc_amt').hide();
			  $('#div_disc_amt').hide();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
		   }
	 else if ($('input[name=disc_radio][value=1]').prop("checked") && amt_0 != '' && per_0 == '') {
			  $('#discount').show();
			  $('#label_disc_code').show();
			  $('#div_disc_code').show();
			  $('#label_disc_per').hide()
			  $('#div_disc_per').hide();
			  $('#label_disc_amt').show();
			  $('#div_disc_amt').show();
			  calculateDue_amount();
	          calculateBalwithPaid(); 	
		   }
  });     
  
/*----------------------------- Calc Due amount on changing PAID amount ------------------------*/    
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

  
/*------------------------------ function definitions ------------------------------------*/
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
	
/*---------------------------------Submit - confirmation-----------------------------------------------------*/

$("#patient_submit").click(function(event) {
        if( !confirm('Are you sure to submit ?')) 
            event.preventDefault();
			
$("#patient_registration").validate({
	//debug: true, 
	ignore: "",
	errorContainer: ".err",
	errorLabelContainer: '.span-error',
    //errorClass: "control-group error",
	onkeyup: true,
	onblur: true,
	//focusCleanup: true,
	//focusInvalid: false,
	//errorClass:'error',
	//validClass:'success',

//submitHandler: function() { alert("Submitted!") },
submitHandler: function(form) {
form.submit();
},
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
		patient_age: { required: true,
						number: true,
						minlength: 1,
						maxlength: 5 },	
		patient_phone: { required: true,
						digits: true,
						minlength: 10,
						maxlength: 10 },	
		patient_address: { required: true,
						minlength: 5,
						maxlength: 50 },
		state: { required: true,
						minlength: 2,
						maxlength: 20 },
		district: { required: true,
						minlength: 5,
						maxlength: 20 },
		/*patient_pin: {  required: true,
						digits: true,
						minlength: 6,
						maxlength: 6 },*/
		dr_letter: "required",
		
		
		dr_name: {   required: function(){
			 				      var dr_letter = $('#dr_letter').val();
								  var hidden_dr_id = $('#hidden_dr_id').val();
								  if ($('input[name=dr_letter][value=1]').prop("checked") && hidden_dr_id =="")
								   {
									   return true;
									}else  {
									   return false;
								   }
          
			
						},
					     minlength: 5,
					     maxlength: 100 },
		
			
		source: {   required: true,
					minlength: 1,
					maxlength: 50 },	
					
		referred_by: {   required: function(){
			 				       var hidden_source_id = $('#hidden_source').val();
								   var referred_by = $('#referred_by').val();
								   if (hidden_source_id == '3' && referred_by =='' || referred_by !='')
								   {
									   return false;
								   }else if (hidden_source_id == '3' && referred_by ==''){
									   return true;
								   }
          
			
						},
					     minlength: 5,
					     maxlength: 50 },
						 
		patient_history: {  
							required: false,
							maxlength: 300 },	
		
		test_remark: {   required: false,
						 maxlength: 300 },	
						 
		test_name: {    required: true,					
						minlength: 5,
						maxlength: 50},
						
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
			patient_age: { required: "",
						   number:"Oops ! Age should be number only",
						   minlength: "Age should be at least 1 number",
						   maxlength: "Age should be max.of 5 numbers" },
			patient_phone: { required: "",
							  digits: "Oops ! Phone no. should be digits only",
							  minlength: "Phone no. should be at least 10 digits",
							  maxlength: "Phone no. should be max.of 10 digits" },
			patient_address: { required: "",
							minlength: "Address should be at least 5 characters",
							maxlength: "Address should be max.of 50 characters" },	
			state: { required: "",
							minlength: "State should be at least 2 characters",
							maxlength: "State should be max.of 50 characters" },	
			district: { required: "",
							minlength: "District should be at least 5 characters",
							maxlength: "District should be max.of 50 characters" },	
			/*patient_pin: { required: "",
							digits: "Oops ! PIN should be digits only",
							minlength: "PIN should be at least 6 characters",
							maxlength: "PIN should be max.of 6 characters" },	*/
			dr_letter: "",	
			
			
			dr_name: { required: "",
							minlength: "Dr.Name should be at least 5 characters",
							maxlength: "Dr.Name should be max.of 100 characters" },
			
			
			source: { required: "",
							minlength: "Source should be at least 1 characters",
							maxlength: "Source should be max.of 50 characters" },						
						
			referred_by: { required: "",
							minlength: "Referred By should be at least 5 characters",
							maxlength: "Referred By should be max.of 50 characters" },
							
			patient_history: {   maxlength:"Patient History should be max.of 300 characters" },	
		
		    test_remark: {   maxlength: "Remarks should be max.of 300 characters" },
		
			test_name: { required: "",
							minlength: "Investigation should be at least 5 characters",
							maxlength: "Investigation should be max.of 50 characters" },
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

}); 