<?php
namespace App\Components\Products;

class Router extends \App\Router {
	protected function init(): void {
		$this
			->get("/", "getProducts")
			->run()
		;
	}
}