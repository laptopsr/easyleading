<?php

class DefaultController extends Controller
{
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('index'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

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
