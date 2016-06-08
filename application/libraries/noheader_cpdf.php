<?php
require_once('fpdf/fpdf.php');

class Noheader_cpdf extends FPDF{

    var $row_height;
    var $javascript;
    var $n_js;

    function IncludeJS($script) {
        $this->javascript=$script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R ]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (isset($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }

    function AutoPrint($dialog=false){
    //Embed some JavaScript to show the print dialog or start printing immediately
        $param=($dialog ? 'true' : 'false');
        $script="print($param);";
        $this->IncludeJS($script);
    }

    function set_row_height($n){
        $this->row_height = $n;
    }

    function set_judul($judul,$sub_judul){
        $this->judul=$judul;
        $this->sub_judul=$sub_judul;
    }



    function Header(){
         $this->SetMargins(3,2,3);
       /* $this->Image('assets/img/logo.jpg',5,2,55,15);
       
        $this->SetY(30);
        $this->SetX(10);
        $this->SetFont('Arial','B',14);
        $this->Cell(200, 7,'',0,2,'L');
        $this->SetFont('Arial','',11);
        $this->Cell(200, 2,'',0,1,'L');
        $this->SetY(30);
        $this->SetX(10);
        $this->SetFont('Arial','',10);
        $this->SetDrawColor(220,115,23);
        //$this->Cell(60,0.5,'','TB',1,'L');

        $this->SetDrawColor(0,0,0);
        // $this->Cell(0,2,'','B',1,'L');
        $this->SetY(2);
        $this->SetFont('Arial','B',12);
        $this->SetTextColor(64,0,160);
        $this->Cell(0, 7,$this->judul,0,1,'R');
        $this->SetFont('Arial','B',11);
        $this->Cell(0, 7,$this->sub_judul,0,1,'R');
        
        $this->Ln(1);*/
        $this->SetY(3);
        $this->SetFont('Courier','',10);

    }

    function Footer(){
        $this->SetFont('Courier','',10);
        $this->SetY(-15);
        // $this->Cell(0,10,'Hal '.$this->PageNo().'/{nb}',0,0,'R');
        $this->SetY(-15);
        $this->Cell(0,10,'Dicetak '.date('d-M-Y  H:m:s'),0,0,'L');
        $this->SetY(-15);
        // $this->Cell(0,10,'www.modaljujur.com',0,0,'C');
    }

    function Table($table,$font=array(),$color=false)
    {
        $border=array();

        // Header & Content Width
        if(! empty($table['width']))
            $this->SetWidths($table['width']);
        elseif(! empty($table['header'])){
            for($i=0;$i<count($table['header']);$i++)
                $table['width'][$i]=($this->w-$this->lMargin-$this->rMargin)/count($table['header']);
            $this->SetWidths($table['width']);
        }elseif(! empty($table['content'][1])){
            for($i=0;$i<count($table['content'][1]);$i++)
                $table['width'][$i]=($this->w-$this->lMargin-$this->rMargin)/count($table['content'][1]);
            $this->SetWidths($table['width']);
        }

        // Header
        if(! empty($table['header_border']))
            $border=$table['header_border'];
        if(! empty($table['header_align']))
            $this->SetAligns($table['header_align']);
        if(! empty($table['header']))
            $this->Baris($table['header'],$color,true,false,$border,$font);

        // Data
        $this->SetFont('','',$this->FontSizePt-1);
        $this->SetLineWidth(.1);
        if(! empty($table['content_border']))
            $border=$table['content_border'];
        if(! empty($table['content_align']))
            $this->SetAligns($table['content_align']);

        $fill = false;
        if(! empty($table['content'])){
            foreach($table['content'] as $row)
            {
                $this->Baris($row,($color)?$fill:$color,false,false,$border,$font);
                $fill = !$fill;
            }
        }

        // Footer
        if(! empty($table['footer_border']))
            $border=$table['footer_border'];
        if(! empty($table['footer_align']))
            $this->SetAligns($table['footer_align']);
        if(! empty($table['footer_width'])){
            $this->SetWidths($table['footer_width']);
        }elseif(! empty($table['footer_content'])){
            for($i=0;$i<count($table['footer_content']);$i++)
                $table['footer_width'][$i]=($this->w-$this->lMargin-$this->rMargin)/count($table['footer_content']);
            $this->SetWidths($table['footer_width']);
        }
        if(! empty($table['footer_content'])){
            $this->SetLineWidth(.1);
            $this->Baris($table['footer_content'],false,false,true,$border,$font);
        }
        $this->SetFont('','',$this->FontSizePt+1);
    }

    // Colored table
    function ColorTable($table,$font=array())
    {
        $this->Table($table,$font,true);
    }

    function Baris($data,$fill=false,$is_header=false,$is_footer=false,$border=array(),$font=array())
    {
        if($is_header && $fill){
            // Colors, line width and bold font
            $this->SetFillColor(49,158,207);
            $this->SetTextColor(255);
            $this->SetDrawColor(62,77,87);
            $this->SetLineWidth(.1);
            (empty($font))?$this->SetFont('','B'):$this->SetFont($font[0],$font[1],$font[2]);
        }elseif($is_header){
            (empty($font))?$this->SetFont('','B'):$this->SetFont($font[0],$font[1],$font[2]);
        }elseif($is_footer){
            (empty($font))?$this->SetFont('','B'):$this->SetFont($font[0],$font[1],$font[2]);
        }


        if(empty($this->row_height))
            $tinggi=4;
        else
            $tinggi=$this->row_height;

        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=$tinggi*$nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();

            //Draw the border
            if(!empty($border)){
               if(strpos($border[$i],'L')!==false)
                    $this->Line($x,$y,$x,$y+$h);//left
                if(strpos($border[$i],'R')!==false)
                    $this->Line($x+$w,$y,$x+$w,$y+$h);//right
                if(strpos($border[$i],'T')!==false)
                    $this->Line($x,$y,$x+$w,$y);//top
                if(strpos($border[$i],'B')!==false)
                  $this->Line($x,$y+$h,$x+$w,$y+$h);//bottom
            }elseif($is_header){
                $this->Line($x,$y,$x+$w,$y);//top
                $this->Line($x,$y+$h,$x+$w,$y+$h);//bottom
            }elseif($is_footer){
                $this->Line($x,$y,$x+$w,$y);//top
            }else{
                $this->Line($x,$y,$x,$y+$h);//left
                $this->Line($x,$y+$h,$x+$w,$y+$h);//bottom
                $this->Line($x,$y,$x+$w,$y);//top
                
            }
            if(!$is_footer && !$is_header)
             $this->Line($x+$w,$y,$x+$w,$y+$h);//right
               

            //Print the text
            $this->MultiCell($w,$tinggi,$data[$i],0,$a,$fill);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        if($is_header && $fill){
            // Color and font restoration
            $this->SetFillColor(224,235,255);
            $this->SetTextColor(0);
            (empty($font)?$this->SetFont('','B'):$this->SetFont($font));
        }
        //Go to the next line
        $this->Ln($h);
    }

   function CheckPageBreak($h){
      if($this->GetY()+$h>$this->PageBreakTrigger)
         $this->AddPage($this->CurOrientation);
   }

    function NbLines($w, $txt)
   {
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
         $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r", '', $txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
         $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
         $c=$s[$i];
         if($c=="\n")
         {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
         }
         if($c==' ')
            $sep=$i;
         $l+=$cw[$c];
         if($l>$wmax)
         {
            if($sep==-1)
            {
               if($i==$j)
                  $i++;
            }
            else
               $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
         }
         else
            $i++;
      }
      return $nl;
   }
}