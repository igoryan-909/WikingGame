<?php
/**
 * @автор Ivanoff
 * @описание файла: 
 * @изменен 24.1.2011
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class lib_auth {
    
    public function set_temp_userdata($user_parameter, $user_value)
    {
        $CI = &get_instance();
        $CI->session->set_userdata($user_parameter, $user_value);
    }
    
    public function set_registration_userdata()
    {
        $CI = &get_instance();
        $user_data = array(
                        'user_name'       => $CI->session->userdata('user_name'),
                        'user_password'   => $CI->session->userdata('user_password'),
                        'user_gender'     => $CI->session->userdata('user_gender')
                        );
        $CI->crud->add(USERS_TABLE, $user_data);
        $user_id = $CI->db->insert_id();
        $user_data = array(
                        'user_parameter_user_id'     => $user_id,
                        'user_parameter_strong'      => 6,
                        'user_parameter_armor'       => 6,
                        'user_parameter_intuition'   => 6,
                        'user_parameter_agility'     => 6,
                        'user_parameter_endurance'   => 6,
                        'user_parameter_gold'        => 0,
                        'user_parameter_silver'      => 10000,
                        );
        $CI->crud->add(GAME_USERS_PARAMETERS_TABLE, $user_data);
        $user_data = array(
                        'users_enhancement_user_id'     => $user_id,
                        'users_enhancement_strong'      => 50,
                        'users_enhancement_armor'       => 50,
                        'users_enhancement_intuition'   => 50,
                        'users_enhancement_agility'     => 50,
                        'users_enhancement_endurance'   => 50
                        );
        $CI->crud->add(GAME_USERS_ENHANCEMENTS_TABLE, $user_data);
        $user_data = array
                            (
                        'user_name'       => '',
                        'user_password'   => '',
                        'user_gender'     => ''
                            );
        $CI->session->unset_userdata($user_data);
    }
    
    public function authorize($user_name, $user_password)
    {
        $CI = &get_instance();
        $user_data = array
                            (
                        'user_name' => $user_name,
                        'user_password' => $user_password
                            );
        $user = $CI->crud->get(USERS_TABLE, $user_data);
        if(!empty($user))
        {
            $user_id = $user[0]['user_id'];
            $this->set_hash_user($user_id, $user_name , $user_password);
            return TRUE;
        } else return FALSE;
    }
    
    public function set_hash_user($user_id, $user_name , $user_password) {
        $CI = &get_instance();
		//Формируем хеш
        $session_data = array
                            (
                            'user_id'        => $user_id,
                            'user_logined'   => 'ok',
                            'user_hash'      => md5($CI->config->item('encryption_key') . $user_name . $user_password)
                            );
        $CI->session->set_userdata($session_data);
	}
    
    public function get_hash_user($user_name, $user_password) {
        $CI = &get_instance();
        return md5($CI->config->item('encryption_key') . $user_name . $user_password);
	}
    
    public function unset_hash_user()
    {
        $CI = &get_instance();
        $session_data = array
                            (
                            'user_id'        => '',
                            'user_logined'   => '',
                            'user_hash'      => ''
                            );
        $CI->session->unset_userdata($session_data);
    }
    
    public function check_user($id) {
        $CI = &get_instance();
        $user_data = $CI->crud->get(USERS_TABLE, array('user_id' => $id));
        if (($CI->session->userdata('user_logined')=='ok') && ($CI->session->userdata('user_hash') == $this->get_hash_user($user_data[0]['user_name'], $user_data[0]['user_password']))) {
            return true;
        } else {
            return false;
        }
    }
}
?>
