<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/uts/index.php?target=";
        $data = [
            array('Text' => 'Home', 'Link' => $base . 'home'),
            array('Text' => 'Pegawai', 'Link' => $base . 'pegawai'),
            array('Text' => 'Penggajian', 'Link' => $base . 'penggajian'),
            array('Text' => 'Admin', 'Link' => $base . 'admin'),
        ];
        return $data;
    }
}
