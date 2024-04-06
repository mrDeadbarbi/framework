<?php
use core\Router;
/**
 * Добавление маршрутов для маршрутизатора
 */
Router::addRoute('^admin/$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);
Router::addRoute('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);
Router::addRoute('^$', ['controller' => 'Main', 'action' => 'index']);
Router::addRoute('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
