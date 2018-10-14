<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function get_members()
    {
        foreach (['firstname', 'surname', 'email'] as $param) {
            $param_value = '';
            if (!empty($_POST[$param])) {
                $param_value = $_POST[$param];
            } elseif (!empty($_GET[$param])) {
                $param_value = $_GET[$param];
            }
            $$param = $param_value;
        }
        $this->load->model('members_model');
        $members = $this->members_model->get_members($firstname, $surname, $email);
        echo json_encode($members);
    }

}
