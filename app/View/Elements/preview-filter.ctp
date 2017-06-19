<h4>Browse items</h4>
<?php
$query = $this->params->query;

echo $this->Form->create('Filter', array('type' => 'get', 'url' => array('controller' => 'records', 'action' => 'index', 'basic'),
    'class' => 'formHorizontal', 'id' => 'FilterPreviewForm', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));
?>
<div class="form-group">
    <?php
    echo $this->Form->label('name', 'Taxon name:', array('class' => 'control-label'));
    echo $this->Form->input('name', array('type' => 'text', 'class' => 'form-control', 'value' => isset($query['name']) ? $query['name'] : ''));
    ?>
</div>
<div class="form-group">
    <?php
    echo $this->Form->label('status', 'Type status:', array('class' => 'control-label'));
    echo $this->Form->input('status', array('type' => 'select', 'class' => 'form-control',
        'options' => array('A' => 'All', 'L' => 'Lectotype', 'N' => 'Neotype', 'E' => 'Epitype'), 'value' => isset($query['status']) ? $query['status'] : 'A'));
    ?>
</div>
<div class="form-group">
    <?php
    $options['all'] = 'All records';
    if (!empty($logged['id'])) {
        $options['mine'] = 'My records';
        $options['notmine'] = 'Others\' records';
    }
    echo $this->Form->label('owner', 'By Owner:', array('class' => 'control-label'));
    echo $this->Form->input('owner', array('type' => 'select', 'class' => 'form-control',
        'options' => $options, 'value' => isset($query['owner']) ? $query['owner'] : 'all'));
    ?>
</div>
<?php if (!empty($logged['id'])) : ?>
    <div class="form-group">
        <?php
        echo $this->Form->label('approved', 'By Approved:', array('class' => 'control-label'));
        echo $this->Form->input('approved', array('type' => 'select', 'class' => 'form-control',
            'options' => array('all' => 'All', 'yes' => 'Approved', 'no' => 'Not approved'), 'value' => isset($query['approved']) ? $query['approved'] : 'all'));
        ?>
    </div>
    <?php
endif;
?>
<div class="form-group">
    <?php
    echo $this->Form->end(array('label' => 'submit', 'class' => 'btn btn-default'));
    ?>
</div>
