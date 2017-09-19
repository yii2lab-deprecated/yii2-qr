<?php

namespace yii2lab\qr\services;

use yii2lab\domain\services\ActiveBaseService;
use yii\web\NotFoundHttpException;

class GeneratorService extends ActiveBaseService {
	
	public function generate($text) {
		try {
			$entity = $this->domain->repositories->qrCache->oneByText($text);
		} catch(NotFoundHttpException $e) {
			$entity = $this->repository->getOne($text);
			$this->domain->repositories->qrCache->insert($entity);
		}
		return $entity;
	}
	
}
