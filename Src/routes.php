<?php

$app->get('/', 'Src\Controllers\IndexController:indexAction')
    ->setName('index_index');