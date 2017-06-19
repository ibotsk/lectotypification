<?php

$remoteOut = array();
if ($remote !== false && !empty($remote)) {
    foreach ($remote as $a) {
        $remoteOut[] = array('value' => $a['Id'], 'label' => $a['Title'], 'desc' => $a['Abbreviation'], 'ipni' => 1);
    }
}

if (!empty($local)) {
    //$localReady[] = array('value' => $l['Publication']['id'], 'label' => , 'desc' => $description, 'ipni' => 0);
    $localReady = Hash::insert(Hash::extract($local, '{n}.Publication'), '{n}.ipni', 0);
    echo json_encode(array_merge($localReady, $remoteOut));
} else {
    echo json_encode($remoteOut);
}
