<?php
class M_user extends CI_Model {
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
        public function get_a_user($id)
        {
                $this->db->select('HEX(id_user) as id,username,nama_lengkap,email,no_telp,alamat');
                $this->db->where("hex(id_user)='$id'");
                $query = $this->db->get('tb_user');
                return $query->result();
        }
        public function get_login($username,$password)
        {
                $this->db->select('HEX(id_user) as id,username,nama_lengkap,email,no_telp,alamat');
                $this->db->where("username='$username'");
                $this->db->where("password='".md5($password)."'");
                $query = $this->db->get('tb_user');
                return $query->result();
        }
        public function get_login_facebook($id_facebook)
        {
                $this->db->select('HEX(id_user) as id,username,nama_lengkap,email,no_telp,alamat');
                $this->db->where("id_facebook='$id_facebook'");
                $query = $this->db->get('tb_user');
                return $query->result();
        }

        public function insert_user($data)
        {
                //print_r($data);die();
                $q="INSERT INTO `tb_user`(`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `alamat`, `aktif`) VALUES  (
                        UNHEX('".$data['id_user']."'), 
                        '".$data['username']."', 
                        '".$data['password']."', 
                        '".$data['nama_lengkap']."', 
                        '".$data['email']."', 
                        '".$data['no_telp']."', 
                        '".$data['alamat']."',  
                        1       
                        )";
                $this->db->query($q);
                if ($this->db->affected_rows()) {
                        $this->db->select('HEX(id_user) as id,username,nama_lengkap,email,no_telp,alamat');
                        $this->db->where('HEX(id_user)="'.$data['id_user'].'"');
                        $hasil=$this->db->get('tb_user')->result();
                } else {
                        $hasil=0;
                }
                
                return  $hasil;
        }
        public function insert_user_facebook($data)
        {
                //print_r($data);die();
                $q="INSERT INTO `tb_user`(`id_user`, `username`, `password`,id_facebook, `aktif`) VALUES  (
                        UNHEX('".$data['id_user']."'), 
                        '".$data['username']."', 
                        '".$data['id_facebook']."',   
                        1       
                        )";
                $this->db->query($q);
                if ($this->db->affected_rows()) {
                        $this->db->select('HEX(id_user) as id,username,id_facebook');
                        $this->db->where('HEX(id_user)="'.$data['id_user'].'"');
                        $hasil=$this->db->get('tb_user')->result();
                } else {
                        $hasil=0;
                }
                
                return  $hasil;
        }

        public function update_user()
        {
                //$this->title    => $_POST['title'];
                //$this->content  => $_POST['content'];
                $this->date     = time();

                $this->db->update($table, $this, array('id' => $_POST['id']));
        }


}
?>