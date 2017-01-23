<?php
class SoapController extends Controller
{
   public function actions()
    {
       return array(
        'luo_uusi' => array(
          'class' => 'CWebServiceAction',
        ),
      );
    }

    /**
     * @param string username
     * @return float
     * @soap
     */
     public function getauth($uname)
     {
               
            $session = Yii::app()->session;
            $session['u_id'] = 1111;
            return 1;
     }

     /**
     * @param string username
     * @return float
     * @soap
     */
     public function getemp($uname)
     {
        $session = Yii::app()->session;
        return isset($session['u_id'])?$session['u_id']:999;
     }
} 



/*
client

$client=new SoapClient('http://localhost/easyleading/index.php/soap/luo_uusi'); 
echo "\n".$client->getauth('harpreet'); 
echo "\n".$client->getemp('harpreet'); 

*/
