<?php
require "vendor/autoload.php";



$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();



//echo "<pre>", var_dump($_SERVER["REQUEST_URI"]) ,"</pre>";
//echo "<pre>", print_r(preg_split("/[\/.]/", $_SERVER["REQUEST_URI"])) ,"</pre>";

function getRouter(
	string $parentNamespace = "App", string $home = "Home", string $routerClass = "Router"
): object {
	$uri = $_SERVER["REQUEST_URI"] ?? "/";
	$uri = preg_split("/[\/.]/", strtolower($uri));
	$component = $home;
	if(!empty($uri[1]) && $uri[1] !== "index") {
		$uri[1][0] = strtoupper($uri[1][0]);
		$component = "$uri[1]";
	}
	$namespace = "\\$parentNamespace\\$component";
	$router = "$namespace\\$routerClass";
	if(!class_exists($router)) throw new Exception("$router doesn't exist");
	if($component === $home) return new $router($namespace, false);
	return new $router($namespace);
}

$router = getRouter();




/*
$router->addRoutes([
	['PATCH','/users/[i:id]', 'users#update', 'update_user'],
	['DELETE','/users/[i:id]', 'users#delete', 'delete_user']
]);

$controllerName = "\Controller\\" . $controllerName;
$controller = new $controllerName();
call_user_func_array([$controller, $task], $params);
*/

/*
function target() {
	$name = "App\ ";

	
}



$router = new AltoRouter();
$router->map("GET", "/", function () {
	echo "index route --- ";
}, "index");
$match = $router->match();
if(is_array($match)) {
	call_user_func_array($match["target"], $match["params"]);
}
*/


/*
$pdo = new PDO("mysql:host=127.0.0.1;dbname=guestbook", "root", "root", [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);

$guestbook = new GuestBook($pdo);





$query = $this->pdo->prepare("INSERT INTO messages (user, content) VALUES (:user, :content)");
$query->execute([
	"user" => $message->username,
	"content" => $message->content
]);





$query = $this->pdo->query("SELECT * FROM messages");
return array_map(function($message) {
	return new Message(
		htmlEntities($message->user), 
		htmlEntities($message->content), 
		DateTime::createFromFormat("Y-m-d H:i:s", $message->date)
	);
}, $query->fetchAll());
*/