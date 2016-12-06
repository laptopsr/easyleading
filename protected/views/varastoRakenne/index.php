<?php
/* @var $this VarastoRakenneController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading">Varasto rakenne</div>
     <div class="panel-body">

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

    </div>
  </div>
 </div>
</div>

<h1>Varastot</h1>

<?php foreach($varastot as $data): ?>
<?php
	$criteria = new CDbCriteria;
	$criteria->order = " position ASC ";
	$criteria->condition = " 
		yid='".Yii::app()->getModule('user')->user()->profile->getAttribute('yid')."' 
		AND is_otsikko=1
		AND varaston_nimike='".$data->varaston_nimike."'
	";
	$varasto = VarastoRakenne::model()->findAll($criteria);
?>
<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading"><?php echo $data->varaston_nimike; ?></div>
     <div class="panel-body">

      <table class="table table-bordered">
       <tr>
	<?php foreach($varasto as $data): ?>
	  <?php echo $this->renderPartial('_view', array('data'=>$data)); ?>
	<?php endforeach; ?>
       </tr>
      </table>

    </div>
  </div>
 </div>
</div>
<?php endforeach; ?>
