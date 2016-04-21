<?php 

require_once('Structures/DataGrid.php');
require_once('Helper.php');

class CDataGrid extends Structures_DataGrid{


	private $procedures = array(); 
	private $options = array();
	private $table = null; //name of table in singular

	public function __construct($limit = null, $page = null){
		parent::Structures_DataGrid($limit, $page);
		// Define DataGrid Color Attributes
        $this->renderer->setTableEvenRowAttributes(array('class' => 'evenrow'));
        $this->renderer->setTableOddRowAttributes(array('class' => 'oddrow'));

        // Define DataGrid Table Attributes
        $this->renderer->setTableAttribute('width', '50%');
        $this->renderer->setTableAttribute('cellspacing', '1');
        $this->renderer->setTableAttribute('cellpadding', '4');
        $this->renderer->setTableAttribute('class', 'table datagrid');

        // Set sorting icons
        $this->renderer->sortIconASC = '&uarr;';
        $this->renderer->sortIconDESC = '&darr;';

        // Set procedures
		$this->procedures = include_once('Procedures.php');

		// Set PDO Connection database
        try {
			$db = new Database();
        	$this->options = array('dbc' => $db);
			if($db == null){
				throw new SQLException("There was an error with the instantiation of the database", 4);
			}
		} catch (SQLException $e) {
			echo $e->getErrorMessage();
		}
       
	}

	public function toBind($procedure, $table){
		try {
			$this->table = $table;
			$binding = $this->bind($this->procedures[$procedure], $this->options, 'PDO');
			if(PEAR::isError($binding)){
				throw new DataGridException("It is not posible to bind the table: " . $table, 5);
			}
			$this->addColumns();
		} catch (DataGridException $e) {
			echo $e->getErrorMessage();
		}
		
	}

	public function toBindRows($procedure, $table){
		try {
			$this->table = $table;
			$binding = $this->bind($procedure, $this->options, 'PDO');
			if(PEAR::isError($binding)){
				throw new DataGridException("It is not posible to bind the table: " . $table, 5);
			}
			$this->addColumnsRows();
		} catch (DataGridException $e) {
			echo $e->getErrorMessage();
		}
		
	}

	public function toRender(){
		try {
			//render table
			$rendering = $this->render();
			if(PEAR::isError($rendering)){
				throw new DataGridException("It is not posible to render the table: " . $this->table, 6);
			}

			//render pagination
			$p_options = array(
						'pagerOptions' => array(
						'mode' => 'Sliding',
						'delta' => 5,
						'httpMethod' => 'GET',
						'altFirst' => 'First page',
						'altPrev'=> 'Previous page',
						'altNext' => 'Next page',
						'altLast' => 'Last page',
						'separator' => '',
						'spacesBeforeSeparator' => 1,
						'spacesAfterSeparator' => 1,
						'prevImg' => '&lsaquo;',
						'nextImg' => '&rsaquo;',
						'firstPageText' => '&laquo;',
						'lastPageText' => '&raquo;',
						));
			echo '<ul class="pagination">';
			$render = $this->render('Pager', $p_options);
			echo '</ul>';
			if(PEAR::isError($rendering)){
				throw new DataGridException("It is not posible to render the pagination on table: " . $this->table, 6);
			}
		} catch (DataGridException $e) {
			echo $e->getErrorMessage();
		}
		
		
		
	}

	public function addColumns(){
		$columns = $this->_dataSource->_options["fields"];
		foreach ($columns as $column) {
			$col = new Structures_DataGrid_Column(ucfirst($column), $column, $column, array('align'=>'center'));
			$this->addColumn($col);
		}
		$column = new Structures_DataGrid_Column('Edit', null, null, array('align' => 'center'), null, 'edit()', array(
																													"name_file" => $this->table,
																													"label" => "Edit"
																												));
		$this->addColumn($column);
		$column = new Structures_DataGrid_Column('Delete', null, null, array('align' => 'center'), null, 'delete()', array(
																													"name_file" => $this->table,
																													"label" => "Delete"
																												));
		$this->addColumn($column);
		$column = new Structures_DataGrid_Column('Print', null, null, array('align' => 'center'), null, 'print_link()', array(
																													"name_file" => $this->table,
																													"label" => "Print"
																												));
		$this->addColumn($column);
	}

	public function addColumnsRows(){
		$columns = $this->_dataSource->_options["fields"];
		foreach ($columns as $column) {
			$col = new Structures_DataGrid_Column(ucfirst($column), $column, $column, array('align'=>'center'));
			$this->addColumn($col);
		}
	}
}

function edit($params, $args = array()){
	extract($params);
	extract($args);
	$id = $record['id'];
	return '<a href="../' . $name_file . '/edit.php?id=' . $id . '" class="glyphicon glyphicon-pencil"></a>';	
}

function delete($params, $args = array()){
	extract($params);
	extract($args);
	$id = $record['id'];
	return '<a href="../' . $name_file . '/delete.php?id=' . $id . '" class="glyphicon glyphicon-remove sweeter"></a>';	
}

function print_link($params, $args = array()){
	extract($params);
	extract($args);
	$id = $record['id'];
	return '<a href="../../controllers/' . $name_file . '/ctrlPdf'. ucfirst($name_file). '.php?id=' . $id . '" class="glyphicon glyphicon-print"></a>';	
}




?>