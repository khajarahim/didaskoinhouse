<?php

require_once(dirname(__FILE__).'/../../config.php');

require_login();
$sitecontext = context_system::instance();
$strtitle = 'Didasko Inhouse development';

$PAGE->set_context($sitecontext);
$PAGE->set_title($strtitle);
$PAGE->set_url($CFG->wwwroot . '/local/didaskoinhouse/index.php');

echo $OUTPUT->header();
echo $OUTPUT->heading($strtitle);

echo '<div id="didaskoMarketing">';
echo 'If you agree to receive marketig material, click button';
echo '<button id="didaskoMarketingButton" type="button" class="btn btn-primary">Marketing</button>';
echo '</div>';


echo '<script src="http://localhost/moodle29/local/didaskoinhouse/yui/src/marketingbutton/js/test.php"></script>';
echo '
<script type="text/javascript">// <![CDATA[
YUI().use("node","io-base", function(Y) {
	var didaskoMarketingCourse = {id:"33"};
	var ajaxUri = "http://localhost/moodle29/local/didaskoinhouse/yui/src/marketingbutton/js";
	var ajaxRequestCheckUser = function(){
		var ajaxUrl = ajaxUri+"/get.php?courseid="+didaskoMarketingCourse.id+"&format=json";
		Y.io(ajaxUrl, {
			 on: {
				success: function (x, o) {
					 var parsedResponse;
					 try {
						 d = (o.responseText);
					 } catch (e) {
						 console.log("JSON Parse failed!");
						 return;
					 }
					 if (d=="Yes"){
						Y.one("#didaskoMarketingButton").set("disabled", true);						 
					 }else{
						 Y.log(d);
					 }
				 }
			 }
		});						
	}
	
	ajaxRequestCheckUser();
	
	var ajaxRequestSendEmail = function(){
		var ajaxUrl = ajaxUri+"/email.php?courseid="+didaskoMarketingCourse.id+"&format=json";
		Y.io(ajaxUrl, {
			 on: {
				success: function (x, o) {
					 var parsedResponse;
					 try {
						 d = (o.responseText);
					 } catch (e) {
						 console.log("JSON Parse failed!");
						 return;
					 }
					 
					 if (d=="Yes"){
						 Y.log("succ");
						 Y.one("#didaskoMarketingButton").set("disabled", true);
					 }else{
						 Y.log(d);
					 }
				 }
			 }
		});						
	}
	
	Y.one("#didaskoMarketingButton").on("click",function(e) {
		Y.one("#didaskoMarketingButton").set("disabled", true);
		ajaxRequestSendEmail();
	});	
	
});
// ]]></script>
';

//$PAGE->requires->js( new moodle_url($CFG->wwwroot . '/local/didaskoinhouse/yui/src/marketingbutton/js/marketingbutton.js'));
//$PAGE->requires->yui_module('moodle-local_didaskoinhouse-marketingbutton','M.local_didaskoinhouse.marketingbutton.checkUser',array($USER->id,'888'));

echo $OUTPUT->footer();