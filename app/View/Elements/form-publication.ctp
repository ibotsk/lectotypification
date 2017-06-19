
<div id="modal-publication" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new journal</h4>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('Publication', array('type' => 'post', 'url' => array('controller' => 'publications', 'action' => 'insert', 'ext' => 'json'),
                    'id' => 'PublicationAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
                echo $this->Form->input('abbreviation', array('class' => 'form-control input-sm', 'placeholder' => 'Abbreviation'));
                echo $this->Form->input('title', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'Title'));
                echo $this->Form->input('remarks', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'Remarks'));
                echo $this->Form->input('BPH_number', array('class' => 'form-control input-sm', 'placeholder' => 'BPH number'));
                echo $this->Form->input('ISBN', array('class' => 'form-control input-sm', 'placeholder' => 'ISBN'));
                echo $this->Form->input('ISSN', array('class' => 'form-control input-sm', 'placeholder' => 'ISSN'));
                echo $this->Form->input('authors_role', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'Authors role'));
                echo $this->Form->input('edition', array('class' => 'form-control input-sm', 'placeholder' => 'Edition'));
                echo $this->Form->input('in_publication_facade', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'In publication facade'));
                echo $this->Form->input('date', array('class' => 'form-control input-sm', 'placeholder' => 'Date'));
                echo $this->Form->input('LC_number', array('class' => 'form-control input-sm', 'placeholder' => 'LC number'));
                echo $this->Form->input('place', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'Place'));
                echo $this->Form->input('publication_author_team', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'Publication author team'));
                echo $this->Form->input('preceded_by', array('type' => 'text', 'class' => 'form-control input-sm', 'placeholder' => 'Preceded by'));
                echo $this->Form->input('TL2_author', array('class' => 'form-control input-sm', 'placeholder' => 'TL2 author'));
                echo $this->Form->input('TL2_number', array('class' => 'form-control input-sm', 'placeholder' => 'TL2 number'));
                echo $this->Form->input('TDWG_abbreviation', array('class' => 'form-control input-sm', 'placeholder' => 'TDWG abbreviation'));
                echo $this->Form->end(array('label' => 'Submit', 'tabindex' => '-1', 'style' => 'position:absolute; top:-1000px;'));
                ?>
            </div>
            <div class="modal-footer">
                <button id="submit-publication" type="button" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
