<?php
class Language
{
	
	public $languange;

	function __construct($lang = null)
	{	
		session_start();
		unset($_COOKIE["Lang"]);
		$this->languange = $lang;
		$this->init();
	}

	public function change($lang = null)
	{
		$this->languange = $lang;
		$this->init();
	}

	public function init()
	{

		if(strcmp($this->languange, "en") == 0)
		{
			require("en.php");
		}
		else if(strcmp($this->languange, "es") == 0)
		{
			require("es.php");
		}
		else
		{
			#Idioma no encontrado, se usará idioma predeterminado Español
			require("es.php");
		}

	}

}


?>