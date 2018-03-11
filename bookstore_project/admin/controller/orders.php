<?php
require_once '../modle/order_modle.php';
$method = isset($_GET['m']) ? $_GET['m'] : 'index';
switch ($method) {
	case 'index':
		listOrders();
		break;
	case 'update':
		updateOrder();
		break;
	case 'export-excel':
		exportExcel();
		break;
	default:
		# code...
		break;
}

function listOrders(){
	$page  = isset($_GET['page']) ? $_GET['page'] : 1;
	$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : "";
	$type = isset($_GET['type']) ? $_GET['type'] : "";

	$dataOrder = get_all_order_modle($type, $keyword);

	$link = createLink(BASE_URL,array("sk"=>"orders","m"=>"index","page"=>"{page}","keyword"=>$keyword, "type"=>$type));

	$dataPaging = paging($link,count($dataOrder),$page,100,$keyword);

	$dataAllOrders = get_all_data_orders($dataPaging['st'],$dataPaging['limit'],$dataPaging['keyword'], $type);
	// print_r($dataAllOrders); die();
	require_once '../view/orders/index_orders_view.php';
}

function updateOrder(){
	$id = isset($_POST['id']) ? $_POST['id'] : 0;
	$id = is_numeric($id) ? $id : 0;
	$type = isset($_POST['type']) ? $_POST['type'] : 0;
	$type = (is_numeric($type) && in_array($type,array('1','2'))) ? $type : 0;
	if ($type != 0 && $id != 0) {
		// xu ly update
		if ($type == 1) {
			$update = update_order_modle($id,$type);
			if ($update) {
				$detailOrder = save_detail_order($id);
				if ($detailOrder) {
					echo "ok";
				}
				else{
					echo "err";
				}
			}
			else{
				echo "errorup";
			}
		}
		elseif ($type == 2) { // xu ly delete
			// $delete = delete_order_modle($id);
			$delete = update_order_modle($id, $type);
			if ($delete) {
				echo "ok";
			}
			else{
				echo "errdl";
			}
		}
	}
	else{
		echo "err";
	}
}

function exportExcel() {

    $array_trang_thai = [
        'Chờ xác nhận',
        'Đã xác nhận',
        'Đã hủy',
    ];
	require "../libs/Classes/PHPExcel.php";
    $objExcel = new PHPExcel;
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('10A1');

    $rowCount = 1;
    $sheet->setCellValue('A'.$rowCount,'Mã đơn hàng');
    $sheet->setCellValue('B'.$rowCount,'Họ tên');
    $sheet->setCellValue('C'.$rowCount,'Số điện thoại');
    $sheet->setCellValue('D'.$rowCount,'Email');
    $sheet->setCellValue('E'.$rowCount,'Địa chỉ');
    $sheet->setCellValue('F'.$rowCount,'Tên sách');
    $sheet->setCellValue('G'.$rowCount,'Trạng thái');
    $sheet->setCellValue('H'.$rowCount,'Số lượng');
    $sheet->setCellValue('I'.$rowCount,'Tổng tiền');
    $sheet->setCellValue('J'.$rowCount,'Ghi chú');
    $sheet->setCellValue('K'.$rowCount,'Ngày đặt');
    $type = isset($_POST['type']) ? $_POST['type'] : 0;

    $results = get_all_order_modle_export($type);

    foreach ($results as $key => $result) {
        $rowCount += 1;
        $sheet->setCellValue('A'.$rowCount,$result['id_hd']);
        $sheet->setCellValue('B'.$rowCount,$result['TenKH']);
        $sheet->setCellValue('C'.$rowCount,$result['SDT']);
        $sheet->setCellValue('D'.$rowCount,$result['Email']);
        $sheet->setCellValue('E'.$rowCount,$result['DiaChi']);
        $sheet->setCellValue('F'.$rowCount,$result['TenSach']);
        $sheet->setCellValue('G'.$rowCount,$array_trang_thai[$result['TrangThai']]);
        $sheet->setCellValue('H'.$rowCount,$result['SoLuong']);
        $sheet->setCellValue('I'.$rowCount,$result['ThanhTien']);
        $sheet->setCellValue('J'.$rowCount,$result['GhiChu']);
        $sheet->setCellValue('K'.$rowCount,$result['create_time']);
    }

    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'export.xlsx';
    $objWriter->save('../../excel/'. date('d_m_Y_H_i_s')."_".$filename);
    require_once '../view/orders/export_excel.php';

    return;
}
 ?>