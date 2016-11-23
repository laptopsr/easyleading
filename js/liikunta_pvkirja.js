$(document).ready(function(){

$('#valiko_pvm').change(function(){
   	pvmVal = $(this).val();
	//$('#tbYht').html('');
	//tauluYhteensa($(this).val());
	window.location.href='liikunta_paivakirja?pvm='+pvmVal;
});




$(document).delegate(".kestoMuutos","click",function(){
	var forID = $(this).attr('for');
	var tnimi = $(this).attr('tnimi');
	var liikunta_id = $(this).attr('liikunta_id');

	$('#showres').modal().html(' '+
'<div class="modal-dialog">'+
    '<div class="modal-content">'+
      '<div class="modal-header">'+
        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
        '<h4 class="modal-title">Muuta kesto, '+tnimi+'</h4>'+
      '</div>'+
      '<div class="modal-body">'+
        '<p>'+
	'<div class="input-group">'+
	'<input type="number" id="vanhaValue" class="form-control" placeholder="Syotä uusi arvo..">'+
	  '<span class="input-group-btn">'+
	    '<button class="btn btn-group painettuMuokkaa">Muuta</button>'+
	  '</span>'+
	'</div>'+
	'</p>'+
      '</div>'+
      '<div class="modal-footer">'+
        '<button type="button" class="btn btn-default" data-dismiss="modal">Sulje</button>'+
      '</div>'+
    '</div>'+
'</div>');

$(".painettuMuokkaa").click(function(){
	var uusiValue = $('#vanhaValue').val();
   	$.ajax({
	   url: 'liikunta_paivakirja',
	      type: "POST",
	      data: { "kestoMuutos" : "true", "id" : forID, "uusiValue" : uusiValue, "liikunta_id" : liikunta_id },
	      	success: function(data){
	  	  	if(data == 'OK')
			window.location.reload();
	
	      	},
	  	error:function(data){
	  		console.log(data); 
	  	}
	});
});


	return false;
});


$("#searchIT").click(function(){
    tableAjax($("#etsiminen").val(),'scroll');
});

$("#etsiminen").keyup(function(){

	var lausenpituus = $(this).val().length;

	if(lausenpituus > 2 && $('#checkMobile').val() !== '1')
	tableAjax($(this).val(),null);
	else
	$('#tb').html(''); //clear

});


$("#showMyFav").click(function(){
	tableAjax(null,"showMyFav");
});

function tableAjax(keyword, fav){

   var pvm = $('#valiko_pvm').val();

   $.ajax({
   url: 'liikunta_paivakirja_ajax',
      type: "POST",
      data: { keyword : keyword, fav : fav, pvm : pvm },
      	success: function(data){
  	  	//console.log(data);
		if(data !== '')
		{
		  if(fav == 'showMyFav')
 	  		$('#tb').html(data).toggle('slow');
		  else
 	  		$('#tb').html(data).show('slow');


		   if(fav == 'scroll')
		   {
			$('html,body').animate({
		        scrollTop: $("#tb").offset().top},
		        'slow');
			console.log(data)
		   }


		}

      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

}

	tauluYhteensa($('#valiko_pvm').val());

function tauluYhteensa(pvm)
{

   $.ajax({
   url: 'liikunta_paivakirja',
      type: "POST",
      data: { pvm : pvm },
      	success: function(data){
  	  	//console.log('11');
		if(data !== '')
 	  	$('#tbYht').html(JSON.parse(data));
		eri();

      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

}


function eri(){

    $( ".datepicker" ).datepicker({
	dateFormat: 'dd.mm.yy',
	changeMonth: true,
	changeYear: true
    });

    $( ".windowsdatepicker" ).datepicker({
	dateFormat: 'yy-mm-dd',
    });


$(".selAll").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});

$(".copyVal").click(function(){

   var maara = $("td input:checked").length;
   if(maara == 0)
   {
	alert('Valitse tuote');
	return false;
   }

   $(".valikkoAndPvm").toggle('slow');

 $(".ok").click(function(){

   var copyToPvm = $(".valPvm").val();
   if(copyToPvm === '')
   {
	alert('Valitse päivämäärä.');
	$(".valPvm").focus();
	return false;
   }
   var valValikko = $(".valValikko").val();


   $("td input:checked").each(function() {
      var id = $(this).val();

   	$.ajax({
	   url: 'copy_rivit_liikunta',
	   type: "POST",
	   data: { id : id, pvm : copyToPvm },
	   success: function(data){
	  	console.log(data);
		if(data == 'copyOk')
		{
			window.location.href='liikunta_paivakirja';
		}
	   },
	   error:function(data){
	  	console.log(data); 
	   }
	});

		$(".valikkoAndPvm").hide('slow');

   });
 });
});


$(".sirraVal").click(function(){

   var maara = $("td input:checked").length;
   if(maara == 0)
   {
	alert('Valitse tuote');
	return false;
   }

   $(".valikkoAndPvm").toggle('slow');

 $(".ok").click(function(){

   var copyToPvm = $(".valPvm").val();
   var valValikko = $(".valValikko").val();


   $("td input:checked").each(function() {
      var id = $(this).val();

   	$.ajax({
	   url: 'siirra_rivit_liikunta',
	   type: "POST",
	   data: { id : id, pvm : copyToPvm },
	   success: function(data){
	  	console.log(data);
		if(data == 'siirraOk')
		{
			window.location.href='liikunta_paivakirja';
		}
	   },
	   error:function(data){
	  	console.log(data); 
	   }
	});

		$(".valikkoAndPvm").hide('slow');


   });
 });
});


$(".poistaVal").click(function(){

   var maara = $("td input:checked").length;
   if(maara == 0)
   {
	alert('Valitse tuote');
	return false;
   }


   $("td input:checked").each(function() {
      var id = $(this).val();

   	$.ajax({
	   url: 'poista_rivit_liikunta',
	   type: "POST",
	   data: { id : id },
	   success: function(data){
	  	console.log(data);
		if(data == 'poistaRiviOk')
		{
		window.location.reload();
		}
	   },
	   error:function(data){
	  	console.log(data); 
	   }
	});

   });

});


}


});
