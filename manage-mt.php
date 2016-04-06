<?php
	header("Content-type: application/json");
	require('config.ini');
	require('class/Routeros_api.php');

	$username = ((isset($_POST['username']))?$_POST['username']:'');
	$password = ((isset($_POST['password']))?$_POST['password']:'');
	$email = ((isset($_POST['email']))?$_POST['email']:'');
	$ifb = ((isset($_POST['ifb']))?$_POST['ifb']:'');

	$API = new routeros_api();  
	$API->debug = false;  

	$response = array();        
	
	//login mt
	if ($API->connect($ip_mt, $username_mt, $password_mt)) {                               
	   
	    $ARRAY = $API->comm("/ip/hotspot/user/add", array(
	        'server'    => $server_user,
	        'name'      => $username, 
	        'password'  => $password,
	        'profile'   => $profile_user,
	        'email'     => $email,
	        'comment'   => $room_user
	    ));  

	    if( isset($ARRAY['!trap']) ){
              if( $ifb != 'ifb' ){
              	$response['msg']='nouser';
              	return print json_encode($response);
              }
          }             
		                 
	 	$API->disconnect();

	 	$response['msg']='ok';
	 	return print json_encode($response);
	}else{
	  $response['msg']='no';
	  return print json_encode($response);
	} 
?>