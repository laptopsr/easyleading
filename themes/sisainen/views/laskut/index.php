<?php
	//$asetukset=Asetukset::model()->findbypk(1);

?>

                <!-- begin PAGE TITLE ROW -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="page-title">
                            <h1>
                                Laskutus <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/laskut/create'; ?>" data-toggle="tooltip" data-placement="right" title="Luo uusi lasku"><i class="fa fa-plus-square"></i></a>
                            </h1>
                            <ol class="breadcrumb">
                                <li><i class="fa fa-dashboard"></i>  <a href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>">Etusivu</a>
                                </li>
                                <li class="active">laskut</li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- end PAGE TITLE ROW -->


	<?php if($lahettamattomat == true): ?>
	<h3 class="alert alert-primary myBgColors"><?php echo Yii::t('main', 'Lähettämättömät laskut'); ?>
		<button class="col-sm-offset-1 valitseKaikki btn btn-sm btn-default btn-group"><?php echo Yii::t('main', 'Valitse kaikki'); ?></button>
		<span id="lahetaValitsemmat"></span>
	</h3>
	<?php endif; ?>


  <div class="panel heading-border">
   <div class="panel-body">

  <table class="table table-striped" id="mobileTable">
  <thead class="myBgColors">
  <tr>
  <?php if($lahettamattomat == true): ?>
  <th></th>
  <?php endif; ?>
  <th></th>
  <th></th>
  <th><?php echo Yii::t('main', 'Nro.'); ?></th>
  <th><?php echo Yii::t('main', 'Asiakas'); ?></th>
  <th><?php echo Yii::t('main', 'Osoite'); ?></th>
  <th><?php echo Yii::t('main', 'Viitenumero'); ?></th>
  <th><?php echo Yii::t('main', 'Luotu'); ?></th>
  <th><?php echo Yii::t('main', 'Tilanne'); ?></th>
  <th><?php echo Yii::t('main', 'Tapahtuma pvm'); ?></th>
  <th><?php echo Yii::t('main', 'Yhteensä'); ?></th>
  <th><?php echo Yii::t('main', 'Avoinna'); ?></th>
  <th><?php echo Yii::t('main', 'Laskun tyyppi'); ?></th>
  </tr>
  </thead>
  <?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'viewData' => array( 'lahettamattomat'=>$lahettamattomat ), // YOUR OWN VARIABLES
  	'template'=>'{items}<table class="table table-striped table-condensed"></table><br/>{pager}',


	'pager' => array(
           'firstPageLabel'=>'<<',
           'prevPageLabel'=>'< Edellinen',
           'nextPageLabel'=>'Seuraava >',
           'lastPageLabel'=>'>>',
           //'maxButtonCount'=>'10',
           'header'=>'<h3>Siirry sivulle:</h3>',
           'cssFile'=>false,
       ), 

  )); ?>
  </table>
   </div>
  </div>



	<!--<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.modal.js"></script>-->
	<div id="showres" class="modal fade" tabindex="-1" role="dialog"></div>


<script type="text/javascript">
$(document).ready(function(){


$(".valitseKaikki").click(function(){
	var $chk=$('#mobileTable input:checkbox');
	$chk.prop('checked',$chk.is(':checked') ? null:'checked');
	if($chk.is(':checked'))
	{
		$('#lahetaValitsemmat').html('<button class="btn btn-sm btn-default btn-group lahetaNamat">Lähetä</button>');
	} else {
		$('#lahetaValitsemmat').html('');
	}
});

$(".valitseLahetettavaksi").click(function(){
	var onkoChecked = false;
	$('#mobileTable input:checkbox').each(function () {
           if (this.checked) {
		onkoChecked = true;
	   }
	});
	if(onkoChecked)
	{
		$('#lahetaValitsemmat').html('<button class="btn btn-sm btn-default btn-group lahetaNamat">Lähetä</button>');
	} else {
		$('#lahetaValitsemmat').html('');
	}
});



$(document).delegate(".lahetaNamat","click",function(){
	$('#mobileTable input:checkbox').each(function () {
           if (this.checked) {

		var thisFor = $(this).attr('for');

	        $.ajax({
	           url: 'laheta_valitsemmat?id='+thisFor,
	           /*type: "POST",
	           data: { id : thisFor },*/
	           success: function(data){
			console.log(data);
	           }
	        });

           }
	});
	window.location.reload();
});



if($('#getTila').val())
{
   $("#tilaLaskulle option[value="+$('#getTila').val()+"]").prop('selected', true);
}

$(".haemob").click(function(){
	$("#mobForm").submit();
});


$(".fa-history").click(function(){

	var thisid = $(this).attr("for");


        $.ajax({

           url: 'get_historia',
	   type: 'POST',
	   data: { id : thisid },
           success: function(data){
		//console.log(data);
		$("#showres").modal().html(JSON.parse(data));
           }
        });

});

});
</script>
