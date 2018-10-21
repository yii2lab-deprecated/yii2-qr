<?php

namespace yii2lab\qr\domain;

use yii2lab\domain\enums\Driver;

/**
 * Class Domain
 * 
 * @property-read \yii2lab\qr\domain\interfaces\services\GeneratorInterface $generator
 * @property-read \yii2lab\qr\domain\interfaces\repositories\RepositoriesInterface $repositories
 */
class Domain extends \yii2lab\domain\Domain {
	
	public function config() {
		return [
			'services' => [
				'generator',
			],
			'repositories' => [
				'generator' => Driver::FILE,
				'cache' => Driver::ACTIVE_RECORD,
			],
		];
	}
	
}