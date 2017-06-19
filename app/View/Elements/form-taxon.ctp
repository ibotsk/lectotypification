
<div id="modal-taxon" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new name</h4>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('ListOfSpecies', array('type' => 'post', 'url' => array('controller' => 'loss', 'action' => 'insert', 'ext' => 'json'),
                    'id' => 'ListOfSpeciesAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
                echo $this->Form->input('family', array('class' => 'form-control', 'placeholder' => 'Family'));
                ?>
                <div class="checkbox">
                    <label><?php echo $this->Form->input('hybrid_genus'); ?>Hybrid genus</label>
                </div>
                <?php
                echo $this->Form->input('genus', array('class' => 'form-control', 'placeholder' => 'Genus'));
                ?>
                <div class="checkbox">
                    <label><?php echo $this->Form->input('hybrid'); ?>Hybrid</label>
                </div>
                <?php
                echo $this->Form->input('species', array('class' => 'form-control', 'placeholder' => 'Species'));
                echo $this->Form->input('species_author', array('class' => 'form-control', 'placeholder' => 'Species author'));
                echo $this->Form->input('infra_species', array('class' => 'form-control', 'placeholder' => 'Infra species'));
                echo $this->Form->input('rank', array('class' => 'form-control', 'placeholder' => 'Rank', 'options' => array('spec.' => 'spec.', 'var.' => 'var.', 'subsp.' => 'subsp.', 'f.' => 'f.', 'subvar.' => 'subvar.')));
                echo $this->Form->input('authors', array('id' => 'los-authors', 'class' => 'form-control', 'placeholder' => 'Authors'));
                ?>
                <!--
                <span id="los-authors-string"></span>
                <div id="los-authors-ids"></div>-->
                <?php
                echo $this->Form->input('publishing_author', array('class' => 'form-control', 'placeholder' => 'Publishing author'));
                //echo $this->Form->input('reference', array('class' => 'form-control', 'placeholder' => 'Reference'));
                ?>
                <div>
                    <?php
                    echo $this->Form->input('publication', array('type' => 'text', 'id' => 'los-publ', 'class' => 'form-control', 'placeholder' => 'Publication (start by typing a publication name)'));
                    echo $this->Form->input('publication_id_ipni', array('type' => 'hidden', 'id' => 'los-publ-ipni'));
                    ?>
                    <span id="los-publication-state-icon"></span>
                </div>
                <?php
                echo $this->Form->input('collation', array('class' => 'form-control', 'placeholder' => 'Collation'));
                echo $this->Form->input('publication_year', array('class' => 'form-control', 'placeholder' => 'Publication year'));
//                echo $this->Form->input('publication_year_note', array('class' => 'form-control', 'placeholder' => 'Publication year note'));
                echo $this->Form->input('name_status', array('class' => 'form-control', 'placeholder' => 'Name status'));
//                echo $this->Form->input('volume', array('class' => 'form-control', 'placeholder' => 'Volume'));
//                echo $this->Form->input('issue', array('class' => 'form-control', 'placeholder' => 'Issue'));
                echo $this->Form->input('start_page', array('class' => 'form-control', 'placeholder' => 'Start page'));
                echo $this->Form->input('end_page', array('class' => 'form-control', 'placeholder' => 'End page'));
                echo $this->Form->input('original_taxon_name', array('class' => 'form-control', 'placeholder' => 'Original taxon name'));
                echo $this->Form->input('original_taxon_name_author_team', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Original taxon name author team'));
                echo $this->Form->end(array('label' => 'Submit', 'tabindex' => '-1', 'style' => 'position:absolute; top:-1000px;'));
                ?>
            </div>
            <div class="modal-footer">
                <button id="submit-name" type="button" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
