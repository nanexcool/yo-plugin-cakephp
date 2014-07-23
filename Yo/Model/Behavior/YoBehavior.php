<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('ModelBehavior', 'Model');
App::uses('YoDispatcher', 'Yo.Lib');

class YoBehavior extends ModelBehavior {
    
    protected $_yo;
    
    protected $_defaults = array(
        'afterSave' => true,
        'afterUpdate' => false,
        'afterDelete' => false,
        'username' => ''
    );
    
    public function setup(Model $model, $config = array()) {
        /*if (!isset($this->settings[$model->alias])) {
            $this->settings[$model->alias] = array(
                
            );
        }*/
        $settings = $config + $this->_defaults;
        $this->settings[$model->alias] = $settings;
        
        $this->_yo = new YoDispatcher();
    }
    
    public function afterSave(Model $model, $created, $options = array()) {
        extract($this->settings[$model->alias]);
        
        // New record
        if ($afterSave && $created) {
            if ($username !== '') {
                $this->_yo->user($username);
            }
            else {
                $this->_yo->all();
            }
        }
        
        // Updated record
        if ($afterUpdate && !$created) {
            if ($username !== '') {
                $this->_yo->user($username);
            }
            else {
                $this->_yo->all();
            }
        }
    }
    
    public function afterDelete(Model $model) {
        extract($this->settings[$model->alias]);
        
        if ($afterDelete) {
            if ($username !== '') {
                $this->_yo->user($username);
            }
            else {
                $this->_yo->all();
            }
        }
    }
    
}