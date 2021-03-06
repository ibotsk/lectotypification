<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP BiocaseComponent
 * @author Matus
 */
class BiocaseComponent extends Component {

    public $components = array();

    public function buildAbcd206Query($id) {
        $protocol = '<?xml version="1.0" encoding="UTF-8"?>'
                . '<request xmlns="http://www.biocase.org/schemas/protocol/1.3">'
                . '<header><type>search</type></header>'
                . '<search>'
                . '<requestFormat>http://www.tdwg.org/schemas/abcd/2.06</requestFormat>'
                . '<responseFormat start="0" limit="10">http://www.tdwg.org/schemas/abcd/2.06</responseFormat>'
                . '<filter>'
                . '<like path="/DataSets/DataSet/Units/Unit/UnitID">'
                . $id
                . '</like>'
                . '</filter>'
                . '<count>false</count>'
                . '</search>'
                . '</request>';
        return $protocol;
    }

}
