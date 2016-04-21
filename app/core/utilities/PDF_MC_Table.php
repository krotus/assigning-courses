<?php
require_once "fpdf.php";

class PDF_MC_Table extends FPDF{
    var $widths;
    var $aligns;
    var $borders;
    var $rojo;
    var $verde;
    var $azul;
    function SetColorCells($r,$g,$b)
    {
       $this->rojo	= $r;
       $this->verde= $g;
       $this->azul	= $r; 
       $this->SetFillColor(10,10,10);     
    }
    function setBorders($B)
    {
       $this->borders=$B;	
    }

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
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
            $b=$this->borders;
            if ($b==True)
               $this->Rect($x,$y,$w,$h);
            //$r=o;

      
            //Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function RowConAltura($data,$alturaMinima)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=5*$nb;
        if ($h<$alturaMinima)
         $h=$alturaMinima;
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
            $b=$this->borders;
            if ($b==True)
               $this->Rect($x,$y,$w,$h);
            $r=o;

      
            //Print the text
            $nb=$this->NbLines($this->widths[$i],$data[$i]);
            $altura=$h/$nb;
            $this->MultiCell($w,$altura,$data[$i],0,$a);
            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
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
    /// FIT CELL

    //Cell with horizontal scaling if text is too wide
    function CellFit($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='',$scale=1,$force=0)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);

        //Calculate ratio to fit cell
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        if($str_width>0)   
           $ratio=($w-$this->cMargin*2)/$str_width;
        else
           $ratio=1;
        $fit=($ratio < 1 || ($ratio > 1 && $force == 1));
        if ($fit)
        {
            switch ($scale)
            {

                //Character spacing
                case 0:
                    //Calculate character spacing in points
                    $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                    //Set character spacing
                    $this->_out(sprintf('BT %.2f Tc ET',$char_space));
                    break;

                //Horizontal scaling
                case 1:
                    //Calculate horizontal scaling
                    $horiz_scale=$ratio*100.0;
                    //Set horizontal scaling
                    $this->_out(sprintf('BT %.2f Tz ET',$horiz_scale));
                    break;

            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }

        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);

        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale==0 ? '0 Tc' : '100 Tz').' ET');
    }

    //Cell with horizontal scaling only if necessary
    function CellFitScale($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,1,0);
    }

    //Cell with horizontal scaling always
    function CellFitScaleForce($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,1,1);
    }

    //Cell with character spacing only if necessary
    function CellFitSpace($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,0,0);
    }

    //Cell with character spacing always
    function CellFitSpaceForce($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
    {
        //Same as calling CellFit directly
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,0,1);
    }

    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }

}
?>