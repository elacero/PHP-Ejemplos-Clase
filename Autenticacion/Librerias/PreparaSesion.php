<?php
if (isset ( $argv ) && count ( $argv ) > 1) {
	for($i = 1; $i < count ( $argv ); $i += 2) {
		$_SESSION [$argv [$i]] = $argv [$i + 1];
	}
}
?>