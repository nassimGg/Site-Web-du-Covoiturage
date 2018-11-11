//Function To Display Popup
function div_show() {
document.getElementById('inscription2').style.display = "block";
document.getElementById('swiper').style.display= "none";
document.getElementById('button').style.display= "none";
document.getElementById('message').style.display= "none";
}
//Function to Hide Popup
function div_hide(){

document.getElementById('inscription2').style.display = "none";
document.getElementById('swiper').style.display= "block";
document.getElementById('button').style.display= "block";
document.getElementById('message').style.display= "block";
}
function div_show1() {
document.getElementById('inscription2').style.display = "block";
document.getElementById('button').style.display= "none";
}
//Function to Hide Popup
function div_hide1(){

document.getElementById('inscription2').style.display = "none";
document.getElementById('button').style.display= "block";
}
function show()
{
	document.getElementById('annonce_affich').style.display= "block";
	document.getElementById('swiper').style.display= "none";
}
function hide()
{
	document.getElementById('annonce_affich').style.display= "none";
	document.getElementById('swiper').style.display= "block";
}
function form_show(){
document.getElementById('form_p').style.display = "block";
document.getElementById('form_v').style.display = "none";
}
function form_hide(){
document.getElementById('form_p').style.display = "none";
document.getElementById('form_v').style.display = "block";

}
function retour_hide()
{document.getElementById('time_retour').style.display= "none";
}
function retour_show()
{document.getElementById('time_retour').style.display= "block";
}

 document.querySelector("html").classList.add('js');  
	       
	    // initialisation des variables  
	    var fileInput  = document.querySelector( ".input-file" ),    
	        button     = document.querySelector( ".input-file-trigger" ),  
	        the_return = document.querySelector(".file-return");  
	       
	    // action lorsque la "barre d'espace" ou "Entrée" est pressée  
	    button.addEventListener( "keydown", function( event ) {  
	        if ( event.keyCode == 13 || event.keyCode == 32 ) {  
	            fileInput.focus();  
	        }  
	    });  
	       
	    // action lorsque le label est cliqué  
	    button.addEventListener( "click", function( event ) {  
	       fileInput.focus();  
	       return false;  
	    });  
	       
	    // affiche un retour visuel dès que input:file change  
	    fileInput.addEventListener( "change", function( event ) {    
	        the_return.innerHTML = this.value;    
	    });  
		
		
		
	
		