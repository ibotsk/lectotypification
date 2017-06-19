<?php

$remoteOut = array();
if ($remote !== false) {
    $json = json_decode($remote, true);
    foreach ($json['Result'] as $j) {
        $remoteOut[] = array('value' => $j['CreatorID'], 'label' => trim($j['Name'], ','), 'desc' => $j['Dates'], 'remote' => 1);
    }
}

if (!empty($local)) {
    $localReady = Hash::insert(Hash::extract($local, '{n}.AuthorBhl'), '{n}.remote', 0);
    echo json_encode(array_merge($localReady, $remoteOut));
} else {
    echo json_encode($remoteOut);
}