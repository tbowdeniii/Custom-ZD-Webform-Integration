<?php
add_action( 'wpcf7_before_send_mail',
  function( $contact_form, &$abort, $submission ) {
	  
	$title = $contact_form->name();
	  
	
    // Mapping user input to variables
    $first_name = $submission->get_posted_data( 'first-name' );
    $last_name = $submission->get_posted_data( 'last-name' );
 	$email = $submission->get_posted_data( 'email' );
	$phone = $submission->get_posted_data( 'phone-number' );
	$hear_about_us = $submission->get_posted_data( 'hear-about' );
	$mealtime_insulin = $submission->get_posted_data( 'insulin-use' );
	$challenges = $submission->get_posted_data( 'insulin-challenges' );
	$manage_diabetes = $submission->get_posted_data( 'manage-diabetes' );
	$verify_age = $submission->get_posted_data( 'verify-age' );
	$support_you = $submission->get_posted_data( 'how-to-learn-more' );
	$preferred_contact = $submission->get_posted_data( 'preferred-contact-method' );
	$preferred_time = $submission->get_posted_data( 'preferred-contact-time' );
	$comment = $submission->get_posted_data( 'comment' );
	$persona = $submission->get_posted_data( 'persona' );
	
    // Declaring variables to represent user inputs after mapping them to Zendesks representation of the field.
	$reformatted_phone = ""; 
	$reformatted_hear_about_us = "";  
	$reformatted_mealtime_insulin = "";
	$reformatted_challenges = "";
	$reformatted_manage_diabetes = "";
	$reformatted_verify_age = "";
	$reformatted_support_you = "";
	$reformatted_preferred_contact = "";
	$reformatted_preferred_time = "";
	$reformatted_comment = "";
	$reformatted_persona = "";
	$reformatted_url = "";
	  
    // Prepend a "1" char to the front of a phone number if it doesn't already exist
	if(substr($phone, 0, 1) != "1") {
		$reformatted_phone = "1" . " " . $phone;
	}
	else {
		$reformatted_phone = $phone;
	}
	
	
	// Begin mapping user inputs to Zendesk's representation of the field.
	switch ($hear_about_us) {
		case ["Physician"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_hcp";
			break;
		case ["Online Search"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_online_search";
			break;
		case ["Social Media"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_social_media";
			break;
		case ["Webinar"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_webinar";
			break;
		case ["Conference"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_conference";
			break;
		case ["Pharmacy"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_pharmacy";
			break;
		case ["Other"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_other";
			break;
		case ["SNAQ app"]:
			$reformatted_hear_about_us = "customer_field_how_did_you_hear_about_us_snaq";
			break;
	}  
	  
	switch ($mealtime_insulin) {
		case ["Yes"]:
			$reformatted_mealtime_insulin = "user_field_mealtime_insulin_yes";
			break;
		case ["No"]:
			$reformatted_mealtime_insulin = "user_field_mealtime_insulin_no";
			break;
		
	}  
	
	switch ($verify_age) {
		case ["Yes"]:
			$reformatted_verify_age = "user_field_are_you_21_or_older_yes";
			break;
		case ["No"]:
			$reformatted_verify_age = "user_field_are_you_21_or_older_no";
			break;
	}  
	
	switch ($preferred_contact) {
		case ["Email"]:
			$reformatted_preferred_contact = "user_field_preferredcomms_email";
			break;
		case ["Telephone"]:
			$reformatted_preferred_contact = "user_field_preferredcomms_phone";
			break;
		case ["Text"]:
			$reformatted_preferred_contact = "user_field_preferredcomms_text";
			break;
	}  
	
	switch ($preferred_time) {
		case ["9:00 AM to 11:59 AM ET"]:
			$reformatted_preferred_time = "9_00-noon_et";
			break;
		case ["12:00 PM to 3:00 PM ET"]:
			$reformatted_preferred_time = "noon-3_00_et";
			break;
		case ["3:01 PM to 6:00 PM ET"]:
			$reformatted_preferred_time = "3_00-6_00pm_et";
			break;
	}  
	
	switch ($support_you) {
		case ["I would like to speak to a TeleHealth provider about getting started on CeQur Simplicity for free with my first prescription. ($25 fee for telehealth/physician consultation applies)."]:
			$reformatted_support_you = "user_field_supportyou_speak_to_a_telehealth_provider";
			break;
		case ["I would like to be connected to a CeQur Care team member to learn more."]:
			$reformatted_support_you = "user_field_supportyou_cequr_team_member";
			break;
		case ["I would like to speak to my own healthcare provider. Please email me information."]:
			$reformatted_support_you = "user_field_supportyou_speak_to_own_provider";
			break;
	} 
	  
	switch ($challenges) {
		case ["Dislike injections"]:
			$reformatted_challenges = "user_field_challenges_dislike_injections";
			break;
		case ["Forget syringe/pen at home"]:
			$reformatted_challenges = "user_field_challenges_forget_syringe/pen_at_home";
			break;
		case ["Difficult to inject outside of your home"]:
			$reformatted_challenges = "user_field_challenges_difficult_to_inject_outside_of_home";
			break;
		case ["Want to carry less items daily"]:
			$reformatted_challenges = "user_field_challenges_want_to_carry_less_items";
			break;
		case ["All of the above"]:
			$reformatted_challenges = "user_field_challenges_all_of_the_above";
			break;
		case ["I do not have any challenges"]:
			$reformatted_challenges = "user_field_challenges_none_of_the_above";
			break;
	}  
	  
	switch ($manage_diabetes) {
		case ["Continuous Glucose Monitor (CGM)"]:
			$reformatted_manage_diabetes = "customer_field_managing_diabetes_cgm";
			break;
		case ["Insulin Pump"]:
			$reformatted_manage_diabetes = "customer_field_managing_diabetes_insulin_pump";
			break;
		case ["Insulin Syringes and Vials"]:
			$reformatted_manage_diabetes = "customer_field_managing_diabetes_syringe";
			break;
		case ["Insulin Pens"]:
			$reformatted_manage_diabetes = "customer_field_managing_diabetes_pens";
			break;
		case ["Other"]:
			$reformatted_manage_diabetes = "customer_field_managing_diabetes_other";
			break;
	}  
	  
	switch ($persona) {
		case ["Patient or Caregiver"]:
			$reformatted_persona = "user_field_patient_caregiver";
			break;
		case ["HCP or Educator"]:
			$reformatted_persona = "user_field_hcp_educator";
			break;
		case ["Other"]:
			$reformatted_persona = "user_field_other";
			break;
		
	}  

	// Begin URL-Tracking Implementation
	// Start by grabbing the referring root URL
	$url = $_SERVER['HTTP_REFERER'] ;

	// Map referer to standardized values 
	switch ($url) {
		case (preg_match('/\W*((?i)instagram(?-i))\W*/', $url) ? true : false):
			$reformatted_url = "Instagram";
			break;
		case (preg_match('/\W*((?i)facebook(?-i))\W*/', $url) ? true : false):
			$reformatted_url = "Facebook";
			break;
		case (preg_match('/\W*((?i)cequr(?-i))\W*/', $url) ? true : false):
			$reformatted_url = "Direct Website";
			break;
		case (preg_match('/\W*((?i)t\.co(?-i))\W*/', $url) ? true : false):
			$reformatted_url = "Twitter";
			break;
	}  
	
	// End Mapping user inputs

    // Begin constructing POST request body
    
	$body = array(
		'user' => array(
			'form-name' => $title,
			'first-name' => $first_name,
			'last-name' => $last_name,
			'email' => $email,
			'phone-number' => $reformatted_phone,
			'hear-about' => $reformatted_hear_about_us,
			'insulin-use' => $reformatted_mealtime_insulin,
			'insulin-challenges' => $reformatted_challenges,
			'manage-diabetes' => $reformatted_manage_diabetes,
			'verify-age' => $reformatted_verify_age,
			'how-to-learn-more' => $reformatted_support_you,
			'preferred-contact-method' => $reformatted_preferred_contact,
			'preferred-contact-time' => $reformatted_preferred_time,
			'comment' => $comment,
			'persona' => $reformatted_persona,
			'url' => $reformatted_url
		)
	);
    
    // Reformat "body" to be json encoded

	$json_body = wp_json_encode($body);

    // Bundling the request arguments

	$args = array(
		'headers' => array(
			'Authorization' => 'Basic ' . base64_encode( 'admin' . ':' . 'pass' ),
			'Content-Type' => 'application/json',
		),
		'body' => $json_body,
		);
	
    
    // 
	
	$request = wp_remote_post('https://mockurl.com/post', $args);
		
	
	
	
  },
  10, 3
);

?>