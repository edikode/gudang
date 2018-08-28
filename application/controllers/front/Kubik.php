<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Kubik extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kubik_model');
    }

    /*
     * Listing of kubik
     */
    function index()
    {
        $data['kubik'] = $this->Kubik_model->get_all_kubik();

        $data['_view'] = 'kubik/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new kubik
     */
    function add()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $params = array(
            'id' => $this->input->post('id'),
            'satum' => $this->input->post('satum'),
    				'satutigam' => $this->input->post('satutigam'),
            );

            $kubik_id = $this->Kubik_model->add_kubik($params);
            redirect('kubik/index');
        }
        else
        {
            $data['_view'] = 'kubik/add';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Editing a kubik
     */
    function edit($id)
    {
        // check if the kubik exists before trying to edit it
        $data['kubik'] = $this->Kubik_model->get_kubik($id);

        if(isset($data['kubik']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)
            {
                $params = array(
					'satum' => $this->input->post('satum'),
					'satutigam' => $this->input->post('satutigam'),
                );

                $this->Kubik_model->update_kubik($id,$params);
                redirect('kubik/index');
            }
            else
            {
                $data['_view'] = 'kubik/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The kubik you are trying to edit does not exist.');
    }

    /*
     * Deleting kubik
     */
    function remove($id)
    {
        $kubik = $this->Kubik_model->get_kubik($id);

        // check if the kubik exists before trying to delete it
        if(isset($kubik['id']))
        {
            $this->Kubik_model->delete_kubik($id);
            redirect('kubik/index');
        }
        else
            show_error('The kubik you are trying to delete does not exist.');
    }

}
