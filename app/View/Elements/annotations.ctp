<h4>Annotations <small class="text-danger">(Test version)</small></h4>

<?php

$annotations = $this->requestAction(array('controller' => 'annotations', 'action' => 'view', $id, 'ext' => 'json'));
//new dBug($annotations);
$ann = $annotations ? json_decode($annotations) : null;
$size = $ann ? $ann->size : "0";
?>
<p><?php echo "This object has " . $size . " annotations"; ?></p>
<p><?php 
echo $this->Html->link('Annotate this object <span class="glyphicon glyphicon-new-window"></span>', ANNOSYS_BASE_URL . "/AnnoSys?recordURL=http://www.iapt-taxon.org/lectotpf/services/record/$id/abcd2.06", array('target' => '_annosys', 'escape' => false)); ?></p>

<?php
if ($ann && $ann->hasAnnotation) :
    foreach ($ann->annotations as $a) :
        $time_in_sec = $a->time / 1000;
        $datetime = date("d.m.Y H:i:s", $time_in_sec);
        ?>
        <a href="<?php echo ANNOSYS_BASE_URL . '/AnnoSys?repositoryURI=' . $a->repositoryURI; ?>" class="comment" title="Show details" target="_annosys">
            <div class="panel panel-default comment">
                <div class="panel-heading">
                    <span class="text-info"><?php echo $a->annotator; ?></span>
                    <span class="pull-right text-info"><?php echo $datetime; ?></span>
                </div>
                <div class="panel-body">
                    <label>Type of annotation:</label> <?php echo $a->motivation; ?>
                </div>
            </div>
        </a>
        <?php
    endforeach;
endif;
?>

<hr />
<div>
    <?php echo $this->Html->link('User guide', 'https://annosys.bgbm.org/sites/default/files/annosys-user-guide_v1-4_2015-06-30.pdf', array('target' => '_annosysuserguide', 'title' => 'AnnoSys user guide')); ?>
</div>
<div>
    <?php echo $this->Html->link('AnnoSys project', 'https://annosys.bgbm.fu-berlin.de/', array('tager' => '_annosyshome', 'title' => 'AnnoSys project website')); ?>
</div>
<div>
    
</div>
