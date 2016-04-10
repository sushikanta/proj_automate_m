$(document).ready(function() {
		  
	 $('#permanent_state').autocomplete({             // START Autocomplete for state-permanent
		source:'autocomplete_state.php', 
		minLength:1,
		focus: function( event, ui ) {
            $( "#permanent_state" ).val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#hidden_permanent_state').val(ui.item.state_id);
			return false;
		    }
		});
		  
	$("#permanent_district").autocomplete({    // START Autocomplete for District
        source: function(request, response) {
            $.ajax({
                url: "autocomplete_district.php",
                dataType: "json",
                data: {
                    term: request.term,
                    state: $("#hidden_permanent_state").val(),                    
                },
                success: function(data) {
                    response(data);
                }
            });
			
        },
		focus: function( event, ui ) {
            $( "#permanent_district").val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#hidden_permanent_district').val(ui.item.district_id);
			return false;
		    }
    });   // END Autocomplete for District
		
	$("#permanent_pin").autocomplete({    // START Autocomplete for pin_code
        source: function(request, response) {
            $.ajax({
                url: "autocomplete_pin.php",
                dataType: "json",
                data: {
                    term: request.term,
                    district: $("#hidden_permanent_district").val(),                    
                },
                success: function(data) {
                    response(data);
                }
            });
			
        },
		focus: function( event, ui ) {
            $( "#permanent_pin").val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#hidden_permanent_pin').val(ui.item.pin_id);
			return false;
		    }
    });   // END Autocomplete for patient_pin	  
	
	
	
	$('#present_state').autocomplete({             // START Autocomplete for state-clinic
		source:'autocomplete_state.php', 
		minLength:1,
		focus: function( event, ui ) {
            $( "#present_state" ).val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#hidden_present_state').val(ui.item.state_id);
			return false;
		    }
		});
		  
		$("#present_district").autocomplete({    // START Autocomplete for District - clinic
        source: function(request, response) {
            $.ajax({
                url: "autocomplete_district.php",
                dataType: "json",
                data: {
                    term: request.term,
                    state: $("#hidden_present_state").val(),                    
                },
                success: function(data) {
                    response(data);
                }
            });
			
        },
		focus: function( event, ui ) {
            $( "#present_district").val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#hidden_present_district').val(ui.item.district_id);
			return false;
		    }
    });   // END Autocomplete for District
		
	$("#present_pin").autocomplete({    // START Autocomplete for pin_code - clinic
        source: function(request, response) {
            $.ajax({
                url: "autocomplete_pin.php",
                dataType: "json",
                data: {
                    term: request.term,
                    district: $("#hidden_present_district").val(),                    
                },
                success: function(data) {
                    response(data);
                }
            });
			
        },
		focus: function( event, ui ) {
            $( "#present_pin").val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#hidden_present_pin').val(ui.item.pin_id);
			return false;
		    }
    });   // END Autocomplete for patient_pin	  
		  

$(function () {	//------------------------------------ Clone Employee Qualification
    $('#btnAdd_qualf').click(function () {
        var num     = $('.cloneQualf').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#emp_qualf' + num).clone().attr('id', 'emp_qualf' + newNum).fadeIn('slow');         
		// sl no - section
        newElem.find('.sl_no').attr('id', 'ID' + newNum + '_sl_no').attr('name', 'ID' + newNum + '_sl_no').html(newNum +'.'); 
        // Qualification - text
        newElem.find('.qualf').attr('id', 'ID' + newNum + '_qualf').attr('name', 'qualf[]').val('');
		// Faculty - text
        newElem.find('.faculty').attr('id', 'ID' + newNum + '_faculty').attr('name', 'faculty[]').val('');
		 //institute - text
        newElem.find('.institute').attr('id', 'ID' + newNum + '_institute').attr('name', 'institute[]').val('');
		 //board_univ- text
        newElem.find('.board_univ').attr('id', 'ID' + newNum + '_board_univ').attr('name', 'board_univ[]').val('');
		 // mark_obtained - text
        newElem.find('.mark_obtained').attr('id', 'ID' + newNum + '_mark_obtained').attr('name', 'mark_obtained[]').val('');
		// total_mark - text
        newElem.find('.total_mark').attr('id', 'ID' + newNum + '_total_mark').attr('name', 'total_mark[]').val('');
		// div_grad - text
        newElem.find('.div_grad').attr('id', 'ID' + newNum + '_div_grad').attr('name', 'div_grad[]').val('');
		//result- text
        newElem.find('.result').attr('id', 'ID' + newNum + '_result').attr('name', 'result[]').val('');
		//passing_year- text
        newElem.find('.passing_year').attr('id', 'ID' + newNum + '_passing_year').attr('name', 'passing_year[]').val('');
		// course_duration - text
        newElem.find('.course_duration').attr('id', 'ID' + newNum + 'course_duration').attr('name', 'course_duration[]').val('');
		// Year suffix 
        newElem.find('.year_text').attr('id', 'ID' + newNum + '_year_text').attr('name', 'year_text[]').val('Years');	
		
        // insert the new element after the last "duplicatable" input field
        $('#emp_qualf' + num).after(newElem);				
        $('#ID' + newNum + '_qualf').focus();	
		
// Enable the "remove" button
    $('#btnDel_qualf').attr('disabled', false); 
 });

$('#btnDel_qualf').click(function () {    //  START delete clone section
		var num = $('.cloneQualf').length;    // how many "duplicatable" input fields we currently have
        if (confirm('Are you sure to remove Sl.no. ' + num + ' ?')){  
					 
           $('#emp_qualf' + num).slideUp('fast', function () {$(this).remove();
				 
				 
         // if only one element remains, disable the "remove" button
         if (num -1 === 1)
                $('#btnDel_qualf').attr('disabled', true);
                // enable the "add" button
                $('#btnAdd_qualf').attr('disabled', false).prop('value', "");
				 });
              
            }
        return false;
      // remove the last element
 
    // enable the "add" button
        $('#btnAdd_qualf').attr('disabled', false);
    }); 
    $('#btnDel_qualf').attr('disabled', true);
	
});   //  END delete clone section 


$(function () {	//------------------------------------ Clone Employee Experience
    $('#btnAdd_exp').click(function () {
        var num     = $('.cloneExp').length, // how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // the numeric ID of the new input field being added
            newElem = $('#emp_exp' + num).clone().attr('id', 'emp_exp' + newNum).fadeIn('slow');         
		// sl no - section
        newElem.find('.sl_no').attr('id', 'ID' + newNum + '_sl_no').attr('name', 'ID' + newNum + '_sl_no').html(newNum +'.'); 
        // prev_company- text
        newElem.find('.prev_company').attr('id', 'ID' + newNum + '_prev_company').attr('name', 'prev_company[]').val('');
		// prev_comp_address - text
        newElem.find('.prev_comp_address').attr('id', 'ID' + newNum + '_prev_comp_address').attr('name', 'prev_comp_address[]').val('');
		 //prev_department - text
        newElem.find('.prev_department').attr('id', 'ID' + newNum + '_prev_department').attr('name', 'prev_department[]').val('');
		 //prev_position- text
        newElem.find('.prev_position').attr('id', 'ID' + newNum + '_prev_position').attr('name', 'prev_position[]').val('');
		 // mark_obtained - text
        newElem.find('.prev_from_date').attr('id', 'ID' + newNum + '_prev_from_date').attr('name', 'prev_from_date[]').val('');
		// prev_till_date - text
        newElem.find('.prev_till_date').attr('id', 'ID' + newNum + '_prev_till_date').attr('name', 'prev_till_date[]').val('');
		// div_grad - text
        newElem.find('.total_year').attr('id', 'ID' + newNum + '_total_year').attr('name', 'total_year[]').val('');
		// Year suffix 
        newElem.find('.year_text_exp').attr('id', 'ID' + newNum + '_year_text_exp').attr('name', 'year_text_exp[]').val('Years');
		
		newElem.find('.prev_from_date, .prev_till_date').removeClass('hasDatepicker').datepicker({   //family member date of birth
																			  changeMonth: true,
																			  changeYear: true,
																			  yearRange: "-10:+0", // Setting yearRange of 120 years ago
																			  dateFormat: "dd-M-yy"															  
																			  }); 
		
		
		
				    
		    
        // insert the new element after the last "duplicatable" input field
        $('#emp_exp' + num).after(newElem);				
        $('#ID' + newNum + '_prev_company').focus();	
		  
		newElem.find('#ID' + newNum + '_prev_from_date, #ID' + newNum + '_prev_till_date').removeClass('hasDatepicker').datepicker({  
							  changeMonth: true,
							  changeYear: true,
							  yearRange: "-10:+0", // Setting yearRange of before 10 years ago
							  dateFormat: "dd-M-yy",
							  onSelect: function() {   // Calculation of Number of years for employee experience
							  var start = newElem.find('#ID' + newNum + '_prev_from_date').removeClass('hasDatepicker').datepicker('getDate');
							  var end = newElem.find('#ID' + newNum + '_prev_till_date').removeClass('hasDatepicker').datepicker('getDate');
							  if(!start || !end)
							  return;
							  var years = ((end - start)/1000/60/60/24/365).toFixed(3);
							  newElem.find('#ID' + newNum + '_total_year').val(years);
							
							   }
	       }); 
		
		
		
		
	
		   
	    
// Enable the "remove" button
    $('#btnDel_exp').attr('disabled', false); 
 });

$('#btnDel_exp').click(function () {    //  START delete clone section
		var num = $('.cloneExp').length;    // how many "duplicatable" input fields we currently have
        if (confirm('Are you sure to remove Sl.no. ' + num + ' ?')){  
					 
           $('#emp_exp' + num).slideUp('fast', function () {$(this).remove();
				 
				 
         // if only one element remains, disable the "remove" button
         if (num -1 === 1)
                $('#btnDel_exp').attr('disabled', true);
                // enable the "add" button
                $('#btnAdd_exp').attr('disabled', false).prop('value', "");
				 });
              
            }
        return false;
      // remove the last element
 
    // enable the "add" button
        $('#btnAdd_exp').attr('disabled', false);
    }); 
    $('#btnDel_exp').attr('disabled', true);
	
});   //  END delete clone section 

 
if($('#experience_yes').is(':checked'))   // show/Hide Emp Experience panel if button is checked as Yes/No
  {
	$('#prevExp_infoPanel').show();		 
	     }
		 else
		 {
			$('#prevExp_infoPanel').hide();	  
	  }			
 			
 
  if ($('#check_address_yes').is(':checked')) {   // show/Hide Empl Temporary address div if button is checked as Yes/No
		 $('#emp_tempAddress_div').show();		 
	     }
		 else
		 {
			$('#emp_tempAddress_div').hide();		
			 }
	  
 $("#experience_yes, #experience_no").click(function () {					// CLICK on Experience? buttons
	  if ($('input[name=check_experience][value=Yes]').prop("checked")) {
		  $('#prevExp_infoPanel').slideDown("fast");	
		 }
	  else if ($('input[name=check_experience][value=No]').prop("checked")) {
		  $('#prevExp_infoPanel').slideUp("fast");	
	     }	 
  });     

 $("#check_address_yes, #check_address_no").click(function () {			// CLICK on Temp Address ? buttons
	  if ($('input[name=check_present_address][value=Yes]').prop("checked")) {
		  $('#emp_tempAddress_div').show();	
	     }
	  else if ($('input[name=check_present_address][value=No]').prop("checked")) {
		  $('#emp_tempAddress_div').hide();	
	     }
	 
  });   

$( "#emp_dob" ).removeClass('hasDatepicker').datepicker({   // Employee date of birth
changeMonth: true,
changeYear: true,
yearRange: "-100:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

$( "#emp_joining_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-10:+1", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
});

$("#prev_till_date, #prev_from_date" ).removeClass('hasDatepicker').datepicker({   //family member date of birth
changeMonth: true,
changeYear: true,
yearRange: "-10:+0", // Setting yearRange of 120 years ago
dateFormat: "dd-M-yy",
onSelect: showDate_diff_inYears
});

function showDate_diff_inYears() {
    var start = $('#prev_from_date').removeClass('hasDatepicker').datepicker('getDate');
    var end   = $('#prev_till_date').removeClass('hasDatepicker').datepicker('getDate');
    if(!start || !end)
        return;
    var diff = ((end - start)/1000/60/60/24/365).toFixed(3);
	
	var test = (0.00287).toFixed(3);
    $('#total_year').val(diff);  
	}
   
$('#emp_dept').autocomplete({             // START Autocomplete for department id
		source:'autocomplete_department.php', 
		minLength:1,
		focus: function( event, ui ) {
            $( "#emp_dept" ).val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#emp_dept_id').val(ui.item.department_id);
			return false;
		    }
		});
$('#emp_position').autocomplete({                // START Autocomplete for department id
		source:'autocomplete_designation.php', 
		minLength:1,
		focus: function( event, ui ) {
            $( "#emp_position" ).val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#emp_position').val(ui.item.value);
			$('#emp_position_id').val(ui.item.designation_id);
			return false;
		    }
		});
		
	$('#emp_reportingTo').autocomplete({                // START Autocomplete for department id
		source:'autocomplete_designation.php', 
		minLength:1,
		focus: function( event, ui ) {
            $( "#emp_reportingTo" ).val( ui.item.label );
            return false;
            },
		select: function (event, ui) {
			$('#emp_reportingTo').val(ui.item.value);
			$('#emp_reportingTo_id').val(ui.item.designation_id);
			return false;
		    }
		});




}); 