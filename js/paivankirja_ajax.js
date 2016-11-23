$(document).ready(function(){


  poistaSuosiki();
  uusiSuosiki();

function uusiSuosiki(){

  $(".tahti").click(function(){

	var forIDP = $(this).attr("forID");
	var thisID = $(this).attr("forID").split('_');
        $.ajax({
        url: 'uusi_suosiki',
        type: "POST",
        data: { tuote_id : thisID[1], sivu : "ruoka" },
        success: function(data){
		sp = data.split("//");
		if(sp[0] == 'uusiFavOK')
   		$("#"+forIDP+" b").replaceWith('<b class="onSuosiki fa fa-star" style="font-size:150%;color:#FF9900; margin-top: 5px;" suID="'+sp[1]+'" forID="'+forIDP+'"></b>');
		poistaSuosiki();
	}
    	});

  });

}

function poistaSuosiki(){

  $(".onSuosiki").click(function(){

	var forIDP = $(this).attr("forID");
	var forID = $(this).attr("forID").split('_');
	var suID = $(this).attr("suID").split('_');

        $.ajax({
        url: 'remove_suosiki',
        type: "POST",
        data: { id : suID, sivu : "ruoka" },
        success: function(data){
   		$("#"+forIDP+" b").replaceWith('<b class="tahti fa fa-star-o" style="font-size:150%; margin-top: 5px;" forID="'+forIDP+'"></b>');
		uusiSuosiki();
	}
    	});

  });

}




  $(".viivat").click(function(){

	$('.viivat').removeClass("bg-info");
	$(this).addClass("bg-info");
	var thisID = $(this).attr("id");
	var taulu = '';
	var pvm = $("#valiko_pvm").val();
	var pvmID = pvm.split('.');
	pvmID = pvmID[2]+"-"+pvmID[1]+"-"+pvmID[0];

	$("#currentModel").val(thisID);


   $.ajax({
        url: 'get_tiedot?id='+thisID,
        type: "POST",
        data: { pvm : pvm },
      	success: function(data){
  	  	sp = JSON.parse(data).split("//");
	  	$('#proteiini').html(sp[1]);
	  	$('#hiilihydraatti').html(sp[2]);
	  	$('#rasva').html(sp[3]);
	  	$('#energia_kcal').html(sp[7]);
	  	$('#la').html(sp[5]);
		/*
		if((sp[1] !== '') | (sp[2] !== '') | (sp[3] !== '') | (sp[4] !== ''))
		$('#tiedot').show();
		else
		$('#tiedot').hide();
		*/



// paa sivu
$(".ruokaView").change(function(){
	var thisValue = $(this).val();
	if(thisValue == 'ruoka')
	{
	   $('#ruoka').show();
	   $('#tiedotRuoasta').fadeOut();
	} else {
	   $('#ruoka').hide();
	   var model = $("#currentModel").val();

	   $.ajax({
	   url: 'show_tiedot?id='+model,
	      	success: function(data){
	  	  	$('#tiedotRuoasta').html(data).fadeIn();
	      	},
	  	error:function(data){
	  		console.log(data); 
	  	}
	   });
	

	}
});


		if(data)
		{

		$(".paina").click(function(){

		var mita = $(this).attr("mita");
		if(mita == 'muu')
		{
		   if($(".muu").val() === '')
		   {
		     alert('Anna annoskoko');
		     return false;
		   } else {
		     var gramm = parseFloat($(".muu").val().replace(",","."));
	   	   }

		} else {
		var gramm = parseFloat($(this).attr("gramm").replace(",","."));
		}

		var whatForVal = $('#valiko1 option:selected').val();	
		var whatForText = $('#valiko1 option:selected').text();	
	
/*
		var energia = (sp[7])/100)*gramm.toFixed(2);
		var proteiini = ((parseFloat(sp[1])/100)*gramm).toFixed(2);
		var hiilihydraatti = ((parseFloat(sp[2])/100)*gramm).toFixed(2);
		var rasva = ((parseFloat(sp[3])/100)*gramm).toFixed(2);
*/


		var alkoholi = parseInt(((parseFloat(sp[12])/100)*gramm).toFixed(2));
		if(((parseInt(sp[11]) + alkoholi) > parseInt(sp[9])) && (sp[8] == true))
		{
		    var r = confirm("Alkoholin käyttösi on runsasta. Paina \"OK\" jos haluat jatkaa.");
		}


    if (r == false) {
        window.location.reload();
	return false;
    }



        	  $.ajax({
           		url: 'ajax_insert',
           		type: "POST",
           		data: { pvm : pvm, tuote : thisID, taulu : whatForText, gramm : gramm  }, //energia_kcal : energia, proteiini : proteiini, hiilihydraatti : hiilihydraatti, rasva : rasva,
           		success: function(html){
         			$('#tiedot').hide('slow'); 
				$('#la').html(''); 
				//pvmGet(pvm);
				setTimeout(function(){document.location.href = "ruoka_paivakirja?pvm="+pvm+"&valiko="+whatForVal;},500);
           		}
        	   });

		});
		}



      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

  });


});
