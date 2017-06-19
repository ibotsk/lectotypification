<ul id="reference-authors" class="list-group">
    <?php
    $i = 0;
    foreach ($authors as $author) :
        ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-10">
                    <span class="badge"><?php echo ($i + 1); ?></span> <?php echo $this->Format->linkAuthor($author, true); ?>
                </div>
                <div class="col-xs-1 text-right">
                    <div>
                        <button class="btn btn-default move move-up author-move-up" title="Move up" <?php echo ($i == 0 ? 'disabled="disabled"' : ''); ?>><span class="glyphicon glyphicon-chevron-up"></span></button>
                    </div>
                    <div>
                        <button class="btn btn-default move move-down author-move-down" title="Move down" <?php echo ($i == count($authors) - 1 ? 'disabled="disabled"' : ''); ?>><span class="glyphicon glyphicon-chevron-down"></span></button>
                    </div>
                </div>
                <div class="col-xs-1">
                    <button class="btn btn-default remove-ref-author" title="Remove from the list"><span class="glyphicon glyphicon-remove"></span></button>
                </div>
            </div>
            <?php
            echo $this->Form->hidden('TypificationReference.TypifRefAuthor.' . $i . '.id', array('value' => $author['id']));
            echo $this->Form->hidden('TypificationReference.TypifRefAuthor.' . $i . '.typif_ref_id', array('value' => $author['typif_ref_id']));
            echo $this->Form->hidden('TypificationReference.TypifRefAuthor.' . $i . '.author_std_form', array('value' => $author['author_std_form']));
            echo $this->Form->hidden('TypificationReference.TypifRefAuthor.' . $i . '.local_author_id', array('value' => $author['local_author_id']));
            echo $this->Form->hidden('TypificationReference.TypifRefAuthor.' . $i . '.remote_author_id', array('value' => $author['remote_author_id']));
            ?>
        </li>
        <?php
        $i++;
    endforeach;
    ?>
</ul>
