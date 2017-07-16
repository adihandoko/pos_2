<?php
class M_toko extends CI_Model {
        public function __construct()
        {
                parent::__construct();
                // Your own constructor code
        }

        public function get_last_ten_entries()
        {
                //$query => $this->db->get($table, 10);
                return $query->result();
        }
        public function get_all_toko_user($id_user)
        {
                $this->db->select('HEX(id_toko) as id_toko,nama_toko,username,no_telp,alamat');
                $this->db->where('hex(id_user)="'.$id_user.'"');
                $query = $this->db->get('tb_toko');
                return $query->result();
        }
        public function get_all_toko()
        {
                $this->db->where('hex(id_toko)="'.$this->input->get('id').'"');
                $query = $this->db->get('tb_toko');
                return $query->result();
        }

        public function insert_toko($data)
        {
                //print_r($data);die();
                $q="INSERT INTO `tb_toko`(`id_toko`,`id_user`, `nama_toko`, `username`, `password`, `no_telp`, `alamat`, `aktif`) VALUES  (
                        UNHEX('".$data['id_toko']."'), 
                        UNHEX('".$data['id_user']."'), 
                        '".$data['nama_toko']."',  
                        '".$data['username']."', 
                        '".$data['password']."', 
                        '".$data['no_telp']."', 
                        '".$data['alamat']."',  
                        1       
                        )";
                $this->db->query($q);
                if ($this->db->affected_rows()) {
                        $this->db->select('HEX(id_toko) as id_toko,HEX(id_user) as id_user,nama_toko,username,no_telp,alamat');
                        $this->db->where('HEX(id_toko)="'.$data['id_toko'].'"');
                        $hasil=$this->db->get('tb_toko')->result();
                } else {
                        $hasil=0;
                }
                
                return  $hasil;
        }

        public function update_toko()
        {
                //$this->title    => $_POST['title'];
                //$this->content  => $_POST['content'];
                $this->date     = time();

                $this->db->update($table, $this, array('id' => $_POST['id']));
        }


}
?>