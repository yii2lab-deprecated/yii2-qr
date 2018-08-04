<?php

namespace yii2lab\qr\domain\repositories\ar;

use yii2lab\domain\interfaces\repositories\CrudInterface;
use yii2lab\qr\domain\entities\QrEntity;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\repositories\ActiveArRepository;
use Yii;
use yii\db\ActiveRecord;
use yii2lab\qr\domain\interfaces\repositories\CacheInterface;

class CacheRepository extends ActiveArRepository implements CrudInterface, CacheInterface {
	
	protected $primaryKey = 'hash';
	
	public function uniqueFields() {
		return [
			['hash'],
		];
	}
	
	public function oneByText($text) {
		$hash = hash('crc32b', $text);
        $entity = new QrEntity([
            'text' => $text,
        ]);
        return $this->oneById($entity->hash);
	}

	public function forgeEntity($data, $class = null) {
		return parent::forgeEntity($data, QrEntity::class);
	}
	
}
