<?php

/*
 * The MIT License (MIT)
 *
 * Copyright 2014 Mariano Conti.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

App::uses('Component', 'Controller');

class YoComponent extends Component {

    protected $_apiKey;
    public $debug = false;
    private $urls = array(
        'all' => 'http://api.justyo.co/yoall/',
        'user' => 'http://api.justyo.co/yo/',
        'subscribers' => 'http://api.justyo.co/subscribers_count/'
    );

    public function __construct(\ComponentCollection $collection, $settings = array()) {
        parent::__construct($collection, $settings);

        Configure::load('Yo.config', 'default', false);
        $this->_apiKey = Configure::read('Yo.apiKey');
        if ($this->_apiKey === 'YOUR_API_KEY') {
            throw new InternalErrorException('Missing Yo API key. See Plugin/Yo/Config/config.php');
        }
    }

    public function user($username) {
        if ($username != '') {
            $this->processRequest($username);
        }
    }

    public function all() {
        $this->processRequest();
    }

    public function subscribers() {
        $url = $this->urls['subscribers'];

        $url .= '?api_token=' . $this->_apiKey;

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
        );

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    private function processRequest($username = '') {
        $postFields = array(
            'api_token' => $this->_apiKey
        );

        $url = $this->urls['all'];

        if ($username != '') {
            $postFields['username'] = $username;
            $url = $this->urls['user'];
        }

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            //CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postFields
        );

        $result = '';

        if (!$this->debug) {
            $curl = curl_init();
            curl_setopt_array($curl, $options);
            $result = curl_exec($curl);
            curl_close($curl);
        }

        return $result;
    }

}
