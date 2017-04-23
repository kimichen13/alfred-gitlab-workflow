<?php
require( 'workflows.php' );
$w = new Workflows();
if (!isset($query)) {
	$query = <<<EOD
           {query}
EOD;
}
$w->set( 'gitlab.password', $query, 'settings.plist' );
echo 'Set Alfred Gitlab Password ********';
?>