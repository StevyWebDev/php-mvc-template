<?php
namespace App\Components\Home;

class Router extends \App\Router {
	protected function init(): void {
		$this->get("/", "getHome")->run();
	}
}