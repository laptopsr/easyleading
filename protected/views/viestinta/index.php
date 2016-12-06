<?php
/* @var $this ViestintaController */
/* @var $dataProvider CActiveDataProvider */
?>

<div class="row">
 <div class="col-sm-12">
   <div class="panel panel-primary">
     <div class="panel-heading">Viestinta</div>
     <div class="panel-body">


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

    </div>
  </div>
 </div>
</div>
