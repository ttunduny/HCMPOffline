/**
 * @author Kariuki
 */
/**  HCMP datepicker option */
json_obj = { "url" : "Images/calendar.gif'",};

var baseUrl=json_obj.url;

  function getLastDayOfYearAndMonth(year, month)
{
    return(new Date((new Date(year, month + 1, 1)) - 1)).getDate();
}    // for the last day of the month
	function refreshDatePickers() {
		var counter = 0;
		$('.clone_datepicker').each(function() {
		var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({ 
        	beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
        if (date.getDate() ==
            getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }

        return [false, ''];
    },
        	        dateFormat: 'd M yy', 
        	        buttonImage: baseUrl,
					changeMonth: true,
			        changeYear: true
				});; // re-init datepicker
				counter++;
		});				
  }
  //	-- Datepicker	showing just the last day of the month 			
	$(".clone_datepicker").datepicker({
	beforeShowDay: function(date)
    {
        // getDate() returns the day [ 0 to 31 ]
     if (date.getDate() ==
         getLastDayOfYearAndMonth(date.getFullYear(), date.getMonth()))
        {
            return [true, ''];
        }
        return [false, ''];
    },				
	dateFormat: 'd M yy', 
	changeMonth: true,
	changeYear: true,
	buttonImage: baseUrl,       });	
	
	  //	-- Datepicker	limit today		
	$(".clone_datepicker_normal_limit_today").datepicker({
    maxDate: new Date(),				
	dateFormat: 'd M yy', 
	changeMonth: true,
	changeYear: true,
	buttonImage: baseUrl,       });	
	
		function refresh_clone_datepicker_normal_limit_today() {
		var counter = 0;
		$('.clone_datepicker_normal_limit_today').each(function() {
		var this_id = $(this).attr("id"); // current inputs id
        var new_id = counter +1; // a new id
        $(this).attr("id", new_id); // change to new id
        $(this).removeClass('hasDatepicker'); // remove hasDatepicker class
        $(this).datepicker({ 
        	        maxDate: new Date(),
        	        dateFormat: 'd M yy', 
        	        buttonImage: baseUrl,
					changeMonth: true,
			        changeYear: true
				});; // re-init datepicker
				counter++;
		});				
  }
 /******************---------------END--------------------------**********************/
 /* HCMP calculate the actual stock value */
function calculate_actual_stock(actual_units,pack_unit_option,user_input,target_total_units_field,input_object,option){
	
  var user_input=parseInt(user_input);

  if (pack_unit_option == 'Pack_Size'){
  		//unit_size
  	var actual_unit_size=parseInt(actual_units);}
   else{
	//do this other
	var actual_unit_size=1; }
 
    var total_commodity_available_stock=actual_unit_size*user_input;
    
    if(isNaN(total_commodity_available_stock)){
     total_commodity_available_stock=0;
    }
    if(target_total_units_field=='return'){
    return total_commodity_available_stock;
    }else{
     input_object.closest("tr").find(target_total_units_field).val(total_commodity_available_stock);	
    }
    
 
}
 /******************---------------END--------------------------**********************/
/* HCMP AJAX request and console response for comfirmation  */
function ajax_simple_post_with_console_response(url, data){
	          $.ajax({
	          type: "POST",
	          data: data,
	          url: url,
	          beforeSend: function() {
	           // console.log("data to send :"+data);
	          },
	          success: function(msg) { console.log(msg);}
	         });
}
 /******************---------------END--------------------------**********************/
/* HCMP system confirmation message box */
function dialog_box(body_html_data,footer_html_data){
	        $('#communication_dialog .modal-body').html("");
			$('#communication_dialog .modal-footer').html("");
            //set message dialog box 
            $('#communication_dialog .modal-footer').html(footer_html_data);
            $('#communication_dialog .modal-body').html(body_html_data);
            $('#communication_dialog').modal('show');
	
}
 /******************---------------END--------------------------**********************/

