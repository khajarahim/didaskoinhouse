# didaskoinhouse

Instruction: Need to change didaskoMarketingCourse and URLs

HTML Code:

<input type="button" id="didaskoMarketingButton" value="Request for Exam Payment Voucher"/>

Javascript Code:

<script src="http://moodle_instance/local/didaskoinhouse/ajax/marketingbutton.php?action=getuser"></script>
<script type="text/javascript">// <![CDATA[
YUI().use("node","io-base", function(Y) {
	var didaskoMarketingCourse = {id:"3"};
	var ajaxUri = "http://moodle_instance/local/didaskoinhouse/ajax/marketingbutton.php";
	var ajaxRequestCheckUser = function(){
		var ajaxUrl = ajaxUri+"?action=checkuser&courseid="+didaskoMarketingCourse.id+"&format=json";
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
		var ajaxUrl = ajaxUri+"?action=emailuser&courseid="+didaskoMarketingCourse.id+"&format=json";
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