<?php

$proxy = require __DIR__ . 'proxy.php';
return [
    'adminEmail'  => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName'  => 'Example.com mailer',
    'proxy'       => $proxy,
];
