<?php
require( 'workflows.php' );
$w = new Workflows();
if (!isset($query)) {
	$query = <<<EOD
           {query}
EOD;
}
$w->set( 'gitlab.email', $query, 'settings.plist' );
echo 'Set Alfred Gitlab Email '.$query;
?>