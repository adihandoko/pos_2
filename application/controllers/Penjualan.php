<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_Produk');
        $this->load->model('M_user');
    }


    public function insert_penjualan()
    {
       $this->input->post();
    }
}
?>