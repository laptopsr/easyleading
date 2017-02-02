

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Liikekirjeet
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">liikekirjeet</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->



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
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/filetree.css" /> 


<!-- /.portlet -->
 <div class="portlet portlet-default">
  <div class="portlet-heading">
      <div class="portlet-title">
         <h4>Tiedostot</h4>
      </div>
    <div class="clearfix"></div>
  </div>
  <div class="portlet-body">

  <div id="result"></div>

   </div>
  </div>
 </div>
<!-- /.portlet -->





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
	if(confirm('Haluatko poistaa tiedoston?'))
	openAjaxTiedosto(variables);
 });

 $(document).delegate(".poistaKansio","click",function(){
	var pois = $(this).attr('pois');
	var variables = [{'poistaKansio': pois}];
	if(confirm('Haluatko varmasti poistaa kansion? Myös kaikki alikansiot poistetaan.')){
		openAjaxTiedosto(variables);
		window.location.href="oma_kansio";
	}
 });


});

</script>
