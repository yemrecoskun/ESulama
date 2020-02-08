<?php
session_start();
require_once 'vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

$db = new FirestoreClient([
    'projectId' => 'e-sulama',
]);

function getDocument2()
{
    global $db;
    $docRef = $db->collection('SensorData')->document('nowData');
    $docRef_pump = $db->collection('SensorData')->document('pump');
    $snapshot = $docRef->snapshot();
    $snapshot_pump = $docRef_pump->snapshot();

    if ($snapshot->exists()) {
        $_SESSION["data"] = $snapshot->data();
        $_SESSION["pump"] = $snapshot_pump->data();
        echo $_SESSION["data"]["Temperature"] . ":"
            . $_SESSION["data"]["Humidity"] . ":"
            . $_SESSION["data"]["Light"] . ":"
            . $_SESSION["data"]["EarthHumidty"] . ":"
            . $_SESSION["data"]["WaterLevel"] . ":"
            . $_SESSION["data"]["Weather"] . ":"
            . $_SESSION["pump"]["autoControl"] . ":"
            . $_SESSION["pump"]["EarthHumidty"] . ":";
    } else {
        printf('Document %s does not exist!' . PHP_EOL, $snapshot->id());
    }
}

function setEarthHum($earth)
{
    global $db;
    $earth = intval($earth);
    $earthRef = $db->collection('SensorData')->document('pump');
    $earthRef->set([
        'EarthHumidty' => $earth
    ], ['merge' => true]);
}
function setAutoControl($autoControl)
{
    global $db;
    $autoControl = intval($autoControl);
    $autoRef = $db->collection('SensorData')->document('pump');
    $autoRef->set([
        'autoControl' => $autoControl
    ], ['merge' => true]);
}
function setPumpControl($control)
{
    global $db;
    $control = intval($control);
    $pumpRef = $db->collection('SensorData')->document('pump');
    $pumpRef->set([
        'control' => $control
    ], ['merge' => true]);
}
function  setTempControl($tempControl){
    global $db;
    $tempControl = intval($tempControl);
    $pumpRef = $db->collection('SensorData')->document('pump');
    $pumpRef->set([
        'tempControl' => $tempControl
    ], ['merge' => true]);
}
function getGraphic($date,$time)
{
    global $db;
    $dateDoc = $db->collection("$date")->document("$time");
    $snap = $dateDoc->snapshot();
    if ($snap->exists()) {
        return $snap->data();
    } else {
        return array("Temperature" => 0,
        "Weather" => 0,
        "EarthHumidty" => 0,
        "Humidity" =>0,
        "Clock" => 0,
        "Light" => 0,
        "WaterLevel" => 0,
        "Calendar" => 0
        );
    }
}
