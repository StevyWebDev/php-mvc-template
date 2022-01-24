<?php
namespace App\Home;

class Router extends \App\Router {
	protected function init(): void {
		$this->get("/", "getHome")->run();
	}
}