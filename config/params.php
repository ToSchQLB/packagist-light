<?php

$proxy = require __DIR__ . DIRECTORY_SEPARATOR . 'proxy.php';
return [
    'adminEmail'         => 'admin@example.com',
    'senderEmail'        => 'noreply@example.com',
    'senderName'         => 'Example.com mailer',
    'proxy'              => $proxy,
    'auto_user_creation' => true,
];
