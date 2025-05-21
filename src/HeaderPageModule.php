<?php declare(strict_types=1);

namespace ExampleWebsite;

use Base3\Api\IAssetResolver;
use Base3\Configuration\Api\IConfiguration;
use ModuledPage\Page\AbstractModuleHeader;

class HeaderPageModule extends AbstractModuleHeader {

  public function __construct(private readonly IAssetResolver $assetresolver) {}

  public function getName() {
    return 'headerpagemodule';
	}

	public function getHtml() {
    $url = $this->assetresolver->resolve('plugin/ExampleWebsite/assets/style.css');
    return '<link rel="stylesheet" type="text/css" href="' . $url . '" />' . "\n";
  }
}
