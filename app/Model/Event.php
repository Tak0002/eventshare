<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

class Event extends AppModel {
    public $recursive = 2;
    public $name = 'Event';
    public $validate = array(
        'name' => array(
            'rule' => array('between',2,30),
            'required' => true,
            'message' => 'イベント名は30文字以下で入力してください',
        ),
        'body' => array(
            'rule' => array('checkByte',1024000),
            'required' => true,
            'message' => 'イベント内容を1MB以内で入力してください',
        ),
        'wanted' => array(
            'rule' => array('naturalNumber'),
            'message' => '数字を入力してください'
        ),
        'wanted_max' => array(
            'rule' => array('naturalNumber'),
            'required' => false,
            'allowEmpty' => true,
            'message' => '数字を入力してください'
        ),
       'event_date' => array(
            'rule' => 'date'
        ),
        'event_time' => array(
            'rule' => array('custom','/(?:(2[0-3])|(1[0-9])|([0-9])):([0-5][0-9])/')
        ),
        'event_end' => array(
            'rule' => array('custom','/(?:(2[0-3])|(1[0-9])|([0-9])):([0-5][0-9])/')
        ),
        'prefecture' => array(
            'ruleName' => array(
                'rule' => array('range', 0, 48),
                'required' => true,
                'message' => '都道府県を正しく入力してください'
            ),
            'ruleName2' => array(
                'rule' => array('naturalNumber'),
                'message' => '都道府県を正しく入力してください'
            ),
       ),
       'place_name' => array(
            'rule' => array('between',1,50),
            'required' => true,
            'message' => '会場名は50文字以下で入力してください',           
       ),
       'place_address' => array(
            'rule' => array('between',1,120),
            'required' => true,
            'message' => '住所は120文字以下で入力してください',           
       ),
      'place_latitude' => array(
           'rule' => array('decimal',true),
           'required' => true,
       ),
      'place_longitude' => array(
           'rule' => array('decimal',true),
           'required' => true,
       )
       
    );
    public $hasMany = array('EventComment' => array(
        'dependent' => true
    ));
    public $hasAndBelongsToMany = array(
        'Tag' => array('dependent' => true),
        'User' => array('dependent'=> true)
        );

    public function checkByte($check,$limit) {
        if(strlen($check['body'])<$limit){
            return true;
        }
        return false;
    }

}