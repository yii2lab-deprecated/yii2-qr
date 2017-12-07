<?php

namespace yii2lab\qr\domain;

use yii2lab\domain\enums\Driver;

class Domain extends \yii2lab\domain\Domain {
	
	public function config() {
		return [
			'services' => [
				'generator',
			],
			'repositories' => [
				'generator' => Driver::FILE,
				'qrCache' => Driver::ACTIVE_RECORD,
			],
		];
	}
	
}