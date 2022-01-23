<?php
namespace App;

use AltoRouter;

abstract class Router {
	private object $controller;
	private AltoRouter $router;

	/**
	 * @param string $path path to the Router's namespace (e.g. \App\Users\Router -> \App\Users) 
	 * @param string $controllerClass name of the Controller class in the $path namespace
	 */
	public function __construct(string $path, string $controllerClass = "Controller") {
		$controller = "$path\\$controllerClass";
		if(!class_exists($controller)) throw new \Exception("$controller doesn't exist");
		$this->controller = new $controller($path);
		$this->router = new AltoRouter();
		$this->init();
	}

	public function run() {
		$match = $this->router->match();
		if(is_array($match)) {
			call_user_func($match["target"], $match["params"]);
		}
	}

	abstract protected function init();

	protected function get(string $route, string $method): self {
		$this->router->map("GET", $route, $this->callController($method));
		return $this;
	}

	protected function post(string $route, string $method): self {
		$this->router->map("POST", $route, $this->callController($method));
		return $this;
	}

	protected function put(string $route, string $method): self {
		$this->router->map("PUT", $route, $this->callController($method));
		return $this;
	}

	protected function delete(string $route, string $method): self {
		$this->router->map("DELETE", $route, $this->callController($method));
		return $this;
	}

	private function callController(string $method): callable {
		return function(array $params = []) use($method) {
			call_user_func_array([$this->controller, $method], $params);
		};
	}
}
/*
$match = $router->match();

if(is_array($match)) {
	call_user_func_array($match["target"], $match["params"]);
}

function(array $params = []) use($method) {
			call_user_func_array([$this->controller, $method], $params);
		}

*/