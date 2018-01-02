<?php
@session_start();
if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}

function add_item($proId, $q) {
	if (array_key_exists($proId, $_SESSION["cart"])) {
		$_SESSION["cart"][$proId] += $q;
	} else {
		$_SESSION["cart"][$proId] = $q;
	}
}

function delete_item($proId) {
	unset($_SESSION["cart"][$proId]);
}

function update_item($proId, $q) {
	$_SESSION["cart"][$proId] = $q;
}

function get_total_items() {
	$total = 0;
	foreach ($_SESSION["cart"] as $proId => $q) {
		$total += $q;
	}

	return $total;
}