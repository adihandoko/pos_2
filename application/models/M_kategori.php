<?php
class M_kategori extends CI_Model {


        public function get_last_ten_entries()
        {
                $query = $this->db->get($table, 10);
                return $query->result();
        }
        public function get_kategori_user($id_user)
        {
                $this->db->select('id_kategori,hex(id_user) as id_user,kategori');
                $this->db->where('hex(id_user)', $id_user);
                $query = $this->db->get('tb_kategori_parent');
                return $query->result();
        }
        public function get_sub_kategori_1_user()
        {       $id_user=$this->input->post('id_user');
                $id_kategori_parent=$this->input->post('id_kategori_parent');
                $this->db->select('id_kategori,hex(id_user) as id_user,kategori,id_kategori_children_1');
                $this->db->where('hex(id_user)', $id_user);
                $this->db->where('(id_kategori_parent)', $id_user);
                $query = $this->db->get('tb_kategori_children_1');
                return $query->result();
        }
        public function get_a_kategori($id_kategori)
        {
                $this->db->select('id_kategori,hex(id_user) as id_user,kategori');
                $this->db->where('id_kategori', $id_kategori);
                $query = $this->db->get('tb_kategori_parent');
                return $query->result();
        }

        public function insert_kategori_parent($data)
        {
                //print_r($data);die();
                $q="INSERT INTO `tb_kategori_parent`(`id_user`, `kategori`, `aktif`) VALUES (
                        UNHEX('".$data['id_user']."'), 
                        '".$data['kategori']."',  
                        1       
                        )";
                $this->db->query($q);
                return  $this->db->affected_rows();
        }
        public function insert_kategori_child_1($data)
        {
                //print_r($data);die();
                $q="INSERT INTO `tb_kategori_children_1`(`id_user`, `kategori`, id_kategori_parent, `aktif`) VALUES (
                        UNHEX('".$data['id_user']."'), 
                        '".$data['kategori']."', 
                        '".$data['id_kategori_parent']."',  
                        1       
                        )";
                $this->db->query($q);
                return  $this->db->affected_rows();
        }

        public function update_entry()
        {
                $this->title    = $_POST['title'];
                $this->content  = $_POST['content'];
                $this->date     = time();

                $this->db->update($table, $this, array('id' => $_POST['id']));
        }

}
?>