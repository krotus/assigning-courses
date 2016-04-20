<?php 

class View{

	private $view;

	public function __construct($view, $title){
		echo $this->render($view, compact("title"));
	}

	public function render($view, $array){
		extract($array);
		ob_start();
		include $view . ".php";
		$renderedView = ob_get_clean();
		return $renderedView;
	}

	public function getView(){
		return $this->view;
	}


}

 ?>