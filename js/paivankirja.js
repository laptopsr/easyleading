$(document).ready(function(){

if($('#userAgent').val() == 'ios')
{
  if(window.localStorage.getItem( "valiko1"))
  $('#valiko1').val(window.localStorage.getItem("valiko1"));


  if(window.localStorage.getItem( "valiko_pvm"))
  $('#valiko_pvm').val(window.localStorage.getItem("valiko_pvm"));

}

/* SKANNAUS */
$(document).delegate("#valiko1","change",function(){
	var thisVal = $(this).val();
	window.localStorage.setItem( "valiko1", thisVal);
});


  $("#skannata").click(function(){
	parent.postMessage("skanname", "*");
	window.localStorage.setItem( "skannausPainike", 'OK');
  });

  if($('#sainCode').val())
  {
	parent.postMessage( "skannettu_"+$('#sainCode').val(), "*");
	$('#sainCode').remove();
  }
/* ////////////////////////// */

window.addEventListener('message', function(e) {

var edata = e.data.split('_');

if(edata[0] == 'skannettu')
{

/*
if(window.localStorage.getItem( "valiko1"))
   window.localStorage.removeItem("valiko1");
if(window.localStorage.getItem( "valiko_pvm"))
   window.localStorage.removeItem("valiko_pvm");
*/
   $('#etsiminen').val(edata[1]); 

   $.ajax({
   url: 'ruoka_paivakirja_ajax',
      type: "POST",
      data: { keyword : edata[1], fav : "skannaus" },
      	success: function(data){
  	  	//console.log(data);
		if(data !== '')
		{

 	  	   $('#tb').html(data).show('slow');

		   var getId = $(data).find('a').attr("id");

		   if(parseInt(getId) > 0)
		   {

			$('html,body').animate({
		        scrollTop: $("#tb").offset().top},
		        'slow');
			$("#"+getId).trigger('click');
			//jQuery.hrefClick();

		   } else {


			$('#eiloytynyt').html('<div class="alert alert-danger">'+
			'Tuotetta ei löytynyt tietokannasta, paina "Jatka" jos haluat lisätä uuden tuotteen<br><br>'+
			'<div class="row"><div class="col-sm-12"><div class="form-inline">'+
			'<a href="#" class="btn btn-default btn-group peruutSkan">Peruuta</a>'+
			'<a href="'+location.protocol + "//" + location.host +'/index.php/viivakoodi/esikatselu?viiva='+edata[1]+'" class="btn btn-primary btn-group pull-right">Jatka</a>'+
			'</div></div></div>'+
			'</div>'
			).show('slow');
			$(".peruutSkan").click(function(){ $('#eiloytynyt').hide('slow'); });
			//window.location.href=location.protocol + "//" + location.host +'/index.php/viivakoodi/esikatselu?viiva='+edata[1];
			//jQuery.hrefClick();
		   }

		}

		return true;

      	},
  	error:function(data){
  		console.log(data); 
  	}
   });


}
});
/* SKANNAUS */



    var proteiini = parseFloat($('#ympyra_proteiini').val());
    var hiilihydraatteja = parseFloat($('#ympyra_hiilihydraatteja').val());
    var rasva = parseFloat($('#ympyra_rasva').val());


    // Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    // Build the chart
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true,
            type: 'pie',
	    marginTop: 100,
	    backgroundColor: null,

        },

exporting: {
            buttons: {
                contextButton: {
                    enabled: false
                }
               }
              },
        title: {
            text: 'Tavoite'
        },
       legend: {
            x: -60,
	    y: 50,
            padding: 55,
        },
/*
       legend: {
            layout: 'column',
            align: 'right',
            verticalAlign: 'top',
            x: -30,
	    y: 130,
            padding: -30,
        },
*/
            plotOptions: {

                pie: {
 		    size: 120,
                    allowPointSelect: false,
                    cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return this.y+' %';
                    },
                    distance: -20,
                    color:'black'
		},
                    showInLegend: true,
                },
            },
        series: [{
            name: 'Osuus',
            data: [
                { name: 'Proteiini', y: proteiini, color : '#09FF00' },
                { name: 'Hiilihydraatti', y: hiilihydraatteja, color : '#0215C1' },
                { name: 'Rasva', y: rasva, color : '#FF0000' },
            ]
        }]
    });




$(document).delegate(".grammMuutos","click",function(){
	var forID = $(this).attr('for');
	var tnimi = $(this).attr('tnimi');
	$('#showres').modal().html(' '+
'<div class="modal-dialog">'+
    '<div class="modal-content">'+
      '<div class="modal-header">'+
        '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
        '<h4 class="modal-title">Muuta painoa, '+tnimi+'</h4>'+
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
	   url: 'ruoka_paivakirja',
	      type: "POST",
	      data: { "grammMuutos" : "true", "id" : forID, "uusiValue" : uusiValue },
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


$("#poistaTaulut").click(function(){
	//sitten
});

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
var mobnum = getParameterByName('Mobile_page');



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

$("#uusituote").click(function(){
	var link = $(this).attr('linkFor');
	window.location.href=link;
});



function tableAjax(keyword,fav){

   $.ajax({
   url: 'ruoka_paivakirja_ajax?Mobile_page='+mobnum,
      type: "POST",
      data: { keyword : keyword, fav : fav },
      	success: function(data){
  	  	console.log('11');
		if(data !== 'Ei tuotteita')
		{

		   if(fav == 'showMyFav')
 	  		$('#tb').html(data).toggle('slow');
		   else
 	  		$('#tb').html(data).show('slow');



			$('html,body').animate({
		        scrollTop: $("#tb").offset().top},
		        'slow');
			console.log(data)


		} 

		   if(fav == 'scroll' && data == 'Ei tuotteita')
		   {
			alert('Elintarviketta ei löytynyt')
		   }


      	},
  	error:function(data){
  		console.log(data); 
  	}
   });

}

   	var pvmVal = $("#valiko_pvm").val();
	pvmGet(pvmVal);



if($('#userAgent').val() == 'ios')
{
$("#valiko_pvm").blur(function(){
   	pvmVal = $(this).val();
	//pvmGet(pvmVal);
	window.localStorage.setItem( "valiko_pvm", pvmVal);
	window.location.href='ruoka_paivakirja?pvm='+pvmVal;
});
} else {
$("#valiko_pvm").change(function(){
   	pvmVal = $(this).val();
	//pvmGet(pvmVal);
	window.location.href='ruoka_paivakirja?pvm='+pvmVal;
});
}




function pvmGet(pvmVal)
{

   $('#taulu1').html('');
   $.ajax({
   url: 'check_pvm',
      type: "POST",
      data: { pvm : pvmVal },
      	success: function(data){
  	  	//console.log(data);
		if(data !== '')
	  	$('#taulu1').html(JSON.parse(data)).show();
		eri();
	        vetelChart();
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
    var forTaulu = $(this).val();
    $("#"+forTaulu+" input:checkbox").prop('checked', $(this).prop("checked"));
});

$(".copyVal").click(function(){
   var thisTaulu = $(this).attr("taulu");
   var maara = $("#"+thisTaulu+" td input:checked").length;
   if(maara == 0)
   {
	alert('Valitse tuote');
	return false;
   }

   $("#"+thisTaulu+" .valikkoAndPvm").toggle('slow');

 $("#"+thisTaulu+" .ok").click(function(){

   var copyToPvm = $("#"+thisTaulu+" .valPvm").val();

   if(copyToPvm === '')
   {
	alert('Valitse päivämäärä.');
	$("#"+thisTaulu+" .valPvm").focus();
	return false;
   }
   var valValikko = $("#"+thisTaulu+" .valValikko").val();


   $("#"+thisTaulu+" td input:checked").each(function() {
      var id = $(this).val();

   	$.ajax({
	   url: 'copy_rivit',
	   type: "POST",
	   data: { id : id, pvm : copyToPvm, taulu : valValikko },
	   success: function(data){
	  	console.log(data);
		if(data == 'copyOk')
		{
			window.location.href='ruoka_paivakirja';
		}
	   },
	   error:function(data){
	  	console.log(data); 
	   }
	});

   });

	//var pvm = $('#valiko_pvm').val();
	//window.location.href="ruoka_paivakirja?pvm="+pvm;

 });
});


$(".sirraVal").click(function(){
   var thisTaulu = $(this).attr("taulu");
   var maara = $("#"+thisTaulu+" td input:checked").length;
   if(maara == 0)
   {
	alert('Valitse tuote');
	return false;
   }

   $("#"+thisTaulu+" .valikkoAndPvm").toggle('slow');

 $("#"+thisTaulu+" .ok").click(function(){

   var copyToPvm = $("#"+thisTaulu+" .valPvm").val();

   if(copyToPvm === '')
   {
	alert('Valitse päivämäärä.');
	$("#"+thisTaulu+" .valPvm").focus();
	return false;
   }

   var valValikko = $("#"+thisTaulu+" .valValikko").val();


   $("#"+thisTaulu+" td input:checked").each(function() {
      var id = $(this).val();

   	$.ajax({
	   url: 'siirra_rivit',
	   type: "POST",
	   data: { id : id, pvm : copyToPvm, taulu : valValikko },
	   success: function(data){
	  	console.log(data);
		if(data == 'siirraOk')
		{
			//$("#rivi_"+id).remove();
			window.location.href='ruoka_paivakirja';
		}
	   },
	   error:function(data){
	  	console.log(data); 
	   }
	});

   });

	//var pvm = $('#valiko_pvm').val();
	//window.location.href="ruoka_paivakirja?pvm="+pvm;

 });
});


$(".poistaVal").click(function(){

   var thisTaulu = $(this).attr("taulu");
   var maara = $("#"+thisTaulu+" td input:checked").length;
   if(maara == 0)
   {
	alert('Valitse tuote');
	return false;
   }


   $("#"+thisTaulu+" td input:checked").each(function() {
      var id = $(this).val();

   	$.ajax({
	   url: 'poista_rivit',
	   type: "POST",
	   data: { id : id },
	   success: function(data){
	  	console.log(data);

	   },
	   error:function(data){
	  	console.log(data); 
	   }
	});

   });

	var pvm = $('#valiko_pvm').val();
	setTimeout(function(){document.location.href = "ruoka_paivakirja?pvm="+pvm;},500);


});


}




 function vetelChart(){

    var tavoite = 0;
    var yhtSyonytEnergia = 0;

    var arvo = parseFloat($("#arvo").val()).toFixed(0);
    var ympyra_proteiini = $("#ympyra_proteiini").val();
    var ympyra_rasva = $("#ympyra_rasva").val();
    var ympyra_hiilihydraatti = $("#ympyra_hiilihydraatteja").val();
    var syotyYli = 0;
    var energiavaje = tavoite-yhtSyonytEnergia;

    var tot_ymp_proteiini = parseFloat($("#tot_ymp_proteiini").val());
    var tot_ymp_hi = parseFloat($("#tot_ymp_hi").val());
    var tot_ymp_rasva = parseFloat($("#tot_ymp_rasva").val());
    var tot_ymp_muut = parseFloat($("#tot_ymp_muut").val());

    tavoite = parseFloat($("#tavoite").val());
    yhtSyonytEnergia = parseFloat($('.yhtSyonytEnergia').text());

    $('#syonytEnergia').val(yhtSyonytEnergia);

    if(yhtSyonytEnergia > tavoite)
    syotyYli = parseInt(yhtSyonytEnergia-tavoite);

    var syomatta = 0;
    syomatta = tavoite-yhtSyonytEnergia;


    if(((ympyra_hiilihydraatti == '') || (ympyra_hiilihydraatti == 'puuttuu')) && (ympyra_proteiini > 0) && (ympyra_rasva > 0)){
    ympyra_hiilihydraatti = 100-ympyra_proteiini-ympyra_rasva;
    //alert(ympyra_hiilihydraatti)
    }
    

    $("#chart-container").html('');
		/*"Syöty energia: "+yhtSyonytEnergia+
		"<br>Kulutus: "+arvo+
		"<br>Tavoite: "+tavoite+
		"<br>Syöty yli tavoitteen: "+syotyYli
		"<br>Ympyrä proteiini: "+ympyra_proteiini+
		"<br>Ympyrä hiilihydraatti: "+ympyra_hiilihydraatti+
		"<br>Ympyrä rasva: "+ympyra_rasva+
		"<br>Energiavaje: "+energiavaje.toFixed(2) +
		"<br>Toteutunut ympyrä proteiini: "+tot_ymp_proteiini +
		"<br>Toteutunut ympyrä hiilihydraatti: "+tot_ymp_hi +
		"<br>Toteutunut ympyrä rasva: "+tot_ymp_rasva + 
		"<br>Toteutunut ympyrä muut: "+tot_ymp_muut */
   //);
	var sum = tot_ymp_hi+tot_ymp_proteiini+tot_ymp_rasva+tot_ymp_muut;

	if(tot_ymp_proteiini > 0 && sum > 0)
	var proteiini =  { name: 'Proteiini', y: Math.round((tot_ymp_proteiini/sum)*100), color: '#09FF00' };
	else
	var proteiini =  { name: 'Proteiini', y: 100, color: '#09FF00' };

	if(tot_ymp_hi > 0 && sum > 0)
	var hiilihydraatti =  { name: 'Hiilihydraatti', y: Math.round((tot_ymp_hi/sum)*100), color: '#0215C1' };
	else
	var hiilihydraatti =  { name: 'Hiilihydraatti', y: 0, color: '#0215C1' };

	if(tot_ymp_rasva > 0 && sum > 0)
	var rasva =  { name: 'Rasva', y: Math.round((tot_ymp_rasva/sum)*100), color: '#FF0000' };
	else
	var rasva =  { name: 'Rasva', y: 0, color: '#FF0000' };

	if(tot_ymp_muut > 0 && sum > 0)
	var alkoholi =  { name: 'Alkoholi', y: Math.round((tot_ymp_muut/sum)*100), color: '#FF7700' };
	else
	var alkoholi =  { name: 'Alkoholi', y: 0, color: '#FF7700' };



	var dat = [proteiini,hiilihydraatti,rasva,alkoholi];
	if(tot_ymp_proteiini == 0)
	dat = [hiilihydraatti,rasva,alkoholi];
	if(tot_ymp_hi == 0)
	dat = [proteiini,rasva,alkoholi];
	if(tot_ymp_rasva == 0)
	dat = [proteiini,hiilihydraatti,alkoholi];
	if(tot_ymp_muut == 0)
	dat = [proteiini,hiilihydraatti,rasva];


    // Make monochrome colors and set them as default for all pies
    Highcharts.getOptions().plotOptions.pie.colors = (function () {
        var colors = [],
            base = Highcharts.getOptions().colors[0],
            i;

        for (i = 0; i < 10; i += 1) {
            // Start out with a darkened base color (negative brighten), and end
            // up with a much brighter color
            colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
    }());

    if((tot_ymp_proteiini == 0) && (tot_ymp_hi == 0) && (tot_ymp_rasva == 0) && (tot_ymp_muut == 0))
    tot_ymp_proteiini = 100;

    // Build the chart
    $('#container2').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: true,
            type: 'pie',
	    marginTop: 100,
	    backgroundColor: null,
        },

exporting: {
            buttons: {
                contextButton: {
                    enabled: false
                }
               }
              },
        title: {
            text: 'Kulutus'
        },
       legend: {
            x: -60,
	    y: 50,
            padding: 55,
        },
/*
       legend: {
            layout: 'column',
            align: 'right',
            verticalAlign: 'top',
            x: -30,
	    y: 130,
            padding: -30,
        },
*/
            plotOptions: {

                pie: {
 		    size: 120,
                    allowPointSelect: false,
                    cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    formatter: function() {
                        return this.y+' %';
                    },
                    distance: -20,
                    color:'black'
		},
                    showInLegend: true,
                },
            },
        series: [{
            name: 'Osuus',
            data: dat
        }]
    });


	/* Plus liikunta jos on */
	var energiankulutus = parseFloat($('#energiankulutus').val());
	if(energiankulutus > 0)
	arvo = energiankulutus+parseFloat(arvo);



	//alert(tot_ymp_proteiini+ " "+tot_ymp_hi+" "+tot_ymp_rasva+" "+tot_ymp_muut)

	   if(yhtSyonytEnergia > tavoite)
	   {

            var gauge = new FlexGauge({
                appendTo: '#example1',
                //animateEasing: true,
                elementId: 'example1_canvas',


                arcSize: 55,
                //arcAngleStart: 1,
                arcStrokeFg: 10,
                arcStrokeBg: 10,
                animateSpeed: 1,
                    dialValue: false,
                    dialLabel: false,
                    dialLabel: 'Syöty<br>'+parseInt(yhtSyonytEnergia)+' kcal.',
                    //dialUnit: 'kcal',
                    dialUnits: 'unit',
                    arcFillInt: yhtSyonytEnergia,
                    arcFillTotal: yhtSyonytEnergia,
                colorArcFg: '#FF3300',
            });

	   } else {

            var gauge = new FlexGauge({
                appendTo: '#example1',
                //animateEasing: true,
                elementId: 'example1_canvas',


                arcSize: 55,
                //arcAngleStart: 1,
                arcStrokeFg: 10,
                arcStrokeBg: 10,
                animateSpeed: 1,
                    dialValue: false,
                    dialLabel: false,
                    dialLabel: 'Syöty<br>'+parseInt(yhtSyonytEnergia)+' kcal.',
                   //dialUnit: 'kcal',
                    dialUnits: 'unit',
                    arcFillInt: yhtSyonytEnergia,
                    arcFillTotal: tavoite,

            });

	   }

	   if(yhtSyonytEnergia > tavoite)
	   {
            var gauge = new FlexGauge({
                appendTo: '#example2',
                //animateEasing: true,
                elementId: 'example2_canvas',


                arcSize: 55,
                //arcAngleStart: 1,
                arcStrokeFg: 10,
                arcStrokeBg: 10,
                animateSpeed: 1,
                    dialValue: false,
                    dialLabel: false,
                    dialLabel: 'Syöty <br>yli tavoitteen<br>'+parseInt(syotyYli)+' kcal.',
                    //dialUnit: 'kcal',
                    dialUnits: 'unit',
                    arcFillInt: syotyYli,
                    arcFillTotal: syotyYli+200,

                arcBgColorLight: 200,
                arcBgColorSat: 50,
                colorArcFg: '#FF3300',

            });

	   } else {
	
            var gauge = new FlexGauge({
                appendTo: '#example2',
                //animateEasing: true,
                elementId: 'example2_canvas',


                arcSize: 55,
                //arcAngleStart: 1,
                arcStrokeFg: 10,
                arcStrokeBg: 10,
                animateSpeed: 1,
                    dialValue: false,
                    dialLabel: false,
                    dialLabel: 'Syömättä <br>'+parseInt(syomatta)+' kcal.',
                    //dialUnit: 'kcal',
                    dialUnits: 'unit',
                    arcFillInt: syomatta,
                    arcFillTotal: tavoite
            });
	   }


	   if(tavoite > arvo)
	   {
            var gauge = new FlexGauge({
                appendTo: '#example3',
                //animateEasing: true,
                elementId: 'example3_canvas',


                arcSize: 55,
                //arcAngleStart: 1,
                arcStrokeFg: 10,
                arcStrokeBg: 10,
                animateSpeed: 1,
                    dialValue: false,
                    dialLabel: false,
                    dialLabel: 'Tavoite<br>'+parseInt(tavoite)+' kcal.<br>Kulutus<br>'+parseInt(arvo)+' kcal.',
                    //dialUnit: 'kcal',
                    dialUnits: 'unit',
                    arcFillInt: tavoite,
                    arcFillTotal: tavoite
            });

	  } else {

            var gauge = new FlexGauge({
                appendTo: '#example3',
                //animateEasing: true,
                elementId: 'example3_canvas',


                arcSize: 55,
                //arcAngleStart: 1,
                arcStrokeFg: 10,
                arcStrokeBg: 10,
                animateSpeed: 1,
                    dialValue: false,
                    dialLabel: false,
                    dialLabel: 'Tavoite<br>'+parseInt(tavoite)+' kcal.<br>Kulutus<br>'+parseInt(arvo)+' kcal.',
                    //dialUnit: 'kcal',
                    dialUnits: 'unit',
                    arcFillInt: tavoite,
                    arcFillTotal: arvo
            });

	  }
 }








});
