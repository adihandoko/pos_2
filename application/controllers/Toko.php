<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class toko extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_toko');
        $this->load->model('M_user');
    }

	public function get_all_toko_user()
	{
		$id_user=$this->input->get('id_user');
		if ($id_user) {
			$hasil=$this->M_toko->get_all_toko_user($id_user);
			if ($hasil) {
	            echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
			} else {
                echo json_encode(array('status' => 'gagal','alasan' => 'data not found', ), JSON_PRETTY_PRINT);
			}
			
		}
		else{
			echo json_encode(array('status' => 'gagal','alasan' => 'empety id user', ), JSON_PRETTY_PRINT);
		}
	}
	public function add_toko()
	{
		$this->load->view('add_toko');
	}
	public function insert_toko()
	{
		if (!$this->input->post('id_user')) {
			echo json_encode(array('status' => 'gagal','alasan' => 'empty id_user', ), JSON_PRETTY_PRINT);
		}elseif(!$this->input->post('nama_toko')){
			echo json_encode(array('status' => 'gagal','alasan' => 'empty nama_toko', ), JSON_PRETTY_PRINT);
		}elseif(!$this->input->post('username')){
			echo json_encode(array('status' => 'gagal','alasan' => 'empty username', ), JSON_PRETTY_PRINT);
		}elseif(!$this->input->post('password')){
			echo json_encode(array('status' => 'gagal','alasan' => 'empty password', ), JSON_PRETTY_PRINT);
		}elseif(!$this->input->post('no_telp')){
			echo json_encode(array('status' => 'gagal','alasan' => 'empty no_telp', ), JSON_PRETTY_PRINT);
		}else {
	        $data=array(
	                'id_toko'        	=> make_GUID(),
	                'nama_toko'			=> $this->input->post('nama_toko'),
	                'id_user'			=> $this->input->post('id_user'),
	                'username'         	=> $this->input->post('username'),
	                'password'			=> md5($this->input->post('password')),
	                'alamat'            => $this->input->post('alamat'),
	                'no_telp'           => $this->input->post('no_telp'),
	                'aktif'				=>1
	                );
	        //print_r($data);
	        $hasil=$this->M_toko->insert_toko($data);
	        if($hasil){
	            echo json_encode(array('status' => 'berhasil','data' => $hasil, ), JSON_PRETTY_PRINT);
	        }else{
	            echo json_encode(array('status' => 'gagal','alasan' => 'fail insert data', ), JSON_PRETTY_PRINT);
	        }
		}
		

	}
	public function update_toko()
	{

	}
	public function nonaktif_toko()
	{

	}
	public function aktif_toko()
	{

	}
}
