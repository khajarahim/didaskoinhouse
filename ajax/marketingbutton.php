<?php

require_once(dirname(__FILE__).'/../../../config.php');
global $CFG, $USER, $DB;

require_login();

$action = $_GET['action'];
switch ($action) {
	case 'getuser' :
		echo 'var didaskoMarkeingUser = {id:"'.$USER->id.'"};';
	break;
	
	case 'checkuser':
		echo ($DB->record_exists('local_user', array('userid'=>$USER->id,'courseid'=>$_GET['courseid'])))? "Yes":"No";	
	break;
	
	case 'emailuser':
		if(!$DB->record_exists('local_user', array('userid'=>$USER->id,'courseid'=>$_GET['courseid']))){
			$DB->insert_record('local_user', array('userid'=>$USER->id,'courseid'=>$_GET['courseid']));
			$fromUser = $USER;
			$config = get_config('local_didaskoinhouse');
			$subject = $config->marketing_emial_subject;
			$toUserId = $config->marketing_user_id;
			$toUser = $DB->get_record('user', array('id'=>$toUserId));
			$courseDetails = $DB->get_record('course', array('id'=>$_GET['courseid']));
			$messageText = 'Dear Student Service,
			
Please find following student requested for Exam Payment Voucher:

User details:
ID: '.$USER->id.'
First name: '.$USER->firstname.' 
Last name: '.$USER->lastname.'
Email: '.$USER->email.'

Course details:
ID: '.$courseDetails->id.'
Course shortname: '.$courseDetails->shortname.'
Course fullname: '.$courseDetails->fullname.'

Regards,
Didasko Learning';
			
			$userLink = '<a href="'.$CFG->wwwroot.'/user/profile.php?id='.$USER->id.'" target="_blank">'.$USER->id.'</a>';
			$courseLink = '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$courseDetails->id.'" target="_blank">'.$courseDetails->id.'</a>';
			
			$messageHtml = 'Dear Student Service,<br><br>
			Please find following student requested for Exam Payment Voucher:<br><br>
			<b>User details:</b><br>
			ID: '.$userLink.'<br>
			First name: '.$USER->firstname.' <br>
			Last name: '.$USER->lastname.'<br>
			Email: '.$USER->email.'<br><br>
			<b>Course details:</b><br>
			ID: '.$courseLink.'<br>
			Course shortname: '.$courseDetails->shortname.'<br>
			Course fullname: '.$courseDetails->fullname.'<br><br>
			Regards,<br>
			Didasko Learning
			';
			
			
			email_to_user($toUser, $fromUser, $subject, $messageText, $messageHtml, ", ", true);
			echo "Yes";
		}	
	break;
}
exit;