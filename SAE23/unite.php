<?php
// Allows to define the unit of measurement according to the type of sensor (°C ; CO2 ; lux; %)
if ($type == 'Temperature') {
    $unit = '°C';
} else if ($type == 'CO2') {
    $unit = 'ppm';
} else if ($type == 'Humidite') {
    $unit = '%';
} else {
    $unit = 'lux';
}
?>
