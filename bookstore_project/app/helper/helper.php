<?php 
function createLink($uri,$filter = array()){
	$string = '';
	// lấy các tham số trên link
	foreach ($filter as $key => $data) {
		$string .= "&{$key}={$data}";
	}
	return $uri.($string ? '?'.ltrim($string,"&") : '');
}

function paging($link,$totalRecord,$currentPage,$limit,$keyword=''){
	// tính tổng số trang
	$totalPage = ceil($totalRecord/$limit);

	// xu ly gioi han cho current page
	if ($currentPage > $totalRecord) {
		$currentPage = $totalPage;
	}
	elseif ($currentPage < 1) {
		$currentPage = 1;
	}
	// tinh start
	$start = ($currentPage - 1)*$limit;
	// xu ly template(bản mẫu) phan trang
	$html = "<div class='text-center'>";
	$html .= "<nav  aria-label='Page navigation'>";
	$html .= "<ul class='pagination'>";
	// xu ly nut prev voi nut first
	if ($totalPage > 1 AND $currentPage > 1 ) {
		$html .= "<li><a href='".str_replace("{page}",1,$link)."'><span style='font-size:10px;' class='glyphicon glyphicon-backward'></span></a></li>";
		$html .= "<li><a href='".str_replace("{page}",$currentPage - 1,$link)."'><span style='font-size:10px;' class='glyphicon glyphicon-chevron-left'></span></a></li>";
	}
	// tinh cac trang o giua
	for ($i = 1; $i <= $totalPage; $i++) {
		if ($i == $currentPage) {
			$html .= "<li class='active'><a>". $i ."<span class='sr-only'></span></a></li>";
		}
		else{
			$html .= "<li><a href='" .str_replace('{page}',$i,$link). "'>".$i."</a></li>";
		}
	}
	// xu ly cho nut next voi last
	if ($currentPage < $totalPage AND $totalPage > 1) {
		$html .= "<li><a href='". str_replace("{page}",$currentPage + 1,$link) ."' aria-label='Next'><span style='font-size:10px;' class='glyphicon glyphicon-chevron-right'></span></a></li>";
		$html .= "<li><a href='". str_replace("{page}",$totalPage,$link) ."'><span style='font-size:10px;' class='glyphicon glyphicon-forward'></span></a></li>";
	}
	$html .= "</ul>";
	$html .= "</nav>";
	$html .= "</div>";

	return array(
		"start" => $start,
		"limit"=>$limit,
		"html"=>$html,
		"keyword" => $keyword
		);
}

 ?>