<?php
class modelLogin extends CI_Model
{       
public function getUser($username)
    {
        $this->db->where('username',$username);
        return $this->db->get('dd_user')->row_array();
    }
}