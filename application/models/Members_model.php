<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members_model extends CI_Model
{
    public function get_members($firstname, $surname, $email)
    {
        $this->db->flush_cache(); // Is not really required for this project, but good to have
                                  // for subsequent calls to the same model function with
                                  // different parameters in order not to get unexpected results.
        if (!empty($firstname)) {
            $this->db->like('firstname', $firstname);
        }
        if (!empty($surname)) {
            $this->db->like('surname', $surname);
        }
        if (!empty($email)) {
            $this->db->like('email', $email);
        }
        $this->db->order_by('Id', 'ASC');
        $result = $this->db->get('members')->result();
        return $result;
    }

}
