<?php

    class User extends CI_controller{

        public function __construct(){
            parent::__construct();
            $this->load->model('User_model');
            
        }


        function index(){
            
            $users= $this->User_model->all();
            $data= array();
            $data['users'] = $users;
            $this->load->view('list',$data);

        }
        
        function create(){
            

            // $this->form_validation->set_rules('name', 'Name', 'required');
            // $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            // if($this->form_validation->run() == false){
            //     $this->load->view('create');
            // } else{
            //     $formArray= array();
            //     $formArray['name'] = $this->input->post('name');
            //     $formArray['email'] = $this->input->post('email');
            //     $formArray['created_at'] = date('Y-m-d');
            //     $this->User_model->create($formArray);
            //     $this->session->set_flashdata('success', 'Record added Successfully!');
            //     redirect(base_url().'user/index');
            // }


            $html = $this->load->view('create','',true);
            $response['html'] = $html;
            echo json_encode($response);
            
        }

        function save(){
            

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if($this->form_validation->run() == true){
                 

            $formArray= array();
                $formArray['name'] = $this->input->post('name');
                $formArray['email'] = $this->input->post('email');
                $formArray['created_at'] = date('Y-m-d');
                $this->User_model->create($formArray);
            
                $response['status'] = 1;
            } else{
                $response['status'] = 0;
                $response['name'] = strip_tags(form_error('name'));
                $response['email'] = strip_tags(form_error('email'));
               
            }
            echo json_encode($response);
            
        }


        function edit($userId){
            
            $user = $this->User_model->getUser($userId);
            $data= array();
            $data['user']= $user;

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if($this->form_validation->run() == false){
                $this->load->view('edit',$data);
            } else{
                $formArray= array();
                $formArray['name'] = $this->input->post('name');
                $formArray['email'] = $this->input->post('email');
                $this->User_model->updateUser($userId,$formArray);
                $this->session->set_flashdata('success', 'Record Updated Successfully!');
                redirect(base_url().'user/index');
            }
           
        }

        function delete($userId){
           
           $user = $this->User_model->getUser($userId);
           if(empty($user)){
            $this->session->set_flashdata('failure', 'Record Not Found In Database!');
            redirect(base_url().'user/index');
           }

           $this->User_model->deleteUser($userId);
           $this->session->set_flashdata('success', 'Record Deleted Successfully!');
           redirect(base_url().'user/index');
        }


       
    }
?>