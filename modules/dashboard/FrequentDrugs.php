<?php

require_once('./roots.php');
require_once('./colorHelper.php');
require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

use  CareMd\CareMd\CareTzBillingArchiveElemQuery;
use  CareMd\CareMd\CareTzDrugsandservicesQuery;

$drugs = array();
$labels = array();
$drugData = array();
$background = array();
$colorHelper = new ColorHelper();
$startTime = strtotime(date('Y-' .'01-01'));


$drugCodes = CareTzDrugsandservicesQuery::create()
	->select(array('item_id', 'item_full_description'))
	->where('CareTzDrugsandservices.purchasing_class LIKE ?', '%drug_list%')
	->where("CareTzDrugsandservices.not_in_use	=?", 0)
	->distinct()
	->find()
	->toArray();


foreach ($drugCodes as $code) {
	$drug = CareTzBillingArchiveElemQuery::create()->filterByItemNumber($code['item_id'])
	// ->where("CareTzBillingArchiveElem.date_change >=?", $startTime)
	->count();
	array_push($drugs, 
		array(
			'name' => $code['item_full_description'],
			'code' => $code['item_id'],
			'total'=> $drug,
		)
	);
}

usort($drugs, function($a, $b) {
    return $b['total'] - $a['total'];
});

$count = @$_GET['count']?$_GET['count']:10;

$topDiseases = array();

for ($i=0; $i < $count; $i++) { 
	array_push($topDiseases, $drugs[$i]);
}

foreach ($topDiseases as $topDisease) {
	array_push($labels, $topDisease['name']);
	array_push($drugData, $topDisease['total']);
	array_push($background, $colorHelper->rand_color());
}

$data['labels'] = $labels;
$data['data'] = $drugData;
$data['background'] = $background;

header('Content-type: application/json');
echo json_encode( $data );

