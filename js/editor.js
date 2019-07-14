function checkLoginRequiredField(event){
	var email = document.querySelector("input[name='email']");
	var password = document.querySelector("input[name='password']");
	var emailWarning = document.querySelector("form #email-warning");
	var passwordWarning = document.querySelector("form #password-warning");
	if(email.value === ""){
		event.preventDefault();
		emailWarning.innerHTML = "*You must enter email!";
	}

	if(password.value === ""){
		event.preventDefault();
		passwordWarning.innerHTML = "*You must enter password!"; 
	}
}

function checkTitle(event){
	var title = document.querySelector("input[name='title']");
	var warning = document.querySelector("form #title-warning");
	if(title.value === ""){
		event.preventDefault();
		warning.innerHTML = "*You must write a title for the entry";
	}
}

function updateEditorMessage(){
	var p = document.querySelector("#editor-message");
	p.innerHTML = "Changes not saved!";
}

function init(){
	var editorForm = document.querySelector("form#editor");
	var title = document.querySelector("input[name='title']");
	if(title !== null){
		//this will prevent standard browser treatment of the required attribute 
		title.required = false;
		title.addEventListener("keydown", updateEditorMessage, false);
	}
	if(editorForm !== null){
    	editorForm.addEventListener("submit", checkTitle, false);
	}
}

document.addEventListener("DOMContentLoaded", init, false);