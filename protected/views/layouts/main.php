<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="fi" />
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />-->
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->





  <!--<link rel="stylesheet" type="text/css" href="css/navbar.css" />-->
  <!--<link rel="stylesheet" href="css/etunti-bootstrap-theme.css">-->

  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/openSans.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/footer.css" />


  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.2.min.js"></script>

<?php
  $curpage = Yii::app()->getController()->getAction()->controller->id;
  $curpage .= '/'.Yii::app()->getController()->getAction()->controller->action->id;

  Yii::app()->clientScript->registerPackage('bootstrapJS');
  Yii::app()->clientScript->registerPackage('bootstrapCSS');

  if(Yii::app()->user->isAdmin())
	$tila = 'Järjestelmänvalvoja';
  if(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 1)
	$tila = 'Yrittäjä';
  elseif(!Yii::app()->user->isGuest and Yii::app()->getModule('user')->user()->profile->getAttribute('tyyppi') == 2)
	$tila = 'Työntekijä';
  elseif(Yii::app()->user->isGuest)
	$tila = 'Vieras';


  // <-- Check chat
  if( !Yii::app()->user->isGuest and $curpage != 'site/chat')
  {
    if(!isset(Yii::app()->user->chatCount))
    {
	if(Yii::app()->getModule('user')->user()->profile->getAttribute('yid') != 0)
		$yid = Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
	else
		$yid = Yii::app()->user->id;

	$criteria = new CDbCriteria;
	$criteria->condition = " chat_id='".$yid."' ";
	$model = YiichatPost::model()->findAll($criteria);
	if(isset($model[0]))
	Yii::app()->user->setState('chatCount', count($model));
    }


  	if( isset(Yii::app()->user->chatCount) )
  	echo '<input type="hidden" id="chatCount" value="'.(int)Yii::app()->user->chatCount.'">';
 	else
  	echo '<input type="hidden" id="chatCount" value=0>';

	echo "
	<script type=\"text/javascript\">
	$(document).ready(function(){
	
	$(function() {
	    startRefresh();
	});
	
	function startRefresh() {
	    setTimeout(startRefresh,5000);
	    $.get('".Yii::app()->request->baseUrl."/index.php/site/chat_check', function(data) {
		data=JSON.parse(data);
		if((data !== '') && ( data !== parseFloat($('#chatCount').val()) ) )
	        	$('#chattiPainike').removeClass('btn btn-warning').addClass('btn btn-warning').css({'color':'white'});
		else if((data !== '') && ( data === parseFloat($('#chatCount').val()) ) )
	        	$('#chattiPainike').removeClass('btn btn-warning');
	
		console.log($('#chatCount').val()+ ' '+ data);
	    });
	}
	
	});
	</script>";
  }
  //     Check chat -->

?>



<script>
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){

  $('.vilkku').pulse({opacity: 0.3}, 
    {
     duration : 2250,
     pulses   : 10000,
     interval : 300
 });

});
</script>


	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl.'/index.php/site/index'; ?>"><?php echo Yii::app()->name; ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">


        <li><?php echo CHtml::link('Etusivu',Yii::app()->request->baseUrl.'/index.php/site/index'); ?></li>

	<?php if(!Yii::app()->user->isGuest) : ?>
        <li><?php echo CHtml::link('Chatti',Yii::app()->request->baseUrl.'/index.php/site/chat', array('id'=>'chattiPainike')); ?></li>
	<?php endif; ?>

      <?php if(!Yii::app()->user->isGuest) : ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle " data-toggle="dropdown" title="Asetukset"><?php echo $tila; ?> <i class="caret"></i></a>
        <ul class="dropdown-menu">
           <li class="menu-item dropdown dropdown-submenu">
          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Asetukset </a>
          	<ul class="dropdown-menu">
            	<li><?php echo CHtml::link('Test2',Yii::app()->request->baseUrl.'/index.php/site/test2'); ?></li>
          	</ul>
           </li>
        </ul>
      </li>
      <?php endif; ?>



      </ul>

      <ul class="nav navbar-nav navbar-right" title="Profiili">

	<?php if(!Yii::app()->user->isGuest) : ?>
            <li><?php echo CHtml::link('<i class="fa fa-user" aria-hidden="true"></i>',Yii::app()->request->baseUrl.'/index.php/user/profile',array(
			'style'=>'font-size: 130%', 
			'data-toggle'=>'tooltip', 
			'data-placement'=>'bottom', 
			'title'=>Yii::t('main', 'Profiili')
			)); ?>
	    </li>
	<?php endif; ?>


	<?php if(Yii::app()->user->isGuest) : ?>
            <li><?php echo CHtml::link('Rekisteröinti',Yii::app()->request->baseUrl.'/index.php/user/registration'); ?></li>
            <li><?php echo CHtml::link('Sisään',Yii::app()->request->baseUrl.'/index.php/user/login'); ?></li>
	<?php else : ?>

            <li><?php echo CHtml::link('<i class="logoutPainike fa fa-power-off" aria-hidden="true"></i>',Yii::app()->request->baseUrl.'/index.php/user/logout',array(
			'style'=>'font-size: 130%', 
			'data-toggle'=>'tooltip', 
			'data-placement'=>'bottom', 
			'title'=>Yii::t('main', 'Ulos')
			)); ?>
	    </li>
	<?php endif; ?>


      </ul>
     </li>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<?php
$curpage = Yii::app()->getController()->getAction()->controller->id;
$curpage .= '/'.Yii::app()->getController()->getAction()->controller->action->id;
?>


<br><br>
<p>
<div class="container container-fluid">
	<?php echo $content; ?>
</div>
</p>


</body>
</html>
