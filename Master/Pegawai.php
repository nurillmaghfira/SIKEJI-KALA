<?php

namespace Master;

use Config\Query_builder;

class Pegawai
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('pegawai')->get()->resultArray();
        $res = '<a href="?target=pegawai&act=tambah_pegawai" class="btn btn-info btn-sm">Tambah Pegawai</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Pangkat</th>
                    <th>Golongan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>';
        $no = 1;
        foreach ($data as $r) {
            $res .= '<tr>
                <td width="10">' . $no . '</td>
                <td width="100">' . $r['id'] . '</td>
                <td>' . $r['nama'] . '</td>
                <td>' . $r['jabatan'] . '</td>
                <td>' . $r['pangkat'] . '</td>
                <td>' . $r['golongan'] . '</td>
                <td>' . $r['status'] . '</td>
                <td width="150">
                    <a href="?target=pegawai&act=edit_pegawai&id=' . $r['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=pegawai&act=delete_pegawai&id=' . $r['id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=pegawai" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pegawai&act=simpan_pegawai">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan">
            </div>
            <div class="mb-3">
                <label for="pangkat" class="form-label">Pangkat</label>
                <input type="text" class="form-control" id="pangkat" name="pangkat">
            </div>
            <div class="mb-3">
                <label for="golongan" class="form-label">Golongan</label>
                <input type="text" class="form-control" id="golongan" name="golongan">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" id="status" name="status">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];
        $pangkat = $_POST['pangkat'];
        $golongan = $_POST['golongan'];
        $status = $_POST['status'];
        $data = array(
            'id' => $id,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'pangkat' => $pangkat,
            'golongan' => $golongan,
            'status' => $status,
        );
        return $this->db->table('pegawai')->insert($data);
    }
    public function edit($id)
    {
        // get data pegawai
        $r = $this->db->table('pegawai')->where("id='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=pegawai" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=pegawai&act=update_pegawai">
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
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" value="' . $r['jabatan'] . '">
            </div>
            <div class="mb-3">
                <label for="pangkat" class="form-label">pangkat</label>
                <input type="text" class="form-control" id="pangkat" name="pangkat" value="' . $r['pangkat'] . '">
            </div>
            <div class="mb-3">
                <label for="golongan" class="form-label">golongan</label>
                <input type="text" class="form-control" id="golongan" name="golongan" value="' . $r['golongan'] . '">
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">status</label>
                <input type="text" class="form-control" id="status" name="status" value="' . $r['status'] . '">
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
        $jabatan = $_POST['jabatan'];
        $pangkat = $_POST['pangkat'];
        $golongan = $_POST['golongan'];
        $status = $_POST['status'];

        $data = array(
            'id' => $id,
            'nama' => $nama,
            'jabatan' => $jabatan,
            'pangkat' => $pangkat,
            'golongan' => $golongan,
            'status' => $status,
        );
        return $this->db->table('pegawai')->where("id='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('pegawai')->where("id='$id'")->delete();
    }
}
