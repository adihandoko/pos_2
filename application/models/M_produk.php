<?php
class M_produk extends CI_Model {
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
        public function get_all_produk_toko($id_toko)
        {
                $this->db->select('
                        HEX(id_produk) as id_produk, 
                        hex(tb_produk.`id_toko`) as id_toko,
                        `kategori`,
                        nama_toko,
                        `nama_produk`, 
                        `harga`, 
                        `satuan`, 
                        `detail`, 
                        `stok`, 
                        `tgl_input`, 
                        `jenis`');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(tb_produk.id_toko)="'.$id_toko.'"');
                $query = $this->db->get('tb_produk');
                return $query->result();
        }
        public function get_all_produk_toko_jml($id_toko)
        {
                $this->db->select(' count(id_produk) as jml');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(tb_produk.id_toko)="'.$id_toko.'"');
                $query = $this->db->get('tb_produk');
                return $query->result()[];
        }
        public function get_all_produk_user($id_user)
        {
                $this->db->select('
                        HEX(id_produk) as id_produk, 
                        hex(tb_produk.`id_toko`) as id_toko,
                        `kategori`,
                        nama_toko,
                        `nama_produk`, 
                        `harga`, 
                        `satuan`, 
                        `detail`, 
                        `stok`, 
                        `tgl_input`, 
                        `jenis`,');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(tb_toko.id_user)="'.$id_user.'"');
                $query = $this->db->get('tb_produk');
                return $query->result();
        }
        public function get_all_produk_user_jml($id_user)
        {
                $this->db->select('count(id_produk) as jml');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(tb_toko.id_user)="'.$id_user.'"');
                $query = $this->db->get('tb_produk');
                return $query->result()[0]->jml;
        }
        public function get_a_produk($id_produk)
        {
                $this->db->select('
                        HEX(id_produk) as id_produk, 
                        hex(tb_produk.`id_toko`) as id_toko,
                        `kategori`,
                        nama_toko,
                        `nama_produk`, 
                        `harga`, 
                        `satuan`, 
                        `detail`, 
                        `stok`, 
                        `tgl_input`, 
                        `jenis`,');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(id_produk)="'.$id_produk.'"');
                $query = $this->db->get('tb_produk');
                return $query->result();
        }
        public function get_search_produk_toko_nama($id_toko,$search)
        {
                $this->db->select('
                        HEX(id_produk) as id_produk, 
                        hex(tb_produk.`id_toko`) as id_toko,
                        `kategori`,
                        nama_toko,
                        `nama_produk`, 
                        `harga`, 
                        `satuan`, 
                        `detail`, 
                        `stok`, 
                        `tgl_input`, 
                        `jenis`,');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(tb_produk.id_toko)="'.$id_toko.'"');
                $this->db->where('tb_produk.nama_produk like "%'.$search.'%"');
                $query = $this->db->get('tb_produk');
                return $query->result();
        }
        public function get_barcode_produk_toko_nama($id_toko,$barcode)
        {
                $this->db->select('
                        HEX(id_produk) as id_produk, 
                        hex(tb_produk.`id_toko`) as id_toko,
                        `kategori`,
                        nama_toko,
                        `nama_produk`, 
                        `harga`, 
                        `satuan`, 
                        `detail`, 
                        `stok`, 
                        `tgl_input`, 
                        `jenis`,');
                $this->db->join('tb_toko','tb_toko.id_toko=tb_produk.id_toko');
                $this->db->where('hex(tb_produk.id_toko)="'.$id_toko.'"');
                $this->db->where('tb_produk.barcode like "%'.$barcode.'%"');
                $query = $this->db->get('tb_produk');
                return $query->result();
        }

        public function insert_produk($data)
        {
                //print_r($data);die();
                $q="INSERT INTO `tb_produk`(`id_produk`, `kategori`, `id_toko`, `nama_produk`, `harga`, `satuan`, `detail`, `stok`, `tgl_input`, `jenis`, `tgl_update`, `aktif`) VALUES (
                        UNHEX('".$data['id_produk']."'), 
                        '".$data['kategori']."', 
                        UNHEX('".$data['id_toko']."'), 
                        '".$data['nama_produk']."', 
                        '".$data['harga']."', 
                        '".$data['satuan']."', 
                        '".$data['detail']."', 
                        '".$data['stok']."', 
                        '".$data['tgl_input']."', 
                        '".$data['jenis']."', 
                        '".$data['tgl_update']."', 
                        1       
                        )";
                $this->db->query($q);
                return  $this->db->affected_rows();
        }

        public function update_produk()
        {
                //$this->title    => $_POST['title'];
                //$this->content  => $_POST['content'];
                $this->date     = time();

                $this->db->update($table, $this, array('id' => $_POST['id']));
        }


}
?>