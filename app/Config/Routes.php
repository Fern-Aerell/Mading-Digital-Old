<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ClientController::index');

// API
$routes->get('/api/get_marquee_text', 'ApiController::get_marquee_text');
$routes->post('/api/add_marquee_text', 'ApiController::add_marquee_text');
$routes->delete('/api/remove_marquee_text/(:num)', 'ApiController::remove_marquee_text/$1');

$routes->get('/api/get_qrcode', 'ApiController::get_qrcode');
$routes->get('/api/get_use_qrcode', 'ApiController::get_use_qrcode');
$routes->post('/api/add_qrcode', 'ApiController::add_qrcode');
$routes->post('/api/set_use_qrcode', 'ApiController::set_use_qrcode');
$routes->delete('/api/remove_qrcode/(:num)', 'ApiController::remove_qrcode/$1');

$routes->get('/api/get_video', 'ApiController::get_video');
$routes->post('/api/add_video', 'ApiController::add_video');
$routes->delete('/api/remove_video/(:num)', 'ApiController::remove_video/$1');

$routes->get('/api/get_activity/(:num)', 'ApiController::get_activity/$1');
$routes->post('/api/add_activity', 'ApiController::add_activity');
$routes->delete('/api/remove_activity/(:num)', 'ApiController::remove_activity/$1');

// Control Panel
$routes->get('/control_panel', 'ControlPanelController::login');
$routes->post('/control_panel', 'ControlPanelController::login');

$routes->get('/control_panel/login', 'ControlPanelController::login');
$routes->post('/control_panel/login', 'ControlPanelController::login');

$routes->get('/control_panel/logout', 'ControlPanelController::logout');

$routes->get('/control_panel/qrcode', 'ControlPanelController::qrcode');
$routes->post('/control_panel/qrcode', 'ControlPanelController::qrcode');

$routes->get('/control_panel/marquee_text', 'ControlPanelController::marquee_text');
$routes->post('/control_panel/marquee_text', 'ControlPanelController::marquee_text');

$routes->get('/control_panel/video', 'ControlPanelController::video');
$routes->post('/control_panel/video', 'ControlPanelController::video');

$routes->get('/control_panel/activity', 'ControlPanelController::activity');
$routes->post('/control_panel/activity', 'ControlPanelController::activity');
