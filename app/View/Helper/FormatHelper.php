<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP Format
 * @author Matus
 */
class FormatHelper extends AppHelper {

    public $helpers = array('Html');

    public function __construct(View $View, $settings = array()) {
        parent::__construct($View, $settings);
    }

    public function type($t) {
        switch ($t) {
            case 'L':
                return 'LECTOTYPE';
            case 'E':
                return 'EPITYPE';
            case 'N':
                return 'NEOTYPE';
            default:
                return 'N/A';
        }
    }

    public function glyph($type) {
        if ($type == 'H') {
            return "glyphicon-leaf icon-herb";
        } else {
            return "glyphicon-picture icon-illustr";
        }
    }

    public function reference($reference, $authors, $options = array('links' => false)) {
        $out = '';
        if (is_array($authors)) {
            $as = array();
            foreach ($authors as $a) {
                $as[] = $this->linkAuthor($a, $options['links']);
            }
            $out = implode(', ', $as);
        } else if (is_string($authors)) {
            $out = $authors;
        }
        if (!empty($reference['year'])) {
            $out .= ' (' . $reference['year'] . ') ';
        }
        if (!empty($reference['title'])) {
            $out .= $reference['title'] . '. ';
        }
        if ($reference['display_type'] == '1') { //journal paper
            if (!empty($reference['publication_std_form'])) {
                if ($options['links']) {
                    $out .= $this->Html->link($reference['publication_std_form'], 'http://www.ipni.org/ipni/idPublicationSearch.do?id=' . $reference['publication_id_ipni'], array('target' => '_ipni_publ', 'title' => 'View publication in IPNI'));
                } else {
                    $out .= $reference['publication_std_form'];
                }
            }
        } else if ($reference['display_type'] == '2') { //book
            $out .= empty($reference['publisher']) ? '' : $reference['publisher'] . '. ';
        } else { //chapter in book
            $out .= empty($reference['editors']) ? '' : 'In: (eds.) ' . $reference['editors'];
            $out .= empty($reference['publisher']) ? '' : $reference['publisher'] . '. ';
        }
        if (!empty($reference['volume'])) {
            $out .= empty($reference['publication_std_form']) ? '' : ', ';
            $out .= $reference['volume'];
        }
        if (!empty($reference['issue'])) {
            $out .= ' (' . $reference['issue'] . ')';
        }
        $pages = '';
        if (!empty($reference['start_page'])) {
            $pages .= $reference['start_page'];
        }
        if (!empty($reference['end_page'])) {
            $pages .= '-' . $reference['end_page'];
        }
        if (!empty($pages)) {
            $out .= $reference['display_type'] == '1' ? ':' : '';
            $out .= $pages;
        }
        return $out;
    }

    public function coordinate($d, $m, $s, $o) {
        if (empty($d) && empty($m) && empty($s)) {
            return '';
        }
        $dd = empty($d) ? '00' : $d;
        $mm = empty($m) ? '00' : $m;
        $ss = empty($s) ? '00' : $s;
        $out = $dd . "° $mm' $ss'' $o";
        return $out;
    }

    public function linkName($recordName) {
        if (empty($recordName)) {
            return 'Empty name';
        }
        $glyph = '<span class="glyphicon glyphicon-new-window text-muted small"></span>';
        if (isset($recordName['ipni_name_id']) && !empty($recordName['ipni_name_id'])) {
            return $this->Html->link($recordName['name_std_form'] . " $glyph", 'http://www.ipni.org/ipni/idPlantNameSearch.do?id=' . $recordName['ipni_name_id'], array('class' => 'remote', 'target' => 'ipni_name', 'title' => 'View name on IPNI', 'escape' => false));
        }
        if (isset($recordName['new_name_id']) && !empty($recordName['new_name_id'])) {
            return $this->Html->link($recordName['name_std_form'] . " $glyph", array('controller' => 'loss', 'action' => 'view', $recordName['new_name_id']), array('class' => 'local', 'target' => 'new_name', 'title' => 'Local name', 'escape' => false));
        }
        return $recordName['name_std_form'];
    }

    public function linkAuthor($author, $link) {
        if (is_array($author)) {
            if ($link) {
                if (!empty($author['remote_author_id'])) { //bhl link
                    return $this->Html->link(trim($author['author_std_form'], ','), 'http://www.biodiversitylibrary.org/creator/' . $author['remote_author_id'], array('class' => 'remote', 'target' => '_bhl_author', 'title' => 'View author on BHL'));
                }
                return $this->Html->link($author['author_std_form'], array('controller' => 'authorsbhl', 'action' => 'view', $author['local_author_id']), array('class' => 'local', 'target' => '_local_bhl_author', 'title' => 'Local author'));
            }
            return $author['author_std_form'];
        }
        return $author;
    }

    public function taxonName($genus, $species, $infra_species, $rank, $hybrid, $hybrid_genus = false, $authors = '', $family = '') {
        $out = $genus;
        if ($hybrid) {
            $out .= ' x';
        }
        $out .= " $species";
        if ($rank != 'spec.') {
            $out .= " $rank $infra_species";
        }
        if (!empty($authors)) {
            $out .= " $authors";
        }
        if (!empty($family)) {
            $out .= " ($family)";
        }
        return $out;
    }

    public function tooltip($label, $title) {
        return '<a href="#" data-toggle="tooltip" title="' . $title . '">' . $label . '</a>';
    }

    public function listGroupItem($val, $label) {
        if (empty($val)) {
            return '';
        }
        return '<li class="list-group-item">' . $val . '<span class="label label-primary pull-right">' . $label . '</span></li>';
    }

}
