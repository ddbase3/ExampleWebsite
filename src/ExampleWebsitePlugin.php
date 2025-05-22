<?php declare(strict_types=1);

namespace ExampleWebsite;

use Base3\Api\IAssetResolver;
use Base3\Api\IPlugin;
use Base3\Api\ICheck;
use Base3\Api\IContainer;
use Base3\Api\IMvcView;
use Base3\Accesscontrol\Api\IAccesscontrol;
use Base3\Accesscontrol\No\NoAccesscontrol;
use Base3\Configuration\Api\IConfiguration;
use Base3\Core\AssetResolver;
use Base3\Session\Api\ISession;
use Base3\Session\BasicSession\BasicSession;
use Base3\Usermanager\Api\IUsermanager;
use Base3\Usermanager\No\NoUsermanager;

class ExampleWebsitePlugin implements IPlugin, ICheck {

	private $container;

	public function __construct(IContainer $container) {
		$this->container = $container;
	}

	// Implementation of IBase

	public function getName() {
		return "examplewebsiteplugin";
	}

	// Implementation of IPlugin

	public function init() {

		$this->container

			->set($this->getName(), $this, IContainer::SHARED)

			->set('session', new BasicSession($this->container->get(IConfiguration::class)), IContainer::SHARED)
			->set(ISession::class, 'session', IContainer::ALIAS)

			->set('accesscontrol', new NoAccesscontrol, IContainer::SHARED | IContainer::NOOVERWRITE)
			->set(IAccesscontrol::class, 'accesscontrol', IContainer::ALIAS)

			->set('usermanager', new NoUsermanager, IContainer::SHARED | IContainer::NOOVERWRITE)
			
			->set(IAssetResolver::class, fn() => new AssetResolver, IContainer::SHARED | IContainer::NOOVERWRITE);
	}

	// Implementation of ICheck

	public function checkDependencies() {
		return array(
			"base3templateplugin_installed" => $this->container->get('base3templateplugin') ? "Ok" : "base3templateplugin not installed"
		);
	}

}
