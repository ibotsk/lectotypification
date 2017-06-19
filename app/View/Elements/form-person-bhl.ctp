
<div id="modal-person-bhl" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add new author</h4>
            </div>
            <div class="modal-body">
                <?php
                echo $this->Form->create('AuthorBhl', array('type' => 'post', 'url' => array('controller' => 'authorsbhl', 'action' => 'insert', 'ext' => 'json'),
                    'id' => 'AuthorBhlAddForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
                echo $this->Form->input('name', array('class' => 'form-control input-sm', 'placeholder' => 'Author name'));
                echo $this->Form->input('unit', array('class' => 'form-control input-sm', 'placeholder' => 'Unit'));
                echo $this->Form->input('location', array('class' => 'form-control input-sm', 'placeholder' => 'Location'));
                echo $this->Form->input('dates', array('class' => 'form-control input-sm', 'placeholder' => 'year of birth to year of death'));
                echo $this->Form->end(array('label' => 'Submit', 'tabindex' => '-1', 'style' => 'position:absolute; top:-1000px;'));
                ?>
            </div>
            <div class="modal-footer">
                <button id="submit-person-bhl" type="button" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
