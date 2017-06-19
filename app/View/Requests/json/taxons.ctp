<?php

//echo json_encode(array(array('value' => 3, 'label' => 'Abcd', 'desc' => 'Ok', 'inpi' => false)));
//return;

$remoteOut = array();
foreach ($remote as $n) {
    $label = implode(' ', array($n['Full name without family and authors'], $n['Authors'], '(' . $n['Family'] . ')'));
    $description = (empty($n['Publication']) ? '' : $n['Publication']) . (empty($n['Collation']) ? '' : (': ' . $n['Collation'] . '. ')) . (empty($n['Publication year full']) ? '' : $n['Publication year full']);
    $remoteOut[] = array('value' => $n['Id'], 'label' => $label, 'desc' => $description, 'ipni' => 1);
}

if (!empty($local)) {
    $localReady = array();
    foreach ($local as $l) {
        $name = $this->Format->taxonName($l['ListOfSpecies']['genus'], $l['ListOfSpecies']['species'], $l['ListOfSpecies']['infra_species'], $l['ListOfSpecies']['rank'], $l['ListOfSpecies']['hybrid'], $l['ListOfSpecies']['hybrid_genus'], $l['ListOfSpecies']['authors'], $l['ListOfSpecies']['family']);
        $description = (empty($l['ListOfSpecies']['publication']) ? '' : $l['ListOfSpecies']['publication']) . (empty($l['ListOfSpecies']['collation']) ? '' : (': ' . $l['ListOfSpecies']['collation'] . '. ')) . (empty($l['ListOfSpecies']['publication_year']) ? '' : $l['ListOfSpecies']['publication_year']);
        $localReady[] = array('value' => $l['ListOfSpecies']['id'], 'label' => $name, 'desc' => $description, 'ipni' => 0);
    }
    echo json_encode(array_merge($localReady, $remoteOut));
} else {
    echo json_encode($remoteOut);
}
