<?php

namespace App\Helpers;

class Helper
{
    public static function actionButtons($detailRoute, $editRoute, $deleteRoute)
    {
        $btn = '<div class="d-flex">';

        // Tombol Detail
        $btn .= '<a href="' . $detailRoute . '" class="btn btn-info btn-sm mr-2">Detail</a>';

        // Tombol Edit
        $btn .= '<a href="' . $editRoute . '" class="btn btn-warning btn-sm mr-2">Edit</a>';

        // Form untuk tombol Hapus
        $btn .= '<form action="' . $deleteRoute . '" method="POST" class="d-inline" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">';
        $btn .= csrf_field(); // Menambahkan CSRF token
        $btn .= method_field('DELETE'); // Mengatur method menjadi DELETE
        $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
        $btn .= '</form>';

        $btn .= '</div>';
        return $btn;
    }
}