<?php

$name = $this->Format->taxonName($data['ListOfSpecies']['genus'], $data['ListOfSpecies']['species'], $data['ListOfSpecies']['infra_species'], $data['ListOfSpecies']['rank'], $data['ListOfSpecies']['hybrid'], $data['ListOfSpecies']['hybrid_genus'], $data['ListOfSpecies']['authors'], $data['ListOfSpecies']['family']);
echo json_encode(array('id' => $id, 'std_name' => $name));
