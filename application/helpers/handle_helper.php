<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('backHandle')){
    function backHandle(){ // nama fungsinya juga bisa d ganti "suka-suka lo" XD (y)
      $CI =& get_instance();
      $CI->load->library(array('output'));
      $CI->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
      $CI->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
      $CI->output->set_header('Pragma: no-cache');
      $CI->output->set_header("Expires: Mon, 26 Jul 2000 05:00:00 GMT");
    }
}

function cleanString($string) {
	$string = str_replace("&quot;","\"",$string);
	$string = str_replace("&apos;","'",$string);
	$string = str_replace("�"," ",$string);
	$string = str_replace("\n"," ",$string);
	$string = preg_replace('/[^a-zA-Z0-9-.:&#;,\/_\'��"!��?\[\]]/', ' ', $string);
	$string = preg_replace('/\s\s+/', ' ', $string);
	return $string;
}

function reviewdata($arrdata){
   echo "<pre>";
    print_r($arrdata);
   echo "</pre>";
   exit;
}

function datetimes($tgl,$Jam=false){
        /*Contoh Format : 2007-08-15 01:27:45*/
        if($tgl==""){
          return "";
        }else{
        $tanggal = strtotime($tgl);
        if($Jam==true){
          @$arrtime = explode(" ",$tgl);
          @$time = $arrtime[1];
        }else{
          $time = "";
        }
        $bln_array = array (
        		'01'=>'Januari',
        		'02'=>'Februari',
        		'03'=>'Maret',
        		'04'=>'April',
        		'05'=>'Mei',
        		'06'=>'Juni',
        		'07'=>'Juli',
        		'08'=>'Agustus',
        		'09'=>'September',
        		'10'=>'Oktober',
        		'11'=>'November',
        		'12'=>'Desember'
        		);
        $hari_arr = Array ('0'=>'Minggu',
        			   '1'=>'Senin',
        			   '2'=>'Selasa',
        				'3'=>'Rabu',
        				'4'=>'Kamis',
        				'5'=>'Jum`at',
        				'6'=>'Sabtu'
        			   );

        $tggl = date('d',$tanggal);
        $bln = date('m',$tanggal);
        $thn = date('Y',$tanggal);
        return "$tggl/$bln/$thn $time";
        }
}

function sendjs($script=""){
  return "<script type='text/javascript'>
  $(document).ready(function(){
      $script
  });
  </script>";
}

function methodpage($require_method="POST"){
  $method = $_SERVER['REQUEST_METHOD'];
  if($method != $require_method){
    redirect('login');
  }
}

if (!function_exists('rupiah')){
   function rupiah($uang){
      if($uang==0 OR $uang == NULL){
        return 0;
      }else{
        return number_format($uang,2,'.',',');
      }

    }
}

if (!function_exists('terbilang')){
function terbilang($bilangan)
{
    if($bilangan=='' || $bilangan==0)
            return "nol";
      $angka = array('0','0','0','0','0','0','0','0','0','0',
                     '0','0','0','0','0','0');
      $kata = array('','satu','dua','tiga','empat','lima',
                    'enam','tujuh','delapan','sembilan');
      $tingkat = array('','ribu','juta','milyar','triliun');

      $panjang_bilangan = strlen($bilangan);

      /* pengujian panjang bilangan */
      if ($panjang_bilangan > 15) {
        $kalimat = "Diluar Batas";
        return $kalimat;
      }

      /* mengambil angka-angka yang ada dalam bilangan,
         dimasukkan ke dalam array */
      for ($i = 1; $i <= $panjang_bilangan; $i++) {
        $angka[$i] = substr($bilangan,-($i),1);
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
        if ($angka[$i+2] != "0") {
          if ($angka[$i+2] == "1") {
            $kata1 = "seratus";
          } else {
            $kata1 = $kata[$angka[$i+2]] . " ratus";
          }
        }

        /* untuk puluhan atau belasan */
        if ($angka[$i+1] != "0") {
          if ($angka[$i+1] == "1") {
            if ($angka[$i] == "0") {
              $kata2 = "sepuluh";
            } elseif ($angka[$i] == "1") {
              $kata2 = "sebelas";
            } else {
              $kata2 = $kata[$angka[$i]] . " belas";
            }
          } else {
            $kata2 = $kata[$angka[$i+1]] . " puluh";
          }
        }

        /* untuk satuan */
        if ($angka[$i] != "0") {
          if ($angka[$i+1] != "1") {
            $kata3 = $kata[$angka[$i]];
          }
        }

        /* pengujian angka apakah tidak nol semua,
           lalu ditambahkan tingkat */
        if (($angka[$i] != "0") OR ($angka[$i+1] != "0") OR
            ($angka[$i+2] != "0")) {
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
        $kalimat = str_replace("satu ribu","seribu",$kalimat);
      }

      return trim($kalimat);
}
}

function DateToIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret",
                       "April", "Mei", "Juni",
                       "Juli", "Agustus", "September",
                       "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl = substr($date,8,2);


    return $tgl." ".$BulanIndo[(int)$bulan-1] . " ". $tahun;
}

if (!function_exists('settglindo')){
function settglindo($data){

      $txt = explode(" ",$data);
      $date = explode("-",$txt[0]);
      return "$date[0]-$date[1]-$date[2]";
    }
}

if (!function_exists('setsqldate')){
    function setsqldate($data){
        $txt = explode("/",$data);
        return "$txt[2]-$txt[1]-$txt[0]";
    }
}

function tglakhirbulan($bln,$thn){
    $bulan[1]='31';
    $bulan[2]='28';
    $bulan[3]='31';
    $bulan[4]='30';
    $bulan[5]='31';
    $bulan[6]='30';
    $bulan[7]='31';
    $bulan[8]='31';
    $bulan[9]='30';
    $bulan[10]='31';
    $bulan[11]='30';
    $bulan[12]='31';

    if ($thn%4==0){
        $bulan[2]=29;
    }
    return $bulan[$bln];
}

function getbulan(){
    $lbulan = array(
        "01"=>"Januari",
        "02"=>"Februari",
        "03"=> "Maret",
        "04"=> "April",
        "05"=> "Mei",
        "06"=> "Juni",
        "07"=> "Juli",
        "08"=> "Agustus",
        "09"=> "September",
        "10"=> "Oktober",
        "11"=> "November",
        "12"=> "Desember"
        );
    return $lbulan;
}

function getromawi($bln){
    $lbulan = array(
        "01"=>"I",
        "02"=>"II",
        "03"=>"III",
        "04"=>"IV",
        "05"=>"V",
        "06"=>"VI",
        "07"=>"VII",
        "08"=>"VIII",
        "09"=>"IX",
        "10"=>"X",
        "11"=>"XI",
        "12"=>"XII"
        );
    return $lbulan[$bln];
}

function getnamabulan($no){
    $lbulan = array(
        "1"=>"Januari",
        "2"=>"Februari",
        "3"=> "Maret",
        "4"=> "April",
        "5"=> "Mei",
        "6"=> "Juni",
        "7"=> "Juli",
        "8"=> "Agustus",
        "9"=> "September",
        "10"=> "Oktober",
        "11"=> "November",
        "12"=> "Desember"
        );
    return $lbulan[$no];
}

function settglawal(){
    return date('Y-m')."-01";

}

function settglakhir(){
    return date('Y-m')."-".tglakhirbulan(date('n'),date('Y'));
}

function filterarray($array,$n){
    $new = ($array[$n-1] == $array[$n])?"":"$array[$n]";
    return $new;
}


if(!function_exists('create_breadcrumb')){
function create_breadcrumb(){
  $ci = &get_instance();
  $i=1;
  $uri = $ci->uri->segment($i);
  $link = '
  <div class="breadCrumbHolder module">
  <div id="breadCrumb0" class="breadCrumb module">
  <ul>';
  while($uri != ''){
      $prep_link = '';
      for($j=1; $j<=$i;$j++){
          $prep_link .= $ci->uri->segment($j).'/';
      }

            if($ci->uri->segment($i+1) == ''){
              $link.='<li><a href="'.site_url($prep_link).'"><b>';
              $link.=$ci->uri->segment($i).'</b></a></li> ';
            }else{
              $link.='<li><a href="'.site_url($prep_link).'">';
              $link.=$ci->uri->segment($i).'</a></li> ';
            }
            $i++;
            $uri = $ci->uri->segment($i);
        }
          $link .= '</ul></div></div>';
          return $link;
    }

}

function to_excel($query, $filename='file_excel')
{
     $headers = ''; // just creating the var for field headers to append to below
     $data = ''; // just creating the var for field data to append to below

     $obj =& get_instance();

     $fields = $query->field_data();
     if ($query->num_rows() == 0) {
          echo '<p>The table appears to have no data.</p>';
     } else {
          foreach ($fields as $field) {
             $headers .= $field->name . "\t";
          }

          foreach ($query->result() as $row) {
               $line = '';
               foreach($row as $value) {
                    if ((!isset($value)) OR ($value == "")) {
                         $value = "\t";
                    } else {
                         $value = str_replace('"', '""', $value);
                         $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
               }
               $data .= trim($line)."\n";
          }

          $data = str_replace("\r","",$data);

          header('Pragma: public');
          header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT');
          header('Cache-Control: no-store, no-cache, must-revalidate'); // HTTP/1.1
          header('Cache-Control: pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
          header ("Pragma: no-cache");
          header("Expires: 0");
          header("Content-Type: application/force-download");
          header("Content-Type: application/octet-stream");
          header("Content-Type: application/download;");
          header("Content-Type: charset=CP1251");
          header("Content-Disposition: attachment;filename=otchet.xls");
          header("Content-Transfer-Encoding: binary ");
          echo "$headers\n$data";
     }
}

function setpesan($tipe,$pesan){
  $text='';
  if($tipe=='info'){
    $text = '<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Info!</strong> '.$pesan.'</div>';
  }elseif($tipe=='error'){
    $text = '<div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Error!</strong> '.$pesan.'</div>';
  }elseif($tipe=='success'){
    $text = '<div title=sukses class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>Success!</strong> '.$pesan.'</div>';
  }

  return $text;
}

function genbutton($type,$status="y",$url="javascript:void(0);",$icon="",$class=""){
  switch($type){
    case "P":
      return ($status=="y") ? "<a href='$url' id='bprint' class='btn $class'><i class='icon icon-print $icon'></i> cetak</a>":"";
      break;

    case "C":
      return ($status=="y") ? "<button type='submit' id='bcreate' class='btn btn-primary $class'><i class='icon icon-plus $icon'></i> simpan</button>":"";
      break;

    case "D":
      return ($status=="y") ? "<a href='$url' id='bdelete' class='$class btn btn-inverse'><i class='icon icon-remove $icon'></i> hapus</a>":"";
      break;

    case "U":
      return ($status=="y") ? "<a href='$url' id='bupdate' class='$class btn btn-danger'><i class='icon icon-ok $icon'></i> ubah</a>":"";
      break;

    case "G":
      return ($status=="y") ? "<a href='$url' id='bgenerate' class='$class btn'><i class='icon icon-fire $icon'></i> generate</a>":"";
      break;

    case "A":
      return ($status=="y") ? "<a href='$url' id='banswer' class='$class btn'><i class='go-eject $icon'></i> answer</a>":"";
      break;
  }
}

function setcell($array=array("nilai","jumlah"=>30,"pemisah"=>" ","align"=>"left")){
  if($array['align']=="right"){
    return str_pad($array['nilai'],$array['jumlah'],$array['pemisah'],STR_PAD_LEFT);
  }elseif($array['align']=='left'){
    return str_pad($array['nilai'],$array['jumlah'],$array['pemisah'],STR_PAD_RIGHT);
  }elseif($array['align']=='center'){
    return str_pad($array['nilai'],$array['jumlah'],$array['pemisah'],STR_PAD_BOTH);
  }
}

function breakpage($no,$limit=9){
  $code = "";
  if($no>$limit){
    $code .= chr(27).chr(67)."\x40";
  }else{
    $code .= chr(27).chr(67)."\x1F";

  }
  return $code;
}

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function send_mail($email,$password,$code){
   $ci = &get_instance();
      $config = Array(
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
    );

    $ci->load->library('email', $config);
    $ci->email->set_newline("\r\n");
    $this->email->from('noreply@pengaduan.bpkb.net', 'Pengaduan Polda Metro Jaya');
    $ci->email->to("$email");

     $ci->email->subject('Email Corfirmation User Register');
     $ci->email->message("
     Kepada $email \n
     ini adalah email konfirmasi user akses pada system.\n
     berikut detail data anda \n
     email : $email \n
     password : $password \n
     untuk mengaktifasi account anda klik link dibawah ini \n
     <a href='".site_url("register/activation/$code")."'>".site_url("register/activation/$code")."</a> \n
     setelah berhasil lakukan perubahan password.
     terima kasih.
     ");

     $ci->email->send();
  }

  function send_mail_password($email,$password){
   $ci = &get_instance();
      $config = Array(
        'mailtype'  => 'html',
        'charset'   => 'iso-8859-1'
    );

    $ci->load->library('email', $config);
    $ci->email->set_newline("\r\n");
    $ci->email->from('noreply@pengaduan.bpkb.net', 'Pengaduan Polda Metro Jaya');
    $ci->email->to("$email");

     $ci->email->subject('Email Reset Password');
     $ci->email->message("
     Kepada $email \n
     ini adalah email untuk reset password .\n
     berikut detail paswword data anda yang baru \n
     email : $email \n
     password : $password \n
     terima kasih.
     ");

     $ci->email->send();
  }

  function total_notif(){
    $ci = &get_instance();
    $ci->db->where('uuid_user', $ci->session->userdata('userid'));
    $ci->db->where('read', 0);
    $query = $ci->db->get('ticket_notify')->num_rows();
    return $query;
  }

  function total_ticket($dept_id){
    $ci = &get_instance();
    $ci->db->where('departement_id',$dept_id);
    $query = $ci->db->get('ticket_ticket')->num_rows();
    return "<span class='badge badge-success pull-right'>$query</span>";
  }

  function total_ticket_status($dept_id,$status){
    $ci = &get_instance();
    $ci->db->where('departement_id',$dept_id);
    $ci->db->where('status_id',$status);
    $query = $ci->db->get('ticket_ticket')->num_rows();
    return "<span class='badge badge-info pull-right'>$query</span>";
  }

  function history($ticket,$user,$status,$dept_id = ""){
   $ci = &get_instance();
   $data = array(
    "uuid" => $ticket,
    "user_uuid" => $user,
    "status" => $status,
    "date" => date("Y-m-d H:i"),
   );
   if($dept_id != "" ){
    $data['new_departement'] = $dept_id;
   }
   $ci->db->insert('ticket_history',$data);
  }
