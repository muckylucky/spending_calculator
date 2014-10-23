// JavaScript Document

$(document).ready(function(){
						   
	// This will make sure that only one of the pay inputs is chosen
	var pay_input = $('#pay').find('input');
	pay_input.on('click', function() {
								   
		if ( pay_input.not(this).is(':checkbox') ) { // Get the input that hasn't been clicked and check if its the checkbox
			pay_input.removeAttr('checked');		 // If so then remove the checked attribute
			return false;
		}
		pay_input.not(this).val('');				 // If its the numeric input then clear the value				 
	});
	
	var percent = $('h2.wage-percent');
	if ( percent ) {
		var amount = percent.text().slice(0,-1) 
		if ( amount > 40 && amount <= 70 ) {
			percent.addClass('warning').text(amount + '% !');
		} else if ( amount > 70 ) {
			percent.addClass('danger').text(amount + '% !');
		}
	}
});