<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_Produk');
        $this->load->model('M_user');
    }

    public function get_produk()
    {
        $x=$this->M_Produk->get_all_produk();
        print_r($x);
    }
    public function get_a_produk($id_produk)
    {
        $data=$this->M_Produk->get_a_produk($id_produk);
        //print_r($data);die();
        if ($data) {
        echo json_encode(array(
            'status' =>'berhasil' ,
            'data'=>$data
         ), JSON_PRETTY_PRINT);}
        else{
                echo json_encode(array(
                    'status' =>'gagal' ,
                    'alasan'=>'empty data'
                 ), JSON_PRETTY_PRINT);
            }
    }
    public function update_stok_produk()
    {
        $id_produk=$this->input->post('id_produk');
        $stok=$this->input->post('id_produk');
        $data=$this->M_Produk->get_a_produk($id_produk);
        ///print_r($data);die();
        echo json_encode(array(
            'status' =>'berhasil' ,
         ), JSON_PRETTY_PRINT);
    }
    public function get_search_produk_toko_nama()
    {
        $id_toko=$this->input->post('id_toko');
        if($id_toko){
        $search=$this->input->post('search');
        $data=$this->M_Produk->get_search_produk_toko_nama($id_toko,$search);
        if ($data) {
            echo json_encode(array(
                'status' =>'berhasil' ,
                'data'=>$data
             ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array(
                    'status' =>'gagal' ,
                    'alasan'=>'empty data'
                 ), JSON_PRETTY_PRINT);
            }
        }else {
        echo json_encode(array(
            'status' =>'gagal' ,
            'alasan'=>'empty id_toko'
         ), JSON_PRETTY_PRINT);
        }
    }
    public function get_search_produk_toko_barcode()
    {
        $id_toko=$this->input->post('id_toko');
        if($id_toko){
        $barcode=$this->input->post('barcode');
        $data=$this->M_Produk->get_barcode_produk_toko_nama($id_toko,$barcode);
        if ($data) {
            echo json_encode(array(
                'status' =>'berhasil' ,
                'data'=>$data
             ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array(
                    'status' =>'gagal' ,
                    'alasan'=>'empty data'
                 ), JSON_PRETTY_PRINT);
            }
        }else {
        echo json_encode(array(
            'status' =>'gagal' ,
            'alasan'=>'empty id_toko'
         ), JSON_PRETTY_PRINT);
        }
    }
    public function get_all_produk_toko()
    {
        $id_toko=$this->input->post('id_toko');
        if($id_toko){
        $data=$this->M_Produk->get_all_produk_toko($id_toko);
        if ($data) {
            echo json_encode(array(
                'status' =>'berhasil' ,
                'data'=>$data
             ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array(
                    'status' =>'gagal' ,
                    'alasan'=>'empty data'
                 ), JSON_PRETTY_PRINT);
            }
        }else {
        echo json_encode(array(
            'status' =>'gagal' ,
            'alasan'=>'empty id_toko'
         ), JSON_PRETTY_PRINT);
        }
    }
    public function get_all_produk_user()
    {
        $id_user=$this->input->post('id_user');
        if($id_user){
        $data=$this->M_Produk->get_all_produk_user($id_user);
        $jml=$this->M_Produk->get_all_produk_user_jml($id_user);
        if ($data) {
            echo json_encode(array(
                'status' =>'berhasil' ,
                'data'=>$data
             ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array(
                    'status' =>'gagal' ,
                    'alasan'=>'empty data'
                 ), JSON_PRETTY_PRINT);
            }
        }else {
        echo json_encode(array(
            'status' =>'gagal' ,
            'alasan'=>'empty id_user'
         ), JSON_PRETTY_PRINT);
        }
    }
	public function add_produk()
	{
		$this->load->view('add_produk');
	}
    function make_GUID(){
            $node=openssl_random_pseudo_bytes(16);
            assert(strlen($node) == 16);
            $node[6] = chr(ord($node[6]) & 0x0f | 0x40); // set version to 0100
            $node[8] = chr(ord($node[8]) & 0x3f | 0x80); // set bits 6-7 to 10
            return strtoupper(vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($node), 4)));
    }
	public function insert_produk()
	{
            $id_produk=$this->make_GUID();
            $sub_kategori = ($this->input->post('sub_kategori')) ? $this->input->post('sub_kategori') : 0 ;
            if ($sub_kategori) {
                $kategori=array(
                    'parent_id' => $this->input->post('kategori'),
                    'child_1' => $sub_kategori;
            }else{
                $kategori=array(
                    'parent_id' => $this->input->post('kategori'));
            }
            $data=array(
                    'id_produk'        => $id_produk,
                    'kategori'         => json_encode($kategori),
                    'id_toko'          => $this->input->post('id_toko'),
                    'barcode'          => $this->input->post('barcode'),
                    'nama_produk'      => $this->input->post('nama_produk'),
                    'harga'            => $this->input->post('harga'),
                    'satuan'           => $this->input->post('satuan'),
                    'detail'           => $this->input->post('detail'),
                    'tgl_input'        => date('Y-m-d H:i:s'),
                    'jenis'            => $this->input->post('jenis'),
                    'detail'           => $this->input->post('detail'),
                    'id_toko'          => $this->input->post('id_toko'),
                    'stok'             => $this->input->post('stok'),
                    'tgl_update'       => date('Y-m-d H:i:s')
                    );
            //print_r($data);die();
            $x=$this->M_Produk->insert_produk($data);
            if($x){
                $data=$this->M_Produk->get_a_produk($id_produk);
                echo json_encode(array(
                    'status' =>'berhasil' ,
                    'data'=>$data
                 ), JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array(
                    'status' =>'gagal' ,
                    'alasan'=>'fail insert data'
                 ), JSON_PRETTY_PRINT);                    
            }
	}
	public function update_produk()
	{

	}
	public function nonaktif_produk()
	{

	}
	public function aktif_produk()
	{

	}
}
