<?php

session_start();

require_once __DIR__ . '/controllers/FacultyController.php';

$controller = new FacultyController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}
