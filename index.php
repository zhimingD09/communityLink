<?php
require_once 'config/config.php';
require_once 'helpers/session_helper.php';
require_once 'helpers/url_helper.php';

// Define the routes
$request = $_SERVER['REQUEST_URI'];
$basePath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
$request = str_replace($basePath, '', $request);

// Route the request
switch ($request) {
    case '/':
    case '':
        require __DIR__ . '/controllers/Pages.php';
        $pages = new Pages();
        $pages->index();
        break;
    case '/about':
        require __DIR__ . '/controllers/Pages.php';
        $pages = new Pages();
        $pages->about();
        break;
    case '/volunteers/register':
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->registerVolunteer();
        break;
    case '/organizations/register':
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->registerOrganization();
        break;
    case '/login':
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->login();
        break;
    case '/logout':
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->logout();
        break;
    case '/admin':
        require __DIR__ . '/controllers/Admin.php';
        $admin = new Admin();
        $admin->index();
        break;
    case '/events':
        require __DIR__ . '/controllers/Events.php';
        $events = new Events();
        $events->index();
        break;
    case '/profile':
        require __DIR__ . '/controllers/Users.php';
        $users = new Users();
        $users->profile();
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}