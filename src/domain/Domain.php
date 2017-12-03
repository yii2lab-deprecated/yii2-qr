<?php

namespace yii2lab\qr\domain;

use common\helpers\Driver;

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