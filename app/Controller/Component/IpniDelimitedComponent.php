<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP IpniDelimitedComponent
 * @author Matus
 */
class IpniDelimitedComponent extends Component {

    public function resultsToArray($string) {
        $r = array();
        $labels = array();
        $lines = explode("\n", $string);
        $i = 0;
        foreach ($lines as $line) {
            if (empty($line)) {
                break;
            }
            $i++;
            $t = explode('%', $line);
            if ($i == 1) {
                $labels = $t;
                continue;
            }
            $r[] = array_combine($labels, array_map('trim', $t));
        }
        return $r;
    }

}
