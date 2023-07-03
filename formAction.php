<?php
session_start();
include "connect.inc.php";
include "event.class.php";
include "review.class.php";

if (empty($_POST['window'])) {
    $window = $_GET['window'];

}

$review = new Review($conn);
$event = new Event($conn);

if ($window == "review"){
    $review->create($_POST);
}

if ($window == 'delete') {
    $id = $_GET['id'];
    $event->delete($id);
}

header('Location: home.php');

?>