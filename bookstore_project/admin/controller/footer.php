<?php
require_once '../modle/setting_model.php';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
    case 'index':
        detailFooter();
        break;
    case 'update':
        updateFooter();
        break;
    default:
        # code...
        break;
}

function detailFooter(){
    $data = get_data('footer');
    require_once '../view/footer/index.php';
}

function updateFooter(){
    $meta_value = isset($_POST['meta_value']) ?  $_POST['meta_value'] : '';
    $result = update_setting_model('footer', $meta_value);
    $data = get_data('footer');
    require_once '../view/footer/index.php';
}
?>