<?php declare(strict_types=1);

namespace ExampleWebsite;

use ModuledPage\Page\AbstractModuleHeader;

class JqueryPageModule extends AbstractModuleHeader {

        public static function getName(): string {
                return "jquerypagemodule";
        }

        public function getHtml() {
                return '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
        }

        public function getPriority() {
                return 10;
        }

}

