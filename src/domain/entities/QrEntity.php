<?php

namespace yii2lab\qr\domain\entities;

use yii\base\InvalidArgumentException;
use yii2lab\app\domain\helpers\EnvService;
use yii2lab\domain\BaseEntity;
use Yii;
use yii\helpers\FileHelper;
use yii2lab\qr\domain\enums\SummaryEnum;

/**
 * Class QrEntity
 *
 * @package yii2lab\qr\domain\entities
 *
 * @property string $text
 * @property string $hash
 * @property string $url
 * @property string $path
 * @property string $hash_algo
 */
class QrEntity extends BaseEntity {

	protected $text;
    protected $format = 'png';
    protected $hash_algo = 'crc32b';
	
	public function rules()
	{
		return [
			[['text', 'format', 'hash_algo'], 'trim'],
			[['text', 'format', 'hash_algo'], 'required'],
		];
	}

	public function setHashAlgo($value) {
        if(!in_array($value, hash_algos())) {
            throw new InvalidArgumentException('Invalid hash algo');
        }
        $this->hash_algo = $value;
    }

    public function getHash() {
        $hash = hash($this->hash_algo, $this->text);
        return $hash;
    }

    public function getUrl() {
        return EnvService::getStaticUrl($this->getPath());
    }

	public function fields() {
		return [
			'text',
			'hash',
			'url',
            //'path',
		];
	}

    public function getPath() {
        $summartEntity = \App::$domain->summary->static->oneById(SummaryEnum::QR_CODE_URL);
        $pathName = $summartEntity->value;
        $relativePath = $this->getRelativePathByHash($this->getHash());
        $fileName = $this->getHash() . DOT . $this->format;
        return $pathName . SL . $relativePath . SL . $fileName;
    }

    private function getRelativePathByHash($hash) {
        $path = substr($hash, 0, 2);
        $path .= SL . substr($hash, 2, 2);
        return $path;
    }

}