<?php

error_reporting(E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR);
require('./roots.php');
require($root_path . 'include/inc_environment_global.php');
define('LANG_FILE', 'billing.php');
require($root_path . 'include/inc_front_chain_lang.php');
require_once($root_path . 'include/care_api_classes/class_tz_insurance.php');
$insurance_tz = new Insurance_tz();
require_once($root_path . 'include/care_api_classes/class_tz_insurance_reports.php');
$insurance_tz_report = new Insurance_Reports_tz();

$pageName = "Billing";

require_once($root_path . 'main_theme/head.inc.php');
require_once($root_path . 'main_theme/header.inc.php');
require_once($root_path . 'main_theme/topHeader.inc.php');

require_once('gui/gui_insurance_reports.php');

require_once($root_path . 'main_theme/footer.inc.php');

?>
