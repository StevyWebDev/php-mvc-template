<?php
namespace App\Components\Home;

class Controller extends \App\Controller {
	public function getHome() {
		$this->render("home", "main", ["title" => "Home"]);
	}
}