<?php

class DefaultController extends Controller
{
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

	        $criteria=new CDbCriteria;
		$criteria->condition="
			status > '".User::STATUS_BANNED."'
			AND yid='".Yii::app()->user->id."'
		";

		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('/user/index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	protected function tyyppiMuutos($data)
	{
		if($data->profile->tyyppi == 1)
			return 'Yrittäjä';
		if($data->profile->tyyppi == 2)
			return 'Työntekijä';
	}
}
