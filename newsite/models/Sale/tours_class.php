
<?php   class ttoouurrss_row    {
								public $Id_xtours;
								public $titulo;
								public $semblanza;
								public $Id_xtipotours;
								public $Id_xcategorias;
								public $Id_xproveedores;
								public $Id_xlocalidades;
								public $path_imagen;
								public $descripcion;
								public $incluye;
								public $informacion_adicional;
								public $precio_pesos;
								public $description;
								public $includes;
								public $additional_info;
								public $price_dollars;
								
	function __construct(){}

    	public function setId_xtours($Id_xtours){ $this->Id_xtours = $Id_xtours;}
		public function getId_xtours(){return $this->Id_xtours;}
	
		public function settitulo($titulo){ $this->titulo = $titulo;}
		public function gettitulo(){return $this->titulo;}
    
    	public function setsemblanza($semblanza){ $this->semblanza = $semblanza;}
		public function getsemblanza(){return $this->semblanza;}
    
    	public function setId_xtipotours($Id_xtipotours){ $this->Id_xtipotours = $Id_xtipotours;}
		public function getId_xtipotours(){return $this->Id_xtipotours;}
    
    	public function setId_xcategorias($Id_xcategorias){ $this->Id_xcategorias = $Id_xcategorias;}
		public function getId_xcategorias(){return $this->Id_xcategorias;}
    
    	public function setId_xproveedores($Id_xproveedores){ $this->Id_xproveedores = $Id_xproveedores;}
		public function getId_xproveedores(){return $this->Id_xproveedores;}
    
    	public function setId_xlocalidades($Id_xlocalidades){ $this->Id_xlocalidades = $Id_xlocalidades;}
		public function getId_xlocalidades(){return $this->Id_xlocalidades;}
    
    	public function setpath_imagen($path_imagen){ $this->path_imagen = $path_imagen;}
		public function getpath_imagen(){return $this->path_imagen;}
    
		public function setdescripcion($descripcion){ $this->descripcion = $descripcion;}
		public function getdescripcion(){return $this->descripcion;}
    
    	public function setincluye($incluye){ $this->incluye = $incluye;}
		public function getincluye(){return $this->incluye;}
    
    	public function setinformacion_adicional($informacion_adicional){ $this->informacion_adicional = $informacion_adicional;}
		public function getinformacion_adicional(){return $this->informacion_adicional;}
    
		public function setprecio_pesos($precio_pesos){ $this->precio_pesos = $precio_pesos;}
		public function getprecio_pesos(){return $this->precio_pesos;}
    
		public function setdescription($description){ $this->description = $description;}
		public function getdescription(){return $this->description;}
	
		public function setincludes($includes){ $this->includes = $includes;}
		public function getincludes(){return $this->includes;}
    
    	public function setadditional_info($additional_info){ $this->additional_info = $additional_info;}
		public function getadditional_info(){return $this->additional_info;}
    
    	public function setprice_dollars($price_dollars){ $this->price_dollars = $price_dollars;}
		public function getprice_dollars(){return $this->price_dollars;}
    
       
}  ?>