<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Bansaw1_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get bansaw1 by id
     */
    function get_bansaw1($id)
    {
        return $this->db->get_where('bansaw1',array('id'=>$id))->row_array();
    }

    /*
     * Get all bansaw1
     */
    function get_all_bansaw1($id)
    {
        return $this->db->get_where('bansaw1',array('bpk_no_bpk'=>$id))->result_array();
    }

    /*
     * function to add new bansaw1
     */
    function add_bansaw1($params)
    {
        $this->db->insert('bansaw1',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update bansaw1
     */
    function update_bansaw1($id,$params)
    {
        $this->db->where('id',$id);
        $response = $this->db->update('bansaw1',$params);
        if($response)
        {
            return "bansaw1 updated successfully";
        }
        else
        {
            return "Error occuring while updating bansaw1";
        }
    }

    /*
     * function to delete bansaw1
     */
    function delete_bansaw1($id)
    {
        $response = $this->db->delete('bansaw1',array('id'=>$id));
        if($response)
        {
            return "bansaw1 deleted successfully";
        }
        else
        {
            return "Error occuring while deleting bansaw1";
        }
    }

    function get_number($id){
      $nomor = $this->db->get_where('bansaw1',array('bpk_no_bpk'=>$id));
      $no = $nomor->num_rows();
      return $no+1;
    }
}
