
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Flex Admin - Responsive Admin Theme</title>

    <!-- GLOBAL STYLES -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic' rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- PAGE LEVEL PLUGIN STYLES -->

    <!-- THEME STYLES -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/style.css" rel="stylesheet">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/css/plugins.css" rel="stylesheet">

    <!-- THEME DEMO STYLES -->
    <link href="css/demo.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-banner text-center">
                    <h1><i class="fa fa-gears"></i> <?php echo Yii::app()->name; ?></h1>
                </div>
                <div class="portlet portlet-green">
                    <div class="portlet-heading login-heading">
                        <div class="portlet-title">
                            <h4><strong>Kirjaudu sisään</strong>
                            </h4>
                        </div>
                        <div class="portlet-widgets">
			    <a class="btn btn-default btn-xs" href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/registration">
                              <i class="fa fa-plus-circle"></i> Rekisteröinti
			    </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="portlet-body">


<?php echo CHtml::beginForm(); ?>
                            <fieldset>
                                <div class="form-group">
                                    <?php echo CHtml::activeTextField($model,'username',array('class'=>'form-control')) ?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::activePasswordField($model,'password',array('class'=>'form-control')) ?>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Muista minut
                                    </label>
                                </div>
                                <br>
				<?php echo CHtml::submitButton(UserModule::t("Kirjaudu"), array('class'=>'btn btn-lg btn-green btn-block')); ?>
                            </fieldset>
                            <br>
                            <p class="small">
                                <a href="#">Unohditko salasanasi?</a>
                            </p>
<?php echo CHtml::endForm(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GLOBAL SCRIPTS -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- HISRC Retina Images -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/plugins/hisrc/hisrc.js"></script>

    <!-- PAGE LEVEL PLUGIN SCRIPTS -->

    <!-- THEME SCRIPTS -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/sisainen_assets/js/flex.js"></script>

</body>

</html>
