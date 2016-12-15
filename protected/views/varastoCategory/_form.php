<?php
/* @var $this VarastoCategoryController */
/* @var $model VarastoCategory */
/* @var $form CActiveForm */
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'varasto-category-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row">
  <div class="col-sm-4">


	<?php echo $form->hiddenField($model,'yid', array('value'=>Yii::app()->getModule('user')->user()->profile->getAttribute('yid'))); ?>
	<?php echo $form->hiddenField($model,'varaston_nimike', array('value'=>$varaston_nimike)); ?>

	<?php echo $form->errorSummary($model); ?>



<!-- Puurakenne -->
	<?php
	if(is_array(json_decode($model->ryhmarakenne, true)))
	{

		function handle($arr, $deepness=1) {
		  if ($deepness == 3) {
		    exit('Not allowed');
		  }

		  foreach ($arr as $key => $value) {
		    if (is_array($value)) {
		      handle($value, ++$deepness);
		    }
		
		    else {
			$countKey = count(explode("_",$key)); //$key
			echo '
			<div class="row" style="margin-left:'.(5*$countKey).'px">
				'.$value.'
			</div>';
		    }
		  }
		}



		$arr = json_decode($model->ryhmarakenne, true);
		handle($arr);
		echo '<br>';
	}
	?>

	<h2>Uusi puu</h2>
	<div class="wrap">
	 <div class="rivit" count=0 id="rivi_0">

	  <div class="row">
	   <div class="col-sm-4" style="margin-bottom:5px;">
 	    <div class="input-group">
		<input type="text" class="form-control" name="VarastoCategory[rakenne][rivi_0]">
      		<span class="input-group-btn">
		    <button class="btn btn-success alaspain" for="rivi_0" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
		    <button class="btn btn-warning oikealle" for="rivi_0" type="button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		</span>
	    </div>
	   </div>
	  </div>
	  <div class="row">
	   <div class="col-sm-12" style="margin-bottom:5px;">
	    <div id="sub_0"></div>
	   </div>
	  </div>

	 </div>
	</div>

<style>
.col-sm-4{ width: 250px; }
</style>

<script type="text/javascript">
$(document).ready(function(){


 $(document).delegate(".alaspain","click",function(){

	var thisCount 		= $('.rivit').last().attr('count');
	var thisCountPlus 	= parseInt(thisCount)+1;

	$('.wrap').append(''+
	 '<div class="rivit" count='+thisCountPlus+' id="rivi_'+thisCountPlus+'">' +

	  '<div class="row">' +
	   '<div class="col-sm-4" style="margin-bottom:5px;">' +
 	    '<div class="input-group">' +
		'<input type="text" class="form-control" name="VarastoCategory[rakenne][rivi_'+thisCountPlus+']">' +
      		'<span class="input-group-btn">' +
		    '<button class="btn btn-success alaspain" for="rivi_'+thisCountPlus+'" type="button"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>' +
		    '<button class="btn btn-warning oikealle" for="rivi_'+thisCountPlus+'" type="button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>' +
		'</span>' +
	    '</div>' +
	   '</div>' +
	  '</div>' +
	  '<div class="row">' +
	   '<div class="col-sm-12" style="margin-bottom:5px;">' +
	    '<div id="sub_'+thisCountPlus+'"></div>' +
	   '</div>' +
	  '</div>' +

	 '</div>'
	);
 });


 $(document).delegate(".oikealle","click",function(){

	var thisPaaRiviId	= $(this).attr('for');
	var thisPaaRiviIdSplit	= $(this).attr('for').split('_');
	var left		= 20*(thisPaaRiviIdSplit.length);

	var lastSlice 		= parseInt(thisPaaRiviIdSplit.slice(-1)[0])+1;
	var countSub		= $('.wrap').find('#sub_'+thisPaaRiviIdSplit[1]).find('button').last().attr('for');
	if(!countSub)
		var lastSub		= 0;
	else
		var lastSub		= parseInt(countSub.slice(-1)[0])+1;

	var nextId		= thisPaaRiviId+'_'+lastSlice+'_'+lastSub;


	if($('#sub_'+thisPaaRiviIdSplit[1]).find('#'+thisPaaRiviId).attr('id'))
	{

	$('#sub_'+thisPaaRiviIdSplit[1]).find('#'+thisPaaRiviId).append(''+
	  '<div id="'+nextId+'" style="margin-top:5px;margin-left:'+left+'px">' +
	   '<div class="row">' +
	    '<div class="col-sm-4">' +
 	     '<div class="input-group">' +
		'<input type="text" class="form-control" name="VarastoCategory[rakenne]['+nextId+']">' +
      		'<span class="input-group-btn">' +
		    '<button class="btn btn-warning oikealle" for="'+nextId+'" type="button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>' +
		'</span>' +
	     '</div>' +
	    '</div>' +
	   '</div>' +


	  '</div>'
	);

	} else {


	$('#sub_'+thisPaaRiviIdSplit[1]).append(''+
	  '<div id="'+nextId+'" style="margin-bottom:5px;margin-left:'+left+'px">' +
	   '<div class="row">' +
	    '<div class="col-sm-4">' +
 	     '<div class="input-group">' +
		'<input type="text" class="form-control" name="VarastoCategory[rakenne]['+nextId+']">' +
      		'<span class="input-group-btn">' +
		    '<button class="btn btn-warning oikealle" for="'+nextId+'" type="button"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>' +
		'</span>' +
	     '</div>' +
	    '</div>' +
	   '</div>' +
	  '</div>'
	);
	}



 });


});
</script>

<!-- Puurakenne -->


<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'ryhmarakenne'); ?>
		<?php echo $form->textArea($model,'ryhmarakenne',array('rows'=>10, 'cols'=>50, 'class'=>'form-control', 'placeholder'=>"Autotarvikkeet,Akkulaaturit\nKalastus,Koukut,Yksihaarakoukut")); ?>
		<?php echo $form->error($model,'ryhmarakenne'); ?>
	</div>
*/?>


 </div>
</div><!-- form -->


	<div class="buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Luo' : 'Tallenna', array('class'=>'submit btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>
