<?php

namespace yii2lab\qr\api\controllers;

use yii2lab\rest\domain\rest\Controller;

class GeneratorController extends Controller
{
	
	public $service = 'qr.generator';
	
	public function actions() {
		$result['generate'] = [
			'class' => 'yii2lab\domain\rest\UniAction',
			'serviceMethod' => 'generate',
			'serviceMethodParams' => ['text'],
		];
		return $result;
	}
	
}
