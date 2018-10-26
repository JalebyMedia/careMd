<?php

require_once('./roots.php');
require_once('./colorHelper.php');
require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

use  CareMd\CareMd\CarePersonQuery;
use  CareMd\CareMd\CareTzInsuranceQuery;
use  CareMd\CareMd\CareTzCompanyQuery;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

$activeProviders = array();
$activePatientProviders = array();
$providers = CareTzCompanyQuery::create()->find()->toArray();

$cash = array(
"Id" => 0,
"Name" => "Cash",
"Contact" => "",
"Email" => "",
"StartDate" => 0,
"EndDate" => 0,
"PrepaidAmount" => 0,
"EnableMemberExpiry" => 0
);
array_push($providers, $cash);

$startDate = time();
$num = 1;

$period = @$_GET['period']?$_GET['period']:"ThisWeek";

$year = date('Y');
$lastYear = date('Y')-1;


$months = array(
	'01' => 'Jan', 
	'02' => 'Feb',
	'03' => 'Mar',
	'04' => 'Apr',
	'05' => 'May', 
	'06' => 'Jun', 
	'07' => 'Jul', 
	'08' => 'Aug',
	'09' => 'Sep',
	'10' => 'Oct', 
	'11' => 'Nov',
	'12' => 'Dec'
);

$lastMonths = array(
	'01' => 'Jan ' . $lastYear, 
	'02' => 'Feb ' . $lastYear,
	'03' => 'Mar ' . $lastYear,
	'04' => 'Apr ' . $lastYear,
	'05' => 'May ' . $lastYear, 
	'06' => 'Jun ' . $lastYear, 
	'07' => 'Jul ' . $lastYear, 
	'08' => 'Aug ' . $lastYear,
	'09' => 'Sep ' . $lastYear,
	'10' => 'Oct ' . $lastYear, 
	'11' => 'Nov ' . $lastYear,
	'12' => 'Dec ' . $lastYear
);

if ($period == "ThisYear") {
	$data['labels'] = array_values($months);
}
if ($period == "LastYear") {
	$data['labels'] = array_values($lastMonths);
}
$weekdays = array();
$weeklables = array();
$lastWeekDays = array();
$lastWeekLabels = array();
$thisMonthLabels = array();
$thisMonthDays = array();
$lastMonthLables = array();
$lastMonthDays = array();


if ($period == "ThisWeek") {
		
	$startWeekDate = Carbon::now()->startOfWeek();
	$endWeekDate =  Carbon::now()->endOfWeek();
	$weekPeriod = CarbonPeriod::create($startWeekDate, $endWeekDate);

	foreach ($weekPeriod as $key => $date) {

		$thisday = array(
			'date' => $date->format('Y-m-d'),
			'name' => $date->format('D'),
		);
		array_push($weeklables, $date->format('D'));
		array_push($weekdays, $thisday);
	}
	$data['labels'] = $weeklables;

}

if ($period == "LastWeek") {
	
	$previous_week = strtotime("-1 week +1 day");
	$start_week = strtotime("last monday midnight",$previous_week);
	$end_week = strtotime("next sunday",$start_week);

	$start_week = date("Y-m-d",$start_week);
	$end_week = date("Y-m-d",$end_week);

	$lastWeekPeriod = CarbonPeriod::create($start_week, $end_week);


	foreach ($lastWeekPeriod as $key => $date) {

		$thisday = array(
			'date' => $date->format('Y-m-d'),
			'name' => $date->format('D'),
		);
		array_push($lastWeekLabels, $date->format('D'). " ".$date->format('d/m/Y'));
		array_push($lastWeekDays, $thisday);
	}
	$data['labels'] = $lastWeekLabels;

}

if ($period == "ThisMonth") {
	
	$start_date = date('Y-m-01');
	$end_date = date('Y-m-t');

	$thisMonthPeriod = CarbonPeriod::create($start_date, $end_date);


	foreach ($thisMonthPeriod as $key => $date) {

		$thisday = array(
			'date' => $date->format('Y-m-d'),
			'name' => $date->format('D'),
		);
		array_push($thisMonthLabels, $date->format('D'). " ". $date->format('d/m/Y'));
		array_push($thisMonthDays, $thisday);
	}
	$data['labels'] = $thisMonthLabels;

}

if ($period == "LastMonth") {
	
	$lastmonth = date('m')-1;
	$start_date = date('Y-'.$lastmonth.'-01');
	$end_date = date('Y-'.$lastmonth.'-t');

	$lastMonthPeriod = CarbonPeriod::create($start_date, $end_date);


	foreach ($lastMonthPeriod as $key => $date) {

		$lastmonth = array(
			'date' => $date->format('Y-m-d'),
			'name' => $date->format('D'),
		);
		array_push($lastMonthLables, $date->format('D'). " ". $date->format('d/m/Y'));
		array_push($lastMonthDays, $lastmonth);
	}
	$data['labels'] = $lastMonthLables;

}
foreach ($providers as $key => $provider) {

	$activeCompany = CareTzInsuranceQuery::create()
	->where('CareTzInsurance.company_id =?', $provider['Id'])
	->orderBy('CareTzInsurance.Id', 'desc')
	->findONe();

	if (@$activeCompany && $activeCompany->getEndDate() >= $startDate) {
		array_push($activeProviders, $provider);		
	}
}

array_push($activeProviders, $cash);
$series = array();
$legendNames = array();

$colorHelper = new ColorHelper();

foreach ($activeProviders as $activeProvider) {
	$row = array();

	if($period == "ThisYear"){
		foreach ($months as $keyMonth => $month) {
			$minDate = $year."-".$keyMonth.'-01';
			$maxDate = $year."-".$keyMonth.'-31';
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $minDate." 00:00:00", "max" => $maxDate." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(2500)
			->find()
			->count();

			array_push($row, $totalPatients);
		}
	}

	if($period == "LastYear"){
		foreach ($months as $keyMonth => $month) {
			$minDate = $lastYear."-".$keyMonth.'-01';
			$maxDate = $lastYear."-".$keyMonth.'-31';
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $minDate." 00:00:00", "max" => $maxDate." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(2500)
			->find()
			->count();

			array_push($row, $totalPatients);
		}
	}

	if($period == "ThisWeek"){
		foreach ($weekdays as $keyDay => $weekDay) {
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $weekDay['date']." 00:00:00", "max" => $weekDay['date']." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(1000)
			->find()
			->count();

			array_push($row, $totalPatients);
		}
	}

	if($period == "LastWeek"){
		foreach ($lastWeekDays as $keyDay => $weekDay) {
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $weekDay['date']." 00:00:00", "max" => $weekDay['date']." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(1000)
			->find()
			->count();

			array_push($row, $totalPatients);
		}
	}

	if($period == "ThisMonth"){
		foreach ($thisMonthDays as $keyDay => $monthDay) {
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $monthDay['date']." 00:00:00", "max" => $monthDay['date']." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(800)
			->find()
			->count();

			array_push($row, $totalPatients);
		}
	}

	if($period == "LastMonth"){
		foreach ($lastMonthDays as $keyDay => $lastMonthDay) {
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $lastMonthDay['date']." 00:00:00", "max" => $lastMonthDay['date']." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(800)
			->count();
			array_push($row, $totalPatients);
		}
	}

	$numPatient = 0;
	foreach ($row as $value) {
		$numPatient += $value;
	}
	if ($numPatient > 0) {
		$preparedData = array(
			'label' =>$activeProvider['Name'],
			'fill' => false,
			'backgroundColor' => $colorHelper->rand_color(),
			'borderColor' => $colorHelper->rand_color(),
			'data'=>$row
		);

		array_push($series, $preparedData);
	}
}
$data['series'] = $series;

header('Content-type: application/json');
echo json_encode( $data );


