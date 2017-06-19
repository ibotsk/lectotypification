<?php

$remoteOut = array();
if ($remote !== false) {
    foreach ($remote as $a) {
        $remoteOut[] = array('value' => $a['Id'], 'label' => $a['Standard form'], 'desc' => $j['Dates'], 'remote' => 1);
    }
}

if (!empty($local)) {
    $localReady = Hash::insert(Hash::extract($local, '{n}.Author'), '{n}.remote', 0);
    echo json_encode(array_merge($localReady, $remoteOut));
} else {
    echo json_encode($remoteOut);
}
