<?php
namespace yii2lab\qr\models;

use paulzi\jsonBehavior\JsonBehavior;
use yii\db\ActiveRecord;

class QrCache extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%qr_cache}}';
	}
	
	public function behaviors()
	{
		return [
			'rulesJson' => [
				'class' => JsonBehavior::className(),
				'attributes' => ['matrix'],
			],
		];
	}
	
}
