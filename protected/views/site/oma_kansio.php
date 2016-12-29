<?php

			// <-- Onko tiedosto
			if(isset($_FILES['fileUpload']) and !empty($_FILES['fileUpload']))
			{
				$img_desc = $this->reArrayFiles($_FILES['fileUpload']);

				$path = Yii::app()->basePath."/../";
				$nextPath = $_POST['kansionSijainti'];
				if (!file_exists($path . $nextPath)) {
					mkdir($path . $nextPath, 0777, true);
				}
    				$files = array();
				$onkokuva = false;
    				foreach($img_desc as $val)
    				{
					$uploaddir = $path . $nextPath. '/';
					$uploadfile = basename($val['name']);	
					if (move_uploaded_file($val['tmp_name'], $uploaddir . $uploadfile)) {

					}
    				}

			}
			//  Onko tiedosto -->



?>
 
 <h2>Omat tiedostot</h2>


 <div id="result"></div>
 <input type="hidden" id="yid" value="<?php echo $yid; ?>">

<script type="text/javascript">
$(document).ready(function(){


 openAjaxTiedosto(null);

 function openAjaxTiedosto(variables){

	var yid = $('#yid').val();

        $.ajax({
          type: 'POST',
          url: 'oma_kansio?yid='+yid,
          data: { ajax : "true", variables : variables },
          success: function(data) {
		data=JSON.parse(data);
		//console.log(variables);
		$('#result').html(data);


		if((variables !== null) && (variables[0]['paaKansio'])){
			$('.nav.nav-tabs').find('.active').removeClass('active');
			$('#paaKansio').addClass('active');
		}
		if((variables !== null) && (variables[0]['luoKansio'])){
			$('.nav.nav-tabs').find('.active').removeClass('active');
			$('#luoKansio').addClass('active');
			$('#luoKansioLomake').show(370);
		}
		if((variables !== null) && (variables[0]['lataaTiedosto'])){
			$('.nav.nav-tabs').find('.active').removeClass('active');
			$('#lataaTiedosto').addClass('active');
			$('#lataaTiedostoLomake').show(370);
		}
          },
          error:  function(xhr, str){
	    console.log('error: ' + xhr.responseCode);
          }
        });

 };


 $(document).delegate("#paaKansio","click",function(){
	var variables = [{'paaKansio': 'true'}];
	openAjaxTiedosto(variables);
 });

 $(document).delegate("#luoKansio","click",function(){
	var variables = [{'luoKansio': 'true'}];
	openAjaxTiedosto(variables);
 });

 $(document).delegate(".luoUusiKansioSubmit","click",function(){
	var kansionNimi 	= $('#kansionNimi').val();
	var kansionSijainti 	= $('#kansionSijainti').val();

	var variables = [{'kansionNimi': kansionNimi, 'kansionSijainti': kansionSijainti}];
	openAjaxTiedosto(variables);
 });

 $(document).delegate("#lataaTiedosto","click",function(){
	var variables = [{'lataaTiedosto': 'true'}];
	openAjaxTiedosto(variables);
 });

 $(document).delegate(".lataaTiedostoSubmit","click",function(){
	$('#uusiTiedostoForm').submit();
 });

 $(document).delegate(".poista","click",function(){
	var pois = $(this).attr('pois');
	var variables = [{'poista': pois}];
	if(confirm('Haluatko poista tiedoston?'))
	openAjaxTiedosto(variables);
 });

 $(document).delegate(".poistaKansio","click",function(){
	var pois = $(this).attr('pois');
	var variables = [{'poistaKansio': pois}];
	if(confirm('Haluatko poista kansion?')){
		openAjaxTiedosto(variables);
		window.location.href="oma_kansio";
	}
 });


});
</script>









