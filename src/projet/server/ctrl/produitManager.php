<?php
include_once('../workers/ProduitBDManager.php');


if (isset($_SERVER['REQUEST_METHOD'])) {
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$paysBD = new ProduitBDManager();
		echo $paysBD->getProduitsXML();
	}
}
