<?php

namespace yii2lab\qr\widgets;

use Yii;
use yii\base\Widget;

class Qr extends Widget
{

	const TYPE_IMG = 'img';
	const TYPE_TABLE = 'table';

	public $type = self::TYPE_IMG;
	public $size = 5;
	public $margin = 1;
	public $text;

	public function run()
	{
		$qr = Yii::$app->qr->generator->generate($this->text);
		$this->type = !empty($this->type) ? $this->type : self::TYPE_IMG;
		$method = 'render' . ucfirst($this->type);
		$this->$method($qr);
	}

	private function renderImg($qr) {
		?>
		<img src="<?= $qr->url ?>" />
		<?php
	}

	private function renderTable($qr) {
		?>
		<table cellspacing="0" cellpadding="0" style="padding: 0; margin: <?= $this->size * $this->margin ?>px">
		<?php
		foreach($qr->matrix as $line) {
			echo '<tr>';
			$this->renderTableLine($line);
			echo '</tr>';
		}
		?>
		</table>
		<?php
	}

	private function renderTableLine($line) {
		foreach($line as $cell) {
			echo '<td height="' . $this->size . '" width="' . $this->size . '" style="line-height: 0; margin: 0; padding: 0; background-color: ' . ($cell ? 'black' : '') . '">';
			echo '<small>&nbsp;</small>';
			echo '</td>';
		}
	}

}
