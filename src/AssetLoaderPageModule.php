<?php declare(strict_types=1);

namespace ExampleWebsite;

use Base3\Api\IAssetResolver;
use ModuledPage\Page\AbstractModuleHeader;

class AssetLoaderPageModule extends AbstractModuleHeader {

        public function __construct(private IAssetResolver $assetresolver) {}

        public static function getName(): string {
                return 'assetloaderpagemodule';
        }

        public function getHtml() {
                $url = 'plugin/ClientStack/assets/assetloader/assetloader.min.js';
                $resolved = $this->assetresolver->resolve($url);
                return '<script src="' . $resolved . '"></script>';
        }

        public function getPriority() {
                return 10;
        }

}

