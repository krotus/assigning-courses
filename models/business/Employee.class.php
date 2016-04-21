<?php 

class Employee extends DataObject{

	private $id = null;
	private $name = null;
	private $surname = null;
	private $category = null;
	private $dni = null;
	private $email = null;

	public function __construct(){
		parent::__construct($this);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getSurname(){
		return $this->surname;
	}

	public function setSurname($surname){
		$this->surname = $surname;
	}

	public function getCategory(){
		return $this->category;
	}

	public function setCategory($category){
		$this->category = $category;
	}

	public function getDni(){
		return $this->dni;
	}

	public function setDni($dni){
		$this->dni = $dni;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public static function getSelfFromDatabaseById($id){
		$employee = null;
		try {
			$dao = new EmployeeDAO();
			$employee = $dao->get($id);
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $employee;
	}

	public function addRelationCategoryById($idCategory){
		$dao = new CategoryDAO();
		$category = $dao->get($idCategory);
		$this->setCategory($category);
	}


	public function createPDF(){
    	////////////////////////////////////////////////////////
    	// Creació del fitxer pdf
    	////////////////////////////////////////////////////////
    	$pdf=new PDFTableMC(); // creem el pdf
    	$pdf->AliasNbPages();
    	$pdf->Open();
    	$pdf->AddPage();
    	$pdf->SetTitle('Profile Employee'.$this->getId());
    	$pdf->SetMargins(10,5,5);
    	$pdf->SetDisplayMode(93);
    	$pdf->Ln(5);

    	// Grup 1
    	$text= 'Data and information about employee';
    	$pdf->SetFont('Arial','',11);
    	$pdf->SetTextColor(255,255,255);
    	$pdf->SetFillColor(192,192,192);
    	$pdf->Cell(190, 5, $text, 0, 1, 'L', '1');
    	$pdf->Ln(3);
    	$pdf->SetTextColor(0,0,0);
    	$pdf->SetFont('Arial','',11);
    	$pdf->SetWidths(array(60,120));            
    	$pdf->SetAligns(array('L', 'L'));
    	$pdf->Row(array('Id:', $this->getId()));
    	$pdf->Ln(2);
    	$pdf->Row(array('Name:', $this->getName()));
    	$pdf->Ln(2);
    	$pdf->Row(array('Surname:', $this->getSurname()));
    	$pdf->Ln(2);
    	$pdf->Row(array('DNI:', $this->getDni()));
    	$pdf->Ln(2);
    	$pdf->Row(array('Email:', $this->getEmail()));
    	$pdf->Ln(2);
    	$pdf->Row(array('Profession:', $this->getCategory()->getName()));
    	$pdf->Ln(2);
    	              
    	
    	$pdf->Ln(10);

    	
    	
    	// Cursos assignats al empleat en qüestió
    	$pdf->SetFont('Arial','',11);
    	$pdf->SetTextColor(255,255,255);
    	$pdf->SetFillColor(192,192,192);
    	$pdf->Cell(190, 5, 'Courses enrolled', 0, 1, 'L', '1');
    	$pdf->Ln(3);
    	$pdf->SetTextColor(0,0,0);
    	$pdf->SetFont('Arial','',11);
    	$pdf->SetWidths(array(60,120));            
    	$pdf->SetAligns(array('L', 'L'));
    	
    	$enrollment = new Enrollment();
    	$enrollments = $enrollment->getAllByIdEmployee($this->getId());
		
		// Títulos de las columnas
    	$header = array('Id', 'Name', 'Hours', 'StartDate', 'Theme');
    	$pdf->FancyTable($header,$enrollments);
    	/*foreach ($enrollments as $enrollment) {
    		$course = $enrollment->getCourse();
    		$pdf->Row(array('Id:', $course->getId()));
    		$pdf->Ln(2);
    		$pdf->Row(array('Name:', $course->getName()));
    		$pdf->Ln(2);
    		$pdf->Row(array('Hours:', $course->getHours()));
    		$pdf->Ln(2);
    		$pdf->Row(array('Start Date:', $course->getStartDate()));
    		$pdf->Ln(2);
    		$pdf->Row(array('Theme:', $course->getTheme()->getName()));
    		$pdf->Ln(2);
    	}*/

    	//mostrar pdf
    	$pdf->Output();
    }
}


?>