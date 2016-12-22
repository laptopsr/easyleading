<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.



  if( $_SERVER['REMOTE_ADDR'] == '::1' or $_SERVER['REMOTE_ADDR'] == '127.0.0.1' )
  {
  $db = 'easyleading';
  $host = 'localhost';
  $user = 'root';
  $pass = '';


  } else {
/*
  $db = 'vetelfi_tyoajan_hallinta';
  $host = 'localhost';
  $user = 'vetelfi_vetel';
  $pass = 'KristinA1';
*/
  $db = 'easyleading';
  $host = 'localhost';
  $user = 'root';
  $pass = '';
  }


return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Easy Leading',
	//'defaultController'=>'konetietokanta/index',
	// preloading 'log' component
	'language' => 'en',
	// autoloading model and component classes
	'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
	'ext.YiiMailer.YiiMailer',
	),

    'modules'=>array(
        #...
        'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',
 
            # send activation email
            'sendActivationMail' => true,
 
            # allow access for non-activated users
            'loginNotActiv' => false,
 
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
 
            # automatically login from registration
            'autoLogin' => true,
 
            # registration path
            'registrationUrl' => array('/user/registration'),
 
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
 
            # login form path
            'loginUrl' => array('/user/login'),
 
            # page after login
            'returnUrl' => array('/user/profile'),
 
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'kristina',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(


/* pdf */
    'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.vendors.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            ),
            'HTML2PDF' => array(
                'librarySourcePath' => 'application.vendors.html2pdf.*',
                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                    'orientation' => 'P', // landscape or portrait orientation
                    'format'      => 'A4', // format A4, A5, ...
                    'language'    => 'en', // language: fr, en, it ...
                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                )*/
            )
        ),
    ),
/* pdf */


'urlManager'=>array(
    'urlFormat'=>'path',
    'rules'=>array(
        'posts/<tag:.*?>'=>'viivakoodi/index',
        // REST patterns
        array('api/tarkistaminen', 'pattern'=>'api/<model:\w+>/tarkistaminen', 'verb'=>'POST'),
        array('api/luorivi', 'pattern'=>'api/<model:\w+>/luorivi', 'verb'=>'POST'),
        array('api/suljerivi', 'pattern'=>'api/<model:\w+>/suljerivi', 'verb'=>'POST'),
        // Other controllers
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    ),
),


'clientScript' => array(
        'scriptMap' => array(
            'jquery.js'=>false,  //disable default implementation of jquery
            'jquery.min.js'=>false,  //desable any others default implementation
            'core.css'=>false, //disable
            //'styles.css'=>false,  //disable
            //'pager.css'=>false,   //disable
            'default.css'=>false,  //disable
        ),
        'packages'=>array(
            'jquery'=>array(                             // set the new jquery
                'baseUrl'=>'js/',
                'js'=>array(
		    'jquery-1.11.2.min.js',
		    'jquery-ui.min.js',
		    'datepicker-fi.js',	
		),
            ),
            'bootstrapJS'=>array(                       //set others js libraries
                'baseUrl'=>'js/',
                'js'=>array(
		    'bootstrap.min.js',
		    'bootstrap-slider.js',
		    'bootstrap-filestyle.min.js',
		    'bootstrap-select.js',
		    'bootstrap-switch.js',
		    'jquery.pulse.js',
		    //'bootstrap-datepicker.js',
		    //'bootstrap-datepicker.fi.js',
		    'asetukset.js',

	  	),
                'depends'=>array('jquery'),         // cause load jquery before load this.
            ),
            'bootstrapCSS'=>array(                       //set others js libraries
                'baseUrl'=>'css/',
                'css'=>array(  
		    'jquery-ui.css',
                    'bootstrap.min.css',
                    //'bootstrap_custom_theme.min.css',
                    'bootstrap-switch.css',
                    'bootstrap-select.min.css',
                    'bootstrap-slider.css',
		    'font-awesome.min.css',

                ),

            ),
        ),
    ),



	'chartjs' => array('class' => 'chartjs.components.ChartJs'),

        'user'=>array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host='.$host.';dbname='.$db,
			'emulatePrepare' => true,
			'username' => $user,
			'password' => $pass,
		        'tablePrefix' => 'tbl_',
			//'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'site_host'=>$_SERVER['HTTP_HOST'],
	),
);
