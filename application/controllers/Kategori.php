<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_kategori');
        $this->load->model('M_user');
    }
	public function get_kategori_user()
	{
		$hasil=$this->M_kategori->get_kategori_user($this->input->post('id_user'));
		if($hasil) {

        $metadata = new stdClass;
        $metadata->links = array();
        $first = new stdClass;
        $first->first = '?limit=20&offset=1';
        $metadata->links[] = $first;

        $last = new stdClass;
        $last->last = '?limit=20&offset=5';
        $metadata->links[] = $last;

        $prev = new stdClass;
        $prev->prev = '?limit=20&offset=1';
        $metadata->links[] = $prev;

        $next = new stdClass;
        $next->next = '?limit=20&offset=2';
        $metadata->links[] = $next;

        $self = new stdClass;
        $self->self = '?limit=20&offset=1';
        $metadata->links[] = $self;

			echo json_encode(array(
				'status' => 'berhasil',
				//'metadata' => $metadata,
				'data'=>$hasil), JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array('status' => 'gagal','alasan'=>'data not found',), JSON_PRETTY_PRINT);
		}
	}
	public function get_sub_kategori_1_user()
	{
		$hasil=$this->M_kategori->get_sub_kategori_1_user();
		if($hasil) {

			echo json_encode(array(
				'status' => 'berhasil',
				//'metadata' => $metadata,
				'data'=>$hasil), JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array('status' => 'gagal','alasan'=>'data not found',), JSON_PRETTY_PRINT);
		}
	}
	public function get_a_kategori()
	{
		$hasil=$this->M_kategori->get_a_kategori($this->input->post('id_kategori'));
		if($hasil) {
			echo json_encode(array('status' => 'berhasil','data'=>$hasil));
		}else{
			echo json_encode(array('status' => 'gagal','alasan'=>'data not found'));
		}
	}
	public function add_kategori()
	{
		$this->load->view('add_kategori');
	}
	public function add_sub_kategori()
	{
		$this->load->view('add_sub_kategori');
	}
	public function insert_kategori()
	{
		if ( !$this->input->post('id_user')) {
			echo json_encode(array('status' => 'gagal','alasan' => 'empty id_user', ));
		}
        if (!$this->M_user->get_a_user($this->input->post('id_user'))) {
			echo json_encode(array('status' => 'gagal','alasan' => 'User not found', ));
        }elseif ( !$this->input->post('kategori')) {
			echo json_encode(array('status' => 'gagal','alasan' => 'empty kategori', ));
		}else {
			$cek_user=$this->M_user->get_a_user($this->input->post('id_user'));
			print_r($cek_user);
			if ($cek_user) {
				$data = array(
					'id_user' => $this->input->post('id_user'),
					'kategori' => $this->input->post('kategori'), );
				$x=$this->M_kategori->insert_kategori_parent($data);
				if($x){
					echo json_encode(array('status' => 'berhasil' ));
				}else{
		            echo json_encode(array('status' => 'gagal','alasan' => 'fail insert data', ));
		        }
			}else{
		            echo json_encode(array('status' => 'gagal','alasan' => 'user not found', ));
			}
		}
		
	}
	public function insert_sub_kategori_1()
	{
		if ( !$this->input->post('id_user')) {
			echo json_encode(array('status' => 'gagal','alasan' => 'empty id_user', ));
		}elseif ( !$this->input->post('kategori')) {
			echo json_encode(array('status' => 'gagal','alasan' => 'empty kategori', ));
		}elseif ( !$this->input->post('id_kategori_parent')) {
			echo json_encode(array('status' => 'gagal','alasan' => 'empty kategori parent', ));
		}else {
			$cek_user=$this->M_user->get_a_user($this->input->post('id_user'));
			if ($cek_user) {
				$data = array(
					'id_user' => $this->input->post('id_user'),
					'kategori' => $this->input->post('kategori'),
					'id_kategori_parent' => $this->input->post('id_kategori_parent'), );
				$x=$this->M_kategori->insert_kategori_child_1($data);
				if($x){
					echo json_encode(array('status' => 'berhasil' ));
				}else{
		            echo json_encode(array('status' => 'gagal','alasan' => 'fail insert data', ));
		        }
			}else{
		            echo json_encode(array('status' => 'gagal','alasan' => 'user not found', ));
			}
		}
		
	}
	public function update_kategori()
	{

	}
	public function nonaktif_kategori()
	{

	}
	public function aktif_kategori()
	{

	}
}
?>