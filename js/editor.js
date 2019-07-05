function checkTitle(event){
	var title = document.querySelector("input[name='title']");
	var warning = document.querySelector("form #title-warning");
	if(title.value === ""){
		event.preventDefault();
		warning.innerHTML = "*You must write a title for the entry";
	}
}

function init(){
	var editorForm = document.querySelector("form#editor");
	var title = document.querySelector("input[name='title']");
	if(title !== null){
		//this will prevent standard browser treatment of the required attribute 
		title.required = false;
	}
	if(editorForm !== null){
    	editorForm.addEventListener("submit", checkTitle, false);
	}
}

document.addEventListener("DOMContentLoaded", init, false);