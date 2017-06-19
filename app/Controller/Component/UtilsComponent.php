<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP UtilsComponent
 * @author Matus
 */
class UtilsComponent extends Component {

    public $components = array();

    public function eToN($a) {
        foreach ($a as &$value) {
            if (is_array($value)) {
                $value = $this->eToN($value);
            } else {
                $value = empty($value) ? null : $value;
            }
        }
        return $a;
    }

    /**
     * Returns an array of values from $old that are not in $new
     * @param type $old
     * @param type $new
     */
    public function diff($old, $new) {
        if (empty($old)) { //nothing existed before
            return array();
        }
        if (empty($new)) { //nothing to compare with, everything in $old is not in $new
            return Hash::extract($old, '{n}.id');
        }
        $new_e = Hash::extract($new, '{n}.id');
        $diff = array();
        foreach ($old as $o) {
            if (isset($o['id']) && !in_array($o['id'], $new_e)) {
                $diff[] = $o['id'];
            }
        }
        return $diff;
    }

    public function coord($str, $lat = true) {
        if (empty($str)) {
            return null;
        }
        $tokens = preg_split('/[°\'\"\s]+/', trim($str));
        $hemisph = '';
        $opposite = false; //negative latitude or longitude
        if ($tokens[0] == '-' || $tokens[0][0] == '-') { //in first case '-' was separated by space, in second case it was not (e.g. -48 is together in array)
            $opposite = true;
        }
        preg_match('/\d+/', $tokens[0], $d); //get numeric part only (in case there is sign)
        $deg = floatval($d[0]);
        $last_elem = $tokens[count($tokens) - 1];
        if ((($last_elem == 'N' || $last_elem == 'S') && $lat) || (($last_elem == 'W' || $last_elem == 'E') && !$lat)) { //explicit N/S/W/E has priority over sign +- at the beginning
            $hemisph = $last_elem;
            unset($tokens[count($tokens) - 1]);
        }
        $min = count($tokens) > 1 ? floatval($tokens[1]) : 0;
        $sec = count($tokens) > 2 ? floatval($tokens[2]) : 0;
        if (empty($hemisph)) {
            $hemisph = $lat ? ($opposite ? 'S' : 'N') : ($opposite ? 'W' : 'E');
        }
        if ($lat) {
            return array('lat_degrees' => $deg, 'lat_minutes' => $min, 'lat_seconds' => $sec, 'north_or_south' => $hemisph);
        }
        return array('lon_degrees' => $deg, 'lon_minutes' => $min, 'lon_seconds' => $sec, 'east_or_west' => $hemisph);
    }

    public function dmsToDec($deg, $min, $sec, $hemisph) {
        if ($deg == null || $min == null || $sec == null) {
            return null;
        }
        $modifier = ($hemisph == 'S' || $hemisph == 'W') ? -1 : 1;
        return $modifier * ($deg + $min / 60 + $sec / 3600);
    }
    
    /**
     * Sets nulls to fields not associated with the type of publication
     * @param type $publication
     * @param type $type
     */
    public function fixPublicationFields($publication) {
        $type = $publication['display_type'];
        switch ($type) {
            case '1': //journal
                $publication['publisher'] = null;
                $publication['book'] = null;
                $publication['editors'] = null;
                break;
            case '2':
                $publication['volume'] = null;
                $publication['issue'] = null;
                $publication['publication_std_form'] = null;
                $publication['publication_id_ipni'] = null;
                $publication['book'] = null;
                break;
            case '3':
                $publication['volume'] = null;
                $publication['issue'] = null;
                $publication['publication_std_form'] = null;
                $publication['publication_id_ipni'] = null;
                break;
            default:
                break;
        }
        return $publication;
    }

}
