<?php
    require_once 'Firestore.php';
    
    if(isset($_POST["earthHumidty"]))
    {
        $earthHum = $_POST["earthHumidty"];
        setEarthHum($earthHum);
        echo 'success';
    }
    else if(isset($_POST["pumpControl"]))
    {
        $pumpControl = $_POST["pumpControl"];
        setPumpControl($pumpControl);
        echo 'success';
    }
    else if(isset($_POST["autoControl"]))
    {
        $autoControl = $_POST["autoControl"];
        setAutoControl($autoControl);
        echo 'success';
    }
    else if(isset($_POST["tempControl"]))
    {
          $tempControl = $_POST["tempControl"];
          setTempControl($tempControl);
          echo 'success';
    }
    else
    {
        echo 'post edilmedi';
    }
?>