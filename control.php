<?php
//DIDN'T SEND FORM
if (empty($_POST)) {
	header("Location: index.php");
	exit();
}




///////////////////////////////
// INSTANTIATE FLASH MESSAGE //
///////////////////////////////
require_once 'flashMessages/flashMessage.php';
$flash=new flashMessage();



//Create array message
$mssg= array(
    "Antiguo" => array(
        'name'  => 'perico',
        'email'  => 'perico@email.com',
        'password'  => 'pericoPassword',
        'address' => 'pericoAddress'
    ),
    "Nuevo" => array(
        'name'  => 'alonso',
        'email'  => 'alonso@email.com',
        'password'  => 'alonsoPassword',
        'address' => 'alonsoAddress'
    )
);


//////////////////////////
//CREATE FLASH MESSAGES //
//////////////////////////
for ($i = 0; $i < 2; $i++) {
    $flash->success($mssg);
    //$flash->warning("Warning Message");
    $flash->error("Error Message");
    $flash->info("Info Message");
}
		



// Redirect
header("Location: index.php");

?>
