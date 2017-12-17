Установка
===

Устанавливаем зависимость:

```
composer require yii2lab/yii2-qr
```

Объявляем миграции:

```php
return [
	...
	'dee.migration.path' => [
	    ...
		'@vendor/yii2lab/yii2-qr/src/domain/migrations',
		...
	],
	...
];
```

Объявляем API модуль:

```php
return [
	'modules' => [
		...
	    'qr' => [
			'class' => 'yii2lab\qr\api\Module',
		],
        ...
	],
	'components' => [
		'urlManager' => [
			'rules' => [
                ...
				'POST v4/qr-generator' => 'qr/generator/generate',
                ...
			],
		],
	],
];
```

Объявляем домен:

```php
return [
	'components' => [
		// ...
		'qr' => [
			'class' => 'yii2lab\domain\Domain',
			'path' => 'yii2lab\qr\domain',
			'repositories' => [
				'generator' => Driver::FILE,
				'qrCache' => Driver::ACTIVE_RECORD,
			],
			'services' => [
				'generator',
			],
		],
		// ...
	],
];
```
