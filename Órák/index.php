<?php
	// A szerver HTTPS jelzőjét vizsgálja: létezik, nem üres, és értéke on-e.
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		// HTTPS használatakor a biztonságos protokoll előtagjával kezdi a célcímet.
		$uri = 'https://';
	} else {
		// Egyébként HTTP protokollt választ.
		$uri = 'http://';
	}
	// Hozzáfűzi a kérés Host fejlécéből származó kiszolgálónevet, és ha szerepel benne, a portot is.
	$uri .= $_SERVER['HTTP_HOST'];
	// Átirányító HTTP-fejlécet küld a kiszolgáló /dashboard/ oldalára; alaphelyzetben 302-es státusszal.
	header('Location: '.$uri.'/dashboard/');
	// Azonnal leállítja a szkriptet, így a PHP-zárótag utáni hibaüzenet normál végrehajtáskor nem jelenik meg.
	exit;
?>
Something is wrong with the XAMPP installation :-(
