function showValidation (type, elem, spanID){
	if (validate(type, elem)) {
		document.getElementById(spanID).innerHTML = "OK";
	}
	else {
		document.getElementById(spanID).innerHTML = "Invalid";
	}

};
function validate(type, elem) {
	if (type == "name") {
		var usernameRegex = /[a-z0-9.]$/;
		var test = $(elem).val();
		if (usernameRegex.test(test)) {
			return true;
		}
		else {
			return false;
		}
	}
	
	if (type == "password") {
		var passRegex = /[a-z0-9]{8}$/;
		var alsoo = /[0-9]{1,1}$/;
		if (passRegex.test($(elem).val())) {
			if (alsoo.test($(elem).val())) {
				return true;
			}
		}
		else {
			return false;
		}
	}
	
};