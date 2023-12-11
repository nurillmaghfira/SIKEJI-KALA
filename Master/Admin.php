<?php

namespace Master;

use Config\Query_builder;

class Admin
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('admin')->get()->resultArray();
        $res = '<a href="?target=admin&act=tambah_admin" class="btn btn-info btn-sm">Tambah admin</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Act</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td>' . $r['id'] . '</td>
                <td>' . $r['nama'] . '</td>
                <td>' . $r['nip'] . '</td>
                <td width="150">
                    <a href="?target=admin&act=edit_admin&id=' . $r['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=admin&act=delete_admin&id=' . $r['id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=admin&act=simpan_admin">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip">
            </div>
           
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'nip' => $nip,

        );
        return $this->db->table('admin')->insert($data);
    }
    public function edit($id)
    {
        // get data admin
        $r = $this->db->table('admin')->where("id='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=admin" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=admin&act=update">
            <input type="hidden" class="form-control" id="param" name="param" value="' . $r['id'] . '">

            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id" value="' . $r['id'] . '">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="' . $r['nama'] . '">
            </div>
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="' . $r['nip'] . '">
            </div>

            <button type="submit" class="btn btn-primary">Ubah</button>
        </form>';
        return $res;
    }

    public function cekRadio($val, $val2)
    {
        if ($val == $val2) {
            return "checked";
        }
        return "";
    }

    public function update()
    {
        $param = $_POST['param'];
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];

        $data = array(
            'id' => $id,
            'nama' => $nama,
            'nip' => $nip,
        );
        return $this->db->table('admin')->where("id='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('admin')->where("id='$id'")->delete();
    }
}
