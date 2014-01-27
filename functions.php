<?php
	if( !isset( $theme ) ){
		require( STYLESHEETPATH . '/module/MP.class.php' );
		$theme = new MP();
	}