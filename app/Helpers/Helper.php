<?php

namespace App\Helpers;

class Helper
{
    /**
     * 
     * @param mixed $detailRoute
     * @param mixed $editRoute
     * @param mixed $deleteRoute
     * @return string
     */
    public static function actionButtons($detailRoute = null, $editRoute = null, $deleteRoute = null)
    {
        // $btn = '<div class="d-flex center">';
        $btn = '<div class="d-flex justify-content-center align-items-center">';
        // $btn = '';

        // Tombol Detail, hanya jika $detailRoute tidak null
        if ($detailRoute !== null) {
            $btn .= '<a href="' . $detailRoute . '" class="btn btn-info btn-sm mr-2">Detail</a>';
        }

        // Tombol Edit, hanya jika $editRoute tidak null
        if ($editRoute !== null) {
            $btn .= '<a href="' . $editRoute . '" class="btn btn-warning btn-sm">Edit</a>';
        }

        // Tombol Hapus, hanya jika $deleteRoute tidak null
        if ($deleteRoute !== null) {
            $btn .= '<form action="' . $deleteRoute . '" method="POST" class="d-inline ml-2" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">';
            $btn .= csrf_field(); // Menambahkan CSRF token
            $btn .= method_field('DELETE'); // Mengatur method menjadi DELETE
            $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
            $btn .= '</form>';
        }

        $btn .= '</div>';
        // $btn .= '';
        return $btn;
    }


    /**
     * Format angka ke format mata uang.
     *
     * @param  float  $number
     * @param  int    $decimals
     * @return string
     */
    public static function formatCurrency($number, $decimals = 2)
    {
        return 'Rp ' . number_format($number, $decimals, ',', '.');
    }
}