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
	require "../libs/PHPExcel/PHPExcel.php";
	$data = [
		['Nguyễn Khánh Linh', 'Nữ', '500k'], 
		['Ngọc Trinh', 'Nữ', '700k'], 
		['Tùng Sơn', 'Không xác định', 'Miễn phí'], 
		['Kenny Sang', 'Không xác định', 'Miễn phí']
			];
	//Khởi tạo đối tượng
	$excel = new PHPExcel();
	//Chọn trang cần ghi (là số từ 0->n)
	$excel->setActiveSheetIndex(0);
	//Tạo tiêu đề cho trang. (có thể không cần)
	$excel->getActiveSheet()->setTitle('demo ghi dữ liệu');

	//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
	$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

	//Xét in đậm cho khoảng cột
	$excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
	//Tạo tiêu đề cho từng cột
	//Vị trí có dạng như sau:
	/**
	 * |A1|B1|C1|..|n1|
	 * |A2|B2|C2|..|n1|
	 * |..|..|..|..|..|
	 * |An|Bn|Cn|..|nn|
	 */
	$excel->getActiveSheet()->setCellValue('A1', 'Tên');
	$excel->getActiveSheet()->setCellValue('B1', 'Giới Tính');
	$excel->getActiveSheet()->setCellValue('C1', 'Đơn giá(/shoot)');
	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
	$numRow = 2;
	foreach($data as $row){
		$excel->getActiveSheet()->setCellValue('A'.$numRow, $row[0]);
		$excel->getActiveSheet()->setCellValue('B'.$numRow, $row[1]);
		$excel->getActiveSheet()->setCellValue('C'.$numRow, $row[2]);
		$numRow++;
	}
	// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
	// ở đây mình lưu file dưới dạng excel2007
	PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('data.xlsx');
	$filename = 'data.xlsx';
	header('Content-Disposition: attachment; filename="' . $filename . '"');  
	header('Content-Type: application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet');  
	header('Content-Length: ' . filesize($filename));  
	header('Content-Transfer-Encoding: binary');  
	header('Cache-Control: must-revalidate');  
	header('Pragma: no-cache');
  
	readfile($filename);  
	PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
}
 ?>