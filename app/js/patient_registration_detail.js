$(document).ready(function() {
	alert();
/*------------------------------- Age Year, months, days show/hide --------------------------------------*/
if ($('#marital_status').val() =='')
      { 	$('#div_age_y').hide();
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
      {   $('#div_age_y').hide();
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
	/*--------------- show/hide of Source  --------------------------*/
$("#src_walkin, #src_staff, #src_others").click(function () {
	alert()
	  
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
 
	/*------------- Autocomplete for state ------------*/    		
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
		  
	/*--------------- Autocomplete for District ---------------*/    		
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
					   return false; } }
        	}).focus(function() {
                $(this).autocomplete("search");
             }); 
	
/*--------------- show/hide of Dr.name  --------------------------*/
	 if ($('input[name=dr_letter][value=2]').prop("checked")) 
	     { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val(""); } 
	 
	 if ($('input[name=dr_letter][value=1]').prop("checked")) 
			 { $('#div_dr_name').show();  }

$("#dr_letter_yes, #dr_letter_no").click(function () {
	  if ($('input[name=dr_letter][value=1]').prop("checked")) 
	     { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=2]').prop("checked")) 
	     { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val(""); }
      });      



/*--------------- Doctor autocomplete --------------------------*/

 $('#dr_name').autocomplete({		   
		  source:'autocomplete_dr.php', 
		  minLength:1,
		  change: function (event, ui){   
				 if (ui.item == null) 
					{ $("#dr_name").val("");  
					  $('#hidden_dr_id').val("");
					  return false;}
			  else 
				   { $("#dr_name").val(ui.item.value);  
					 $('#hidden_dr_id').val(ui.item.dr_id);
					 return false; }}
		});


/*----------------------------- UPDATE Patient - info  ----------------------------------*/

$("#submit-info").click(function(event) {
        if( !confirm('Are you sure to update patient information ?')) 
            event.preventDefault();
			
$("#form_patient_info").validate({
	//debug: true, 
	ignore: "",
	errorContainer: ".err",
	errorLabelContainer: '.span-error',
	onkeyup: true,
	onblur: true,
	
invalidHandler: function(event, validator) {
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
					  } 
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
						minlength: 5,
						maxlength: 50 },
		state: { required: true,
						minlength: 2,
						maxlength: 50 },
		district: { required: true,
						minlength: 5,
						maxlength: 50 },
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
					     minlength: 2,
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





/*-------------------------------------------- autocomplete - 1ST Test ----------------------------------------------*/    		
 $('#test_name').autocomplete({               
	    source:'autocomplete_test.php', 
		minLength:1,		
		  
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


/*------------------- Update payment info -----------------------*/	

$("#payment-update").click(function(event) {
        if( !confirm('Are you sure to update payment ?')) 
            event.preventDefault();
			
			$("#form_payment").validate({
				
				ignore: "",
				errorContainer: ".err",
				errorLabelContainer: '.span-error',
				//errorClass: "control-group error",
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
					  return false;
					  
					  /*$("div.errors").hide();
					  $("div.errors span").hide();*/  } 
				else { $("div.error").hide(); $("div.error span").hide(); return true;}
			},
	
rules: {
		tax_radio: { required: true,},
		tax: { required: function(){
						   var tax_radio = $('#tax_radio').val();
						   if (tax_radio == '1') {  return true; } 
					  else if (tax_radio == '2') { return false;}
					  },
				number: function(){
						   var tax_radio = $('#tax_radio').val();
						   if (tax_radio == '1') {  return true; } 
					  else if (tax_radio == '2') { return false;}
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
  
   $("#disc_no, #disc_yes").click(function () {
	  if ($('input[name=disc_radio][value=N]').prop("checked")) {
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


/*-------------------------------------------- Editable datatable ----------------------------------------------*/  
$('#PT_edit_table').dataTable( {	

        "bJQueryUI": true,
		"bPaginate": false,
		"bProcessing": true,
        "bStateSave": true,
		"bBootstrap": true,
		"bInfo": false,
		"bFilter": false,
		
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
			
				
     } ).makeEditable({
		 
		 
		sAddURL:           "ajax_patient_registration_detail_add.php",
        sDeleteURL:        "ajax_patient_registration_detail_delete.php",
				
		sAddNewRowFormId:  "formNewPatientTest",	
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
				label: "Cancel",
				class: "back-class",
				name: "action",
				value: "cancel-add",
				icons: { primary: 'ui-icon-close' }
				},
        oAddNewRowFormOptions: {
				title: 'Add new Investigation',
				autoOpen: false, 
				modal: true,
				//hide: 'fade', 
				width:'auto',
				height: 'auto',
				//backdrop: 'static',				
				//position: { my: "top", at: "centre", of: window }		

				}, 		
	
			aoColumns: [
                    	null,                    				
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
						setTimeout('window.location.reload()', 30);					
                    },
					
					fnOnAdded: function(status)
					{ 	
						
						jAlert("Status - ' " + status + ".' ! Please click on < Update Payment > to reflect the changes");
						setTimeout('window.location.reload()', 50);
					},
					
                    fnOnDeleting: function (tr, id, fnDeleteRow) {
                        jConfirm('Please confirm that you want to delete selected row', 'Confirm Delete', function (r) {
                            if (r) {
                                fnDeleteRow(id);
                            }
                        });
                        return false;
                    },
					fnOnDeleted: function(status)
					{ 	
						jAlert("Status - ' " + status + ".' ! Please click on < Update Payment > to reflect the changes");
						setTimeout('window.location.reload()', 500);
					},

    } );
	
  var qTable = $('#PT_edit_table').dataTable(); 
  qTable.fnSetColumnVis( 0, false );  // Hide the first column after initialisation
  qTable.fnSetColumnVis( 1, false );   // Hide the second column after initialisation
  qTable.fnSetColumnVis( 2, false );   // Hide the second column after initialisation		
  qTable.fnSetColumnVis( 3, false );   // Hide the second column after initialisation		

}); 