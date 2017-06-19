<?php
//this element is used in insert and edit views
//if insert, $data is empty -> inputs are empty
//if edit, $data is editing record -> inputs are not empty

echo $this->element('form-person-bhl');
echo $this->element('form-taxon');
echo $this->element('form-publication');

$action = 'insert';
if (!empty($data)) {
    $action = 'edit';
}
$url = array('controller' => 'records', 'action' => $action);
if ($action == 'edit' && Hash::check($data['Record']['id'])) {
    $url[] = $data['Record']['id'];
}

echo $this->Form->create(false, array('type' => 'post', 'url' => $url,
    'class' => 'formHorizontal', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false)));

echo $this->Form->hidden('Record.id', array('value' => (empty($data['Record']['id']) ? '' : $data['Record']['id'])));
echo $this->Form->hidden('Locality.id', array('value' => (empty($data['Locality']['id']) ? '' : $data['Locality']['id'])));
echo $this->Form->hidden('TypificationReference.id', array('value' => (empty($data['TypificationReference']['id']) ? '' : $data['TypificationReference']['id'])));
echo $this->Form->hidden('RecordName.id', array('value' => (empty($data['RecordName']['id']) ? '' : $data['RecordName']['id'])));
echo $this->Form->hidden('Register.id', array('value' => (empty($data['Register']['id']) ? '' : $data['Register']['id'])));
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Name</h4>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            echo $this->Form->label('RecordName.name_std_form', 'Name <span id="taxon-name-state-icon"></span>', array('class' => 'control-label'));
            echo $this->Form->input('RecordName.name_std_form', array('type' => 'text', 'id' => 'taxon-name', 'class' => 'form-control', 'placeholder' => 'Start by typing a name',
                'value' => (empty($data['RecordName']['name_std_form']) ? '' : $data['RecordName']['name_std_form'])));
            $name_id = '';
            if (Hash::check($data, 'RecordName.ipni_name_id')) {
                $name_id = !empty($data['RecordName']['ipni_name_id']) ? $data['RecordName']['ipni_name_id'] : $data['RecordName']['new_name_id'];
            } else {
                $name_id = '';
            }
            echo $this->Form->hidden('RecordName.name_id', array('id' => 'taxon-id', 'value' => $name_id));
            echo $this->Form->hidden('RecordName.ipni', array('id' => 'taxon-ipni', 'value' => (!empty($data['RecordName']['ipni_name_id']) ? 1 : 0))); //if name is first registered as local and then edited to be from ipni, from then it is taken as ipni - ipni has priority over local
            ?>
        </div>
        <div>
            If you <b>cannot find the name</b>, it probably is not present in the IPNI database.
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-taxon">Add new name</button>
            <?php //echo $this->Html->link('Add new name', "#", ['id' => 'add-new-name', 'class' => 'btn btn-default', 'role' => 'button']);   ?>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h4>Type specimen or illustration</h4></div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.unit_type', 'Type:', array('class' => 'control-label'));
            echo $this->Form->input('Record.unit_type', array('type' => 'select', 'class' => 'form-control',
                'options' => array('H' => 'Herbarium specimen', 'I' => 'Illustration'),
                'value' => (empty($data['Record']['unit_type']) ? '' : $data['Record']['unit_type'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.type', 'Typification status:', array('class' => 'control-label'));
            echo $this->Form->input('Record.type', array('type' => 'select', 'class' => 'form-control',
                'options' => array('L' => 'Lectotype', 'N' => 'Neotype', 'E' => 'Epitype'),
                'value' => (empty($data['Record']['type']) ? '' : $data['Record']['type'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.barcode', 'Barcode:', array('class' => 'control-label'));
            echo $this->Form->input('Record.barcode', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['barcode']) ? '' : $data['Record']['barcode'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.herbarium', 'Herbarium:', array('class' => 'control-label'));
            echo $this->Form->input('Record.herbarium', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['herbarium']) ? '' : $data['Record']['herbarium'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.herbarium_link', 'Herbarium link:', array('class' => 'control-label'));
            echo $this->Form->input('Record.herbarium_link', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['herbarium_link']) ? '' : $data['Record']['herbarium_link'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.url_stable', 'Stable url:', array('class' => 'control-label'));
            echo $this->Form->input('Record.url_stable', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['url_stable']) ? '' : $data['Record']['url_stable'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.url_jstor', 'JSTOR url:', array('class' => 'control-label'));
            echo $this->Form->input('Record.url_jstor', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['url_jstor']) ? '' : $data['Record']['url_jstor'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.illustration_publication', 'Publication of illustration:', array('class' => 'control-label'));
            echo $this->Form->input('Record.illustration_publication', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['illustration_publication']) ? '' : $data['Record']['illustration_publication'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.collector', 'Collectors:', array('class' => 'control-label'));
            echo $this->Form->input('Record.collector', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['collector']) ? '' : $data['Record']['collector'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.collection_number', 'Collection number:', array('class' => 'control-label'));
            echo $this->Form->input('Record.collection_number', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['collection_number']) ? '' : $data['Record']['collection_number'])));
            ?>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-md-3 col-xs-12">
                    <?php
                    echo $this->Form->label('Record.collection_date1', 'Collection date from:', array('class' => 'control-label'));
                    echo $this->Form->input('Record.collection_date1', array('type' => 'text', 'id' => 'collection-date1', 'class' => 'form-control',
                        'value' => (empty($data['Record']['collection_date1']) ? '' : $data['Record']['collection_date1'])));
                    ?>
                </span>
                <span class="col-md-3 col-xs-12">
                    <?php
                    echo $this->Form->label('Record.collection_date2', 'Collection date to:', array('class' => 'control-label'));
                    echo $this->Form->input('Record.collection_date2', array('type' => 'text', 'id' => 'collection-date2', 'class' => 'form-control',
                        'value' => (empty($data['Record']['collection_date2']) ? '' : $data['Record']['collection_date2'])));
                    ?>
                </span>
                <span class="col-md-3"></span>
            </div>
        </div>

        <div class="form-group">
            <?php
            echo $this->Form->label('Locality.description', 'Locality description:', array('class' => 'control-label'));
            echo $this->Form->input('Locality.description', array('type' => 'textarea', 'class' => 'form-control',
                'value' => (empty($data['Locality']['description']) ? '' : $data['Locality']['description'])));
            ?>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-md-3 col-xs-12">
                    <?php
                    echo $this->Form->label('Locality.latitude', 'Locality latitude:', array('class' => 'control-label'));
                    echo $this->Form->input('Locality.latitude', array('type' => 'text', 'class' => 'form-control',
                        'value' => (empty($data['Locality']) ? '' : $this->Format->coordinate($data['Locality']['lat_degrees'], $data['Locality']['lat_minutes'], $data['Locality']['lat_seconds'], $data['Locality']['north_or_south']))));
                    ?>
                </span>
                <span class="col-md-3 col-xs-12">
                    <?php
                    echo $this->Form->label('Locality.longitude', 'Locality longitude:', array('class' => 'control-label'));
                    echo $this->Form->input('Locality.longitude', array('type' => 'text', 'class' => 'form-control',
                        'value' => (empty($data['Locality']) ? '' : $this->Format->coordinate($data['Locality']['lon_degrees'], $data['Locality']['lon_minutes'], $data['Locality']['lon_seconds'], $data['Locality']['east_or_west']))));
                    ?>
                </span>
            </div>
        </div>
        <div class="form-group">
            <?php
            $tip = "Name of the project this record collecting is a part of";
            echo $this->Form->label('Record.project', 'Project:' . $this->Format->tooltip('?', $tip), array('class' => 'control-label'));
            echo $this->Form->input('Record.project', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['project']) ? '' : $data['Record']['project'])));
            ?>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Publication place of typification</h4>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.display_type', 'Publication type:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.display_type', array('id' => 'publication-type', 'class' => 'form-control',
                'options' => array('1' => 'Journal paper', '2' => 'Book', '3' => 'Chapter in book'),
                'value' => (empty($data['TypificationReference']['display_type']) ? '1' : $data['TypificationReference']['display_type'])));
            ?>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-person-bhl">Add new author</button>
            <?php
            echo $this->Form->label('TypifRefAuthor.author_std_form', 'Authors: <span id="authors-ref-state-icon"></span>', array('class' => 'control-label'));
            echo $this->Form->input('TypifRefAuthor.author_std_form', array('type' => 'text', 'id' => 'ref-authors', 'class' => 'form-control', 'placeholder' => 'Start by typing a name'));

            $publAuthors = Hash::check($data, 'TypificationReference.TypifRefAuthor') === true ? $data['TypificationReference']['TypifRefAuthor'] : array();
            echo $this->element('author-list', array('authors' => $publAuthors));
            ?>

        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.title', 'Title:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.title', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['title']) ? '' : $data['TypificationReference']['title'])));
            ?>
        </div>
        <div id="journal">
            <div class="form-group">
                <?php
                echo $this->Form->label('TypificationReference.publication_std_form', 'Journal: <span id="publication-state-icon"></span>', array('class' => 'control-label'));
                echo $this->Form->input('TypificationReference.publication_std_form', array('type' => 'text', 'id' => 'ref-publ', 'class' => 'form-control',
                    'value' => (empty($data['TypificationReference']['publication_std_form']) ? '' : $data['TypificationReference']['publication_std_form']), 'placeholder' => 'Start by typing a publication name'));
                $publication_id = '';
                if (Hash::check($data, 'TypificationReference.publication_id_ipni')) {
                    $publication_id = !empty($data['TypificationReference']['publication_id_ipni']) ? $data['TypificationReference']['publication_id_ipni'] : $data['TypificationReference']['publication_id_new'];
                } else {
                    $publication_id = '';
                }
//                echo $this->Form->hidden('TypificationReference.publication_id_ipni', array('id' => 'ref-publ-ipni',
//                    'value' => (empty($data['TypificationReference']['publication_id_ipni']) ? '' : $data['TypificationReference']['publication_id_ipni'])));
                echo $this->Form->hidden('TypificationReference.publication_id', array('id' => 'ref-publ-id', 'value' => $publication_id));
                echo $this->Form->hidden('TypificationReference.ipni', array('id' => 'ref-publ-ipni', 'value' => (!empty($data['TypificationReference']['publication_id_ipni']) ? 1 : 0))); //if name is first registered as local and then edited to be from ipni, from then it is taken as ipni - ipni has priority over local
                ?>
            </div>
            <div>
                If you <b>cannot find the journal</b>, it probably is not present in the IPNI database.
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-publication">Add new journal</button>
                <?php //echo $this->Html->link('Add new name', "#", ['id' => 'add-new-name', 'class' => 'btn btn-default', 'role' => 'button']);    ?>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.year', 'Year:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.year', array('type' => 'text', 'class' => 'form-control', 'maxLength' => 4,
                'value' => (empty($data['TypificationReference']['year']) ? '' : $data['TypificationReference']['year'])));
            ?>
        </div>
        <div id="volume" class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.volume', 'Volume:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.volume', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['volume']) ? '' : $data['TypificationReference']['volume'])));
            ?>
        </div>
        <div id="issue" class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.issue', 'Issue:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.issue', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['issue']) ? '' : $data['TypificationReference']['issue'])));
            ?>
        </div>
        <div id="publisher" class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.publisher', 'Publisher:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.publisher', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['publisher']) ? '' : $data['TypificationReference']['publisher'])));
            ?>
        </div>
        <div id="editors" class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.editors', 'Editors:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.editors', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['editors']) ? '' : $data['TypificationReference']['editors'])));
            ?>
        </div>
        <div id="book" class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.book', 'Book title:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.book', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['book']) ? '' : $data['TypificationReference']['book'])));
            ?>
        </div>
        <div class="form-group">
            <div class="row">
                <span class="col-md-3 col-xs-12">
                    <?php
                    echo $this->Form->label('TypificationReference.start_page', 'Start Page:', array('class' => 'control-label'));
                    echo $this->Form->input('TypificationReference.start_page', array('type' => 'text', 'class' => 'form-control',
                        'value' => (empty($data['TypificationReference']['start_page']) ? '' : $data['TypificationReference']['start_page'])));
                    ?>
                </span>
                <span class="col-md-3 col-xs-12">
                    <?php
                    echo $this->Form->label('TypificationReference.end_page', 'End Page:', array('class' => 'control-label'));
                    echo $this->Form->input('TypificationReference.end_page', array('type' => 'text', 'class' => 'form-control',
                        'value' => (empty($data['TypificationReference']['end_page']) ? '' : $data['TypificationReference']['end_page'])));
                    ?>
                </span>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('Record.page_of_typification', 'Page of typification:', array('class' => 'control-label'));
            echo $this->Form->input('Record.page_of_typification', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['Record']['page_of_typification']) ? '' : $data['Record']['page_of_typification'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.pdf_link', 'Link to PDF page:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.pdf_link', array('type' => 'text', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['pdf_link']) ? '' : $data['TypificationReference']['pdf_link'])));
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $this->Form->label('TypificationReference.note', 'Note:', array('class' => 'control-label'));
            echo $this->Form->input('TypificationReference.note', array('type' => 'textarea', 'class' => 'form-control',
                'value' => (empty($data['TypificationReference']['note']) ? '' : $data['TypificationReference']['note'])));
            ?>
        </div>
    </div>
</div>

<?php
echo $this->Form->hidden('Register.username', array('value' => $logged['username']));
echo $this->Form->end(array('label' => 'Submit', 'class' => 'btn btn-default', 'div' => false));
