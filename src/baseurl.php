<?php
require( 'workflows.php' );
$w = new Workflows();
if (!isset($query)) {
	$query = <<<EOD
           {query}
EOD;
}
$w->set( 'gitlab.baseurl', $query, 'settings.plist' );
echo 'Set Alfred Gitlab BaseURL '.$query;
?>