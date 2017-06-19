<?php
echo $this->element('preview-filter');
echo $this->Flash->render();

?>

<div id="records-preview">
    <div class="text-primary">
        <?php
        echo $this->Paginator->counter(
                'Page {:page} of {:pages}, showing {:current} records out of
     {:count} total, starting on record {:start}, ending on {:end}'
        );
        ?>
    </div>
    <div class="row text-center">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('< Prev', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
            <?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 1, 'modulus' => 6, 'tag' => 'li', 'separator' => false, 'ellipsis' => '<li class="readonly"><a>...</a></li>', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
            <?php echo $this->Paginator->next('Next >', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
        </ul>
    </div>
    <?php
    foreach ($records as $r):
        ?>
        <div class="panel panel-default record">
            <div class="row panel-body">
                <div class="col-sm-1 text-center">
                    <div>
                        <?php
                        $glyph = '<span class="glyphicon ' . $this->Format->glyph($r['Record']['unit_type']) . '"></span>';
                        //echo $this->Html->link($glyph, ['controller' => 'records', 'action' => 'view', $r['Record']['id']], ['escape' => false, 'class' => 'thumbnail']);
                        echo $glyph;
                        ?>
                    </div>
                    <h3 class="text-info"><?php echo $r['Record']['type']; ?></h3>
                    <!--<span class="glyphicon "></span> -->
                </div>
                <div class="col-sm-8">
                    <h4><?php echo $this->Html->link($r['RecordName']['name_std_form'], array('controller' => 'records', 'action' => 'view', $r['Record']['id'])); ?></h4>
                    <!--<div class="text-info"><?php echo $this->Format->type($r['Record']['type']); ?></div>-->
                    <div><?php echo $this->Format->reference($r['TypificationReference'], $r['TypificationReference']['TypifRefAuthor']); ?></div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if (!empty($logged['id'])) : //show only when user is logged
                                echo $r['Record']['approved'] ? '<span class="text-success">approved</span>' : '<span class="text-danger">not approved</span>';
                            endif;
                            ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                            if ($r['Register']['username'] == $logged['username']) {
                                echo '<span class="text-warning">Owned</span>';
                            }
                            ?>
                        </div>
                        <div class="col-md-3 text-right">
                            <?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array('controller' => 'records', 'action' => 'edit', $r['Record']['id']), array('escape' => false, 'class' => 'thumbnail text-center edit', 'title' => 'Edit')); ?>
                        </div>
                    </div>
                    <div class="small text-muted text-right">Inserted by <?php echo $r['Register']['username'] . ', ' . $r['Register']['inserted']; ?></div>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
    <div class="row text-center">
        <ul class="pagination">
            <?php echo $this->Paginator->prev('< Prev', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
            <?php echo $this->Paginator->numbers(array('first' => 1, 'last' => 1, 'modulus' => 6, 'tag' => 'li', 'separator' => false, 'ellipsis' => '<li class="readonly"><a>...</a></li>', 'currentTag' => 'a', 'currentClass' => 'active')); ?>
            <?php echo $this->Paginator->next('Next >', array('tag' => 'li', 'class' => false), null, array('disabledTag' => 'a', 'class' => 'disabled')); ?>
        </ul>
    </div>
</div>
