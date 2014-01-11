<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('game');
    }
    
    public function index()
    {
        $data['title'] = 'Добро пожаловать';
        if(!$this->lib_auth->check_user($this->session->userdata('user_id'))) $this->load->view('join/user_name', $data);
        else $this->load->view('game/game', $data);
    }
    
    public function join($step = FALSE)
    {
        if($this->lib_auth->check_user($this->session->userdata('user_id'))) redirect('');
        $this->load->library('form_validation');
        if(!$step)
        {
            
        }
        switch($step)
        {
            case 'password' : 
                $rules = array(
                            array(
                                'field' => 'user_name',
                                'label' => $this->lang->line('user_name'),
                                'rules' => 'required|min_length[3]|max_length[20]|uniq_user_name'
                                )
                            );
                $this->form_validation->set_rules($rules);
                if($this->form_validation->run())
                {
                    $this->lib_auth->set_temp_userdata('user_name', trim($_POST['user_name']));
                    $data['title'] = 'Добро пожаловать';
                    $this->load->view('join/user_password', $data);
                } else
                {
                    $data['title'] = 'Добро пожаловать';
                    $this->load->view('join/user_name', $data);
                }
                break;
            case 'gender' :
                $rules = array(
                            array(
                                'field' => 'user_password',
                                'label' => $this->lang->line('user_password'),
                                'rules' => 'required|min_length[6]|max_length[20]'
                                )
                            );
                $this->form_validation->set_rules($rules);
                if($this->form_validation->run())
                {
                    $data['title'] = 'Добро пожаловать';
                    $this->lib_auth->set_temp_userdata('user_password', md5(trim($this->config->item('encryption_key') . $_POST['user_password'])));
                    $this->load->view('join/user_gender', $data);
                } else
                {
                    $data['title'] = 'Добро пожаловать';
                    $this->load->view('join/user_password', $data);
                }
                break;
            case 'send' :
                $rules = array(
                            array(
                                'field' => 'user_gender',
                                'label' => $this->lang->line('user_gender'),
                                'rules' => 'required'
                                )
                            );
                $this->form_validation->set_rules($rules);
                if($this->form_validation->run())
                {
                    $data['title'] = 'Успешно';
                    $this->lib_auth->set_temp_userdata('user_gender', $_POST['user_gender']);
                    $this->lib_auth->set_registration_userdata();
                    $this->load->view('join/send', $data);
                } else
                {
                    $this->load->view('join/user_gender', $data);
                }
        }
    }
    
    public function authorize($send = FALSE)
    {
        if($send)
        {
            if($this->lib_auth->authorize($_POST['user_name'], md5(trim($this->config->item('encryption_key') . $_POST['user_password'])))) redirect('user');
            else
            {
                $data['error'] = $this->lang->line('incorrect_login');
                $this->load->view('authorize/authorize',$data);
            }
        } else
        {
            if($this->lib_auth->check_user($this->session->userdata('user_id'))) redirect('user');
            else $this->load->view('authorize/authorize');
        }
    }
    
    public function logout()
    {
        $this->lib_auth->unset_hash_user();
        redirect('');
    }
    
    public function user($function = FALSE, $parameter = FALSE)
    {
        if(!$this->lib_auth->check_user($this->session->userdata('user_id'))) redirect('authorize');
        $where = array
                    (
                    'user_id' => $this->session->userdata('user_id')
                    );
        $user_data = $this->crud->get(USERS_TABLE, $where);
        if($function)
        {
            switch($function)
            {
                case 'enhancement' :
                    $where = array
                                (
                                'users_enhancement_user_id' => $this->session->userdata('user_id')
                                );
                    $data_enhancements = $this->crud->get(GAME_USERS_ENHANCEMENTS_TABLE, $where);
                    $where = array
                                (
                                'user_parameter_user_id' => $this->session->userdata('user_id')
                                );
                    $data_parameters = $this->crud->get(GAME_USERS_PARAMETERS_TABLE, $where);
                    if($parameter)
                    {
                        switch($parameter)
                        {
                            case 'strong' :
                                if($this->lib_game->set_user_level($parameter)) redirect('user/' . $function);
                                else redirect('user/' . $function);
                                break;
                        }
                    }
                    $this->load->view('game/user_enhancement', $data_enhancements[0] + $data_parameters[0] + $user_data[0]);
                    break;
            }
        } else
        {
            $this->load->view('game/user', $user_data[0]);
        }
    }
}