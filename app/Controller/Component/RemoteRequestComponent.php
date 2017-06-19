<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * CakePHP RemoteRequestComponent
 * @author Matus
 */
class RemoteRequestComponent extends Component {

    public $components = array();

    public function sendQuery($url, $params = array()) {
        $query = http_build_query($params);
        if (!empty($params)) {
            $url .= ($url[count($url) - 1] == '?' ? '' : '?'); //append '?' to the end of url if not present
        }
        $curl = curl_init($url . $query);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($code != 200) {
            $response = null;
        }
        curl_close($curl);
        return $response;
    }

}
