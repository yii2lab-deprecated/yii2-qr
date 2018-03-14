<?php
namespace yii2lab\qr\domain\models;

use paulzi\jsonBehavior\JsonBehavior;
use yii\db\ActiveRecord;

class Cache extends ActiveRecord
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
				'class' => JsonBehavior::class,
				'attributes' => ['matrix'],
			],
		];
	}
	
}
