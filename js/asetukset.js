  $(function() {


/*
jQuery.hrefClick = function hrefClick(){
    $("a").click(function (event) {
        event.preventDefault();
        window.location = $(this).attr("href");
    });
}
jQuery.hrefClick();
*/



$(document).delegate(".logoutPainike","click",function(){
	window.localStorage.setItem( "logoutPainike", 'OK');
});


$("#reload").click(function(){
   	window.location.reload();
});

$("#logout").click(function(){
	parent.postMessage("logout", "*");
});


    $( ".datepicker" ).datepicker({
	dateFormat: 'dd.mm.yy',
	changeMonth: true,
	changeYear: true
    });

    $( ".windowsdatepicker" ).datepicker({
	dateFormat: 'yy-mm-dd',
    });


  });



