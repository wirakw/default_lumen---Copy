<?php

function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}

function rupiahWithoutPrefix($angka){
    $hasil_rupiah = number_format($angka,2,',','.');
    return $hasil_rupiah;
}