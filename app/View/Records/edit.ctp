<?php
if ($logged['permission'] == 1 || $logged['permission'] == 2) : //show approval change form only when admin (1) or moderator (2)
    $approved = $data[0]['Record']['approved'];
    echo $this->Form->create(false, array('id' => 'ApprovalForm', 'class' => 'record-form', 'url' => array('controller' => 'records', 'action' => 'approve', $data[0]['Record']['id']), 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
    ?>
    <div class="checkbox">
        <label>
            <?php
            echo $this->Form->input('approval', array('type' => 'checkbox', 'class' => 'approval', 'checked' => ($approved ? 'checked' : '')));
            echo $approved ? '<span class="text-success"><strong>Approved</strong></span>' : '<span class="text-danger"><strong>Not approved</strong></span>';
            ?>
        </label>
    </div>
    <?php
    echo $this->Form->end();
endif;

echo $this->element('insert-edit-form', array('data' => $data[0]));
