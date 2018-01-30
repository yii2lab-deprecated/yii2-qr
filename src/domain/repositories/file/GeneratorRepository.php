<?php

namespace yii2lab\qr\domain\repositories\file;

use yii2lab\qr\domain\entities\QrEntity;
use yii2lab\domain\repositories\FileRepository;
use dosamigos\qrcode\lib\Enum;
use dosamigos\qrcode\QrCode;
use yii2lab\qr\domain\interfaces\repositories\GeneratorInterface;

class GeneratorRepository extends FileRepository implements GeneratorInterface {
	
	public $size = 5;
	public $margin = 1;
	public $level = Enum::QR_ECLEVEL_L;
	public $pathName = 'qr';
	public $format = 'png';
	
	public function getOne($text) {
		$data['text'] = $text;
		$data['hash'] = $this->genHash($text);
		$data['uri'] = $this->getUri($data['hash']);
		if(!$this->isExists($text)) {
			$data['matrix'] = $this->getMatrix($text);
			$this->save($text);
		}
		$entity = $this->forgeEntity($data);
		return $entity;
	}
	
	private function isExists($text) {
		$fileName = $this->getFileNameByText($text);
		return file_exists($fileName);
	}
	
	private function genHash($text) {
		$hash = hash('crc32b', $text);
		return $hash;
	}
	
	private function getMatrix($text) {
		$matrix = QrCode::text($text);
		$matrixArray = [];
		foreach($matrix as $line) {
			$matrixArray[] = $this->parseMatrixLine($line);
		}
		return $matrixArray;
	}
	
	private function parseMatrixLine($line) {
		$lineArray = [];
		$lineLen = strlen($line);
		for($i = 0; $i < $lineLen; $i++) {
			$lineArray[] = intval($line[$i]);
		}
		return $lineArray;
	}
	
	private function getFileNameByText($text) {
		$hash = $this->genHash($text);
		$fileName = $this->getFilePath($hash);
		return $fileName;
	}
	
	protected function getFileName($name, $format = null) {
		$newName = $name/* . BL . $this->level . $this->size . $this->margin*/;
		return parent::getFileName($newName, $format);
	}
	
	private function save($text) {
		$fileName = $this->getFileNameByText($text);
		$this->createDirectory();
		QrCode::encode($text, $fileName, $this->level, $this->size, $this->margin);
	}
	
	public function forgeEntity($data, $class = null) {
		return parent::forgeEntity($data, QrEntity::className());
	}
	
}
