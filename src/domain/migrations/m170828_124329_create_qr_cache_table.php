<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

/**
* Handles the creation of table `qr_cache`.
*/
class m170828_124329_create_qr_cache_table extends Migration
{
	public $table = '{{%qr_cache}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'hash' => $this->string(),
			'text' => $this->text(),
			'matrix' => $this->text(),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique('hash');
	}

}
