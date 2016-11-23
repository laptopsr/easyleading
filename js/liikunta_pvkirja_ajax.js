$(document).ready(function(){


$("#valiko_pvm").change(function(){
   	//pvmVal = $(this).val();
	$('#oikeallaTaulu').html('');
});


$(".viivat").click(function(){
 	$('.viivat').removeClass("bg-info");
	$(this).addClass("bg-info");
	var thisID = $(this).attr("id");
	var pvm = $("#valiko_pvm").val();
	var laji = $(this).attr('laji');
	var value = $(this).attr('value');

	pvmGet2(pvm, laji, value, thisID);
});


function pvmGet2(pvm, laji, value, liikunta_id){

   $.ajax({
   url: 'get_liikunta_ajax',
      type: "POST",
      data: { pvm : pvm, laji : laji, value : value, liikunta_id : liikunta_id },
      	success: function(data){
  	  	//console.log(data);
		if(data !== '')
 	  	$('#oikeallaTaulu').html(data).show('slow');

			$('html,body').animate({
		        scrollTop: $("#oikeallaTaulu").offset().top},
		        'slow');
			$("#"+getId).trigger('click');

		$('#LiikuntaUser_kesto').focus();
      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

}



  poistaSuosiki();
  uusiSuosiki();

function uusiSuosiki(){

  $(".tahti").click(function(){
	var thisID = parseInt($(this).attr("forID"));

        $.ajax({
        url: 'uusi_suosiki',
        type: "POST",
        data: { liikunta_paivakirja_id : thisID, sivu : "liikunta" },
        success: function(data){
		sp = data.split("//");
		if(sp[0] == 'uusiFavOK')
   		$("#"+thisID+" b").replaceWith('<b class="onSuosiki fa fa-star" style="font-size:150%;color:#FF9900" suID="'+sp[1]+'" forID="'+thisID+'"></b>');
		poistaSuosiki();
	}
    	});

  });

}

function poistaSuosiki(){

  $(".onSuosiki").click(function(){

	var forID = parseInt($(this).attr("forID"));
	var suID = parseInt($(this).attr("suID"));

        $.ajax({
        url: 'remove_suosiki',
        type: "POST",
        data: { id : suID, sivu : "liikunta" },
        success: function(data){
   		$("#"+forID+" b").replaceWith('<b class="tahti fa fa-star-o" style="font-size:150%" forID="'+forID+'"></b>');
		
uusiSuosiki();
	}
    	});

  });

}



});
