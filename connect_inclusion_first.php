<?php
    require_once 'config_inclusion_first.php';
    require_once 'FileMaker.php';

    $inclusionFirst = new FileMaker();
    $inclusionFirst->setProperty('database', DATABASE);
    $inclusionFirst->setProperty('hostspec', HOSTSPEC);
    $inclusionFirst->setProperty('username', USERNAME);
    $inclusionFirst->setProperty('password', PASSWORD);
?>