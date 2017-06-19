<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP AnnoSysComponent
 * @author Matus
 */
class AnnoSysComponent extends Component {

    public function getAnnotations($authority, $namespace, $objectId) {
        if (!$authority) {
            throw new InvalidArgumentException(__('Invalid parameter authority'));
        }
        if (!$namespace) {
            throw new InvalidArgumentException(__('Invalid argument namespace'));
        }
        if (!$objectId) {
            throw new InvalidArgumentException(__('Invalid argument objectID'));
        }
        $url = "https://annosys.bgbm.fu-berlin.de/AnnoSysTest/services/records/$authority/$namespace/$objectId/annotations";
        $response = null;
        if (file_exists($url)) {
            $response = file_get_contents($url);
        }
        return $response;
    }

}
