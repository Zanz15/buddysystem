function changeInputDate(input){
	if(input == 2){
		document.forms['newBuddyForm'].availableFromInput.value = document.getElementById(calendarDate).value;
	}
	else {
		document.forms['newBuddyForm'].availableFromInput.value = input;
	}
}

function validateEmail(form_id, input_id, confirm_input_id, feedback_id) {
	   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	   
		var address = document.forms[form_id].elements[input_id].value;
	   var confirmAddress = document.forms[form_id].elements[confirm_input_id].value;
		var feedback = document.getElementById(feedback_id);

	   if(!reg.test(address)) // check email
		   feedback.innerHTML ='<strong>E-mail address not valid</strong>';

	   else if(confirmAddress != '') {
			// test if confirm field is the same
			if (address != confirmAddress)
			   feedback.innerHTML ='<strong>E-mail addresses not the same</strong>';

			else feedback.innerHTML ='<strong>E-mail valid</strong>';
		}
}

function isValidDate(day,month,year){
	// as months are 0-11
	var dt=new Date(year, --month, day);

	return ( (day==dt.getDate())
				&& (month==dt.getMonth())
				&& (year==dt.getFullYear()) );
}

function validateDate(form_id, input_id, feedback_id)
{
	var date = document.forms[form_id].elements[input_id].value;
	date = date.replace(/\-/g, "/").replace(/\./g, "/").split("/");

	var feedback = document.getElementById(feedback_id);

	if( isValidDate(date[0], date[1], date[2]) )
		feedback.innerHTML = '<strong>Date valid</strong>';
	else
		feedback.innerHTML = '<strong>Date not valid</strong>';
}
