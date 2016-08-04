<?php
defined('MOODLE_INTERNAL') || die;
if ($hassiteconfig) {
	
	$ADMIN->add('localplugins', new admin_category('didaskoinhouse', get_string('didaskoinhouse','local_didaskoinhouse')));
 	
 	$didasko_settings = new admin_settingpage('local_marketing', get_string('didaskomarketingsettings','local_didaskoinhouse'));
 	$ADMIN->add('didaskoinhouse', $didasko_settings);
 	$didasko_settings->add(new admin_setting_configtext('local_didaskoinhouse/marketing_user_id',get_string('recepientId','local_didaskoinhouse'), get_string('recepientidDescription','local_didaskoinhouse'), '1'));
	$didasko_settings->add(new admin_setting_configtext('local_didaskoinhouse/marketing_emial_subject',get_string('recepientEmailsSubject','local_didaskoinhouse'), get_string('recepientEmailSubjectDescription','local_didaskoinhouse'), get_string('recepientEmailSubjectDescriptionDefault','local_didaskoinhouse')));
}