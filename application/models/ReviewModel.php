<?php
class ReviewModel extends CI_Model {

    public function insert_review($data) {
        return $this->db->insert('reviews', $data);
    }

    public function get_reviews_by_product($product_id) {
        $this->db->where('product_id', $product_id);
        $query = $this->db->get('reviews');
        return $query->result_array();
    }

    public function get_all_reviews() {
        $query = $this->db->get('reviews'); // Get all reviews
        return $query->result_array(); // Return as an array
    }
    
}
?>
