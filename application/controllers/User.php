<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_user');
    }

    function make_GUID(){
            $node=openssl_random_pseudo_bytes(16);
            assert(strlen($node) == 16);
            $node[6] = chr(ord($node[6]) & 0x0f | 0x40); // set version to 0100
            $node[8] = chr(ord($node[8]) & 0x3f | 0x80); // set bits 6-7 to 10
            return strtoupper(vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($node), 4)));
    }
    public function add_user()
    {
        $this->load->view('add_user');
    }
    public function login_v()
    {
        $this->load->view('login');
    }
    public function login_f()
    {
        $this->load->view('login_f');
    }
    public function login()
    {
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        if($username && $password){
            $hasil=$this->M_user->get_login($username,$password);
            //print_r($hasil);
            if($hasil){
                echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array('status' => 'gagal','alasan' => 'data not found', ), JSON_PRETTY_PRINT);
            }
        }else{
            echo json_encode(array('status' => 'gagal','alasan' => 'empty username or password', ), JSON_PRETTY_PRINT);
        }
    }
    public function login_facebook()
    {
        $id_facebook=$this->input->post('id_facebook');
        if($id_facebook){
            $hasil=$this->M_user->get_login_facebook($id_facebook);
            //print_r($hasil);
            if($hasil){
                echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array('status' => 'gagal','alasan' => 'data not found', ), JSON_PRETTY_PRINT);
            }
        }else{
            echo json_encode(array('status' => 'gagal','alasan' => 'empty id', ), JSON_PRETTY_PRINT);
        }
    }
    public function get_a_user()
    {
        $id=$this->input->post('id_user');
        if($id){
            $hasil=$this->M_user->get_a_user($id);
            //print_r($hasil);
            if($hasil){
                echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array('status' => 'gagal','alasan' => 'data not found', ), JSON_PRETTY_PRINT);
            }
        }else{
            echo json_encode(array('status' => 'gagal','alasan' => 'empety id', ), JSON_PRETTY_PRINT);
        }
    }
    public function insert_user()
    {
        $data=array(
                'id_user'           => $this->make_GUID(),
                'username'          => $this->input->post('username'),
                'password'          => md5($this->input->post('password')),
                'nama_lengkap'      => $this->input->post('nama_lengkap'),
                'email'             => $this->input->post('email'),
                'no_telp'           => $this->input->post('no_telp'),
                'alamat'            => $this->input->post('alamat'),
                'aktif'             =>1
                );
        $hasil=$this->M_user->insert_user($data);
        if($hasil){
            echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
        }else{
            echo json_encode(array('status' => 'gagal','alasan' => 'fail insert data', ), JSON_PRETTY_PRINT);
        }

    }
    public function insert_user_facebook()
    {
        $data=array(
                'id_user'           => $this->make_GUID(),
                'username'          => $this->input->post('username'),
                'id_facebook'       => $this->input->post('id_facebook'),
                'aktif'             =>1
                );
        $hasil=$this->M_user->insert_user_facebook($data);
        if($hasil){
            echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
        }else{
            echo json_encode(array('status' => 'gagal','alasan' => 'fail insert data', ), JSON_PRETTY_PRINT);
        }

    }
	public function update_user()
	{

	}
	public function nonaktif_user()
	{

	}
	public function aktif_user()
	{

	}
}
