<?php declare(strict_types=1);

namespace ExampleWebsite;

use Base3\Api\IAssetResolver;
use Base3\Configuration\Api\IConfiguration;
use ModuledPage\Page\AbstractModuleFooter;

class FooterPageModule extends AbstractModuleFooter {

	public function __construct(private readonly IAssetResolver $assetresolver) {}

	public function getName() {
		return 'footerpagemodule';
	}

	public function getPriority() {
		return 50;
	}
	
	public function getHtml() {
		$url = $this->assetresolver->resolve('plugin/FreeTemplate/assets/script.js');
		return '<script src="' . $url . '"></script>' . "\n";
	}
}
