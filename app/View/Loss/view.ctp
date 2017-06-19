<h3>Taxon name <small class="local">Local</small></h3>
<div class="well">Fields are in compliance with IPNI</div>

<ul class="list-group full">
    <li class="list-group-item"><h4><?php echo $this->Format->taxonName($los['ListOfSpecies']['genus'], 
            $los['ListOfSpecies']['species'], $los['ListOfSpecies']['infra_species'], 
            $los['ListOfSpecies']['rank'], $los['ListOfSpecies']['hybrid'], 
            $los['ListOfSpecies']['hybrid_genus'], $los['ListOfSpecies']['authors'], 
            $los['ListOfSpecies']['family']); ?></h4> <span class="label label-primary pull-right">Name</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['family']; ?> <span class="label label-primary pull-right">Family</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['hybrid_genus']; ?> <span class="label label-primary pull-right">Hybrid genus</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['hybrid']; ?> <span class="label label-primary pull-right">Hybrid</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['genus']; ?> <span class="label label-primary pull-right">Genus</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['species']; ?> <span class="label label-primary pull-right">Species</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['species_author']; ?> <span class="label label-primary pull-right">Species author</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['infra_species']; ?> <span class="label label-primary pull-right">Infra species</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['rank']; ?> <span class="label label-primary pull-right">Rank</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['authors']; ?> <span class="label label-primary pull-right">Authors</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['basionym']; ?> <span class="label label-primary pull-right">Basionym</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['publishing_author']; ?> <span class="label label-primary pull-right">Publishing author</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['reference']; ?> <span class="label label-primary pull-right">Reference</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['publication']; ?> <span class="label label-primary pull-right">Publication</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['collation']; ?> <span class="label label-primary pull-right">Collation</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['publication_year']; ?> <span class="label label-primary pull-right">Publication year</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['publication_year_note']; ?> <span class="label label-primary pull-right">Publication year note</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['volume']; ?> <span class="label label-primary pull-right">Volume</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['issue']; ?> <span class="label label-primary pull-right">Issue</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['start_page']; ?> <span class="label label-primary pull-right">Start page</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['end_page']; ?> <span class="label label-primary pull-right">End page</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['original_taxon_name']; ?> <span class="label label-primary pull-right">Original taxon name</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['original_taxon_name_author_team']; ?> <span class="label label-primary pull-right">Original taxon name author team</span></li>
    <li class="list-group-item"><?php echo $los['ListOfSpecies']['name_status']; ?> <span class="label label-primary pull-right">Name status</span></li>
</ul>

<?php

new dBug($los);
