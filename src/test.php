<?php

//***********
require_once('workflows.php');

$w = new Workflows();

$email = $w->get( 'gitlab.email', 'settings.plist' );
$password = $w->get( 'gitlab.password', 'settings.plist' );
$baseurl = $w->get( 'gitlab.baseurl', 'settings.plist' );

if (!$email) {
	$w->result( 'git-email', 'https://github.com/kimichen13/alfred-gitlab-workflow#Setup', 'Gitlab Email Required', 'Press Enter to see documentation on how to set up.', 'icon.png', 'yes' );
}
if (!$password) {
	$w->result( 'git-password', 'https://github.com/kimichen13/alfred-gitlab-workflow/tree/develop#Setup', 'Gitlab Password/Token Required', 'Press Enter to see documentation on how to set up.', 'icon.png', 'yes' );
}
if (!$baseurl) {
	$w->result( 'git-baseurl', 'https://github.com/kimichen13/alfred-gitlab-workflow/tree/develop#Setup', 'Gitlab BaseUrl Required', 'Press Enter to see documentation on how to set up.', 'icon.png', 'yes' );
}

if ( count( $w->results() ) == 0 ){
	// Test
	$url = $baseurl."/api/v3/session";
    $login = false;
	if($email && $password) {
		exec('sh auth.sh -e '.escapeshellarg($email).' -p '.escapeshellarg($password).' --url '.escapeshellarg($url), $output, $return_var);

        $response = implode($output);
		$data = substr($response, (strpos($response, $url) + strlen($url)));
		$msg = json_decode( $data );
        $w->set( 'gitlab.token', $msg->{'private_token'}, 'settings.plist' );
        $login = true;
	}

    if ($login){
        $w->result( 'git-test', null, 'Test Successful', '', 'icon.png', 'no' );
    } else {
        $w->result( 'git-test', null, 'Test Unsuccessful', '', 'icon.png', 'no' );
    }
}

echo $w->toxml();

?>