<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {	
    function __construct() {
        parent::__construct();
        $this->load->model('M_order');
        $this->load->model('M_user');
    }

    function make_GUID(){
            $node=openssl_random_pseudo_bytes(16);
            assert(strlen($node) == 16);
            $node[6] = chr(ord($node[6]) & 0x0f | 0x40); // set version to 0100
            $node[8] = chr(ord($node[8]) & 0x3f | 0x80); // set bits 6-7 to 10
            return strtoupper(vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($node), 4)));
    }

    public function insert_order()
    {
      $id_order=$this->make_GUID();
      $data=array(
              'id_order'        => $id_order,
              'id_user'          => $this->input->post('id_user'),
              'id_toko'          => $this->input->post('id_toko'),
              'nama_toko'      => $this->input->post('nama_toko'),
              'diskon'      => $this->input->post('diskon'),
              'note'      => $this->input->post('note'),
              'tgl_order'       => date('Y-m-d H:i:s'),
              'status'      => 'lunas'
              );
      $x=$this->M_order->insert_order($data);
      $id_produk=$this->post('id_produk');
      $nama_produk=$this->post('nama_produk');
      $jml=$this->post('jml');
      $harga_satuan=$this->post('harga_satuan');
      $i=0;
      foreach ($id_produk as $key) {
        $data_detail=array(
              'id_order'        => $id_order,
              'id_produk'       => $id_produk[$i],
              'id_toko'          => $this->input->post('id_toko'),
              'nama_produk'       => $nama_produk[$i],
              'jml'       => $jml[$i],
              'harga_satuan'       => $harga_satuan[$i],
              'subtotal'       => $jml[$i]*$harga_satuan[$i],
          );
      $this->M_order->insert_order_detail($data_detail);
      $i++;
      }
    }
}
?>