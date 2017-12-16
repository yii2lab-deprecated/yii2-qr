<?php

namespace yii2lab\qr\domain\services;

use yii2lab\domain\services\BaseService;
use yii\web\NotFoundHttpException;
use yii2lab\qr\domain\interfaces\services\GeneratorInterface;

class GeneratorService extends BaseService implements GeneratorInterface {
	
	public function generate($text) {
		try {
			$entity = $this->domain->repositories->cache->oneByText($text);
		} catch(NotFoundHttpException $e) {
			$entity = $this->repository->getOne($text);
			$this->domain->repositories->cache->insert($entity);
		}
		return $entity;
	}
	
}
