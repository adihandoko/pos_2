<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_menu');
        $this->load->model('M_user');
    }
	public function banner()
	{
		$hasil=$this->M_menu->get_banner();
		if($hasil) {
			echo json_encode(array(
				'status' => 'berhasil',
				'data'=>$hasil), JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array('status' => 'gagal','alasan'=>'data not found',), JSON_PRETTY_PRINT);
		}
	}
	public function drawer()
	{
		$hasil=$this->M_menu->get_drawer();
		if($hasil) {
			echo json_encode(array(
				'status' => 'berhasil',
				'data'=>$hasil), JSON_PRETTY_PRINT);
		}else{
			echo json_encode(array('status' => 'gagal','alasan'=>'data not found',), JSON_PRETTY_PRINT);
		}
	}
}
?>