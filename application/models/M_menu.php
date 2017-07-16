<?php
class M_user extends CI_Model {
        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        public function get_drawer()
        {
                $this->db->select('*');
                $this->db->where("drawer=1");
                $query = $this->db->get('tb_menu');
                return $query->result();
        }
        public function get_banner()
        {
                $this->db->select('*');
                $this->db->where("banner=1");
                $query = $this->db->get('tb_menu');
                return $query->result();
        }



}
?>