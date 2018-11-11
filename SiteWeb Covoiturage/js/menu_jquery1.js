$(function() {
    var button = $('#profilb');
    var box = $('#profilBox');
    var form = $('#details_profil');
    button.removeAttr('href');
    button.mouseup(function(profil) {
        box.toggle();
        button.toggleClass('active');
		document.getElementById('profilb').style.backgroundColor= "#f2f2f2";
		
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(profil) {
        if(!($(profil.target).parent('#profilb').length > 0)) {
            button.removeClass('active');
            box.hide();
			document.getElementById('profilb').style.backgroundColor= "";
        }
    });
});