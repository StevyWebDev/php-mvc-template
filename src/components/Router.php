<?php
namespace App;

use AltoRouter;

abstract class Router {
	private object $controller;
	private string $component;
	private bool $relativeRoutes;
	private AltoRouter $router;

	/**
	 * @param  string $namespace path to the Router's namespace (e.g. \App\Users\Router -> \App\Users) 
	 * @param  string $relativeRoutes if set to true, the routes will be relative to the namespace (e.g. \App\Users -> "localhost/users/$route")
	 * @param  string $controllerClass name of the Controller class in the namespace
	 */
	public function __construct(string $namespace, bool $relativeRoutes = true, string $controllerClass = "Controller") {
		$controller = "$namespace\\$controllerClass";
		if(!class_exists($controller)) throw new \Exception("$controller doesn't exist");
		$this->relativeRoutes = $relativeRoutes;
		$this->component = end(explode("\\", $namespace,));
		$this->controller = new $controller($namespace, $this->component);
		$this->router = new AltoRouter();
		$this->init();
	}

	public function run() {
		$match = $this->router->match();
		if(is_array($match)) {
			call_user_func($match["target"], $match["params"]);
		}
	}

	abstract protected function init(): void;

	protected function get(string $route, string $controllerMethod): self {
		return $this->addRoute("GET", $route, $controllerMethod);
	}

	protected function post(string $route, string $controllerMethod): self {
		return $this->addRoute("POST", $route, $controllerMethod);
	}

	protected function put(string $route, string $controllerMethod): self {
		return $this->addRoute("PUT", $route, $controllerMethod);
	}

	protected function delete(string $route, string $controllerMethod): self {
		return $this->addRoute("DELETE", $route, $controllerMethod);
	}

	private function addRoute(string $httpMethod, string $route, string $controllerMethod): self {
		if($this->relativeRoutes) {
			$route = strtolower("/$this->component") . $route;
		}
		if($route !== "/" && substr($route, -1) === "/") $route = substr($route, 0, -1);
		$this->router->map($httpMethod, $route, $this->callController($controllerMethod));
		return $this;
	}

	private function callController(string $controllerMethod): callable {
		return function(array $params = []) use($controllerMethod) {
			call_user_func_array([$this->controller, $controllerMethod], $params);
		};
	}
}