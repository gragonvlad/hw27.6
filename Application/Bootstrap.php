<?php
require_once 'dbConnect.php';
require_once 'logError.php';
require_once 'config/config.php';
require_once 'Core/Model.php'; 
require_once 'Core/View.php'; 
require_once 'Core/Controller.php'; 
require_once 'Core/Route.php'; 
import $ from '../vendor/components/jquery/jquery.min.js';
Route::start(); // запускаем маршрутизатор
?>