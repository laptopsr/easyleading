<?php
/* @var $this SiteController */
?>
<div id="etusivu">

<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') != 2) : ?>

	<div class="row">
	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php if(Yii::app()->user->isAdmin()) : ?>
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user/admin',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	  <?php else: ?>
	  <?php echo CHtml::link('Henkilöstö',Yii::app()->request->baseUrl.'/index.php/user',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	  <?php endif; ?>
	 </div>
	 <!--laatiko loppu-->
	</div>

<?php endif; ?>


<!-- tyontekija -->
<?php if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2) : ?>
	<div class="row">
	 <!--laatiko alka-->
	 <div class="col-sm-3">
	  <?php echo CHtml::link('Joko, työntekijän varten',Yii::app()->request->baseUrl.'/index.php/joko',
			array('class'=>'painike btn btn-primary btn-block btn-lg')); 
	  ?>
	 </div>
	 <!--laatiko loppu-->
	</div>

<?php endif; ?>
<!-- tyontekija -->



<h1><?php echo Yii::app()->name; ?> chatti</h1>
<div id='chat'></div>
<?php 
    $this->widget('YiiChatWidget',array(
        'chat_id'=>Yii::app()->getModule('user')->user()->profile->getAttribute('yid'),// a chat identificator
        'identity'=>1,                      // the user, Yii::app()->user->id ?
        'selector'=>'#chat',                // were it will be inserted
        'minPostLen'=>2,                    // min and
        'maxPostLen'=>10,                   // max string size for post
        'model'=>new ChatHandler(),    // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
        'data'=>'any data',                 // data passed to the handler
        // success and error handlers, both optionals.
        'onSuccess'=>new CJavaScriptExpression(
            "function(code, text, post_id){   }"),
        'onError'=>new CJavaScriptExpression(
            "function(errorcode, info){  }"),
    ));
?>

 </div>
