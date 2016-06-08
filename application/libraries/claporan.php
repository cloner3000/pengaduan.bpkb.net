<?php
require_once("tableforshell.php");
class Claporan extends Tableforshell{
 
  function header_lap(){
    $CI = &get_instance();
    $toko = $CI->userauth->getinfotoko();
   // $this->cell("$toko->nama_toko","100","L",0);
    $this->enter();
    //$this->cell("$toko->alamat No Telp. $toko->telp","100","C",0);
    //$this->enter();
  }
  
  function sign(){
    
    $this->header(
            array(
                array('STAFF', 50, 'C'),
                //array('SOPIR', 33, 'C'),
                array('PENERIMA', 51, 'C'), 
            )
        );
    foreach(range(1,2) as $i){    
    $this->line(
                array(
                    array("", 50, 'C'),
                    //array("", 33, 'R'),
                    array("", 51, 'L')
                )
            );
    }
    echo str_pad("",104,"-",STR_PAD_BOTH);
    $this->enter();
    echo str_pad("Barang yang sudah dibeli tidak bisa dikembalikan kecuali dengan perjanjian",104," ",STR_PAD_RIGHT);
    $this->enter();
    //echo str_pad("Komplain hanya diterima selambat-lambatnya setelah barang diterima",104," ",STR_PAD_RIGHT);
    //$this->enter();
    
  }  
  
  function sign_pre(){
        $this->header(
            array(
                array('STAFF', 33, 'C'),
                array('KASIR', 33, 'C'),
                array('CHECK', 34, 'C'), 
            )
        );
    foreach(range(1,2) as $i){    
    $this->line(
                array(
                    array("", 33, 'C'),
                    array("", 33, 'R'),
                    array("", 34, 'L')
                )
            );
    }
    echo str_pad("",104,"-",STR_PAD_BOTH);
    $this->enter();
    
    
  }  
  
  function sign_do(){
    $this->enter();
    $this->header(
            array(
                array('STAFF TOKO', 24, 'C'),
                array('STAFF GUDANG 1', 25, 'C'),
                array('STAFF GUDANG 2', 25, 'C'),
                array('PENGAMBIL', 25, 'C'),
                 
            )
        );
    foreach(range(1,2) as $i){    
    $this->line(
                array(
                  array('', 24, 'C'),
                  array('', 25, 'C'),
                  array('', 25, 'C'),
                  array('', 25, 'C'),
                )
            );
    }
    echo str_pad("",104,"-",STR_PAD_BOTH);
    $this->enter();
    
    
  }  
  
  function sign_surat_jalan(){
    $this->enter();
    $this->header(
            array(
                array('KASIR', 33, 'C'),
                array('SOPIR', 34, 'C'),                
                array('PENERIMA', 34, 'C'), 
            )
        );
    foreach(range(1,2) as $i){    
    $this->line(
                array(
                    array("", 33, 'C'),
                    array('', 34, 'C'),
                    array("", 34, 'L')
                )
            );
    }
    echo str_pad("",104,"-",STR_PAD_BOTH);
    $this->enter();
   
    
  }  
  
  function footer_lap(){
  $CI = &get_instance();
  //$this->enter();
  $this->cell(date('d-M-Y  H:m:s'),60,'L',0).$this->cell("oleh : ".$CI->session->userdata("name"),40,'R',0);

  }
}
?>