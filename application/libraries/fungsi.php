<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Fungsi
{
  var $CI = null;

  function fungsi() {
    $this->CI = & get_instance();
    $this->CI->load->database();
  }
  function kdauto($tabel, $inisial, $nm_kolom) {
    $field = $nm_kolom;
    $panjang = strlen($inisial) + 4;

    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel);
    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
  }

  function kdautoall($tabel, $inisial, $nm_kolom, $len) {
    $field = $nm_kolom;
    $panjang = strlen($inisial) + $len;

    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel);
    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
  }

  function kdtranauto($tabel, $inisial, $nm_kolom, $len, $idsupplier) {
    $field = $nm_kolom;
    $panjang = strlen($inisial) + 3;

    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel . " WHERE idsupplier = '$idsupplier'");
    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
  }

  function kdpreorder($tabel, $inisial, $nm_kolom, $len) {
    $field = $nm_kolom;
    $panjang = strlen($inisial) + $len;
    $date = date("Y-m-d");
    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel . " WHERE date(tgl_trans) = '$date'");
    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
  }

  function kddoorder($tabel, $inisial, $nm_kolom, $len) {
    $field = $nm_kolom;
    $panjang = strlen($inisial) + $len;
    $date = date("Y-m-d");
    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel . " WHERE date(tgl_trans) = '$date'");
    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
  }

  function kdtransgudang($tabel, $inisial, $nm_kolom, $tipe) {
    $field = $nm_kolom;
    $panjang = strlen($inisial) + 4;
    $date = date("Y-m-d");
    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel . " WHERE status = '$tipe' and date(tgl_trans) = '$date'");
    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($inisial) - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }
    return $inisial . $tmp . $angka;
  }

  function notajualauto($tabel, $inisial, $nm_kolom, $tgl, $userid, $cus) {
    $field = $nm_kolom;
    $panjang = 3;
    $tglaktif = explode("-", $tgl);

    $qry = $this->CI->db->query("SELECT max(" . $field . ") as kode FROM " . $tabel . " WHERE month(tgl_trans) = '$tglaktif[1]' AND year(tgl_trans) = '$tglaktif[0]' AND code_cust='$cus'");

    foreach ($qry->result_array() as $row) {
      @$row[kode];
    }
    if (@$row[kode] == "") {
      $angka = 0;
    }
    else {
      $angka = substr(@$row[kode], 0, 0 - strlen($inisial));
    }
    $angka++;
    $angka = strval($angka);
    $tmp = "";
    for ($i = 1; $i <= ($panjang - strlen($angka)); $i++) {
      $tmp = $tmp . "0";
    }

    return $tmp . $angka . $inisial;
  }

  function getip() {
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) $ip_lok = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) $ip_lok = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) $ip_lok = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip_lok = $_SERVER['REMOTE_ADDR'];
    else $ip_lok = "unknown";
    return ($ip_lok);
  }
  function close($id) {
    mysql_close($id);
  }

  function terbilang($bilangan) {
    if ($bilangan == '' || $bilangan == 0) return "nol";
    $angka = array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');
    $kata = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan');
    $tingkat = array('', 'ribu', 'juta', 'milyar', 'triliun');

    $panjang_bilangan = strlen($bilangan);

    /* pengujian panjang bilangan */
    if ($panjang_bilangan > 15) {
      $kalimat = "Diluar Batas";
      return $kalimat;
    }

    /* mengambil angka-angka yang ada dalam bilangan,
     dimasukkan ke dalam array */
    for ($i = 1; $i <= $panjang_bilangan; $i++) {
      $angka[$i] = substr($bilangan, -($i), 1);
    }

    $i = 1;
    $j = 0;
    $kalimat = "";

    /* mulai proses iterasi terhadap array angka */
    while ($i <= $panjang_bilangan) {

      $subkalimat = "";
      $kata1 = "";
      $kata2 = "";
      $kata3 = "";

      /* untuk ratusan */
      if ($angka[$i + 2] != "0") {
        if ($angka[$i + 2] == "1") {
          $kata1 = "seratus";
        }
        else {
          $kata1 = $kata[$angka[$i + 2]] . " ratus";
        }
      }

      /* untuk puluhan atau belasan */
      if ($angka[$i + 1] != "0") {
        if ($angka[$i + 1] == "1") {
          if ($angka[$i] == "0") {
            $kata2 = "sepuluh";
          }
          elseif ($angka[$i] == "1") {
            $kata2 = "sebelas";
          }
          else {
            $kata2 = $kata[$angka[$i]] . " belas";
          }
        }
        else {
          $kata2 = $kata[$angka[$i + 1]] . " puluh";
        }
      }

      /* untuk satuan */
      if ($angka[$i] != "0") {
        if ($angka[$i + 1] != "1") {
          $kata3 = $kata[$angka[$i]];
        }
      }

      /* pengujian angka apakah tidak nol semua,
       lalu ditambahkan tingkat */
      if (($angka[$i] != "0") OR ($angka[$i + 1] != "0") OR ($angka[$i + 2] != "0")) {
        $subkalimat = "$kata1 $kata2 $kata3 " . $tingkat[$j] . " ";
      }

      /* gabungkan variabe sub kalimat (untuk satu blok 3 angka)
       ke variabel kalimat */
      $kalimat = $subkalimat . $kalimat;
      $i = $i + 3;
      $j = $j + 1;
    }

    /* mengganti satu ribu jadi seribu jika diperlukan */
    if (($angka[5] == "0") AND ($angka[6] == "0")) {
      $kalimat = str_replace("satu ribu", "seribu", $kalimat);
    }

    return trim($kalimat);
  }
  function array_delete($array, $keys) {
    $tmp_array = array();
    if (is_string($keys)) {
      $keys_to_be_deleted = array($keys);
    }
    elseif (is_array($keys)) {
      $keys_to_be_deleted = $keys;
    }
    else {
      return $array;
    }
    foreach ($array as $key => $val) {
      if (!in_array($key, $keys_to_be_deleted)) {
        $tmp_array[$key] = $val;
      }
    }
    return $tmp_array;
  }

  function date_diff($d1, $d2) {
    $d1 = (is_string($d1) ? strtotime($d1) : $d1);
    $d2 = (is_string($d2) ? strtotime($d2) : $d2);
    $diff_secs = abs($d1 - $d2);
    $base_year = min(date("Y", $d1), date("Y", $d2));
    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
    return array("years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1, "hours_total" => floor($diff_secs / 3600), "hours" => date("G", $diff), "minutes_total" => floor($diff_secs / 60), "minutes" => (int)date("i", $diff), "seconds_total" => $diff_secs, "seconds" => (int)date("s", $diff));
  }

  function filter($text) {
    $text = preg_replace("'<script[^>]*>.*?</script>'si", '', $text);
    $text = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text);
    $text = preg_replace('/<!--.+?-->/', '', $text);
    $text = preg_replace('/{.+?}/', '', $text);
    $text = preg_replace('/&nbsp;/', ' ', $text);
    $text = preg_replace('/&amp;/', ' ', $text);
    $text = preg_replace('/&quot;/', ' ', $text);
    $text = preg_replace("/\r\n\r\n\r\n+/", " ", $text);
    $text = preg_replace('/[!"\#\$%\'\(\)\?\[\]\^`\{\}~\*\/]/', '', $text);
    return trim(strip_tags($text));
  }

  function checkemail($email) {
    $email = strtolower($email);
    if ((!$email) || (!preg_match("/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,6}$/", $email))) $error.= "format E-Mail address wrong!";
    if ((strlen($email) >= 4) && (substr($email, 0, 4) == "www.")) $error.= "Please remove the beginning(<b>www.</b>)";
    if (strrpos($email, "") > 0) $error.= "E-Mail address can not use space";
    return $error;
  }

  function renamefile() {
    $str = 'abcdefghijklmnopqrstuvwxyz123456789';
    $shuffled = str_shuffle($str);
    $data_1 = substr($shuffled, -5);
    $data_2 = substr($shuffled, 0, 5);
    $newname = md5($data_1 . $data_2);
    $file_name = $newname;
    return $file_name;
  }

  function byteFormat($bytes, $unit = "", $decimals = 2) {

    //    echo byteFormat(4096, "B") ."\n";
    //    echo byteFormat(8, "B", 2) . "\n";
    //    echo byteFormat(1, "KB", 5) . "\n";
    //    echo byteFormat(1073741824, "B", 0) . "\n";
    //    echo byteFormat(1073741824, "KB", 0) . "\n";
    //    echo byteFormat(1073741824, "MB") . "\n";
    //    echo byteFormat(1073741824) . "\n";
    //    echo byteFormat(1073741824, "TB", 10) . "\n";
    //    echo byteFormat(1099511627776, "PB", 6) . "\n";
    $units = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4, 'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);
    $value = 0;
    if ($bytes > 0) {
      if (!array_key_exists($unit, $units)) {
        $pow = floor(log($bytes) / log(1024));
        $unit = array_search($pow, $units);
      }
      $value = ($bytes / pow(1024, floor($units[$unit])));
    }
    if (!is_numeric($decimals) || $decimals < 0) {
      $decimals = 2;
    }
    return sprintf('%.' . $decimals . 'f ' . $unit, $value);
  }

  function createPassword($length) {
    $chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $i = 0;
    $password = "";
    while ($i <= $length) {
      $password.= $chars{mt_rand(0, strlen($chars)) };
      $i++;
    }
    return $password;
  }

  function highlight_text($text, $words) {
    foreach ($words as $word) {
      $text = highlight_phrase($text, $word, '<span style="color:#990000; font-weight: bold;">', '</span>');
    }
    return $text;
  }

  function datediff($start_date, $end_date = "now", $unit = "D") {
    $unit = strtoupper($unit);
    $start = strtotime($start_date);
    if ($start === - 1) {
      return ("invalid start date");
    }

    $end = strtotime($end_date);
    if ($end === - 1) {
      return ("invalid end date");
    }
    $diff = $start - $end;

    $day1 = date("j", $start);
    $mon1 = date("n", $start);
    $year1 = date("Y", $start);
    $day2 = date("j", $end);
    $mon2 = date("n", $end);
    $year2 = date("Y", $end);

    switch ($unit) {
      case "D":
        return (intval($diff / (24 * 60 * 60)));
        break;

      case "M":
        if ($day1 > $day2) {
          $mdiff = (($year2 - $year1) * 12) + ($mon2 - $mon1 - 1);
        }
        else {
          $mdiff = (($year2 - $year1) * 12) + ($mon2 - $mon1);
        }
        return ($mdiff);
        break;

      case "Y":
        if (($mon1 > $mon2) || (($mon1 == $mon2) && ($day1 > $day2))) {
          $ydiff = $year2 - $year1 - 1;
        }
        else {
          $ydiff = $year2 - $year1;
        }
        return ($ydiff);
        break;

      case "YM":
        if ($day1 > $day2) {
          if ($mon1 >= $mon2) {
            $ymdiff = 12 + ($mon2 - $mon1 - 1);
          }
          else {
            $ymdiff = $mon2 - $mon1 - 1;
          }
        }
        else {
          if ($mon1 > $mon2) {
            $ymdiff = 12 + ($mon2 - $mon1);
          }
          else {
            $ymdiff = $mon2 - $mon1;
          }
        }
        return ($ymdiff);
        break;

      case "YD":
        if (($mon1 > $mon2) || (($mon1 == $mon2) && ($day1 > $day2))) {
          $yddiff = intval(($end - mktime(0, 0, 0, $mon1, $day1, $year2 - 1)) / (24 * 60 * 60));
        }
        else {
          $yddiff = intval(($end - mktime(0, 0, 0, $mon1, $day1, $year2)) / (24 * 60 * 60));
        }
        return ($yddiff);
        break;

      case "MD":
        if ($day1 > $day2) {
          $mddiff = intval(($end - mktime(0, 0, 0, $mon2 - 1, $day1, $year2)) / (24 * 60 * 60));
        }
        else {
          $mddiff = intval(($end - mktime(0, 0, 0, $mon2, $day1, $year2)) / (24 * 60 * 60));
        }
        return ($mddiff);
        break;

      default:
        return ("{Datedif Error: Unrecognized \$unit parameter. Valid values are 'Y', 'M', 'D', 'YM'. Default is 'D'.}");
    }
  }

  function sumdate($date, $year) {
    $splitdate = explode("-", $date);
    $splityear = $splitdate[0] + $year;
    return $splityear . "-" . $splitdate[1] . "-" . $splitdate[2];
  }

  function accept_data($value) {
    foreach ($value as $key => $val) {
      $data[$val] = $this->CI->input->post($val, TRUE);
      if (!is_array($data[$val])) {
        $data[$val] = strip_image_tags($data[$val]);
        $data[$val] = quotes_to_entities($data[$val]);
        $data[$val] = encode_php_tags($data[$val]);
        $data[$val] = trim($data[$val]);
      }
    }
    return $data;
  }

  /**
   * $time1 = '12:12:20';
   * $time2 = '13:14:29';
   * echo 'Begin of Time: '.$time1;
   * echo '<br />End of Time: '.$time2;
   * echo '<br />The Sum of Time: '. sum_the_time($time1, $time2);  // this will give you a result: 19:12:25
   * echo '<br />Duration: '. duration_time($time1, $time2); // this will give you a result: 0 Day(s), 1 Hour(s), 2 Minute(s), 9 Second(s).
   */
  function sum_the_time($time1, $time2) {
    $times = array($time1, $time2);
    $seconds = 0;
    foreach ($times as $time) {
      list($hour, $minute, $second) = explode(':', $time);
      $seconds+= $hour * 3600;
      $seconds+= $minute * 60;
      $seconds+= $second;
    }
    $hours = floor($seconds / 3600);
    $seconds-= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
  }

  function GetServerStatus($site, $port) {
    $status = array("OFFLINE", "ONLINE");
    $fp = @fsockopen($site, $port, $errno, $errstr, 2);
    if (!$fp) {
      return $status[0];
    }
    else {
      return $status[1];
    }
  }

  function duration_time($parambegindate, $paramenddate) {
    $begindate = strtotime($parambegindate);
    $enddate = strtotime($paramenddate);
    $diff = intval($enddate) - intval($begindate);
    $diffday = intval(floor($diff / 86400));
    $modday = ($diff % 86400);
    $diffhour = intval(floor($modday / 3600));
    $diffminute = intval(floor(($modday % 3600) / 60));
    $diffsecond = ($modday % 60);
    return array("day" => round($diffday), "hour" => round($diffhour), "minute" => round($diffminute, 0), "second" => round($diffsecond, 0));
  }

  function config_pagination() {

    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&larr; Previous';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = 'Next &rarr;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    return $config;
  }
}
