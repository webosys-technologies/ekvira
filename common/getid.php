<?php
include('Navigation.php');
function calcID(){
$a=new Navigation;
$state=$a->get();
return $state;
}
?>
