<?php
/**
 * Created by PhpStorm.
 * User: HP 840 G3
 * Date: 3/12/2018
 * Time: 12:47 AM
 * @param $meta_key
 * @return array|mixed
 */
require_once 'app/config/database.php';;

function get_data($meta_key) {
    $data = array();
    $conn = connection();
    $sql  = "SELECT * FROM setting WHERE meta_key = :meta_key";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bindParam(":meta_key",$meta_key,PDO::PARAM_STR);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
        $stmt->closeCursor();
    }
    disconnect($conn);
    return $data;
}

function update_setting_model($meta_key, $meta_value){
    $flag = FALSE;
    $conn = connection();
    $data = get_data($meta_key);
    if (empty($data)) {
        $sqlEdit = "INSERT INTO setting VALUES (:meta_key,:meta_key)";
        $stmt = $conn->prepare($sqlEdit);
        if ($stmt) {
            $stmt->bindParam(":meta_value",$meta_value,PDO::PARAM_STR);
            $stmt->bindParam(":meta_key",$meta_key,PDO::PARAM_STR);
            if ($stmt->execute()) {
                $flag = TRUE;
            }
            $stmt->closeCursor();
        }
        disconnect($conn);
        return $flag;
    }
    $sqlEdit = "UPDATE setting SET meta_value = :meta_value WHERE meta_key = :meta_key";
    $stmt = $conn->prepare($sqlEdit);
    if ($stmt) {
        $stmt->bindParam(":meta_value",$meta_value,PDO::PARAM_STR);
        $stmt->bindParam(":meta_key",$meta_key,PDO::PARAM_STR);
        if ($stmt->execute()) {
            $flag = TRUE;
        }
        $stmt->closeCursor();
    }
    disconnect($conn);
    return $flag;
}

