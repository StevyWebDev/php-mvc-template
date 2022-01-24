<?php
namespace App;

class Controller {
	private string $views;
	private string $layouts;

	public function __construct(
		string $path, 
		string $component,
		string $modelClass = "Model",
		string $viewsDir = "views",
		string $layoutsDir = "layouts"
	) {
		$this->views = __DIR__ . "/$component/$viewsDir";	
		$this->layouts = implode("/", array_slice(
				explode(DIRECTORY_SEPARATOR, __DIR__), 0, -1
			) // retrieving __DIR__ minus one nesting level
		) . "/$layoutsDir";

		//echo "<pre>", $this->layouts, "</pre>";
		//echo $this->views , " ---------------- ";
	}

	protected function render(string $view, string $layout = null, array $params = []): void {
		extract($params);
		ob_start();
		require "$this->views/$view.html.php";
		$content = ob_get_clean();
		if(!$layout) {
			echo $content;
			return;
		}
		require "$this->layouts/$layout";
		exit();
	}

	protected function redirect(string $route): void {
		header("location: $route");
	}

	/*
	protected function render(string $path, array $varibales = []): void {
		extract($varibales);
		ob_start();
		require 'Views/' . $path . '.html.php';
		$content = ob_get_clean();

		require 'Views/layout.html.php';
		exit;
    }
	*/

	//create interaction with views
}