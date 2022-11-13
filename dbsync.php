<?php

try {
    $pdo_mac = new PDO('mysql:host=kumars-macbook-pro.local;dbname=cashProDB', 'prabhakar', 'Kumar@123');
    $pdo_hp = new PDO('mysql:host=localhost;dbname=cashProDB', 'root', '');

    // echo "connection successful";

    // echo $pdo_mac->getAttribute(PDO::ATTR_CONNECTION_STATUS);

    $pdo_mac->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);


    $sql_mac = "Select * from tbl_cashflow";

    $result_mac = $pdo_mac->query($sql_mac);

    $sql_hp = "Select * from tbl_cashflow";

    $result_hp = $pdo_hp->query($sql_hp);

    if ($result_mac->rowCount() == $result_hp->rowCount()) {
        // echo "DB Sync";
    } else {
        // echo "DB not Sync";

        if ($result_mac->rowCount() > $result_hp->rowCount()) {
            // echo "Db Sync is started from MacBook to HP";
        } else {
            // echo "Db Sync is started from HP to Macbook";
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}