$(document).ready(function() {

/*--------------- show/hide of Source  --------------------------*/
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
	        $("#referred_by").autocomplete({    			// START Autocomplete STAFF
				source: "autocomplete_staff.php",
				minLength:0, 
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
							   return false;} }
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

	if ($('input[name=src_type][value=W]').prop("checked")) { $('#div_refBy').hide();}
	if ($('input[name=src_type][value=S]').prop("checked")) { $('#div_refBy').show();}
	if ($('input[name=src_type][value=O]').prop("checked")) { $('#div_refBy').show();}
	


/*--------------- show/hide of Dr.name  --------------------------*/
$("#dr_letter_yes, #dr_letter_no").click(function () {
      $("#dr_name").val("");
	  $('#hidden_dr_id').val("");
	  
	  if ($('input[name=dr_letter][value=Y]').prop("checked")) { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=N]').prop("checked")) { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val("");}
   });      

	  if ($('input[name=dr_letter][value=Y]').prop("checked")) { $('#div_dr_name').show();  }
	  if ($('input[name=dr_letter][value=N]').prop("checked")) { $('#div_dr_name').hide(); $('#dr_name, #hidden_dr_id').val(""); }


/*--------------- Doctor autocomplete --------------------------*/
 $('#dr_name').autocomplete({		   
		  source:'autocomplete_dr.php', 
		  minLength:0,
		  scroll:true,
		  //autoFocus: true,
		  
		  change: function (event, ui){   
				 if (ui.item == null) 
					{ $("#dr_name").val("");
					  $('#hidden_dr_id').val("");
					  return false;}
			  else 
				   { $("#dr_name").val(ui.item.value);  
					 $('#hidden_dr_id').val(ui.item.dr_id);
					 return false; }
			}
		}).focus(function() {
                $(this).autocomplete("search");
            });

/*------------------- autocomplete - 1ST Test-----------------------*/    		
 $('#test_name').autocomplete({               
	    source:'autocomplete_test.php', 
		minLength:3,
		scroll:true,		  
		change: function (event, ui){   
				if (ui.item == null) 
				{ $('#test_name').val("");
				  $('#hidden_test_id').val("");
				  $('#hidden_dept_id').val("");
				  $('#test_price').val("");
				  $('#total_amt').val("");
				  calculateDue_amount();
				  //calculateBalwithPaid();
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
			      //calculateBalwithPaid();
				  $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function () {
					calculateDue_amount();
					//calculateBalwithPaid();
				  });
				  return false; }
		        },		
	}).focus(function() {
                $(this).autocomplete("search");
            });

/*---------------------- START Clone -------------------------------*/    		
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
        $('#ID' + newNum + '_test_name').focus();	
		$('#test_price_store').val(newNum);	
		
/*---------------------------------- START autocomplete for added tests ----------------------------------------------*/    		
	$('#ID' + newNum + '_test_name').autocomplete({ 
		source:'autocomplete_test.php', 
		minLength:3,
		scroll:true,
		//max:10,
		//delay: 0,
		
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
			 // calculateBalwithPaid();
			  $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function(){
				calculateDue_amount();
				//calculateBalwithPaid();
			   }); 
			   return false; }
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
					 //calculateBalwithPaid();
				   $("#tax_no, #tax_yes, #disc_no, #disc_yes").click(function () {
					 calculateDue_amount();
					 //calculateBalwithPaid();					
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


 /*--------------------- Tax/Discount ------------------*/
 if ($('input[name=tax_radio][value=2]').prop("checked")){ $('#label_tax, #div_tax').hide(); }
 if ($('input[name=disc_radio][value=2]').prop("checked")){ $('#discount').hide(); }
 if ($('input[name=disc_radio][value=1]').prop("checked")){ $('#discount').show(); }
 calculateDue_amount();
 
 /*--------------  TAX BUTTON CLICK  ----------------*/
  $("#tax_no, #tax_yes").click(function (){
	  
	  if ($('input[name=tax_radio][value=2]').prop("checked")) 
	     { $('#label_tax').hide();
		   $('#div_tax').hide();
		   calculateDue_amount();
		   }
	  else
	     { $('#label_tax').show();
		   $('#div_tax').show(); 
		   calculateDue_amount();
		   }
      });      

	/*-------- KEY UP - PAID AMOUNT / TAX --------*/
	$('#paid_amount').on('keyup', function() { calculateDue_amount(); });
	$('#tax').on('keyup', function() { calculateDue_amount(); });
  
/*--------- function definitions ------------*/
function calculateDue_amount(){
var total_amt = Number($('#total_amt').val());
if(total_amt == ""){
	$('#net_amount').val("");
	$('#due_amount').val(""); } 
else {
  
  var tax_per = Number($('#tax').val());     // global declaration
  var disc_per = Number($('#disc_per').val());
  var paid_amt = Number($('#paid_amount').val());
  
 if ($('input[name=tax_radio][value=2]').prop("checked") && $('input[name=disc_radio][value=2]').prop("checked"))  // tax = no, disc = no
     { 
	  $('#discount').hide();
	  var cal_due = total_amt - paid_amt;
	  $('#net_amount').val(total_amt.toFixed(2));
	  $('#due_amount').val(cal_due.toFixed(2));	 
	 }
 
 if ($('input[name=tax_radio][value=1]').prop("checked") && $('input[name=disc_radio][value=2]').prop("checked"))  // tax = yes, disc = no
    { 
	  $('#discount').hide();
	  var net_after_tax = total_amt + (tax_per * 0.01 * total_amt);
	  var cal_due = net_after_tax - paid_amt;
	  $('#net_amount').val(net_after_tax.toFixed(2));
	  $('#due_amount').val(cal_due.toFixed(2));	  
	  }
	
  if ($('input[name=tax_radio][value=2]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked"))  // tax = no, disc = Yes
    { 
	 $('#discount').show();	 
	  var net_after_disc = total_amt - (disc_per * 0.01 * total_amt);
	  var cal_due = net_after_disc - paid_amt;
	  $('#net_amount').val(net_after_disc.toFixed(2));
	  $('#due_amount').val(cal_due.toFixed(2));	 
	   }
 if ($('input[name=tax_radio][value=1]').prop("checked") && $('input[name=disc_radio][value=1]').prop("checked"))  // tax = yes, disc = yes
    { 
	  $('#discount').show();
	  var net_after_tax = total_amt + (tax_per * 0.01 * total_amt);
	  var net_after_disc = net_after_tax - (disc_per * 0.01 * net_after_tax);
	  var cal_due = net_after_disc - paid_amt;
	  $('#net_amount').val(net_after_disc.toFixed(2));
	  $('#due_amount').val(cal_due.toFixed(2));	 
	  }
  }
}
	
	/*--------------- Submit - confirmation -------------------*/  
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
					  ? 'Missed 1 field. Highlighted - '
					  : 'Missed ' + errors + ' fields. Highlighted - ';
					  $("div.error").show().delay(3000).fadeOut("medium");
					  $("div.error span").html(message);
					  $("div.err").hide();
					  $("div.err span").hide();
					  $("#page_date").hide();
					  return false;} 
				else { $("div.error").hide(); $("div.error span").hide(); return true;}
			},	   
rules: {
		
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
			 				       var src_type = $('#src_type').val();
								   var referred_by = $('#hidden_referred_by').val();
								   if ($('input[name=src_type][value=W]').prop("checked") && referred_by =='' || referred_by !='')
								      return false;								  
									  else
									   return true;
								   
						},
					     minlength: 3,
					     maxlength: 100 },
						 
		patient_history: {  
							required: false,
							maxlength: 200 },	
		
		lab_note: {   required: false,
						 maxlength: 100 },	
						 
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
						   
						  /* 
						  var tax_radio1 = $('#tax_radio').val();
						  if ($('input[name=tax_radio][value=1]')) {  return true; } 
					  else if ($('input[name=tax_radio][value=2]')) { return false;}*/
				      },
			 },
		disc_radio: { required: true,},
		disc_code:  { required: function(){
						   if ($('input[name=disc_radio][value=1]').prop("checked")) { return true; }  // yes
					  else if ($('input[name=disc_radio][value=2]').prop("checked")) { return false; }  // no
					  },
			 },
		
		/*paid_amount: { required: true,
						number: true,
						minlength: 1,
					    maxlength: 10
						},*/
		paid_amount: { required: true,
					   number: true,
						minlength: 1,
						min:0,
					    max: function(){ return Number($('#net_amount').val());},
						
					},	

},

messages: {
			
			dr_letter: "",	
			
			dr_name: { required: "",
							minlength: "Dr.Name should be at least 3 characters",
							maxlength: "Dr.Name should be max.of 100 characters" },
							
			
			src_type: { required: "",},						
						
			referred_by: { required: "",
							minlength: "Referred By should be at least 3 characters",
							maxlength: "Referred By should be max.of 100 characters" },
							
			patient_history: { maxlength:"Patient History should be max.of 100 characters" },	
		
		    lab_note: { maxlength: "Lab Notes should be max.of 50 characters" },
		
			'test_name[]': "",
			'test_price[]': "",
			
			tax_radio: { required: ''},
			tax: { required: '',
				   number: "Oops ! Tax should be numbers only" },			 
			disc_radio: { required: ''},
			disc_code:  { required: ''},
			/*paid_amount: { required: "",
						   number: "Oops ! Paid Amount should be numbers only",
						    minlength: "Paid Amount should be at least 1 characters",
							maxlength: "Paid Amount should be max.of 10 characters" },*/	
							
			paid_amount: { required: "",
						   number: "Oops ! Paid Amount should be numbers only",
						   min:'min.number is 0',
					       max: function(){ return 'Max.payable amount Rs. ' + Number($('#net_amount').val());},
						},					

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