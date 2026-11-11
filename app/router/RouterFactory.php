<?php

namespace App;

use Nette\Application\Routers\RouteList;


/**
 * Router factory.
 */
class RouterFactory
{

	public static function createRouter(): RouteList
	{
		$router = new RouteList();
		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}

}
