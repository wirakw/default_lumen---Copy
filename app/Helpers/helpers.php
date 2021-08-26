<?php

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}


function invoiceFormat($str)
{
    $new = explode("-",$str);
    return $new[2] . '/' .$new[1] . '/' .$new[0];
}


function strtodate($str)
{
    $new = explode(" ",$str);
    if (!isset($new[2])) {
        dd($new);
    }
    $bln  = "01";
    switch ($new[1]) {
        case "Jan":
            $bln = "01";
            break;
        case "Feb":
            $bln = "02";
            break;
        case "Mar":
            $bln = "03";
            break;
        case "Apr":
            $bln = "04";
            break;
        case "Mei":
            $bln = "05";
            break;
        case "Jun":
            $bln = "06";
            break;
        case "Jul":
            $bln = "07";
            break;
        case "Agu":
            $bln = "08";
            break;
        case "Sep":
            $bln = "09";
            break;
        case "Okt":
            $bln = "10";
            break;
        case "Nov":
            $bln = "11";
            break;
        case "Des":
            $bln = "12";
            break;
    }
    $newStr = $new[2] . '-' .$bln . '-' .$new[0];
    return $newStr;
}

function pembulatan($uang)
{
    $ratusan = substr($uang, -3);
    if ($ratusan < 500) {
        $akhir = $uang - $ratusan;
    } else {
        $akhir = $uang + (1000 - $ratusan);
    }

    //  echo number_format($akhir, 2, ',', '.');;
    return $akhir;
}

function getRomawi($bln)
{
    switch ($bln) {
        case 1:
            return "I";
            break;
        case 2:
            return "II";
            break;
        case 3:
            return "III";
            break;
        case 4:
            return "IV";
            break;
        case 5:
            return "V";
            break;
        case 6:
            return "VI";
            break;
        case 7:
            return "VII";
            break;
        case 8:
            return "VIII";
            break;
        case 9:
            return "IX";
            break;
        case 10:
            return "X";
            break;
        case 11:
            return "XI";
            break;
        case 12:
            return "XII";
            break;
    }
}

function rupiahWithoutPrefix($angka)
{
    $hasil_rupiah = number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function invoice_num($input, $pad_len = 7, $prefix = null)
{
    if ($pad_len <= strlen($input)) {
        trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);
    }

    if (is_string($prefix)) {
        return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));
    }

    return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string $path
     * @return string
     */
    function public_path($path = '')
    {
        return env('PUBLIC_PATH', base_path('public')) . ($path ? '/' . $path : $path);
    }
}
