
<div id="modal-person" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new author</h4>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('Author', array('type' => 'post', 'url' => array('controller' => 'authors', 'action' => 'insert'),
                    'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
                echo $this->Form->input('default_author_name', array('class' => 'form-control input-sm', 'placeholder' => 'Default author name'));
                echo $this->Form->input('default_author_forename', array('class' => 'form-control input-sm', 'placeholder' => 'Default author forename'));
                echo $this->Form->input('default_author_surname', array('class' => 'form-control input-sm', 'placeholder' => 'Default author surname'));
                echo $this->Form->input('standard_form', array('class' => 'form-control input-sm', 'placeholder' => 'Standard form'));
                echo $this->Form->input('name_notes', array('type' => 'textarea', 'class' => 'form-control input-sm', 'placeholder' => 'Name notes'));
                echo $this->Form->input('name_source', array('class' => 'form-control input-sm', 'placeholder' => 'Name source'));
                echo $this->Form->input('dates', array('class' => 'form-control input-sm', 'placeholder' => 'Years of birth and death'));
                echo $this->Form->input('alternative_abbreviations', array('class' => 'form-control input-sm', 'placeholder' => 'Alternative abbreviations'));
                echo $this->Form->input('alternative_names', array('class' => 'form-control input-sm', 'placeholder' => 'Alternative names'));
                echo $this->Form->input('taxon_groups', array('class' => 'form-control input-sm', 'placeholder' => 'Taxon groups of interest'));
                echo $this->Form->input('example_of_name_published', array('class' => 'form-control input-sm', 'placeholder' => 'Example of name published'));
                echo $this->Form->end(array('label' => 'Submit', 'tabindex' => '-1', 'style' => 'position:absolute; top:-1000px;'));
                ?>
            </div>
            <div class="modal-footer">
                <button id="submit-person" type="button" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>