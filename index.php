<?php
require_once 'config/config.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/url_helper.php';

// Define the routes
$request = $_SERVER['REQUEST_URI'];
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$request = str_replace($basePath, '', $request);

// Parse URL
$url = parse_url($request, PHP_URL_PATH);
$url = trim($url, '/');
$urlParts = explode('/', $url);

// Route the request
if (empty($url)) {
    // Home page
    require __DIR__ . '/controllers/Pages.php';
    $pages = new Pages();
    $pages->index();
} else {
    // Get controller
    $controller = $urlParts[0];
    
    // Get method (if exists)
    $method = isset($urlParts[1]) ? $urlParts[1] : 'index';
    
    // Get parameters (if exists)
    $params = array_slice($urlParts, 2);
    
    // Map specific routes
    if ($controller == 'about') {
        require __DIR__ . '/controllers/Pages.php';
        $pages = new Pages();
        $pages->about();
    } elseif ($controller == 'volunteers' && $method == 'register') {
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->registerVolunteer();
    } elseif ($controller == 'organizations' && $method == 'register') {
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->registerOrganization();
    } elseif ($controller == 'login') {
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->login();
    } elseif ($controller == 'logout') {
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->logout();
    } elseif ($controller == 'admin') {
        require __DIR__ . '/controllers/Admin.php';
        $admin = new Admin();
        $admin->index();
    } elseif ($controller == 'events') {
        require __DIR__ . '/controllers/Events.php';
        $events = new Events();
        
        if ($method == 'index') {
            $events->index();
        } elseif ($method == 'show' && !empty($params[0])) {
            $events->show($params[0]);
        } elseif ($method == 'create') {
            $events->create();
        } elseif ($method == 'edit' && !empty($params[0])) {
            $events->edit($params[0]);
        } elseif ($method == 'delete' && !empty($params[0])) {
            $events->delete($params[0]);
        } elseif ($method == 'register' && !empty($params[0])) {
            $events->register($params[0]);
        } elseif ($method == 'unregister' && !empty($params[0])) {
            $events->unregister($params[0]);
        } else {
            http_response_code(404);
            require __DIR__ . '/views/pages/404.php';
        }
    } elseif ($controller == 'profile') {
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->profile();
    } else {
        http_response_code(404);
        require __DIR__ . '/views/pages/404.php';
    }
}