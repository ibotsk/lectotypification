<?php $r = $record[0]; ?>
<div id="view-record" class="row">
    <div class="col-md-9">
        <ul class="list-group full">
            <li class="list-group-item"><?php echo $r['Record']['approved'] ? '<span class="text-success"><strong>Approved</strong></span>' : '<span class="text-danger"><strong>Not approved</strong></span>'; ?></li>
            <li class="list-group-item"><h4><?php echo $this->Format->linkName($r['RecordName']); ?></h4><span class="label label-primary pull-right">Taxon</span></li>
            <li class="list-group-item text-info"><?php echo $this->Format->type($r['Record']['type']); ?><span class="label label-primary pull-right">Type</span></li>
        </ul>
        <ul class="list-group full">
            <?php if ($r['Record']['unit_type'] == 'H'): ?>
                <li class="list-group-item">Herbarium specimen <span class="label label-primary pull-right">Unit</span></li>
            <?php else: ?>
                <li class="list-group-item">Illustration <span class="label label-primary pull-right">Unit</span></li>
            <?php endif; ?>
            <?php
            $url_stable = empty($r['Record']['url_stable']) ? '' : $this->Html->link($r['Record']['url_stable'], $r['Record']['url_stable'], array('target' => '_blank'));
            $url_jstor = empty($r['Record']['url_jstor']) ? '' : $this->Html->link($r['Record']['url_jstor'], $r['Record']['url_jstor'], array('target' => '_blank'));
            echo $this->Format->listGroupItem($url_stable, 'Stable URL');
            echo $this->Format->listGroupItem($url_jstor, 'JSTOR URL');
            echo $this->Format->listGroupItem($r['Record']['barcode'], 'Barcode');
            echo $this->Format->listGroupItem($r['Record']['herbarium'], 'Herbarium');
            echo $this->Format->listGroupItem($r['Record']['collector'], 'Collectors');
            echo $this->Format->listGroupItem($r['Record']['collection_number'], 'Collection number');
            echo $this->Format->listGroupItem($r['Record']['collection_date1'], 'Collection date from');
            echo $this->Format->listGroupItem($r['Record']['collection_date2'], 'Collection date to');
            echo $this->Format->listGroupItem($r['Record']['illustration_publication'], 'Illustration publication');
            ?>
        </ul>
        <ul class="list-group full">
            <li class="list-group-item"><?php echo $this->Format->reference($r['TypificationReference'], $r['TypificationReference']['TypifRefAuthor'], array('links' => true)); ?><span class="label label-primary pull-right">Typification reference</span></li>
            <li class="list-group-item"><?php echo $r['Record']['page_of_typification']; ?><span class="label label-primary pull-right">Page of typification</span></li>
        </ul>
        <ul class="list-group full">
            <li class="list-group-item"><?php echo $r['Locality']['description']; ?><span class="label label-primary pull-right">Locality description</span></li>
            <li class="list-group-item"><?php echo $this->Format->coordinate($r['Locality']['lat_degrees'], $r['Locality']['lat_minutes'], $r['Locality']['lat_seconds'], $r['Locality']['north_or_south']); ?><span class="label label-primary pull-right">Latitude</span></li>
            <li class="list-group-item"><?php echo $this->Format->coordinate($r['Locality']['lon_degrees'], $r['Locality']['lon_minutes'], $r['Locality']['lon_seconds'], $r['Locality']['east_or_west']); ?><span class="label label-primary pull-right">Longitude</span></li>
        </ul>
    </div>
    <div class="col-md-3">
        <?php echo $this->element('annotations', array('id' => $r['Record']['id'])); ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 pull-right">
        <?php echo $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>', array('controller' => 'records', 'action' => 'edit', $r['Record']['id']), array('escape' => false, 'class' => 'thumbnail text-center edit', 'title' => 'Edit')); ?>
    </div>
</div>
