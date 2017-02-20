<?php
namespace app\assets;

use yii\web\AssetBundle;

class FaAssets extends AssetBundle{
	public $basePath = "@webroot/assets/fontawesome";
	public $baseUrl ="@web/assets/fontawesome";
	public $css=[
	'css/font-awesome.min.css',
	];

	public $publishOptions=[
		'only'=>[
			'fonts/',
			'css/',
		]
	];
}

?>