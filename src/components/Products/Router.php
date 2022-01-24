<?php
namespace App\Products;

class Router extends \App\Router {
	protected function init(): void {
		$this
			->get("/", "getProducts")
			->get("/test", "getProducts")
			->run()
		;
	}
}