<?php

namespace yii2lab\qr\domain\entities;

use yii2lab\domain\BaseEntity;
use Yii;
use yii\helpers\FileHelper;

/**
 * Class QrEntity
 *
 * @package yii2lab\qr\domain\entities
 *
 * @property string $text
 * @property string $hash
 * @property array $matrix
 * @property string $url
 * @property string $path
 *
 */
class QrEntity extends BaseEntity {
	
	protected $text;
	protected $hash;
	protected $matrix = [];
	
	public function rules()
	{
		return [
			[['hash', 'text'], 'trim'],
			[['hash', 'text'], 'required'],
		];
	}
	
	public function getUrl() {
		return env('servers.static.domain') . $this->genFilePath($this->hash);
	}
	
	public function getPath() {
		$publicPath = env('servers.static.publicPath');
		$path = Yii::getAlias($publicPath) . $this->genFilePath($this->hash);
		$path = FileHelper::normalizePath($path);
		return Yii::getAlias($path);
	}
	
	public function fields() {
		return [
			'text',
			'hash',
			'url',
			//'matrix',
		];
	}
	
	private function genFilePath($hash) {
		return param('static.path.qr') . SL . $hash . '.png';
	}
	
}