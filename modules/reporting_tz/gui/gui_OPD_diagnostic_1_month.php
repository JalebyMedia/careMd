<?php
// PRINTOUT - SECTION :: See below for common GUI
if ($PRINTOUT) {
echo '<head>
<script language="javascript"> this.window.print(); </script>
<title>'.$LDOPDSummary.'</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>';
echo '<html><body>';
?>
<DIV align="center">
	<h1><?php echo $LDPDDiagnosticReport; ?><?php echo date('F Y',$start);?></h1>
	<p><?php echo $LDCreationTime; ?><?php echo date("F j, Y, g:i a");?></p>
</DIV>
  <br><br>


<table width="600" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            
                            <tr bgcolor="orange" >
                              <td width="50" scope="col"><?php echo $LDDiagnosticCode; ?></td>
                              <td width="300" scope="col"><?php echo $LDDiagnosticFullName; ?></td>
                              <td width="50" bgcolor="orange">&lt; 1 month male </td>
                               <td width="50" bgcolor="orange">&lt; 1 month female</td>
                              <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                              <td width="50" bgcolor="orange">1month to &lt; 1yr male</td>
                               <td width="50" bgcolor="orange">1month to &lt; 1yr female</td>
                               <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                               <td width="50" bgcolor="orange">1yr to &lt; 5yrs male</td>
                               <td width="50" bgcolor="orange">1yr to &lt; 5yrs female</td>
                               <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                             <td width="50" bgcolor="orange"> >= 5yr male</td>
                               <td width="50" bgcolor="orange"> >= 5yr female</td>
                               <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                              
                                            
<?php

$rep_obj->Display_OPD_Diagnostic_month($start, $end);

?>    
                          </table>
		</form>	

<?php 
exit();
} 

?>


<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<HTML>
<HEAD>
 <TITLE><?php echo $LDReportingModule; ?></TITLE>
 <meta name="Description" content="Hospital and Healthcare Integrated Information System - CARE2x">
 <meta name="Author" content="Robert Meggle">
 <meta name="Generator" content="various: Quanta, AceHTML 4 Freeware, NuSphere, PHP Coder">
 <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  	<script language="javascript" >
<!-- 
function gethelp(x,s,x1,x2,x3,x4)
{
	if (!x) x="";
	urlholder="../../main/help-router.php?sid=<?php echo sid;?>&lang=$lang&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3+"&x4="+x4;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
    function printOut()
    {
    	urlholder="./OPD_diagnostic_1_month.php?printout=TRUE&start=<?php echo $start;?>&end=<?php echo $end;?>" ;
    	testprintout=window.open(urlholder,"printout","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
      	window.testprintout.moveTo(0,0);
    }
// -->

</script> 
<link rel="stylesheet" href="../../css/themes/default/default.css" type="text/css">
<script language="javascript" src="../../js/hilitebu.js"></script>

<STYLE TYPE="text/css">
A:link  {color: #000066;}
A:hover {color: #cc0033;}
A:active {color: #cc0000;}
A:visited {color: #000066;}
A:visited:active {color: #cc0000;}
A:visited:hover {color: #cc0033;}
</style>
<script language="JavaScript">
<!--
function popPic(pid,nm){

 if(pid!="") regpicwindow = window.open("../../main/pop_reg_pic.php?sid=<?php echo sid;?>&lang=$lang&pid="+pid+"&nm="+nm,"regpicwin","toolbar=no,scrollbars,width=180,height=250");

}
// -->
</script>

 
</HEAD>

<BODY bgcolor=#ffffff link=#000066 alink=#cc0000 vlink=#000066  >

<!-- START HEAD OF HTML CONTENT --->

<table width=100% border=0 cellspacing=0 height=100%>
<tbody class="main">

	<tr>

		<td  valign="top" align="middle" height="35">
			 <table cellspacing="0"  class="titlebar" border=0>
 <tr valign=top  class="titlebar" >
  <td width="202" bgcolor="#99ccff" >
    &nbsp;&nbsp;<font color="#330066"><?php echo $LDReportingOPDDiagnostic; ?></font></td>
  <td width="408" align=right bgcolor="#99ccff">
   <a href="javascript: history.back();"><img src="../../gui/img/control/default/en/en_back2.gif" border=0 width="110" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)" ></a>
   <a href="javascript:gethelp('reporting_overview.php','Reporting :: Overview')"><img src="../../gui/img/control/default/en/en_hilfe-r.gif" border=0 width="75" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>
   <a href="<?php echo $root_path;?>modules/reporting_tz/reporting_main_menu.php" ><img src="../../gui/img/control/default/en/en_close2.gif" border=0 width="103" height="24" alt="" style="filter:alpha(opacity=70)" onMouseover="hilite(this,1)" onMouseOut="hilite(this,0)"></a>  
  </td>
 </tr>
 </table>	
 <?php require_once($root_path . 'main_theme/reportingNav.inc.php'); ?>
    <?php 
require_once($root_path . 'main_theme/footer.inc.php');
   ?>         
  <!-- END HEAD OF HTML CONTENT --->


               
               
  <!-- START BOTTIOM OF HTML CONTENT --->
  <br><br>
			<form name="form1" method="post" action="">

							<?php require_once($root_path.$top_dir.'include/inc_gui_timeframe.php'); ?>
  
                          </p>
						  <br>
                          <table width="600" border="1" cellspacing="0" cellpadding="0" align="center" bgcolor=#ffffdd>
                            
                            <tr bgcolor="orange" >
                              <td width="50" scope="col"><?php echo $LDDiagnosticCode; ?></td>
                              <td width="300" scope="col"><?php echo $LDDiagnosticFullName; ?></td>
                              <td width="50" bgcolor="orange">&lt; 1 month male </td>
                               <td width="50" bgcolor="orange">&lt; 1 month female</td>
                              <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                              <td width="50" bgcolor="orange">1month to &lt; 1yr male</td>
                               <td width="50" bgcolor="orange">1month to &lt; 1yr female</td>
                               <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                               <td width="50" bgcolor="orange">1yr to &lt; 5yrs male</td>
                               <td width="50" bgcolor="orange">1yr to &lt; 5yrs female</td>
                               <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                             <td width="50" bgcolor="orange"> >= 5yr male</td>
                               <td width="50" bgcolor="orange"> >= 5yr female</td>
                               <td bgcolor="orange"><?php echo $LDtotal; ?></td>
                              
                                        
<?php

$rep_obj->Display_OPD_Diagnostic_month($start, $end);

?>    
                          </table>
		</form>	
<a href="javascript:printOut()"><img border=0 src=<?php echo $root_path;?>/gui/img/common/default/billing_print_out.gif></a><br>					  
						  <br><br><br>						  
                          <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
	<td align="center">
  		<table width="100%" bgcolor="#ffffff" cellspacing=0 cellpadding=5>
   		<tr>
   			<td>
	    		<div class="copyright">
					<script language="JavaScript">
					<!-- Script Begin
					function openCreditsWindow() {
					
						urlholder="../../language/$lang/$lang_credits.php?lang=$lang";
						creditswin=window.open(urlholder,"creditswin","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");
					
					}
					//  Script End -->
					</script>

	
					 <a href="http://www.luico.co.tz" target=_new>CARE2X 3rd Generation pre-deployment 3.3</a> :: <a href="../../legal_gnu_gpl.htm" target=_new> License</a> ::
					 <a href=mailto:care2x@luico.co.tz>Contact</a>  :: <a href="../../language/en/en_privacy.htm" target="pp"> Our Privacy Policy </a> ::
					 <a href="../../docs/show_legal.php?lang=$lang" target="lgl"> Legal </a> ::
					 <a href="javascript:openCreditsWindow()"> Credits </a> ::.<br>

				</div>
    		</td>
   		<tr>
  		</table>
	</td>
	</tr>
</table>
<!-- START BOTTIOM OF HTML CONTENT --->

</body>