<?php

namespace Master;

use Config\Query_builder;

class Penggajian
{
    private $db;
    public function __construct($con)
    {
        $this->db = new Query_builder($con);
    }
    public function index()
    {
        $data = $this->db->table('penggajian')->get()->resultArray();
        $res = '<a href="?target=penggajian&act=tambah_penggajian" class="btn btn-info btn-sm">Tambah penggajian</a><br><br>
        <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Gaji Lama</th>
                    <th>Gaji Terbaru</th>
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
                <td>' . $r['gaji_lama'] . '</td>
                <td>' . $r['gaji_terbaru'] . '</td>
                <td width="150">
                    <a href="?target=penggajian&act=edit_penggajian&id=' . $r['id'] . '" class="btn btn-primary btn-sm">Edit</a>
                    <a href="?target=penggajian&act=delete_penggajian&id=' . $r['id'] . '" class="btn btn-danger btn-sm">Hapus</a>
                </td>';
            $no++;
        }
        $res .= '</tbody></table></div>';
        return $res;
    }
    public function tambah()
    {
        $res = '<a href="?target=penggajian" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=penggajian&act=simpan_penggajian">
            <div class="mb-3">
                <label for="id" class="form-label">Id</label>
                <input type="text" class="form-control" id="id" name="id">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="gaji_lama" class="form-label">Gaji Lama</label>
                <input type="text" class="form-control" id="gaji_lama" name="gaji_lama">
            </div>
            <div class="mb-3">
                <label for="gaji_terbaru" class="form-label">Gaji Terbaru</label>
                <input type="text" class="form-control" id="gaji_terbaru" name="gaji_terbaru">
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>';

        return $res;
    }

    public function simpan()
    {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $gaji_lama = $_POST['gaji_lama'];
        $gaji_terbaru = $_POST['gaji_terbaru'];

        $data = array(
            'id' => $id,
            'nama' => $nama,
            'gaji_lama' => $gaji_lama,
            'gaji_terbaru' => $gaji_terbaru,
        );
        return $this->db->table('penggajian')->insert($data);
    }
    public function edit($id)
    {
        // get data penggajian
        $r = $this->db->table('penggajian')->where("id='$id'")->get()->rowArray();
        //cek radio

        $res = '<a href="?target=penggajian" class="btn btn-danger btn-sm">Kembali</a><br><br>';
        $res .= '<form method="post" action="?target=penggajian&act=update">
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
                <label for="gaji_lama" class="form-label">Gaji Lama</label>
                <input type="text" class="form-control" id="gaji_lama" name="gaji_lama" value="' . $r['gaji_lama'] . '">
            </div>
            <div class="mb-3">
                <label for="gaji_terbaru" class="form-label">Gaji Terbaru</label>
                <input type="text" class="form-control" id="gaji_terbaru" name="gaji_terbaru" value="' . $r['gaji_terbaru'] . '">
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
        $gaji_lama = $_POST['gaji_lama'];
        $gaji_terbaru = $_POST['gaji_terbaru'];

        $data = array(
            'id' => $id,
            'nama' => $nama,
            'gaji_lama' => $gaji_lama,
            'gaji_terbaru' => $gaji_terbaru,
        );
        return $this->db->table('penggajian')->where("id='$param'")->update($data);
    }

    public function delete($id)
    {
        return $this->db->table('penggajian')->where("id='$id'")->delete();
    }
}
