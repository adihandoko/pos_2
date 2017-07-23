<?php
class M_order extends CI_Model {
public function __construct()
{
parent::__construct();
// Your own constructor code
}
public function insert_order($data)
{
        $q="INSERT INTO `tb_order`
            (`id_order`,
             `id_user`,
             `id_toko`,
             `nama_toko`,
             `nama_pembeli`,
             `telp_pembeli`,
             `email_pembeli`,
             `diskon`,
             `total`,
             `tgl_order`,
             `status`,
             `note`)
        VALUES (
        UNHEX('".data['id_order']."'),
        UNHEX('".data['id_user']."'),
        UNHEX('".data['id_toko']."'),
        '".data['nama_toko']."',
        '".data['diskon']."',
        '".data['total']."',
        '".data['tgl_order']."',
        '".data['status']."',
        '".data['note'].")   
        )";
$this->db->query($q);
return  $this->db->affected_rows();
}
public function insert_order_detail($data)
{
        $q="INSERT INTO `tb_order_detail`
            (
             `id_order`,
             `id_produk`,
             `id_toko`,
             `nama_produk`,
             `jml`,
             `harga_satuan`,
             `subtotal`)
        VALUES (
        UNHEX('".data['id_order']."'),
        UNHEX('".data['id_produk']."'),
        UNHEX('".data['id_toko']."'),
        '".data['nama_produk']."',
        '".data['jml']."',
        '".data['harga_satuan']."',
        '".data['subtotal'].")";
        $this->db->query($q);
        return  $this->db->affected_rows();
}

public function insert_bayar($data)
{
        # code...
}




}
?>