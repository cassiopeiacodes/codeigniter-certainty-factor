<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('tgl_indo'))
{
  function tgl_indo($tgl)
  {
    list($hr, $date , $time)  = explode(" ",$tgl);
    list($tgl, $bln, $thn)    = explode("-",$date);

    $hr   = _getHari($hr);
    $bln  = _getBulan($bln);

    return "$hr, $tgl $bln $thn Pukul $time";
  }
}

if (!function_exists('_getBulan'))
{
  function _getBulan($bln){
    switch ($bln){
      case 1:
        return "Januari";
        break;
      case 2:
        return "Februari";
        break;
      case 3:
        return "Maret";
        break;
      case 4:
        return "April";
        break;
      case 5:
        return "Mei";
        break;
      case 6:
        return "Juni";
        break;
      case 7:
        return "Juli";
        break;
      case 8:
        return "Agustus";
        break;
      case 9:
        return "September";
        break;
      case 10:
        return "Oktober";
        break;
      case 11:
        return "November";
        break;
      case 12:
        return "Desember";
        break;
    }
  }
}

if (!function_exists('_getHari'))
{
  function _getHari($str){
    switch ($str)
    {
      case 1:
        return 'Senin';
        break;

      case 2:
        return 'Selasa';
        break;

      case 3:
        return 'Rabu';
        break;

      case 4:
        return 'Kamis';
        break;

      case 5:
        return 'Jumat';
        break;

      case 6:
        return 'Sabtu';
        break;

      default:
        return 'Minggu';
        break;
    }
  }
}
