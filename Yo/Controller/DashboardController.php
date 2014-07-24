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

App::uses('YoAppController', 'Yo.Controller');

class DashboardController extends YoAppController {
    
    public $components = array('Yo.Yo');
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow();
    }
    
    public function index() {
        
    }
    
    public function user() {
        $this->autoRender = false;
        if (!$this->request->is('ajax')) {
            return;
        }
        if ($this->request['url']['username']) {
            $res = $this->Yo->user($this->request['url']['username']);
        }
        
        return $res;
    }
    
    public function getSubscribers() {
        $this->autoRender = false;
        if (!$this->request->is('ajax')) {
            return;
        }
        $subs = Cache::read('Yo.subs');
        if ($subs !== false) {
            return $subs;
        }
        $subs = $this->Yo->subscribers();
        Cache::write('Yo.subs', $subs);
        return $subs;
    }
}