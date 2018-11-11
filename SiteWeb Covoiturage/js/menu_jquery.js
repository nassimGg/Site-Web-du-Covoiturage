$( document ).ready(function() {
$('#cssmenu > ul > li > a').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});
});

$(function() {
    var button = $('#loginb');
    var box = $('#loginBox1');
    var form = $('#loginForm1');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginb').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});
// Login Form
$(function() {
    var button = $('#loginb');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginb').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });
});
$(function() {
    var bouton = $('#profilb');
    var pbox = $('#profilBox');
    var prof = $('#details_profil');
    bouton.removeAttr('href');
    bouton.mouseup(function(profil) {
        pbox.toggle();
        bouton.toggleClass('active');
    });
    prof.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(profil) {
        if(!($(profil.target).parent('#profilb').length > 0)) {
            bouton.removeClass('active');
            pbox.hide();
        }
    });
});