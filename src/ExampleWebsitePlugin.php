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
use Base3\Middleware\Session\SessionMiddleware;
use Base3\Middleware\Accesscontrol\AccesscontrolMiddleware;
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

	public static function getName(): string {
		return "examplewebsiteplugin";
	}

	// Implementation of IPlugin

	public function init() {

		$this->container

			->set($this->getName(), $this, IContainer::SHARED)

			->set(ISession::class, fn($c) => new BasicSession($c->get(IConfiguration::class)), IContainer::SHARED)
			->set('session', ISession::class, IContainer::ALIAS)

			->set(IAccesscontrol::class, fn() => new NoAccesscontrol, IContainer::SHARED | IContainer::NOOVERWRITE)
			->set('accesscontrol', IAccesscontrol::class, IContainer::ALIAS)

			->set('middlewares', fn($c) => [
				new SessionMiddleware($c->get(ISession::class)),
				new AccesscontrolMiddleware($c->get(IAccesscontrol::class))
			])

			->set(IUsermanager::class, fn() => new NoUsermanager, IContainer::SHARED | IContainer::NOOVERWRITE)
			->set('usermanager', IUsermanager::class, IContainer::ALIAS)
			
			->set(IAssetResolver::class, fn() => new AssetResolver, IContainer::SHARED | IContainer::NOOVERWRITE);
	}

	// Implementation of ICheck

	public function checkDependencies() {
		return [];
	}

}
