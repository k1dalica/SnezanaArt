$('#menuOnSmall').click(function() {
	$(this).toggleClass('open');
	$('#menu').toggleClass('open');
});

var fixHeader = false;
window.addEventListener('scroll', function (evt) {
  	checkScrollForHeader();
});

$('a[href*=\\#]').on('click', function(event){     
    event.preventDefault();
    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    $(this).removeClass('open');
	$('#menu').removeClass('open');
	$('#menuOnSmall').removeClass('open');
});

$('#viewGalleryImage i.close').click(function() {
	$('#viewGalleryImage').fadeOut(400);
	$('#popupgallery').css('overflow','auto');
});

$('#popupgallery i.close').click(function() {
	$('#popupgallery').fadeOut(400);
	$('body').css('overflow','auto');
});

$('#prev').click(function() {
	changeImage(1);
});

$('#next').click(function() {
	changeImage(2);
});

function checkScrollForHeader() {
	var dft = $(window).scrollTop();
  	var Hel = document.getElementById('header');
	if(dft > 200) {
		fixHeader = true;
		$(Hel).addClass('fixed');
	} else {
		$(Hel).removeClass('fixed');
	}
}

function checkScrollForHeader() {
		var dft = $(window).scrollTop();
	  	var Hel = document.getElementById('header');
		if(dft > 200) {
			fixHeader = true;
			$(Hel).addClass('fixed');
		} else {
			$(Hel).removeClass('fixed');
		}
	}

function changeImage(pn) {
	var img = $('#vgInfo').attr("img");
	var gid = $('#vgInfo').attr("gid");
	showLoading();
	$.post( "ajax.php",{ "action": "changeImage", "img": img, "gid": gid, "pn": pn }, function( data ) {
		$('#vgInfo').attr("img",data);
		$('#vgImg').css('background-image', 'url(' + data + ')');
		getOpisSlike(data);
		hideLoading();
	});
}

function getOpisSlike(src) {
	$.post( "ajax.php",{ "action": "getImageDesc", "url": src }, function( data ) {
		$('#vgDesc').html(data);
	});
}

$(document).on('click','#popupgallery .wrapper img',function() {
	showLoading();
	var src = $(this).attr("src");
	$('#vgInfo').attr("img",src);
	$('#vgImg').css('background-image', 'url(' + src + ')');
	$('#viewGalleryImage').fadeIn(400);
	$('#popupgallery').css('overflow','hidden');
	getOpisSlike(src);
	hideLoading();
});

function sendEmail() {
	$('#c-loading').show();
	var name = $('#fullName').val();
	var email = $('#emailAdress').val();
	var msg = $('#message').val();

	$lang = $('#language').val();
	$.post( "ajax.php",{ "action": "sendEmail", "name": name, "email": email, "msg": msg }, function( data ) {
		if(data=="1") {
			if($lang=="en")
				$('#contactInfoMsg .text').text("Thank you for contacting me, i will reply as soon as possible.");
			else
				$('#contactInfoMsg .text').text("Hvala Vam što ste me kontaktirali, odgovoriću Vam u što kraćem roku.");
			$('#contactInfoMsg').removeClass('error');
			$('#contactInfoMsg').addClass('success');
			$('#contactInfoMsg').slideDown(300);
			$('#fullName').val("");
			$('#emailAdress').val("");
			$('#message').val("");
		} else if(data=="2") {
			if($lang=="en")
				$('#contactInfoMsg .text').text("All fields must be fulfilled.");
			else
				$('#contactInfoMsg .text').text("Sva polja moraju biti popunjena.");
			$('#contactInfoMsg').slideDown(300);
		} else if(data=="3") {
			if($lang=="en")
				$('#contactInfoMsg .text').text("Please enter a valid email adress.");
			else
				$('#contactInfoMsg .text').text("Molimo Vas unesite ispravnu email adresu.");
			$('#contactInfoMsg').addClass('error');
			$('#contactInfoMsg').slideDown(300);
		}
		$('#c-loading').fadeOut(300);
	});
}

function changeLang(curent) {
	$.post( "ajax.php",{ "action": "switchLang", "lang": curent }, function( data ) {
		location.reload();
	});
}

function  viewGallery(gal) {
	$('body').css('overflow','hidden');
	showLoading();
	$.post( "ajax.php",{ "action": "viewGallery", gid: gal }, function( data ) {
		$('#vgInfo').attr("gid",gal);
		$("#popupgallery .wrapper").html( data );
		

		var images = $('#popupgallery .wrapper img');
		var nimages = images.length;
		images.load(function() {
	        nimages--;
	        if(nimages == 0) {
	            $('#popupgallery').fadeIn(400);
	            hideLoading();
	        }
	    });
	});
}

function showLoading() {
	$('#loading').fadeIn(400);
}

function hideLoading() {
	$('#loading').fadeOut(400);
}


$(window).on("load", function() {
    $('#removeLoadingGif').remove();
    checkScrollForHeader();
    hideLoading();
});
