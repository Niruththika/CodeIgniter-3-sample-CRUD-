<?php
class Crud_model extends CI_Model
{
    function saverecords($data)
    {
        $this->db->insert('crud',$data);
        return true;
    }

    public function display_records()
    {
        $query = $this->db->get('crud');
        return $query->result();
    }

    public function displayrecordsById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('crud');
        return $query->result();
    }

    public function update_records($first_name,$last_name,$email,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('crud', array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email
        ));
    }

    public function deleteRecordById($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('crud');
        return true;
    }
}
?>