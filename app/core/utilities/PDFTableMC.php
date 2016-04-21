<?php 


require_once "PDF_MC_Table.php";

// Estenem les possibilitats de la classe original (fpdf) en una de nova
class PDFTableMC extends PDF_MC_Table{

    function Header(){
        $this->SetTextColor(0,64,0);
        $this->SetLineWidth(0.25);
        $this->Rect(10,10,190, 15);
        $this-> SetY(15);
        $this-> SetX(15);
        $this->SetFont('Arial','B',16);
        $this->Cell(110,5,'ASSIGNING COURSES APP',0,0,'L');
        $this->SetFont('Arial','',10);
        $this->Cell(75,5,'Date and time: '.date("d/m/Y G:i"),0,0,'R');
        $this->Ln(15);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0,'PROFILE OF EMPLOYEE');
        $this->Ln(10);
        $this->SetFont('Arial','B',13);
        $this->SetWidths(array(15,35,15,115));            
        $this->SetAligns(array('L', 'L', 'L', 'L' ));
        //$this->Row(array('Codi:', $GLOBALS['petcod'], 'Nom:', $GLOBALS['petnom']  ));   
    }   

    function Footer() {
        //Go to 1.5 cm from bottom
        $this->SetY(-15);
        //Select Arial italic 8
        $this->SetFont('Arial','I',8);
        //Print centered page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }


    // Tabla coloreada
    function FancyTable($header, $enrollments)
    {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(0,255,100);
        $this->SetTextColor(255);
        $this->SetDrawColor(0,255,100);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
            
        // Cabecera
        $w = array(40, 35, 45, 40, 35);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->getCourse();
            $this->Cell($w[0],6,$course->getId(),'LR',0,'L',$fill);
            $this->Cell($w[1],6,$course->getName(),'LR',0,'L',$fill);
            $this->Cell($w[2],6,$course->getHours(),'LR',0,'R',$fill);
            $this->Cell($w[3],6,$course->getStartDate(),'LR',0,'R',$fill);
            $this->Cell($w[4],6,$course->getTheme()->getName(),'LR',0,'R',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w),0,'','T');
    }

}

?>