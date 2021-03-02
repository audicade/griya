<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property extends CI_Model {
 
  function getImage($postData=array()){
 
    $response = array();
 
    if(isset($postData['id']) ){
 
      // Select record
      $this->db->select('*');
      $this->db->where('id', $postData['id']);
      $records = $this->db->get('user_property');
      $response = $records->result_array();
 
    }
 
    return $response;
  }

}