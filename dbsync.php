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
            $sql_mac = "SELECT max(rec_id) as max_rec_mac from tbl_cashflow";
            $sql_hp = "SELECT max(rec_id) as max_rec_hp from tbl_cashflow";

            $result_mac = $pdo_mac->query($sql_mac);
            $result_hp = $pdo_hp->query($sql_hp);

            $row_mac = $result_mac->fetch();
            $row_hp = $result_hp->fetch();

            $max_rec_hp = ($row_hp['max_rec_hp'] == NULL) ? 0 : $row_hp['max_rec_hp'];
            $max_rec_mac = ($row_mac['max_rec_mac'] == NULL) ? 0 : $row_mac['max_rec_mac'];

            // echo "Records are not to be sync from " . $max_rec_hp . " to record no " . $max_rec_mac;

            $sql_get_record = "SELECT * FROM tbl_cashflow WEHRE rec_id >" . $max_rec_hp;

            $result_for_copy = $pdo_mac->query($sql_get_record);

            echo $result_for_copy->rowCount();

            while ($row_for_copy = $result_for_copy->fetch()) {

                var_dump($row_for_copy);
                echo "<br>";
            }


            // while ($row_mac = $result_mac->fetch()) {
            //     $revenue[] = $row["datapoint"];
            // }
        } else {
            // echo "Db Sync is started from HP to Macbook";
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}