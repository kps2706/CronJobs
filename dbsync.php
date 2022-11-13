<?php

try {
    $pdo_mac = new PDO('mysql:host=kumars-macbook-pro.local;dbname=cashProDB', 'prabhakar', 'Kumar@123');
    $pdo_hp = new PDO('mysql:host=localhost;dbname=cashProDB', 'root', '');

    // echo "connection successful";

    echo $pdo_mac->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    $pdo_mac->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch (PDOException $e) {
    echo $e->getMessage();
}