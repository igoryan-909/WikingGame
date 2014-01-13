<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller
{
    private $data = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('game');
        if($this->lib_auth->check_user($this->session->userdata('user_id')))
        {
            $this->lib_game->check_crusade_limit();
            $this->lib_game->crusade_resources();
        }
    }
    
    public function index()
    {
        if(!$this->lib_auth->check_user($this->session->userdata('user_id')))
		{
			$this->data['title'] = $this->lang->line('user_registration');
			$this->lib_view->output(array('main_header', 'join/user_name', 'main_footer'), $this->data);
		}
        else
        {
			$this->data['title'] = $this->lang->line('welcome');
            $this->lib_view->output(array('main_header', 'game/game', 'main_footer'), $this->data);
        }
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
                    $this->data['title'] = $this->lang->line('user_password');
                    $this->lib_view->output(array('main_header', 'join/user_password', 'main_footer'), $this->data);
                } else
                {
                    $this->data['title'] = $this->lang->line('user_registration');
                    $this->lib_view->output(array('main_header', 'join/user_name', 'main_footer'), $this->data);
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
                    $this->data['title'] = $this->lang->line('user_gender');
                    $this->lib_auth->set_temp_userdata('user_password', md5(trim($this->config->item('encryption_key') . $_POST['user_password'])));
                    $this->lib_view->output(array('main_header', 'join/user_gender', 'main_footer'), $this->data);
                } else
                {
                    $this->data['title'] = $this->lang->line('user_password');
                    $this->lib_view->output(array('main_header', 'join/user_password', 'main_footer'), $this->data);
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
                    $this->data['title'] = 'Успешно';
                    $this->lib_auth->set_temp_userdata('user_gender', $_POST['user_gender']);
                    $this->lib_auth->set_registration_userdata();
                    $this->lib_view->output(array('main_header', 'join/send', 'main_footer'), $this->data);
                } else
                {
					$this->data['title'] = $this->lang->line('user_gender');
                    $this->lib_view->output(array('main_header', 'join/user_gender', 'main_footer'), $this->data);
                }
        }
    }
    
    public function authorize($send = FALSE)
    {
		if($this->lib_auth->check_user($this->session->userdata('user_id'))) redirect('');
		$this->data['title'] = $this->lang->line('authorize');
        if($send == 'send')
        {
            if($this->lib_auth->authorize($_POST['user_name'], md5(trim($this->config->item('encryption_key') . $_POST['user_password'])))) redirect('');
            else
            {
                $this->data['error'] = $this->lang->line('incorrect_login');
                $this->lib_view->output(array('main_header', 'authorize/authorize', 'main_footer'), $this->data);
            }
        } else
        {
            $this->lib_view->output(array('main_header', 'authorize/authorize', 'main_footer'), $this->data);
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
                            case 'armor' :
                                if($this->lib_game->set_user_level($parameter)) redirect('user/' . $function);
                                else redirect('user/' . $function);
                                break;
                            case 'intuition' :
                                if($this->lib_game->set_user_level($parameter)) redirect('user/' . $function);
                                else redirect('user/' . $function);
                                break;
                            case 'agility' :
                                if($this->lib_game->set_user_level($parameter)) redirect('user/' . $function);
                                else redirect('user/' . $function);
                                break;
                            case 'endurance' :
                                if($this->lib_game->set_user_level($parameter)) redirect('user/' . $function);
                                else redirect('user/' . $function);
                                break;
                        }
                    }
                    $this->data = $data_enhancements[0] + $data_parameters[0] + $user_data[0];
					$this->data['title'] = $this->lang->line('enhancement');
                    $this->lib_view->output(array('main_header', 'game/user_enhancement', 'main_footer'), $this->data);
                    break;
            }
        } else
        {
			$this->data = $user_data[0];
			$this->data['title'] = $this->lang->line('hero');
            $this->lib_view->output(array('main_header', 'game/user', 'main_footer'), $this->data);
        }
    }
    public function crusade($go = FALSE)
    {
        if(!$this->lib_auth->check_user($this->session->userdata('user_id'))) redirect('authorize');
        $this->data = $this->lib_game->get_user_crusade_data();
		$this->data['title'] = $this->lang->line('crusade');
        if($go == 'go')
        {
            switch($_POST['crusade_time'])
            {
                case 10 :
                    $crusade_length = $_POST['crusade_time'];
                    break;
                case 20 :
                    $crusade_length = $_POST['crusade_time'];
                    break;
                default :
                    $crusade_length = FALSE;
            }
            if($crusade_length && !$this->data['elapsed_time'])
            {
                $time_start = time();
                $time_end = $time_start + ($crusade_length * 60);
                $this->lib_game->user_crusade_start($time_start, $time_end, $crusade_length);
            }
            redirect('crusade/');
        }
        $this->lib_view->output(array('main_header', 'game/crusade', 'main_footer'), $this->data);
    }
}