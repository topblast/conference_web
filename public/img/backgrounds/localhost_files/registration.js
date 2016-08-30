function submitForm(form) {
	var username = form.username.value;
	var email = form.email.value;
	var password = form.password.value;
	var pword = form.confirm_pword.value;

	if (password != pword) {
		document.getElementById("error_msg1").innerHTML = "Passwords do not match.";
	}


}

/*have to check the complexity of the password and display
appropriate error message if it doesn't meet the criteria*/