<?php  

/**
*
*/

class SalesController
{

	private $db;
	function __construct()
	{
		$this->db = new databaseController();
	}


	//ANY: ../ventas/Index
	public function anyIndex(){
		session_start();
		if(isset($_SESSION["user"])){
			//$this->KillerIT();
			include("views/Sales/index.php");
		}
		else
		{
			header( "Location: /panel/login");
		}
	}

	public function getReservas(){
		session_start();
		include ("views/Sales/salesOff.php");
	}


   	/* =-==-==-==-==-==-==-==-==-==-==-==-==-==-==-==-==-==-==-== */


public function getReporte(){
	 session_start();

	try {
        $Fecha_2 = date("Y-m-d");
	 	$Fecha_1 = date("Y-m-d",strtotime($Fecha_2."- 1 month"));
	 	$total_publico = 0;
		$total_neto  = 0;
		$lista = array();

		//$random = 1;
	 	$db = new db();
	 	$conn = $db->conn_local();
	 	$query = "SELECT Id_type_vending, type_vending FROM type_vending WHERE Activo = 1;";
	 	$stmt = $conn->prepare($query);
	 	//$stmt->bindParam(1,$random);
	 	$stmt->execute();
	 	$count = $stmt->rowCount();
	 	$lista_vending = array();
	 	if($count > 0){        
	 		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			//echo "Se===Vé";
	 		//print_r($rows);
	 		foreach ($rows as $row) {

	 			$type_vending = new type_vending();
	 			$type_vending->setId($row['Id_type_vending']);
	 			$type_vending->setNombre($row['type_vending']);
	 			array_push($lista_vending, $type_vending);
	 		}
	 		//print_r($lista_vending);
	 	}
	 	else{
	 		echo "No encontro resultados";
	 	}

	 	/* Segunda consulta de Jaisiel */ 
	 	$consulta = "SELECT Id_Status, Status_payments FROM Status WHERE Activo = 1";
	 	$stmt2 = $conn->prepare($consulta);
	 	$stmt2->execute();
	 	$count2 = $stmt2->rowCount();
	 	if($count2 > 0){
	 		$rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
	 		$lista_estatus = array();
	 		foreach ($rows as $row) {

	 			$estatus = new estatus();
	 			$estatus->setId($row['Id_Status']);
	 			$estatus->setNombre($row['Status_payments']);
	 			array_push($lista_estatus, $estatus);
				
	 		}
	 		//print_r($lista_estatus);
	 	}
	 	else {
	 		echo "Error al consultar los datos";
	 	}

        //Datos de inicio
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider FROM VISTA__GRAN_TOT_VTAS WHERE isDeleted = 0 AND Id_Status = 3 AND DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ORDER BY Id DESC ;";
			
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0){
				$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$lista = array();
				//print_r($rows);
				foreach ($rows as $row) {
					//echo "<br><br>";
					//print_r($row);
					$sale = new sale_row();
					$sale->setId($row['Id']);
					$sale->setCustomer($row['Customers_Name']);
					$sale->setLastName($row['LastName']);
					$sale->setSecondName($row['SecondLastName']);
					$sale->setStatus($row['Status_payments']);
					$sale->setService($row['Services_Name']);
					$sale->setDateTo($row['DateTo']);
					$sale->setDateFrom($row['DateFrom']);
					$sale->setTotal($row['Total']);
					$sale->setSubTotal($row['Subtotal']);
					$sale->setTypeVending($row['type_vending']);
					$sale->setTypeService($row['TypeService']);
					$sale->setProvider($row['NameProvider']);
					array_push($lista, $sale);

				}

				$query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',SUM(Total) 'GRAN_TOTAL_PUBLICO' FROM VISTA__GRAN_TOT_VTAS WHERE isDeleted = 0 AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE)  ;";
				$stmt2 = $conn->prepare($query2);
				$stmt2->execute();
				$count2 = $stmt2->rowCount();
				if($count2 > 0){

					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					$total_publico = $row['GRAN_TOTAL_PUBLICO'];
					$total_neto = $row['GRAN_TOTAL_NETO'];
				}
				else{
					$total_publico = 0;
					$total_neto = 0;
				}
			}
			else
				$count =0;

		} catch (Exception $e) {
		 	echo "Error fatal: ".$e;
		}

 		/*...........................................................................................................................*/



		include ("views/Sales/Vtas_Tot_Contenedor.php");


	} catch (Exception $e) {
	 	echo "Error fatal: ".$e;
	 }

}

public function postReporte(){
session_start();
/*	if($_POST){
		if(isset($_POST["Id_type_vending"])&& isset($_POST["Id_Status"])&&isset($_POST["Fecha_1"])&&isset($_POST["Fecha_2"]))
		{*/

			$total_publico = 0;
			$total_neto  = 0;
			$lista = array();

		 	$db = new db();
		 	$conn = $db->conn_local();
		 	$query = "SELECT Id_type_vending, type_vending FROM type_vending WHERE Activo = 1;";
		 	$stmt = $conn->prepare($query);
		 	$stmt->execute();
		 	$count = $stmt->rowCount();
		 	$lista_vending = array();
		 	if($count > 0){
		 		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		 		//print_r($rows); ok
		 		foreach ($rows as $row) {

		 			$type_vending = new type_vending();
		 			$type_vending->setId($row['Id_type_vending']);
		 			$type_vending->setNombre($row['type_vending']);
		 			array_push($lista_vending, $type_vending);
		 		}
		 	}
		 	else{
		 		$lista_vending = NULL;
		 	}

		 	/* Segunda consulta de Jaissiel */
		 	$lista_estatus = array();
		 	$consulta = "SELECT Id_Status, Status_payments FROM Status WHERE Activo = 1";
		 	$stmt2 = $conn->prepare($consulta);
		 	$stmt2->execute();
		 	$count2 = $stmt2->rowCount();
		 	if($count2 > 0){
		 		$rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		 		//print_r($rows); ok
		 		foreach ($rows as $row) {

		 			$estatus = new estatus();
		 			$estatus->setId($row['Id_Status']);
		 			$estatus->setNombre($row['Status_payments']);
		 			array_push($lista_estatus, $estatus);
		 		}
		 		//print_r($lista_estatus);
		 	}
		 	else{
		 		$lista_estatus = NULL;
		 	}

			if(isset($_POST["Id_type_vending"]))
			{

				$Id_type_vending = $_POST["Id_type_vending"];
				$Id_Status       = $_POST["Id_Status"];
				$Fecha_1         = $_POST["Fecha_1"];
				$Fecha_2         = $_POST["Fecha_2"];
                
                  $exxxcel = 0;
                if (isset($_POST["exxxcel"])){
                    $exxxcel          = $_POST["exxxcel"];
                }
                 // print_r ($exxxcel)."<-exxxcel"; 
               if ($exxxcel == 100) {
                    header("Content-type: application/vnd.ms-excel; name='excel'");
                    header("Content-Disposition: filename=Rep_Oktrip_Total_Ventas.xls");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                }
                
				//-- Formato de Fechas llega mm/dd/yyyy  se convierte  yyyy-mm-dd --
	            $diagonal = substr($Fecha_1,2,1);
				//print_r($diagonal);
				if ($diagonal == "/") {
					$d1 = substr($Fecha_1,3,2);
					$m1 = substr($Fecha_1,0,2);
					$a1 = substr($Fecha_1,6,4);
					$d2 = substr($Fecha_2,3,2);
					$m2 = substr($Fecha_2,0,2);
					$a2 = substr($Fecha_2,6,4);

					$Fecha_1 = $a1."-".$m1."-".$d1;
					$Fecha_2 = $a2."-".$m2."-".$d2;

					$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1);
					$Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
			  	}


				if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' )
				{

					$Rango_Fechas = " AND DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
					$Rango_Fechas_All = " DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
				}
				else {
					$Rango_Fechas = " ";
				}

				if ($Id_type_vending == .9 && $Id_Status == .9){
					try {
						$db = new db();
						$conn = $db->conn_local();
						$query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider FROM VISTA__GRAN_TOT_VTAS WHERE isDeleted = 0 AND $Rango_Fechas_All ORDER BY Id DESC;";
						$stmt = $conn->prepare($query);
						$stmt->execute();
						$count = $stmt->rowCount();

						if($count > 0){

							$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$lista = array();
							foreach ($rows as $row) {

								$sale = new sale_row(); /* nueva instancia de la clase sale_row    */
								$sale->setId($row['Id']);
								$sale->setCustomer($row['Customers_Name']);
								$sale->setLastName($row['LastName']);
								$sale->setSecondName($row['SecondLastName']);
								$sale->setStatus($row['Status_payments']);
								$sale->setService($row['Services_Name']);
								$sale->setDateTo($row['DateTo']);
								$sale->setDateFrom($row['DateFrom']);
								$sale->setTotal($row['Total']);
								$sale->setSubTotal($row['Subtotal']);
								$sale->setTypeVending($row['type_vending']);
								$sale->setTypeService($row['TypeService']);
								$sale->setProvider($row['NameProvider']);
								array_push($lista, $sale);

							}
                            if ($Id_Status == 3){
								$query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',SUM(Total) 'GRAN_TOTAL_PUBLICO' FROM vista__gran_tot_vtas 
                                                  WHERE isDeleted = 0 AND $Rango_Fechas_All;";
								$stmt2 = $conn->prepare($query2);
								$stmt2->execute();
								$count2 = $stmt2->rowCount();
								if($count2 > 0){
									$row = $stmt2->fetch(PDO::FETCH_ASSOC);
									//print_r($row);
									$total_publico = $row['GRAN_TOTAL_PUBLICO'];
									$total_neto = $row['GRAN_TOTAL_NETO'];
								}
							   else {
						        	$total_neto = 0;
						        	$total_publico = 0;
						        }

							}
							else
							    $bandera = 1;
								//echo "Falla en la sumatoria";
						}
						else
							$count= 0;

					} catch (Exception $e) {

					}
				}

                
                /*  typevendig == .9 && Status <> .9  muestra web y off  + status seleccionado   */
                
             				else if ($Id_type_vending == .9 && $Id_Status <> .9){
					try {
							$db = new db();
							$conn = $db->conn_local();
							
    						$query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider FROM VISTA__GRAN_TOT_VTAS WHERE isDeleted = 0 AND Id_Status LIKE '%$Id_Status%' $Rango_Fechas ORDER BY Id DESC;";

							$stmt = $conn->prepare($query);
							$stmt->execute();
							$count = $stmt->rowCount();
							if($count > 0){
								$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
								$lista = array();
								//print_r($rows);
								foreach ($rows as $row) {
									//echo "<br><br>";
									//print_r($row);
									$sale = new sale_row();
									$sale->setId($row['Id']);
									$sale->setCustomer($row['Customers_Name']);
									$sale->setLastName($row['LastName']);
									$sale->setSecondName($row['SecondLastName']);
									$sale->setStatus($row['Status_payments']);
									$sale->setService($row['Services_Name']);
									$sale->setDateTo($row['DateTo']);
									$sale->setDateFrom($row['DateFrom']);
									$sale->setTotal($row['Total']);
									$sale->setSubTotal($row['Subtotal']);
									$sale->setTypeVending($row['type_vending']);
									$sale->setTypeService($row['TypeService']);
									$sale->setProvider($row['NameProvider']);
									array_push($lista, $sale);

								}
                                if ($Id_Status == 3){
									$query_2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',SUM(Subtotal),SUM(Total) 'GRAN_TOTAL_PUBLICO' 
                                    FROM VISTA__GRAN_TOT_VTAS WHERE isDeleted = 0 AND  Id_Status LIKE '%$Id_Status%' $Rango_Fechas;";
									$stmt_2 = $conn->prepare($query_2);
									$stmt_2->execute();
									$count_2 = $stmt_2->rowCount();
									if($count_2 > 0){
										$row = $stmt_2->fetch(PDO::FETCH_ASSOC);
										//print_r($row);
										$total_publico = $row['GRAN_TOTAL_PUBLICO'];
										$total_neto = $row['GRAN_TOTAL_NETO'];
									}
								   else {
							        	$total_neto = 0;
							        	$total_publico = 0;
						        	}
								}
								else
							        $bandera = 1;
									//echo "Falla en la sumatoria";
							}
							else
								$count =0;

						 } catch (Exception $e) {
						 	echo "Error fatal: ".$e;
						 }
				}   
                
                
                
                
				/* un elseif para cuando typevendig <> .9 && Status == .9  para que se muestren todos los estatus                 */
				else if ($Id_type_vending <> .9 && $Id_Status == .9){
					try {
							$db = new db();
							$conn = $db->conn_local();
							$query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, 
                                                            DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider
                                                            FROM VISTA__GRAN_TOT_VTAS 
                                                            WHERE isDeleted = 0 AND offline LIKE '%$Id_type_vending%' $Rango_Fechas 
                                                            ORDER BY Id DESC;";
                   //        print $query . "ln 408"; 
							$stmt = $conn->prepare($query);
							$stmt->execute();
							$count = $stmt->rowCount();
							if($count > 0){
								$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
								$lista = array();
								//print_r($rows);
								foreach ($rows as $row) {
									//echo "<br><br>";
									//print_r($row);
									$sale = new sale_row();
									$sale->setId($row['Id']);
									$sale->setCustomer($row['Customers_Name']);
									$sale->setLastName($row['LastName']);
									$sale->setSecondName($row['SecondLastName']);
									$sale->setStatus($row['Status_payments']);
									$sale->setService($row['Services_Name']);
									$sale->setDateTo($row['DateTo']);
									$sale->setDateFrom($row['DateFrom']);
									$sale->setTotal($row['Total']);
									$sale->setSubTotal($row['Subtotal']);
									$sale->setTypeVending($row['type_vending']);
									$sale->setTypeService($row['TypeService']);
									$sale->setProvider($row['NameProvider']);
									array_push($lista, $sale);

								}
                                if ($Id_Status == 3 || $Id_type_vending == 0  ){ // aqui solo entra si selecciono estatus 3: Autorizado OR  VtasWEB
                                    
                                    if ($Id_type_vending == 0 ){
                                    
									$query_2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',
                                                                       SUM(Total) 'GRAN_TOTAL_PUBLICO' 
                                                        FROM VISTA__GRAN_TOT_VTAS 
                                                        WHERE  offline LIKE '%$Id_type_vending%'  $Rango_Fechas;";
                                    //    print  $query_2 . "Ln 443";
                                    }
                                    else {
                                        
                                    $query_2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',
                                                                       SUM(Total) 'GRAN_TOTAL_PUBLICO' 
                                                        FROM VISTA__GRAN_TOT_VTAS 
                                                        WHERE isDeleted = 0 AND offline LIKE '%$Id_type_vending%' 
                                                                                            AND Id_Status LIKE '%$Id_Status%' $Rango_Fechas;";
                                    //    print  $query_2 ;
                                    }
                                    
                                    
									$stmt_2 = $conn->prepare($query_2);
									$stmt_2->execute();
									$count_2 = $stmt_2->rowCount();
									if($count_2 > 0){
										$row = $stmt_2->fetch(PDO::FETCH_ASSOC);
										//print_r($row);
										$total_publico = $row['GRAN_TOTAL_PUBLICO'];
										$total_neto = $row['GRAN_TOTAL_NETO'];
									}
								   else {
							        	$total_neto = 0;
							        	$total_publico = 0;
						        	}
								}
								else
							        $bandera = 1;
									//echo "Falla en la sumatoria";
							}
							else
								$count =0;

						 } catch (Exception $e) {
						 	echo "Error fatal: ".$e;
						 }
				}

				else {
					//por ejemplo solo vtas webs autorizadas;
					try
					{
						$db = new db();
						$conn = $db->conn_local();
						$query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, 
                        DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider 
                        FROM VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND offline LIKE '%$Id_type_vending%' 
                        AND Id_Status LIKE '%$Id_Status%' $Rango_Fechas ORDER BY Id DESC;";
						$stmt = $conn->prepare($query);
						$stmt->execute();
						$count = $stmt->rowCount();
						if($count > 0){
							$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
							$lista = array();
							//print_r($rows);
							foreach ($rows as $row) {
								//echo "<br><br>";
								//print_r($row);
								$sale = new sale_row();
								$sale->setId($row['Id']);
								$sale->setCustomer($row['Customers_Name']);
								$sale->setLastName($row['LastName']);
								$sale->setSecondName($row['SecondLastName']);
								$sale->setStatus($row['Status_payments']);
								$sale->setService($row['Services_Name']);
								$sale->setDateTo($row['DateTo']);
								$sale->setDateFrom($row['DateFrom']);
								$sale->setTotal($row['Total']);
								$sale->setSubTotal($row['Subtotal']);
								$sale->setTypeVending($row['type_vending']);
								$sale->setTypeService($row['TypeService']);
								$sale->setProvider($row['NameProvider']);
								array_push($lista, $sale);

							}
                            if ($Id_Status == 3 || $Id_type_vending == 0 ){
                                
								//$query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',
//                                                                 SUM(Total) 'GRAN_TOTAL_PUBLICO' 
//                                                  FROM VISTA__GRAN_TOT_VTAS
//                                                  WHERE isDeleted = 0 AND offline LIKE '%$Id_type_vending%' 
//                                                                                        AND Id_Status LIKE '%$Id_Status%' $Rango_Fechas;";
                                
                                if ($Id_type_vending == 0   ){
                                    
									$query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO', 
                                                                       SUM(Total) 'GRAN_TOTAL_PUBLICO' 
                                                        FROM VISTA__GRAN_TOT_VTAS 
                                                        WHERE  Id_Status = 3 AND  offline LIKE '%$Id_type_vending%'  $Rango_Fechas;";
                                      //  print $query2 ."ln 535" ;
                                    }
                                    else {
                                        
                                    $query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',
                                                                       SUM(Total) 'GRAN_TOTAL_PUBLICO' 
                                                        FROM VISTA__GRAN_TOT_VTAS 
                                                        WHERE isDeleted = 0 AND offline LIKE '%$Id_type_vending%' 
                                                                                            AND Id_Status LIKE '%$Id_Status%' $Rango_Fechas;";
                                     //  print  $query2 . "ln 544" ; 
                                    }
                                
                                
                                
                                
                                
                                
                                
								$stmt2 = $conn->prepare($query2);
								$stmt2->execute();
								$count2 = $stmt2->rowCount();
								if($count2 > 0){
									$row = $stmt2->fetch(PDO::FETCH_ASSOC);
									// print_r($row);
									$total_publico = $row['GRAN_TOTAL_PUBLICO'];
									$total_neto = $row['GRAN_TOTAL_NETO'];
								}
						        else {
						        	$total_neto = 0;
						        	$total_publico = 0;
						        }
							}
							else
						        $bandera = 1;

						}
						else
							$count =0;

					 } catch (Exception $e) {
					 	echo "Error fatal: ".$e;
					 }
				}
			}
			include "views/Sales/Vtas_Tot_Contenedor.php";
	/*Ambos cierres del post	}
	}*/
	/*}*/
}


/*---<>}}}}*>--------------------------------------------------------------------------------------------------------------------*/
public function getTrips(){

	session_start();
	try{

	 	$Fecha_2 = date("Y-m-d");
	 	$Fecha_1 = date("Y-m-d",strtotime($Fecha_2."- 1 month"));
	 	$total_publico = 0;
		$total_neto  = 0;
		$lista = array();
         $db = new db();
		$conn = $db->conn_local();
		$query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider, Id_productos FROM  VISTA__TOT_VTAS_TRANSPORTACION WHERE isDeleted = 0 AND  Id_productos  IN ( '233', '232', '235', '270', '206', '208', '209', '271', '224', '915') AND Id_Status = 3 AND DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ORDER BY Id DESC ;";                  
        $stmt = $conn->prepare($query);             
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$sale = new sale_row(); /* nueva instancia de la clase sale_row    */
				$sale->setId($row['Id']);
				$sale->setCustomer($row['Customers_Name']);
				$sale->setLastName($row['LastName']);
				$sale->setSecondName($row['SecondLastName']);
				$sale->setStatus($row['Status_payments']);
				$sale->setService($row['Services_Name']);
				$sale->setDateTo($row['DateTo']);
				$sale->setDateFrom($row['DateFrom']);
				$sale->setTotal($row['Total']);
				$sale->setSubTotal($row['Subtotal']);
				$sale->setTypeVending($row['type_vending']);
				$sale->setTypeService($row['TypeService']);
				$sale->setProvider($row['NameProvider']);
				array_push($lista, $sale);

			}
                
			$query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',SUM(Total) 'GRAN_TOTAL_PUBLICO' FROM VISTA__TOT_VTAS_TRANSPORTACION WHERE isDeleted = 0 AND  Id_productos  IN ( '233', '232', '235', '270', '206', '208', '209', '271', '224', '915') AND Id_Status = 3 AND DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ORDER BY Id DESC ;"; 
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_publico = $row['GRAN_TOTAL_PUBLICO'];
					$total_neto = $row['GRAN_TOTAL_NETO'];

			}
			else
			    $bandera = 1; 	//echo "Falla en la sumatoria";
		}
		else
			$count= 0;
                       
         
	 	include ("views/Sales/Vtas_Trips_Contenedor.php");


	} 
    catch (Exception $e)
    {
	 	echo "Error fatal: ".$e;
	 }

}

public function postTrips() { 

	session_start();

    $total_publico = 0;
 	$total_neto  = 0;
	$lista = array();
    $exxxcel = 0;
    $Id_productos = $_POST["Id_productos"];
	$Fecha_1          = $_POST["Fecha_1"];
	$Fecha_2         = $_POST["Fecha_2"];
    
if (isset($_POST["exxxcel"])){
    $exxxcel          = $_POST["exxxcel"];
}
                 // print_r ($exxxcel)."<-exxxcel"; 
               if ($exxxcel == 100) {
                    header("Content-type: application/vnd.ms-excel; name='excel'");
                    header("Content-Disposition: filename=Rep_Oktrip_Vtas_Traslados.xls");
                    header("Pragma: no-cache");
                    header("Expires: 0");
                }

    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " DateTo BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{

		$db = new db();
		$conn = $db->conn_local();
        
        if ($Id_productos == 999 ){
            $query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider, Id_productos FROM  VISTA__TOT_VTAS_TRANSPORTACION WHERE isDeleted = 0 AND  Id_productos  IN ( '233', '232', '235', '270', '206', '208', '209', '271', '224', '915') AND Id_Status = 3  $Rango_Fechas ORDER BY Id DESC;";   
        }
        else {
		    $query = "SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total,  Subtotal, type_vending, TypeService, NameProvider, Id_productos FROM  VISTA__TOT_VTAS_TRANSPORTACION WHERE isDeleted = 0 AND  Id_Status = 3 AND Id_productos = $Id_productos  $Rango_Fechas ORDER BY Id DESC;";   
        }
        $stmt = $conn->prepare($query);             
        $stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$sale = new sale_row(); /* nueva instancia de la clase sale_row    */
				$sale->setId($row['Id']);
				$sale->setCustomer($row['Customers_Name']);
				$sale->setLastName($row['LastName']);
				$sale->setSecondName($row['SecondLastName']);
				$sale->setStatus($row['Status_payments']);
				$sale->setService($row['Services_Name']);
				$sale->setDateTo($row['DateTo']);
				$sale->setDateFrom($row['DateFrom']);
				$sale->setTotal($row['Total']);
				$sale->setSubTotal($row['Subtotal']);
				$sale->setTypeVending($row['type_vending']);
				$sale->setTypeService($row['TypeService']);
				$sale->setProvider($row['NameProvider']);
				array_push($lista, $sale);

			}
                    
			
         if ($Id_productos == 999 ){
            $query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',SUM(Total) 'GRAN_TOTAL_PUBLICO' FROM VISTA__TOT_VTAS_TRANSPORTACION WHERE isDeleted = 0 AND   Id_Status = 3 AND Id_productos  IN ( '233', '232', '235', '270', '206', '208', '209', '271', '224', '915') $Rango_Fechas;";
        }
        else {
		    $query2 ="SELECT SUM(Subtotal) 'GRAN_TOTAL_NETO',SUM(Total) 'GRAN_TOTAL_PUBLICO' FROM VISTA__TOT_VTAS_TRANSPORTACION WHERE isDeleted = 0 AND  Id_Status = 3 AND Id_productos = '$Id_productos ' $Rango_Fechas;";
        }
			$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();	
            if($count2 > 0){
				$row = $stmt2->fetch(PDO::FETCH_ASSOC);
				//print_r($row);
				$total_publico = $row['GRAN_TOTAL_PUBLICO'];
				$total_neto = $row['GRAN_TOTAL_NETO'];
			}
			else
				$bandera = 1; 	//echo "Falla en la sumatoria";
		}
		else
			$count= 0;
        
        
        
        
        

	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Vtas_Trips_Contenedor.php";	
}    


    
    
    /*---<>}}}}*>--------------------------------------------------------------------------------------------------------------------*/
public function getConsolidado(){

	session_start();
	try{
     $db = new db();
	$conn = $db->conn_local();
		
		
		
/* ███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░  */		              
    
            $query3 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_WEB',   SUM(Total) 'PUBLICO_2019_VTAS_WEB',
                               SUM(NoPeople) 'TOTAL_PAX_WEB_2019'    
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND offline = 0  AND  Id_Status = 3  AND DateTo 
                               BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   ";  // print $query3; 
           	$stmt3 = $conn->prepare($query3);
			$stmt3->execute();
        	$row = $stmt3->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_WEB = $row["NETO_2019_VTAS_WEB"]; if (empty($NETO_2019_VTAS_WEB)) { $NETO_2019_VTAS_WEB =   9096 ;  } else { $NETO_2019_VTAS_WEB = $row['NETO_2019_VTAS_WEB'] + 9096; } 
            $PUBLICO_2019_VTAS_WEB = $row["PUBLICO_2019_VTAS_WEB"]; if (empty($PUBLICO_2019_VTAS_WEB)) { $PUBLICO_2019_VTAS_WEB =  11087 ;  } else { $PUBLICO_2019_VTAS_WEB = $row['PUBLICO_2019_VTAS_WEB'] + 11087 ; } 
            $TOTAL_PAX_WEB_2019 = $row["TOTAL_PAX_WEB_2019"]; if (empty($TOTAL_PAX_WEB_2019)) { $TOTAL_PAX_WEB_2019 = 0 ;  } else { $TOTAL_PAX_WEB_2019 = $row['TOTAL_PAX_WEB_2019'] ; } 
            
            
            
            $query4 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_OFFLINE',   SUM(Total) 'PUBLICO_2019_VTAS_OFFLINE',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_2019'  
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL  
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND Id_Agents IN (0, 7) AND Commission = 0  
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
            $stmt4 = $conn->prepare($query4);
			$stmt4->execute();
        	$row = $stmt4->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_OFFLINE = $row["NETO_2019_VTAS_OFFLINE"]; if (empty($NETO_2019_VTAS_OFFLINE)) { $NETO_2019_VTAS_OFFLINE =   6683 ;  } else { $NETO_2019_VTAS_OFFLINE = $row['NETO_2019_VTAS_OFFLINE'] + 6683; } 
            $PUBLICO_2019_VTAS_OFFLINE = $row["PUBLICO_2019_VTAS_OFFLINE"]; if (empty($PUBLICO_2019_VTAS_OFFLINE)) { $PUBLICO_2019_VTAS_OFFLINE =  8036 ;  } else { $PUBLICO_2019_VTAS_OFFLINE = $row['PUBLICO_2019_VTAS_OFFLINE'] + 8036 ; } 
            $TOTAL_PAX_OFFLINE_2019 = $row["TOTAL_PAX_OFFLINE_2019"]; if (empty($TOTAL_PAX_OFFLINE_2019)) { $TOTAL_PAX_OFFLINE_2019 = 0 ;  } else { $TOTAL_PAX_OFFLINE_2019 = $row['TOTAL_PAX_OFFLINE_2019'] ; } 
            
            
            
            $query5 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_OFFLINE_REPS',   SUM(Total) 'PUBLICO_2019_VTAS_OFFLINE_REPS',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_REPS_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND  Id_Agents NOT IN (0, 7) AND Commission <> 0 
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
       		$stmt5 = $conn->prepare($query5);
			$stmt5->execute();
        	$row = $stmt5->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_OFFLINE_REPS = $row["NETO_2019_VTAS_OFFLINE_REPS"]; if (empty($NETO_2019_VTAS_OFFLINE_REPS)) { $NETO_2019_VTAS_OFFLINE_REPS =   158277 ;  } else { $NETO_2019_VTAS_OFFLINE_REPS = $row['NETO_2019_VTAS_OFFLINE_REPS'] + 158277; } 
            $PUBLICO_2019_VTAS_OFFLINE_REPS = $row["PUBLICO_2019_VTAS_OFFLINE_REPS"]; if (empty($PUBLICO_2019_VTAS_OFFLINE_REPS)) { $PUBLICO_2019_VTAS_OFFLINE_REPS =  186047 ;  } else { $PUBLICO_2019_VTAS_OFFLINE_REPS = $row['PUBLICO_2019_VTAS_OFFLINE_REPS'] + 186047 ; } 
            $TOTAL_PAX_OFFLINE_REPS_2019 = $row["TOTAL_PAX_OFFLINE_REPS_2019"]; if (empty($TOTAL_PAX_OFFLINE_REPS_2019)) { $TOTAL_PAX_OFFLINE_REPS_2019 = 0 ;  } else { $TOTAL_PAX_OFFLINE_REPS_2019 = $row['TOTAL_PAX_OFFLINE_REPS_2019'] ; } 
            
            
            
            
          /* $query6 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_TRAS_7USD',   SUM(Total) 'PUBLICO_2019_VTAS_TRAS_7USD', 
                               SUM(NoPeople) 'TOTAL_PAX_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 232 
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
							  
		  */					  
							  
            $query6 ="   SELECT SUM(total_neto) 'NETO_2019_VTAS_TRAS_7USD',   SUM(total_publico) 'PUBLICO_2019_VTAS_TRAS_7USD',  SUM(paxxx) 'TOTAL_PAX_2019'
					      FROM volaris
					      WHERE Id_productos = 232
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE)
						     AND CAST('2019-12-31' AS DATE); "; 		
       		$stmt6 = $conn->prepare($query6);
			$stmt6->execute();
        	$row = $stmt6->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_TRAS_7USD = $row["NETO_2019_VTAS_TRAS_7USD"]; if (empty($NETO_2019_VTAS_TRAS_7USD)) { $NETO_2019_VTAS_TRAS_7USD =   13513 ;  } else { $NETO_2019_VTAS_TRAS_7USD = $row['NETO_2019_VTAS_TRAS_7USD'] + 13513; } 
            $PUBLICO_2019_VTAS_TRAS_7USD = $row["PUBLICO_2019_VTAS_TRAS_7USD"]; if (empty($PUBLICO_2019_VTAS_TRAS_7USD)) { $PUBLICO_2019_VTAS_TRAS_7USD =  28695 ;  } else { $PUBLICO_2019_VTAS_TRAS_7USD = $row['PUBLICO_2019_VTAS_TRAS_7USD'] + 28695 ; } 
            $TOT_PAX_2019 = $row["TOTAL_PAX_2019"]; if (empty($TOT_PAX_2019)) { $TOT_PAX_2019 = 174 ;  } else { $TOT_PAX_2019 = $row['TOTAL_PAX_2019'] + 174 ; } 
			/* suma de totales son de la vista VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL de 01.01.19  a 19.11.19*/
			
			
			
			$query_316 =" SELECT SUM(total_neto) 'NETO_2019_VTAS_TRAS_12USD',   SUM(total_publico) 'PUBLICO_2019_VTAS_TRAS_12USD',  SUM(paxxx) 'TOT_PAX_12USD_2019'
					      FROM volaris
					      WHERE Id_productos = 316
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE)
						     AND CAST('2019-12-31' AS DATE); "; 
       		$stmt_316 = $conn->prepare($query_316);
			$stmt_316->execute();
        	$row = $stmt_316->fetch(PDO::FETCH_ASSOC);
			$NETO_2019_VTAS_TRAS_12USD = $row["NETO_2019_VTAS_TRAS_12USD"]; if (empty($NETO_2019_VTAS_TRAS_12USD)) { $NETO_2019_VTAS_TRAS_12USD =   0 ;  } else { $NETO_2019_VTAS_TRAS_12USD = $row['NETO_2019_VTAS_TRAS_12USD'] ; } 
            $PUBLICO_2019_VTAS_TRAS_12USD = $row["PUBLICO_2019_VTAS_TRAS_12USD"]; if (empty($PUBLICO_2019_VTAS_TRAS_12USD)) { $PUBLICO_2019_VTAS_TRAS_12USD =  0 ;  } else { $PUBLICO_2019_VTAS_TRAS_12USD = $row['PUBLICO_2019_VTAS_TRAS_12USD'] ; } 
            $TOT_PAX_12USD_2019 = $row["TOT_PAX_12USD_2019"]; if (empty($TOT_PAX_12USD_2019)) { $TOT_PAX_12USD_2019 = $TOT_PAX_12USD_2019 ;  } else { $TOT_PAX_12USD_2019 = $row['TOT_PAX_12USD_2019']  ; } 
    
	
	
	        $query_235 =" SELECT SUM(total_neto) 'NETO_2019_VTAS_TRAS_PRIVADA',   SUM(total_publico) 'PUBLICO_2019_VTAS_TRAS_PRIVADA',  SUM(paxxx) 'TOT_PAX_PRIVADA_2019'
					      FROM volaris
					      WHERE Id_productos = 235
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE)
						     AND CAST('2019-12-31' AS DATE); "; 
       		$stmt_235 = $conn->prepare($query_235);
			$stmt_235->execute();
        	$row = $stmt_235->fetch(PDO::FETCH_ASSOC);
			$NETO_2019_VTAS_TRAS_PRIVADA = $row["NETO_2019_VTAS_TRAS_PRIVADA"]; if (empty($NETO_2019_VTAS_TRAS_PRIVADA)) { $NETO_2019_VTAS_TRAS_PRIVADA =   0 ;  } else { $NETO_2019_VTAS_TRAS_PRIVADA = $row['NETO_2019_VTAS_TRAS_PRIVADA'] ; } 
            $PUBLICO_2019_VTAS_TRAS_PRIVADA = $row["PUBLICO_2019_VTAS_TRAS_PRIVADA"]; if (empty($PUBLICO_2019_VTAS_TRAS_PRIVADA)) { $PUBLICO_2019_VTAS_TRAS_PRIVADA =  0 ;  } else { $PUBLICO_2019_VTAS_TRAS_PRIVADA = $row['PUBLICO_2019_VTAS_TRAS_PRIVADA'] ; } 
            $TOT_PAX_PRIVADA_2019 = $row["TOT_PAX_PRIVADA_2019"]; if (empty($TOT_PAX_PRIVADA_2019)) { $TOT_PAX_PRIVADA_2019 = $TOT_PAX_PRIVADA_2019 ;  } else { $TOT_PAX_PRIVADA_2019 = $row['TOT_PAX_PRIVADA_2019']  ; } 
    
	
	
			
			
            
            
                        
            $query7 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ULTRAMAR',   SUM(Total) 'PUBLICO_2019_VTAS_ULTRAMAR', 
                               SUM(NoPeople) 'TOTAL_PAX_ULTRAMAR_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 276  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt7 = $conn->prepare($query7);
			$stmt7->execute();
        	$row = $stmt7->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_ULTRAMAR = $row["NETO_2019_VTAS_ULTRAMAR"]; if (empty($NETO_2019_VTAS_ULTRAMAR)) { $NETO_2019_VTAS_ULTRAMAR =  18359 ;  } else { $NETO_2019_VTAS_ULTRAMAR = $row['NETO_2019_VTAS_ULTRAMAR'] + 18359; } 
            $PUBLICO_2019_VTAS_ULTRAMAR = $row["PUBLICO_2019_VTAS_ULTRAMAR"]; if (empty($PUBLICO_2019_VTAS_ULTRAMAR)) { $PUBLICO_2019_VTAS_ULTRAMAR =  22624 ;  } else { $PUBLICO_2019_VTAS_ULTRAMAR = $row['PUBLICO_2019_VTAS_ULTRAMAR'] + 22624 ; } 
            $TOTAL_PAX_ULTRAMAR_2019 = $row["TOTAL_PAX_ULTRAMAR_2019"]; if (empty($TOTAL_PAX_ULTRAMAR_2019)) { $TOTAL_PAX_ULTRAMAR_2019 = 0 ;  } else { $TOTAL_PAX_ULTRAMAR_2019 = $row['TOTAL_PAX_ULTRAMAR_2019'] ; } 
            
            
        $query9 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ALOHAKAI',   SUM(Total) 'PUBLICO_2019_VTAS_ALOHAKAI', 
                               SUM(NoPeople) 'TOTAL_PAX_ALOHAKAI_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 283  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt9 = $conn->prepare($query9);
			$stmt9->execute();
        	$row = $stmt9->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_ALOHAKAI = $row["NETO_2019_VTAS_ALOHAKAI"]; if (empty($NETO_2019_VTAS_ALOHAKAI)) { $NETO_2019_VTAS_ALOHAKAI =  0 ;  } 
            $PUBLICO_2019_VTAS_ALOHAKAI = $row["PUBLICO_2019_VTAS_ALOHAKAI"]; if (empty($PUBLICO_2019_VTAS_ALOHAKAI)) { $PUBLICO_2019_VTAS_ALOHAKAI =  0 ;  } 
            $TOTAL_PAX_ALOHAKAI_2019 = $row["TOTAL_PAX_ALOHAKAI_2019"]; if (empty($TOTAL_PAX_ALOHAKAI_2019)) { $TOTAL_PAX_ALOHAKAI_2019 = 0 ;  }  
            
        
        
        
           $query10 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_AZULTRAVEL',   SUM(Total) 'PUBLICO_2019_VTAS_AZULTRAVEL', 
                               SUM(NoPeople) 'TOTAL_PAX_AZULTRAVEL_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 284  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt10 = $conn->prepare($query10);
			$stmt10->execute();
        	$row = $stmt10->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_AZULTRAVEL = $row["NETO_2019_VTAS_AZULTRAVEL"]; if (empty($NETO_2019_VTAS_AZULTRAVEL)) { $NETO_2019_VTAS_AZULTRAVEL =  0 ;  } 
            $PUBLICO_2019_VTAS_AZULTRAVEL = $row["PUBLICO_2019_VTAS_AZULTRAVEL"]; if (empty($PUBLICO_2019_VTAS_AZULTRAVEL)) { $PUBLICO_2019_VTAS_AZULTRAVEL =  0 ;  }  
            $TOTAL_PAX_AZULTRAVEL_2019 = $row["TOTAL_PAX_AZULTRAVEL_2019"]; if (empty($TOTAL_PAX_AZULTRAVEL_2019)) { $TOTAL_PAX_AZULTRAVEL_2019 = 0 ;  } 
            
        
        
        
        
        
            $query8 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_GPH',   SUM(Total) 'PUBLICO_2019_VTAS_GPH', 
                               SUM(NoPeople) 'TOTAL_PAX_GPH_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 278  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt8 = $conn->prepare($query8);
			$stmt8->execute();
        	$row = $stmt8->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_GPH = $row["NETO_2019_VTAS_GPH"]; if (empty($NETO_2019_VTAS_GPH)) { $NETO_2019_VTAS_GPH =  $NETO_2019_VTAS_GPH ;  } else { $NETO_2019_VTAS_GPH = $row['NETO_2019_VTAS_GPH'] ; } 
            $PUBLICO_2019_VTAS_GPH = $row["PUBLICO_2019_VTAS_GPH"]; if (empty($PUBLICO_2019_VTAS_GPH)) { $PUBLICO_2019_VTAS_GPH =  $PUBLICO_2019_VTAS_GPH ;  } else { $PUBLICO_2019_VTAS_GPH = $row['PUBLICO_2019_VTAS_GPH']  ; } 
            $TOTAL_PAX_GPH_2019 = $row["TOTAL_PAX_GPH_2019"]; if (empty($TOTAL_PAX_GPH_2019)) { $TOTAL_PAX_GPH_2019 = 0 ;  } else { $TOTAL_PAX_GPH_2019 = $row['TOTAL_PAX_GPH_2019'] ; } 
            
        
              
        
        /* $query1b =" SELECT SUM(NoPeople) 'TOTAL_PAX_GRATIS_2019' 
	                            FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                            WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 233 
	                            AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
								*/
								
		    $query1b ="  SELECT SUM(paxxx) 'TOTAL_PAX_GRATIS_2019'
					      FROM volaris
					      WHERE Id_productos = 233
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE)
						     AND CAST('2019-12-31' AS DATE); "; 		
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
            $TOTAL_PAX_GRATIS_2019 = $row["TOTAL_PAX_GRATIS_2019"]; if (empty($TOTAL_PAX_GRATIS_2019)) { $TOTAL_PAX_GRATIS_2019 = 152 ;  } else { $TOTAL_PAX_GRATIS_2019 = $row['TOTAL_PAX_GRATIS_2019'] + 152 ; } 
            
        


            $query1c ="SELECT SUM(paxxx) 'TOT_PAX_IN_2019'
					 FROM volaris
					 WHERE Id_productos = 270
						 AND fecha_llegada <> '0000-00-00'
						 AND isDeleted = 0
						 AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE)
						 AND CAST('2019-12-31' AS DATE); "; 
       		$stmt1c = $conn->prepare($query1c);
			$stmt1c->execute();
        	$row = $stmt1c->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_IN_2019 = $row["TOT_PAX_IN_2019"]; if (empty($TOT_PAX_IN_2019)) { $TOT_PAX_IN_2019 = 348 ;  } else { $TOT_PAX_IN_2019 = $row['TOT_PAX_IN_2019'] + 348 ; } 
            $TOT_PAX_IN_2019 = $row["TOT_PAX_IN_2019"]; if (empty($TOT_PAX_IN_2019)) { $TOT_PAX_IN_2019 = $TOT_PAX_IN_2019 ;  } else { $TOT_PAX_IN_2019 = $row['TOT_PAX_IN_2019']  ; } 
         
        
        
        $query1d =" SELECT SUM(paxxx) 'TOT_PAX_OUT_2019'
					FROM volaris
					WHERE Id_productos = 270
						AND fecha_salida <> '0000-00-00'
						AND isDeleted = 0
						AND fecha_salida BETWEEN CAST('2019-01-01' AS DATE)
						AND CAST('2019-12-31' AS DATE);  "; 
						
		
		    $stmt1d = $conn->prepare($query1d);
			$stmt1d->execute();
        	$row = $stmt1d->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_OUT_2019 = $row["TOT_PAX_OUT_2019"]; if (empty($TOT_PAX_OUT_2019)) { $TOT_PAX_OUT_2019 = 346 ;  } else { $TOT_PAX_OUT_2019 = $row['TOT_PAX_OUT_2019'] + 346 ; } 
            $TOT_PAX_OUT_2019 = $row["TOT_PAX_OUT_2019"]; if (empty($TOT_PAX_OUT_2019)) { $TOT_PAX_OUT_2019 = $TOT_PAX_OUT_2019 ;  } else { $TOT_PAX_OUT_2019 = $row['TOT_PAX_OUT_2019'] ; } 
            
            
        
        
$TOT_N_2019  = $NETO_2019_VTAS_WEB + $NETO_2019_VTAS_OFFLINE +  $NETO_2019_VTAS_OFFLINE_REPS + $NETO_2019_VTAS_TRAS_7USD + $NETO_2019_VTAS_ULTRAMAR + $NETO_2019_VTAS_GPH + $NETO_2019_VTAS_ALOHAKAI + $NETO_2019_VTAS_AZULTRAVEL + $NETO_2019_VTAS_TRAS_12USD + $NETO_2019_VTAS_TRAS_PRIVADA ;
$TOT_P_2019  = $PUBLICO_2019_VTAS_WEB + $PUBLICO_2019_VTAS_OFFLINE + $PUBLICO_2019_VTAS_OFFLINE_REPS +  $PUBLICO_2019_VTAS_TRAS_7USD + $PUBLICO_2019_VTAS_ULTRAMAR + $PUBLICO_2019_VTAS_GPH + $PUBLICO_2019_VTAS_ALOHAKAI + $PUBLICO_2019_VTAS_AZULTRAVEL + $PUBLICO_2019_VTAS_TRAS_12USD + $PUBLICO_2019_VTAS_TRAS_PRIVADA ;
$TOT_PAX     = $TOTAL_PAX_WEB_2019 + $TOTAL_PAX_OFFLINE_2019 + $TOTAL_PAX_OFFLINE_REPS_2019 +  $TOT_PAX_2019 + $TOTAL_PAX_GRATIS_2019 + $TOTAL_PAX_ULTRAMAR_2019 + $TOT_PAX_IN_2019 + $TOT_PAX_OUT_2019 + $TOTAL_PAX_GPH_2019 + $TOTAL_PAX_ALOHAKAI_2019 + $TOTAL_PAX_AZULTRAVEL_2019 + $TOT_PAX_12USD_2019 + $TOT_PAX_PRIVADA_2019 ;

		
/* ███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░  */		
		
		    $query3_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_WEB',   SUM(Total) 'PUBLICO_2020_VTAS_WEB',
                               SUM(NoPeople) 'TOTAL_PAX_WEB_2020'    
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND offline = 0  AND  Id_Status = 3  AND DateTo 
                               BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;   ";  // print $query3; 
           	$stmt3_2020 = $conn->prepare($query3_2020);
			$stmt3_2020->execute();
        	$row = $stmt3_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_WEB = $row["NETO_2020_VTAS_WEB"]; if (empty($NETO_2020_VTAS_WEB)) { $NETO_2020_VTAS_WEB =   0 ;  } else { $NETO_2020_VTAS_WEB = $row['NETO_2020_VTAS_WEB'] + 0; } 
            $PUBLICO_2020_VTAS_WEB = $row["PUBLICO_2020_VTAS_WEB"]; if (empty($PUBLICO_2020_VTAS_WEB)) { $PUBLICO_2020_VTAS_WEB =  0 ;  } else { $PUBLICO_2020_VTAS_WEB = $row['PUBLICO_2020_VTAS_WEB'] + 0 ; } 
            $TOTAL_PAX_WEB_2020 = $row["TOTAL_PAX_WEB_2020"]; if (empty($TOTAL_PAX_WEB_2020)) { $TOTAL_PAX_WEB_2020 = 0 ;  } else { $TOTAL_PAX_WEB_2020 = $row['TOTAL_PAX_WEB_2020'] ; } 
            
            
            
            $query4_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_OFFLINE',   SUM(Total) 'PUBLICO_2020_VTAS_OFFLINE',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_2020'  
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL  
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND Id_Agents IN (0, 7) AND Commission = 0  
	                          AND DateTo BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;   "; 
            $stmt4_2020 = $conn->prepare($query4_2020);
			$stmt4_2020->execute();
        	$row = $stmt4_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_OFFLINE = $row["NETO_2020_VTAS_OFFLINE"]; if (empty($NETO_2020_VTAS_OFFLINE)) { $NETO_2020_VTAS_OFFLINE =   0 ;  } else { $NETO_2020_VTAS_OFFLINE = $row['NETO_2020_VTAS_OFFLINE'] + 0; } 
            $PUBLICO_2020_VTAS_OFFLINE = $row["PUBLICO_2020_VTAS_OFFLINE"]; if (empty($PUBLICO_2020_VTAS_OFFLINE)) { $PUBLICO_2020_VTAS_OFFLINE =  0 ;  } else { $PUBLICO_2020_VTAS_OFFLINE = $row['PUBLICO_2020_VTAS_OFFLINE'] + 0 ; } 
            $TOTAL_PAX_OFFLINE_2020 = $row["TOTAL_PAX_OFFLINE_2020"]; if (empty($TOTAL_PAX_OFFLINE_2020)) { $TOTAL_PAX_OFFLINE_2020 = 0 ;  } else { $TOTAL_PAX_OFFLINE_2020 = $row['TOTAL_PAX_OFFLINE_2020'] ; } 
            
            
            
            $query5_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_OFFLINE_REPS',   SUM(Total) 'PUBLICO_2020_VTAS_OFFLINE_REPS',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_REPS_2020' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND  Id_Agents NOT IN (0, 7) AND Commission <> 0 
	                          AND DateTo BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;   "; 
       		$stmt5_2020 = $conn->prepare($query5_2020);
			$stmt5_2020->execute();
        	$row = $stmt5_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_OFFLINE_REPS = $row["NETO_2020_VTAS_OFFLINE_REPS"]; if (empty($NETO_2020_VTAS_OFFLINE_REPS)) { $NETO_2020_VTAS_OFFLINE_REPS =   0 ;  } else { $NETO_2020_VTAS_OFFLINE_REPS = $row['NETO_2020_VTAS_OFFLINE_REPS'] + 0; } 
            $PUBLICO_2020_VTAS_OFFLINE_REPS = $row["PUBLICO_2020_VTAS_OFFLINE_REPS"]; if (empty($PUBLICO_2020_VTAS_OFFLINE_REPS)) { $PUBLICO_2020_VTAS_OFFLINE_REPS =  0 ;  } else { $PUBLICO_2020_VTAS_OFFLINE_REPS = $row['PUBLICO_2020_VTAS_OFFLINE_REPS'] + 0 ; } 
            $TOTAL_PAX_OFFLINE_REPS_2020 = $row["TOTAL_PAX_OFFLINE_REPS_2020"]; if (empty($TOTAL_PAX_OFFLINE_REPS_2020)) { $TOTAL_PAX_OFFLINE_REPS_2020 = 0 ;  } else { $TOTAL_PAX_OFFLINE_REPS_2020 = $row['TOTAL_PAX_OFFLINE_REPS_2020'] ; } 
            
            
            
            
          /* $query6 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_TRAS_7USD',   SUM(Total) 'PUBLICO_2020_VTAS_TRAS_7USD', 
                               SUM(NoPeople) 'TOTAL_PAX_2020' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 232 
	                          AND DateTo BETWEEN CAST('2020-02-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;   "; 
							  
		  */					  
							  
            $query6_2020 ="   SELECT SUM(total_neto) 'NETO_2020_VTAS_TRAS_7USD',   SUM(total_publico) 'PUBLICO_2020_VTAS_TRAS_7USD',  SUM(paxxx) 'TOT_PAX_7USD_2020'
					      FROM volaris
					      WHERE Id_productos = 232
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2020-01-01' AS DATE)
						     AND CAST('2020-12-31' AS DATE); "; 		
       		$stmt6_2020 = $conn->prepare($query6_2020);
			$stmt6_2020->execute();
        	$row = $stmt6_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_TRAS_7USD = $row["NETO_2020_VTAS_TRAS_7USD"]; if (empty($NETO_2020_VTAS_TRAS_7USD)) { $NETO_2020_VTAS_TRAS_7USD =   0 ;  } else { $NETO_2020_VTAS_TRAS_7USD = $row['NETO_2020_VTAS_TRAS_7USD'] + 0; } 
            $PUBLICO_2020_VTAS_TRAS_7USD = $row["PUBLICO_2020_VTAS_TRAS_7USD"]; if (empty($PUBLICO_2020_VTAS_TRAS_7USD)) { $PUBLICO_2020_VTAS_TRAS_7USD =  0 ;  } else { $PUBLICO_2020_VTAS_TRAS_7USD = $row['PUBLICO_2020_VTAS_TRAS_7USD'] + 0 ; } 
            $TOT_PAX_7USD_2020 = $row["TOT_PAX_7USD_2020"]; if (empty($TOT_PAX_7USD_2020)) { $TOT_PAX_7USD_2020 = 0 ;  } else { $TOT_PAX_7USD_2020 = $row['TOT_PAX_7USD_2020'] + 0 ; } 
			/* suma de totales son de la vista VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL de 01.01.19  a 19.11.19*/
			
			
			
			$query_316_2020 =" SELECT SUM(total_neto) 'NETO_2020_VTAS_TRAS_12USD',   SUM(total_publico) 'PUBLICO_2020_VTAS_TRAS_12USD',  SUM(paxxx) 'TOT_PAX_12USD_2020'
					      FROM volaris
					      WHERE Id_productos = 316
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2020-01-01' AS DATE)
						     AND CAST('2020-12-31' AS DATE); "; 
       		$stmt_316_2020 = $conn->prepare($query_316_2020);
			$stmt_316_2020->execute();
        	$row = $stmt_316_2020->fetch(PDO::FETCH_ASSOC);
			$NETO_2020_VTAS_TRAS_12USD = $row["NETO_2020_VTAS_TRAS_12USD"]; if (empty($NETO_2020_VTAS_TRAS_12USD)) { $NETO_2020_VTAS_TRAS_12USD =   0 ;  } else { $NETO_2020_VTAS_TRAS_12USD = $row['NETO_2020_VTAS_TRAS_12USD'] ; } 
            $PUBLICO_2020_VTAS_TRAS_12USD = $row["PUBLICO_2020_VTAS_TRAS_12USD"]; if (empty($PUBLICO_2020_VTAS_TRAS_12USD)) { $PUBLICO_2020_VTAS_TRAS_12USD =  0 ;  } else { $PUBLICO_2020_VTAS_TRAS_12USD = $row['PUBLICO_2020_VTAS_TRAS_12USD'] ; } 
            $TOT_PAX_12USD_2020 = $row["TOT_PAX_12USD_2020"]; if (empty($TOT_PAX_12USD_2020)) { $TOT_PAX_12USD_2020 = 0 ;  } else { $TOT_PAX_12USD_2020 = $row['TOT_PAX_12USD_2020'] + 0 ; } 
    
	
	
	        $query_235_2020 =" SELECT SUM(total_neto) 'NETO_2020_VTAS_TRAS_PRIVADA',   SUM(total_publico) 'PUBLICO_2020_VTAS_TRAS_PRIVADA',  SUM(paxxx) 'TOT_PAX_PRIVADA_2020'
					      FROM volaris
					      WHERE Id_productos = 235
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2020-01-01' AS DATE)
						     AND CAST('2020-12-31' AS DATE); "; 
       		$stmt_235_2020 = $conn->prepare($query_235_2020);
			$stmt_235_2020->execute();
        	$row = $stmt_235_2020->fetch(PDO::FETCH_ASSOC);
			$NETO_2020_VTAS_TRAS_PRIVADA = $row["NETO_2020_VTAS_TRAS_PRIVADA"]; if (empty($NETO_2020_VTAS_TRAS_PRIVADA)) { $NETO_2020_VTAS_TRAS_PRIVADA =   0 ;  } else { $NETO_2020_VTAS_TRAS_PRIVADA = $row['NETO_2020_VTAS_TRAS_PRIVADA'] ; } 
            $PUBLICO_2020_VTAS_TRAS_PRIVADA = $row["PUBLICO_2020_VTAS_TRAS_PRIVADA"]; if (empty($PUBLICO_2020_VTAS_TRAS_PRIVADA)) { $PUBLICO_2020_VTAS_TRAS_PRIVADA =  0 ;  } else { $PUBLICO_2020_VTAS_TRAS_PRIVADA = $row['PUBLICO_2020_VTAS_TRAS_PRIVADA'] ; } 
            $TOT_PAX_PRIVADA_2020 = $row["TOT_PAX_PRIVADA_2020"]; if (empty($TOT_PAX_PRIVADA_2020)) { $TOT_PAX_PRIVADA_2020 = 0 ;  } else { $TOT_PAX_PRIVADA_2020 = $row['TOT_PAX_PRIVADA_2020'] + 0 ; } 
    
	
	
			
			
            
            
                        
            $query7_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_ULTRAMAR',   SUM(Total) 'PUBLICO_2020_VTAS_ULTRAMAR', 
                               SUM(NoPeople) 'TOTAL_PAX_ULTRAMAR_2020' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 276  
                               AND DateTo BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;  "; 
       		$stmt7_2020 = $conn->prepare($query7_2020);
			$stmt7_2020->execute();
        	$row = $stmt7_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_ULTRAMAR = $row["NETO_2020_VTAS_ULTRAMAR"]; if (empty($NETO_2020_VTAS_ULTRAMAR)) { $NETO_2020_VTAS_ULTRAMAR =  0 ;  } else { $NETO_2020_VTAS_ULTRAMAR = $row['NETO_2020_VTAS_ULTRAMAR'] + 0; } 
            $PUBLICO_2020_VTAS_ULTRAMAR = $row["PUBLICO_2020_VTAS_ULTRAMAR"]; if (empty($PUBLICO_2020_VTAS_ULTRAMAR)) { $PUBLICO_2020_VTAS_ULTRAMAR =  0 ;  } else { $PUBLICO_2020_VTAS_ULTRAMAR = $row['PUBLICO_2020_VTAS_ULTRAMAR'] + 0 ; } 
            $TOTAL_PAX_ULTRAMAR_2020 = $row["TOTAL_PAX_ULTRAMAR_2020"]; if (empty($TOTAL_PAX_ULTRAMAR_2020)) { $TOTAL_PAX_ULTRAMAR_2020 = 0 ;  } else { $TOTAL_PAX_ULTRAMAR_2020 = $row['TOTAL_PAX_ULTRAMAR_2020'] ; } 
            
            
        $query9_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_ALOHAKAI',   SUM(Total) 'PUBLICO_2020_VTAS_ALOHAKAI', 
                               SUM(NoPeople) 'TOTAL_PAX_ALOHAKAI_2020' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 283  
                               AND DateTo BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;  "; 
       		$stmt9_2020 = $conn->prepare($query9_2020);
			$stmt9_2020->execute();
        	$row = $stmt9_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_ALOHAKAI = $row["NETO_2020_VTAS_ALOHAKAI"]; if (empty($NETO_2020_VTAS_ALOHAKAI)) { $NETO_2020_VTAS_ALOHAKAI =  0 ;  } 
            $PUBLICO_2020_VTAS_ALOHAKAI = $row["PUBLICO_2020_VTAS_ALOHAKAI"]; if (empty($PUBLICO_2020_VTAS_ALOHAKAI)) { $PUBLICO_2020_VTAS_ALOHAKAI =  0 ;  } 
            $TOTAL_PAX_ALOHAKAI_2020 = $row["TOTAL_PAX_ALOHAKAI_2020"]; if (empty($TOTAL_PAX_ALOHAKAI_2020)) { $TOTAL_PAX_ALOHAKAI_2020 = 0 ;  }  
            
        
        
        
           $query10_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_AZULTRAVEL',   SUM(Total) 'PUBLICO_2020_VTAS_AZULTRAVEL', 
                               SUM(NoPeople) 'TOTAL_PAX_AZULTRAVEL_2020' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 284  
                               AND DateTo BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;  "; 
       		$stmt10_2020 = $conn->prepare($query10_2020);
			$stmt10_2020->execute();
        	$row = $stmt10_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_AZULTRAVEL = $row["NETO_2020_VTAS_AZULTRAVEL"]; if (empty($NETO_2020_VTAS_AZULTRAVEL)) { $NETO_2020_VTAS_AZULTRAVEL =  0 ;  } 
            $PUBLICO_2020_VTAS_AZULTRAVEL = $row["PUBLICO_2020_VTAS_AZULTRAVEL"]; if (empty($PUBLICO_2020_VTAS_AZULTRAVEL)) { $PUBLICO_2020_VTAS_AZULTRAVEL =  0 ;  }  
            $TOTAL_PAX_AZULTRAVEL_2020 = $row["TOTAL_PAX_AZULTRAVEL_2020"]; if (empty($TOTAL_PAX_AZULTRAVEL_2020)) { $TOTAL_PAX_AZULTRAVEL_2020 = 0 ;  } 
            
        
        
        
        
        
            $query8_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_GPH',   SUM(Total) 'PUBLICO_2020_VTAS_GPH', 
                               SUM(NoPeople) 'TOTAL_PAX_GPH_2020' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 278  
                               AND DateTo BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;  "; 
       		$stmt8_2020 = $conn->prepare($query8_2020);
			$stmt8_2020->execute();
        	$row = $stmt8_2020->fetch(PDO::FETCH_ASSOC);
            $NETO_2020_VTAS_GPH = $row["NETO_2020_VTAS_GPH"]; if (empty($NETO_2020_VTAS_GPH)) { $NETO_2020_VTAS_GPH =  0 ;  } else { $NETO_2020_VTAS_GPH = $row['NETO_2020_VTAS_GPH'] ; } 
            $PUBLICO_2020_VTAS_GPH = $row["PUBLICO_2020_VTAS_GPH"]; if (empty($PUBLICO_2020_VTAS_GPH)) { $PUBLICO_2020_VTAS_GPH =  0 ;  } else { $PUBLICO_2020_VTAS_GPH = $row['PUBLICO_2020_VTAS_GPH']  ; } 
            $TOTAL_PAX_GPH_2020 = $row["TOTAL_PAX_GPH_2020"]; if (empty($TOTAL_PAX_GPH_2020)) { $TOTAL_PAX_GPH_2020 = 0 ;  } else { $TOTAL_PAX_GPH_2020 = $row['TOTAL_PAX_GPH_2020'] ; } 
            
        
              
        
        /* $query1b =" SELECT SUM(NoPeople) 'TOTAL_PAX_GRATIS_2020' 
	                            FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                            WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 233 
	                            AND DateTo BETWEEN CAST('2020-02-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;  "; 
								*/
								
		    $query1b_2020 ="  SELECT SUM(paxxx) 'TOTAL_PAX_GRATIS_2020'
					      FROM volaris
					      WHERE Id_productos = 233
						     AND isDeleted = 0
						     AND fecha_llegada BETWEEN CAST('2020-01-01' AS DATE)
						     AND CAST('2020-12-31' AS DATE); "; 		
       		$stmt1b_2020 = $conn->prepare($query1b_2020);
			$stmt1b_2020->execute();
        	$row = $stmt1b_2020->fetch(PDO::FETCH_ASSOC);
            $TOTAL_PAX_GRATIS_2020 = $row["TOTAL_PAX_GRATIS_2020"]; if (empty($TOTAL_PAX_GRATIS_2020)) { $TOTAL_PAX_GRATIS_2020 = 0 ;  } else { $TOTAL_PAX_GRATIS_2020 = $row['TOTAL_PAX_GRATIS_2020'] + 0 ; } 
            
        


            $query1c_2020 ="SELECT SUM(paxxx) 'TOT_PAX_IN_2020'
					 FROM volaris
					 WHERE Id_productos = 270
						 AND fecha_llegada <> '0000-00-00'
						 AND isDeleted = 0
						 AND fecha_llegada BETWEEN CAST('2020-01-01' AS DATE)
						 AND CAST('2020-12-31' AS DATE); "; 
       		$stmt1c_2020 = $conn->prepare($query1c_2020);
			$stmt1c_2020->execute();
        	$row = $stmt1c_2020->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_IN_2020 = $row["TOT_PAX_IN_2020"]; if (empty($TOT_PAX_IN_2020)) { $TOT_PAX_IN_2020 = 348 ;  } else { $TOT_PAX_IN_2020 = $row['TOT_PAX_IN_2020'] + 348 ; } 
            $TOT_PAX_IN_2020 = $row["TOT_PAX_IN_2020"]; if (empty($TOT_PAX_IN_2020)) { $TOT_PAX_IN_2020 = 0 ;  } else { $TOT_PAX_IN_2020 = $row['TOT_PAX_IN_2020']  ; } 
         
        
        
        $query1d_2020 =" SELECT SUM(paxxx) 'TOT_PAX_OUT_2020'
					FROM volaris
					WHERE Id_productos = 270
						AND fecha_salida <> '0000-00-00'
						AND isDeleted = 0
						AND fecha_salida BETWEEN CAST('2020-01-01' AS DATE)
						AND CAST('2020-12-31' AS DATE);  "; 
						
		
		    $stmt1d_2020 = $conn->prepare($query1d_2020);
			$stmt1d_2020->execute();
        	$row = $stmt1d_2020->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_OUT_2020 = $row["TOT_PAX_OUT_2020"]; if (empty($TOT_PAX_OUT_2020)) { $TOT_PAX_OUT_2020 = 346 ;  } else { $TOT_PAX_OUT_2020 = $row['TOT_PAX_OUT_2020'] + 346 ; } 
            $TOT_PAX_OUT_2020 = $row["TOT_PAX_OUT_2020"]; if (empty($TOT_PAX_OUT_2020)) { $TOT_PAX_OUT_2020 = 0 ;  } else { $TOT_PAX_OUT_2020 = $row['TOT_PAX_OUT_2020'] ; } 
            
            
        
        
$TOT_N_2020   = $NETO_2020_VTAS_WEB + $NETO_2020_VTAS_OFFLINE +  $NETO_2020_VTAS_OFFLINE_REPS + $NETO_2020_VTAS_TRAS_7USD + $NETO_2020_VTAS_ULTRAMAR + $NETO_2020_VTAS_GPH + $NETO_2020_VTAS_ALOHAKAI + $NETO_2020_VTAS_AZULTRAVEL + $NETO_2020_VTAS_TRAS_12USD + $NETO_2020_VTAS_TRAS_PRIVADA ;
$TOT_P_2020   = $PUBLICO_2020_VTAS_WEB + $PUBLICO_2020_VTAS_OFFLINE + $PUBLICO_2020_VTAS_OFFLINE_REPS +  $PUBLICO_2020_VTAS_TRAS_7USD + $PUBLICO_2020_VTAS_ULTRAMAR + $PUBLICO_2020_VTAS_GPH + $PUBLICO_2020_VTAS_ALOHAKAI + $PUBLICO_2020_VTAS_AZULTRAVEL + $PUBLICO_2020_VTAS_TRAS_12USD + $PUBLICO_2020_VTAS_TRAS_PRIVADA ;
$TOT_PAX_2020 = $TOTAL_PAX_WEB_2020 + $TOTAL_PAX_OFFLINE_2020 + $TOTAL_PAX_OFFLINE_REPS_2020 +  $TOT_PAX_7USD_2020 + $TOTAL_PAX_GRATIS_2020 + $TOTAL_PAX_ULTRAMAR_2020 + $TOT_PAX_IN_2020 + $TOT_PAX_OUT_2020 + $TOTAL_PAX_GPH_2020 + $TOTAL_PAX_ALOHAKAI_2020 + $TOTAL_PAX_AZULTRAVEL_2020 + $TOT_PAX_12USD_2020 + $TOT_PAX_PRIVADA_2020 ;

		
		

		
		
              
	 	     include ("views/Sales/Vtas_Consolidado_Contenedor.php");
	} 
    catch (Exception $e)
    {
	 	      echo "Algo se debe revizar: ".$e;
	 }

}
/* ███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░  */		              

/*---<> ||||||||||||||*>--------------------------------------------------------------------------------------------------------------------*/
    public function getMesesweb(){
	 session_start();

	try {
        $Ene_1 = '2019-01-01';  $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01';  $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01';  $Mar_2 = '2019-03-31';  
        $Abr_1 = '2019-04-01';  $Abr_2 = '2019-04-30';  $May_1 = '2019-05-01';  $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01';  $Jun_2 = '2019-06-30';
        $Jul_1 = '2019-07-01';  $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01';  $Ago_2 = '2019-08-31';  $Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30'; 
        $Oct_1 = '2019-10-01';  $Oct_2 = '2019-10-31';  $Nov_1 = '2019-11-01';  $Nov_2 = '2019-11-30';  $Dic_1 = '2019-12-01';  $Dic_2 = '2019-12-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE) )
                              ORDER BY Id DESC ;";
           //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
            $query1b ="SELECT SUM(Total) 'Web_Pub_Ene',  SUM(Subtotal) 'Web_Net_Ene' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ene = $row["Web_Pub_Ene"]; if (empty($Web_Pub_Ene)) { $Web_Pub_Ene = 0 ;  }  
            $Web_Net_Ene = $row["Web_Net_Ene"]; if (empty($Web_Net_Ene)) { $Web_Net_Ene = 0 ;  }  
            
            
              
              
            $query1a ="SELECT SUM(Total) 'Off_Pub_Ene',  SUM(Subtotal) 'Off_Net_Ene' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)  ;"; 
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			
            $Off_Pub_Ene = $row["Off_Pub_Ene"]; if (empty($Off_Pub_Ene)) { $Off_Pub_Ene = 0 ;  }  
            $Off_Net_Ene = $row["Off_Net_Ene"]; if (empty($Off_Net_Ene)) { $Off_Net_Ene = 0 ;  }  
              
            $Tot_Pub_Ene = $Web_Pub_Ene +  $Off_Pub_Ene ;
			$Tot_Net_Ene = $Web_Net_Ene +  $Off_Net_Ene ;
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        
        try {
			$db = new db();
			$conn = $db->conn_local();
			$query2 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
          if($count2 > 0){
				$rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
				$lista2 = array();
				
				foreach ($rows2 as $row) {
					
					$sale2 = new sale_row();
					$sale2->setId($row['Id']);
					$sale2->setCustomer($row['Customers_Name']);
					$sale2->setLastName($row['LastName']);
					$sale2->setSecondName($row['SecondLastName']);
					$sale2->setStatus($row['Status_payments']);
					$sale2->setService($row['Services_Name']);
					$sale2->setDateTo($row['DateTo']);
					$sale2->setDateFrom($row['DateFrom']);
					$sale2->setTotal($row['Total']);
					$sale2->setSubTotal($row['Subtotal']);
					$sale2->setTypeVending($row['type_vending']);
					$sale2->setTypeService($row['TypeService']);
					$sale2->setProvider($row['NameProvider']);
                    $sale2->setPaxxx($row['NoPeople']);
					array_push($lista2, $sale2);
				}
           
              
           $query2b ="SELECT SUM(Total) 'Web_Pub_Feb',  SUM(Subtotal) 'Web_Net_Feb' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)  ;"; 
       		$stmt2b = $conn->prepare($query2b);
			$stmt2b->execute();
        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row["Web_Pub_Feb"]; if (empty($Web_Pub_Feb)) { $Web_Pub_Feb = 0 ;  }  
            $Web_Net_Feb = $row["Web_Net_Feb"]; if (empty($Web_Net_Feb)) { $Web_Net_Feb = 0 ;  }  
                  
            $query2a ="SELECT SUM(Total) 'Off_Pub_Feb',  SUM(Subtotal) 'Off_Net_Feb' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)  ;"; 
       		$stmt2a = $conn->prepare($query2a);
			$stmt2a->execute();
        	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row["Off_Pub_Feb"]; if (empty($Off_Pub_Feb)) { $Off_Pub_Feb = 0 ;  }  
            $Off_Net_Feb = $row["Off_Net_Feb"]; if (empty($Off_Net_Feb)) { $Off_Net_Feb = 0 ;  }  
              
            $Tot_Pub_Feb = $Web_Pub_Feb +  $Off_Pub_Feb ;
			$Tot_Net_Feb = $Web_Net_Feb +  $Off_Net_Feb ;
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
        try {
			$db = new db();
			$conn = $db->conn_local();
			$query3 =   " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3
                              AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt3 = $conn->prepare($query3);
			$stmt3->execute();
			$count3 = $stmt3->rowCount();
          if($count3 > 0){
				$rows3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
				$lista3 = array();
				
				foreach ($rows3 as $row) {
					
					$sale3 = new sale_row();
					$sale3->setId($row['Id']);
					$sale3->setCustomer($row['Customers_Name']);
					$sale3->setLastName($row['LastName']);
					$sale3->setSecondName($row['SecondLastName']);
					$sale3->setStatus($row['Status_payments']);
					$sale3->setService($row['Services_Name']);
					$sale3->setDateTo($row['DateTo']);
					$sale3->setDateFrom($row['DateFrom']);
					$sale3->setTotal($row['Total']);
					$sale3->setSubTotal($row['Subtotal']);
					$sale3->setTypeVending($row['type_vending']);
					$sale3->setTypeService($row['TypeService']);
					$sale3->setProvider($row['NameProvider']);
                    $sale3->setPaxxx($row['NoPeople']);
					array_push($lista3, $sale3);
				}
              
              
					
              
            $query3b ="SELECT SUM(Total) 'Web_Pub_Mar',  SUM(Subtotal) 'Web_Net_Mar' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)  ;"; 
       		$stmt3b = $conn->prepare($query3b);
			$stmt3b->execute();
        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row["Web_Pub_Mar"]; if (empty($Web_Pub_Mar)) { $Web_Pub_Mar = 0 ;  }  
            $Web_Net_Mar = $row["Web_Net_Mar"]; if (empty($Web_Net_Mar)) { $Web_Net_Mar = 0 ;  }  
                  
            $query3a ="SELECT SUM(Total) 'Off_Pub_Mar',  SUM(Subtotal) 'Off_Net_Mar' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)  ;"; 
       		$stmt3a = $conn->prepare($query3a);
			$stmt3a->execute();
        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row["Off_Pub_Mar"]; if (empty($Off_Pub_Mar)) { $Off_Pub_Mar = 0 ;  }  
            $Off_Net_Mar = $row["Off_Net_Mar"]; if (empty($Off_Net_Mar)) { $Off_Net_Mar = 0 ;  }  
              
            $Tot_Pub_Mar = $Web_Pub_Mar +  $Off_Pub_Mar ;
			$Tot_Net_Mar = $Web_Net_Mar +  $Off_Net_Mar ;
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query4 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt4 = $conn->prepare($query4);
			$stmt4->execute();
			$count4 = $stmt4->rowCount();
          if($count4 > 0){
				$rows4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
				$lista4 = array();
				
				foreach ($rows4 as $row) {
					
					$sale4 = new sale_row();
					$sale4->setId($row['Id']);
					$sale4->setCustomer($row['Customers_Name']);
					$sale4->setLastName($row['LastName']);
					$sale4->setSecondName($row['SecondLastName']);
					$sale4->setStatus($row['Status_payments']);
					$sale4->setService($row['Services_Name']);
					$sale4->setDateTo($row['DateTo']);
					$sale4->setDateFrom($row['DateFrom']);
					$sale4->setTotal($row['Total']);
					$sale4->setSubTotal($row['Subtotal']);
					$sale4->setTypeVending($row['type_vending']);
					$sale4->setTypeService($row['TypeService']);
					$sale4->setProvider($row['NameProvider']);
                    $sale4->setPaxxx($row['NoPeople']);
					array_push($lista4, $sale4);
				}
              
            $query4b ="SELECT SUM(Total) 'Web_Pub_Abr',  SUM(Subtotal) 'Web_Net_Abr' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)  ;"; 
       		$stmt4b = $conn->prepare($query4b);
			$stmt4b->execute();
        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row["Web_Pub_Abr"]; if (empty($Web_Pub_Abr)) { $Web_Pub_Abr = 0 ;  }  
            $Web_Net_Abr = $row["Web_Net_Abr"]; if (empty($Web_Net_Abr)) { $Web_Net_Abr = 0 ;  }  
                  
            $query4a ="SELECT SUM(Total) 'Off_Pub_Abr',  SUM(Subtotal) 'Off_Net_Abr' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)  ;"; 
       		$stmt4a = $conn->prepare($query4a);
			$stmt4a->execute();
        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row["Off_Pub_Abr"]; if (empty($Off_Pub_Abr)) { $Off_Pub_Abr = 0 ;  }  
            $Off_Net_Abr = $row["Off_Net_Abr"]; if (empty($Off_Net_Abr)) { $Off_Net_Abr = 0 ;  }  
              
            $Tot_Pub_Abr = $Web_Pub_Abr +  $Off_Pub_Abr ;
			$Tot_Net_Abr = $Web_Net_Abr +  $Off_Net_Abr ;
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query5 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3
                              AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE) )
                              ORDER BY Id DESC ;";
			
							  
			
							  
            //print $query5;
			$stmt5 = $conn->prepare($query5);
			$stmt5->execute();
			$count5 = $stmt5->rowCount();
          if($count5 > 0){
				$rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
				$lista5 = array();
				
				foreach ($rows5 as $row) {
					
					$sale5 = new sale_row();
					$sale5->setId($row['Id']);
					$sale5->setCustomer($row['Customers_Name']);
					$sale5->setLastName($row['LastName']);
					$sale5->setSecondName($row['SecondLastName']);
					$sale5->setStatus($row['Status_payments']);
					$sale5->setService($row['Services_Name']);
					$sale5->setDateTo($row['DateTo']);
					$sale5->setDateFrom($row['DateFrom']);
					$sale5->setTotal($row['Total']);
					$sale5->setSubTotal($row['Subtotal']);
					$sale5->setTypeVending($row['type_vending']);
					$sale5->setTypeService($row['TypeService']);
					$sale5->setProvider($row['NameProvider']);
                    $sale5->setPaxxx($row['NoPeople']);
					array_push($lista5, $sale5);
				}
              
            $query5b ="SELECT SUM(Total) 'Web_Pub_May',  SUM(Subtotal) 'Web_Net_May' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);
			$stmt5b->execute();
        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row["Web_Pub_May"]; if (empty($Web_Pub_May)) { $Web_Pub_May = 0 ;  }  
            $Web_Net_May = $row["Web_Net_May"]; if (empty($Web_Net_May)) { $Web_Net_May = 0 ;  }  
                  
            $query5a ="SELECT SUM(Total) 'Off_Pub_May',  SUM(Subtotal) 'Off_Net_May' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);
			$stmt5a->execute();
        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row["Off_Pub_May"]; if (empty($Off_Pub_May)) { $Off_Pub_May = 0 ;  }  
            $Off_Net_May = $row["Off_Net_May"]; if (empty($Off_Net_May)) { $Off_Net_May = 0 ;  }  
              
            $Tot_Pub_May = $Web_Pub_May +  $Off_Pub_May ;
			$Tot_Net_May = $Web_Net_May +  $Off_Net_May ;
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
        try {
			$db = new db();
			$conn = $db->conn_local();
			$query6 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt6 = $conn->prepare($query6);
			$stmt6->execute();
			$count6 = $stmt6->rowCount();
          if($count6 > 0){
				$rows6 = $stmt6->fetchAll(PDO::FETCH_ASSOC);
				$lista6 = array();
				
				foreach ($rows6 as $row) {
					
					$sale6 = new sale_row();
					$sale6->setId($row['Id']);
					$sale6->setCustomer($row['Customers_Name']);
					$sale6->setLastName($row['LastName']);
					$sale6->setSecondName($row['SecondLastName']);
					$sale6->setStatus($row['Status_payments']);
					$sale6->setService($row['Services_Name']);
					$sale6->setDateTo($row['DateTo']);
					$sale6->setDateFrom($row['DateFrom']);
					$sale6->setTotal($row['Total']);
					$sale6->setSubTotal($row['Subtotal']);
					$sale6->setTypeVending($row['type_vending']);
					$sale6->setTypeService($row['TypeService']);
					$sale6->setProvider($row['NameProvider']);
                    $sale6->setPaxxx($row['NoPeople']);
					array_push($lista6, $sale6);
				}
			$query6b ="SELECT SUM(Total) 'Web_Pub_Jun',  SUM(Subtotal) 'Web_Net_Jun' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)  ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row["Web_Pub_Jun"]; if (empty($Web_Pub_Jun)) { $Web_Pub_Jun = 0 ;  }  
            $Web_Net_Jun = $row["Web_Net_Jun"]; if (empty($Web_Net_Jun)) { $Web_Net_Jun = 0 ;  }  
                  
            $query6a ="SELECT SUM(Total) 'Off_Pub_Jun',  SUM(Subtotal) 'Off_Net_Jun' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)  ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row["Off_Pub_Jun"]; if (empty($Off_Pub_Jun)) { $Off_Pub_Jun = 0 ;  }  
            $Off_Net_Jun = $row["Off_Net_Jun"]; if (empty($Off_Net_Jun)) { $Off_Net_Jun = 0 ;  }  
              
            $Tot_Pub_Jun = $Web_Pub_Jun +  $Off_Pub_Jun ;
			$Tot_Net_Jun = $Web_Net_Jun +  $Off_Net_Jun ;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
        try {
			$db = new db();
			$conn = $db->conn_local();
			$query7 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt7 = $conn->prepare($query7);
			$stmt7->execute();
			$count7 = $stmt7->rowCount();
          if($count7 > 0){
				$rows7 = $stmt7->fetchAll(PDO::FETCH_ASSOC);
				$lista7 = array();
				
				foreach ($rows7 as $row) {
					
					$sale7 = new sale_row();
					$sale7->setId($row['Id']);
					$sale7->setCustomer($row['Customers_Name']);
					$sale7->setLastName($row['LastName']);
					$sale7->setSecondName($row['SecondLastName']);
					$sale7->setStatus($row['Status_payments']);
					$sale7->setService($row['Services_Name']);
					$sale7->setDateTo($row['DateTo']);
					$sale7->setDateFrom($row['DateFrom']);
					$sale7->setTotal($row['Total']);
					$sale7->setSubTotal($row['Subtotal']);
					$sale7->setTypeVending($row['type_vending']);
					$sale7->setTypeService($row['TypeService']);
					$sale7->setProvider($row['NameProvider']);
                    $sale7->setPaxxx($row['NoPeople']);
					array_push($lista7, $sale7);
				}
			$query7b ="SELECT SUM(Total) 'Web_Pub_Jul',  SUM(Subtotal) 'Web_Net_Jul' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)  ;"; 
       		$stmt7b = $conn->prepare($query7b);
			$stmt7b->execute();
        	$row = $stmt7b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row["Web_Pub_Jul"]; if (empty($Web_Pub_Jul)) { $Web_Pub_Jul = 0 ;  }  
            $Web_Net_Jul = $row["Web_Net_Jul"]; if (empty($Web_Net_Jul)) { $Web_Net_Jul = 0 ;  }  
                  
            $query7a ="SELECT SUM(Total) 'Off_Pub_Jul',  SUM(Subtotal) 'Off_Net_Jul' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)  ;"; 
       		$stmt7a = $conn->prepare($query7a);
			$stmt7a->execute();
        	$row = $stmt7a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row["Off_Pub_Jul"]; if (empty($Off_Pub_Jul)) { $Off_Pub_Jul = 0 ;  }  
            $Off_Net_Jul = $row["Off_Net_Jul"]; if (empty($Off_Net_Jul)) { $Off_Net_Jul = 0 ;  }  
              
            $Tot_Pub_Jul = $Web_Pub_Jul +  $Off_Pub_Jul ;
			$Tot_Net_Jul = $Web_Net_Jul +  $Off_Net_Jul ;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query8 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt8 = $conn->prepare($query8);
			$stmt8->execute();
			$count8 = $stmt8->rowCount();
          if($count8 > 0){
				$rows8 = $stmt8->fetchAll(PDO::FETCH_ASSOC);
				$lista8 = array();
				
				foreach ($rows8 as $row) {
					
					$sale8 = new sale_row();
					$sale8->setId($row['Id']);
					$sale8->setCustomer($row['Customers_Name']);
					$sale8->setLastName($row['LastName']);
					$sale8->setSecondName($row['SecondLastName']);
					$sale8->setStatus($row['Status_payments']);
					$sale8->setService($row['Services_Name']);
					$sale8->setDateTo($row['DateTo']);
					$sale8->setDateFrom($row['DateFrom']);
					$sale8->setTotal($row['Total']);
					$sale8->setSubTotal($row['Subtotal']);
					$sale8->setTypeVending($row['type_vending']);
					$sale8->setTypeService($row['TypeService']);
					$sale8->setProvider($row['NameProvider']);
                    $sale8->setPaxxx($row['NoPeople']);
					array_push($lista8, $sale8);
				}
			$query8b ="SELECT SUM(Total) 'Web_Pub_Ago',  SUM(Subtotal) 'Web_Net_Ago' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);
			$stmt8b->execute();
        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row["Web_Pub_Ago"]; if (empty($Web_Pub_Ago)) { $Web_Pub_Ago = 0 ;  }  
            $Web_Net_Ago = $row["Web_Net_Ago"]; if (empty($Web_Net_Ago)) { $Web_Net_Ago = 0 ;  }  
                  
            $query8a ="SELECT SUM(Total) 'Off_Pub_Ago',  SUM(Subtotal) 'Off_Net_Ago' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);
			$stmt8a->execute();
        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row["Off_Pub_Ago"]; if (empty($Off_Pub_Ago)) { $Off_Pub_Ago = 0 ;  }  
            $Off_Net_Ago = $row["Off_Net_Ago"]; if (empty($Off_Net_Ago)) { $Off_Net_Ago = 0 ;  }  
              
            $Tot_Pub_Ago = $Web_Pub_Ago +  $Off_Pub_Ago ;
			$Tot_Net_Ago = $Web_Net_Ago +  $Off_Net_Ago ;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query9 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt9 = $conn->prepare($query9);
			$stmt9->execute();
			$count9 = $stmt9->rowCount();
          if($count9 > 0){
				$rows9 = $stmt9->fetchAll(PDO::FETCH_ASSOC);
				$lista9 = array();
				
				foreach ($rows9 as $row) {
					
					$sale9 = new sale_row();
					$sale9->setId($row['Id']);
					$sale9->setCustomer($row['Customers_Name']);
					$sale9->setLastName($row['LastName']);
					$sale9->setSecondName($row['SecondLastName']);
					$sale9->setStatus($row['Status_payments']);
					$sale9->setService($row['Services_Name']);
					$sale9->setDateTo($row['DateTo']);
					$sale9->setDateFrom($row['DateFrom']);
					$sale9->setTotal($row['Total']);
					$sale9->setSubTotal($row['Subtotal']);
					$sale9->setTypeVending($row['type_vending']);
					$sale9->setTypeService($row['TypeService']);
					$sale9->setProvider($row['NameProvider']);
                    $sale9->setPaxxx($row['NoPeople']);
					array_push($lista9, $sale9);
				}
			$query9b ="SELECT SUM(Total) 'Web_Pub_Sep',  SUM(Subtotal) 'Web_Net_Sep' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);
			$stmt9b->execute();
        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row["Web_Pub_Sep"]; if (empty($Web_Pub_Sep)) { $Web_Pub_Sep = 0 ;  }  
            $Web_Net_Sep = $row["Web_Net_Sep"]; if (empty($Web_Net_Sep)) { $Web_Net_Sep = 0 ;  }  
                  
            $query9a ="SELECT SUM(Total) 'Off_Pub_Sep',  SUM(Subtotal) 'Off_Net_Sep' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);
			$stmt9a->execute();
        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row["Off_Pub_Sep"]; if (empty($Off_Pub_Sep)) { $Off_Pub_Sep = 0 ;  }  
            $Off_Net_Sep = $row["Off_Net_Sep"]; if (empty($Off_Net_Sep)) { $Off_Net_Sep = 0 ;  }  
              
            $Tot_Pub_Sep = $Web_Pub_Sep +  $Off_Pub_Sep ;
			$Tot_Net_Sep = $Web_Net_Sep +  $Off_Net_Sep ;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query10 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt10 = $conn->prepare($query10);
			$stmt10->execute();
			$count10 = $stmt10->rowCount();
          if($count10 > 0){
				$rows10 = $stmt10->fetchAll(PDO::FETCH_ASSOC);
				$lista10 = array();
				
				foreach ($rows10 as $row) {
					
					$sale10 = new sale_row();
					$sale10->setId($row['Id']);
					$sale10->setCustomer($row['Customers_Name']);
					$sale10->setLastName($row['LastName']);
					$sale10->setSecondName($row['SecondLastName']);
					$sale10->setStatus($row['Status_payments']);
					$sale10->setService($row['Services_Name']);
					$sale10->setDateTo($row['DateTo']);
					$sale10->setDateFrom($row['DateFrom']);
					$sale10->setTotal($row['Total']);
					$sale10->setSubTotal($row['Subtotal']);
					$sale10->setTypeVending($row['type_vending']);
					$sale10->setTypeService($row['TypeService']);
					$sale10->setProvider($row['NameProvider']);
                    $sale10->setPaxxx($row['NoPeople']);
					array_push($lista10, $sale10);
				}
			$query10b ="SELECT SUM(Total) 'Web_Pub_Oct',  SUM(Subtotal) 'Web_Net_Oct' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);
			$stmt10b->execute();
        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row["Web_Pub_Oct"]; if (empty($Web_Pub_Oct)) { $Web_Pub_Oct = 0 ;  }  
            $Web_Net_Oct = $row["Web_Net_Oct"]; if (empty($Web_Net_Oct)) { $Web_Net_Oct = 0 ;  }  
                  
            $query10a ="SELECT SUM(Total) 'Off_Pub_Oct',  SUM(Subtotal) 'Off_Net_Oct' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);
			$stmt10a->execute();
        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row["Off_Pub_Oct"]; if (empty($Off_Pub_Oct)) { $Off_Pub_Oct = 0 ;  }  
            $Off_Net_Oct = $row["Off_Net_Oct"]; if (empty($Off_Net_Oct)) { $Off_Net_Oct = 0 ;  }  
              
            $Tot_Pub_Oct = $Web_Pub_Oct +  $Off_Pub_Oct ;
			$Tot_Net_Oct = $Web_Net_Oct +  $Off_Net_Oct ;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query11 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query;
			$stmt11 = $conn->prepare($query11);
			$stmt11->execute();
			$count11 = $stmt11->rowCount();
          if($count11 > 0){
				$rows11 = $stmt11->fetchAll(PDO::FETCH_ASSOC);
				$lista11 = array();
				
				foreach ($rows11 as $row) {
					
					$sale11 = new sale_row();
					$sale11->setId($row['Id']);
					$sale11->setCustomer($row['Customers_Name']);
					$sale11->setLastName($row['LastName']);
					$sale11->setSecondName($row['SecondLastName']);
					$sale11->setStatus($row['Status_payments']);
					$sale11->setService($row['Services_Name']);
					$sale11->setDateTo($row['DateTo']);
					$sale11->setDateFrom($row['DateFrom']);
					$sale11->setTotal($row['Total']);
					$sale11->setSubTotal($row['Subtotal']);
					$sale11->setTypeVending($row['type_vending']);
					$sale11->setTypeService($row['TypeService']);
					$sale11->setProvider($row['NameProvider']);
                    $sale11->setPaxxx($row['NoPeople']);
					array_push($lista11, $sale11);
				}
			$query11b ="SELECT SUM(Total) 'Web_Pub_Nov',  SUM(Subtotal) 'Web_Net_Nov' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);
			$stmt11b->execute();
        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row["Web_Pub_Nov"]; if (empty($Web_Pub_Nov)) { $Web_Pub_Nov = 0 ;  }  
            $Web_Net_Nov = $row["Web_Net_Nov"]; if (empty($Web_Net_Nov)) { $Web_Net_Nov = 0 ;  }  
                  
            $query11a ="SELECT SUM(Total) 'Off_Pub_Nov',  SUM(Subtotal) 'Off_Net_Nov' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);
			$stmt11a->execute();
        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row["Off_Pub_Nov"]; if (empty($Off_Pub_Nov)) { $Off_Pub_Nov = 0 ;  }  
            $Off_Net_Nov = $row["Off_Net_Nov"]; if (empty($Off_Net_Nov)) { $Off_Net_Nov = 0 ;  }  
              
            $Tot_Pub_Nov = $Web_Pub_Nov +  $Off_Pub_Nov ;
			$Tot_Net_Nov = $Web_Net_Nov +  $Off_Net_Nov ; 
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
        
         try {
			$db = new db();
			$conn = $db->conn_local();
			$query12 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0) AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query12;
			$stmt12 = $conn->prepare($query12);
			$stmt12->execute();
			$count12 = $stmt12->rowCount();
          if($count12 > 0){
				$rows12 = $stmt12->fetchAll(PDO::FETCH_ASSOC);
				$lista12 = array();
				
				foreach ($rows12 as $row) {
					
					$sale12 = new sale_row();
					$sale12->setId($row['Id']);
					$sale12->setCustomer($row['Customers_Name']);
					$sale12->setLastName($row['LastName']);
					$sale12->setSecondName($row['SecondLastName']);
					$sale12->setStatus($row['Status_payments']);
					$sale12->setService($row['Services_Name']);
					$sale12->setDateTo($row['DateTo']);
					$sale12->setDateFrom($row['DateFrom']);
					$sale12->setTotal($row['Total']);
					$sale12->setSubTotal($row['Subtotal']);
					$sale12->setTypeVending($row['type_vending']);
					$sale12->setTypeService($row['TypeService']);
					$sale12->setProvider($row['NameProvider']);
                    $sale12->setPaxxx($row['NoPeople']);
                    array_push($lista12, $sale12);
				}
			$query12b ="SELECT SUM(Total) 'Web_Pub_Dic',  SUM(Subtotal) 'Web_Net_Dic' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0) AND  Id_Status = 3 AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);
			$stmt12b->execute();
        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row["Web_Pub_Dic"]; if (empty($Web_Pub_Dic)) { $Web_Pub_Dic = 0 ;  }  
            $Web_Net_Dic = $row["Web_Net_Dic"]; if (empty($Web_Net_Dic)) { $Web_Net_Dic = 0 ;  }  
                  
            $query12a ="SELECT SUM(Total) 'Off_Pub_Dic',  SUM(Subtotal) 'Off_Net_Dic' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);
			$stmt12a->execute();
        	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row["Off_Pub_Dic"]; if (empty($Off_Pub_Dic)) { $Off_Pub_Dic = 0 ;  }  
            $Off_Net_Dic = $row["Off_Net_Dic"]; if (empty($Off_Net_Dic)) { $Off_Net_Dic = 0 ;  }  
              
            $Tot_Pub_Dic = $Web_Pub_Dic +  $Off_Pub_Dic ;
			$Tot_Net_Dic = $Web_Net_Dic +  $Off_Net_Dic ; 
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}
        
        
        
        
        
        
		include ("views/Sales/Vtas_Web_Mensuales_2019.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}


    
    

    public function getEnero19(){
	 session_start();

	try {
        $Ene_1 = '2019-01-01';         $Ene_2 = '2019-01-31'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
            $query1b ="SELECT SUM(Total) 'Web_Pub_Ene',  SUM(Subtotal) 'Web_Net_Ene' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ene = $row["Web_Pub_Ene"]; if (empty($Web_Pub_Ene)) { $Web_Pub_Ene = 0 ;  }  
            $Web_Net_Ene = $row["Web_Net_Ene"]; if (empty($Web_Net_Ene)) { $Web_Net_Ene = 0 ;  }  
                  
            $query1a ="SELECT SUM(Total) 'Off_Pub_Ene',  SUM(Subtotal) 'Off_Net_Ene' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)  ;"; 
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ene = $row["Off_Pub_Ene"]; if (empty($Off_Pub_Ene)) { $Off_Pub_Ene = 0 ;  }  
            $Off_Net_Ene = $row["Off_Net_Ene"]; if (empty($Off_Net_Ene)) { $Off_Net_Ene = 0 ;  }  
              
            $Tot_Pub_Ene = $Web_Pub_Ene +  $Off_Pub_Ene ;
			$Tot_Net_Ene = $Web_Net_Ene +  $Off_Net_Ene ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Enero2019.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}

  

    public function getFebrero19(){
	 session_start();

	try {
      
        $Feb_1 = '2019-02-01';         $Feb_2 = '2019-02-28';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
            $query2b ="SELECT SUM(Total) 'Web_Pub_Feb',  SUM(Subtotal) 'Web_Net_Feb' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)  ;"; 
       		$stmt2b = $conn->prepare($query2b);
			$stmt2b->execute();
        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row["Web_Pub_Feb"]; if (empty($Web_Pub_Feb)) { $Web_Pub_Feb = 0 ;  }  
            $Web_Net_Feb = $row["Web_Net_Feb"]; if (empty($Web_Net_Feb)) { $Web_Net_Feb = 0 ;  }  
                  
            $query2a ="SELECT SUM(Total) 'Off_Pub_Feb',  SUM(Subtotal) 'Off_Net_Feb' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)  ;"; 
       		$stmt2a = $conn->prepare($query2a);
			$stmt2a->execute();
        	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row["Off_Pub_Feb"]; if (empty($Off_Pub_Feb)) { $Off_Pub_Feb = 0 ;  }  
            $Off_Net_Feb = $row["Off_Net_Feb"]; if (empty($Off_Net_Feb)) { $Off_Net_Feb = 0 ;  }  
              
            $Tot_Pub_Feb = $Web_Pub_Feb +  $Off_Pub_Feb ;
			$Tot_Net_Feb = $Web_Net_Feb +  $Off_Net_Feb ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Febrero2019.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}

    

    

public function getMarzo19(){
	 session_start();

	try {
      
        $Mar_1 = '2019-03-01';         $Mar_2 = '2019-03-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
           $query3b ="SELECT SUM(Total) 'Web_Pub_Mar',  SUM(Subtotal) 'Web_Net_Mar' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)  ;"; 
       		$stmt3b = $conn->prepare($query3b);
			$stmt3b->execute();
        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row["Web_Pub_Mar"]; if (empty($Web_Pub_Mar)) { $Web_Pub_Mar = 0 ;  }  
            $Web_Net_Mar = $row["Web_Net_Mar"]; if (empty($Web_Net_Mar)) { $Web_Net_Mar = 0 ;  }  
                  
            $query3a ="SELECT SUM(Total) 'Off_Pub_Mar',  SUM(Subtotal) 'Off_Net_Mar' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)  ;"; 
       		$stmt3a = $conn->prepare($query3a);
			$stmt3a->execute();
        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row["Off_Pub_Mar"]; if (empty($Off_Pub_Mar)) { $Off_Pub_Mar = 0 ;  }  
            $Off_Net_Mar = $row["Off_Net_Mar"]; if (empty($Off_Net_Mar)) { $Off_Net_Mar = 0 ;  }  
              
            $Tot_Pub_Mar = $Web_Pub_Mar +  $Off_Pub_Mar ;
			$Tot_Net_Mar = $Web_Net_Mar +  $Off_Net_Mar ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Marzo2019.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}


    
    

public function getAbril19(){
	 session_start();

	try {
      
        $Abr_1 = '2019-04-01';         $Abr_2 = '2019-04-30';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
             $query4b ="SELECT SUM(Total) 'Web_Pub_Abr',  SUM(Subtotal) 'Web_Net_Abr' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)  ;"; 
       		$stmt4b = $conn->prepare($query4b);
			$stmt4b->execute();
        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row["Web_Pub_Abr"]; if (empty($Web_Pub_Abr)) { $Web_Pub_Abr = 0 ;  }  
            $Web_Net_Abr = $row["Web_Net_Abr"]; if (empty($Web_Net_Abr)) { $Web_Net_Abr = 0 ;  }  
                  
            $query4a ="SELECT SUM(Total) 'Off_Pub_Abr',  SUM(Subtotal) 'Off_Net_Abr' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)  ;"; 
       		$stmt4a = $conn->prepare($query4a);
			$stmt4a->execute();
        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row["Off_Pub_Abr"]; if (empty($Off_Pub_Abr)) { $Off_Pub_Abr = 0 ;  }  
            $Off_Net_Abr = $row["Off_Net_Abr"]; if (empty($Off_Net_Abr)) { $Off_Net_Abr = 0 ;  }  
              
            $Tot_Pub_Abr = $Web_Pub_Abr +  $Off_Pub_Abr ;
			$Tot_Net_Abr = $Web_Net_Abr +  $Off_Net_Abr ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Abril2019.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}


    
    public function getMayo19(){
	 session_start();

	try {
      
        $May_1 = '2019-05-01';         $May_2 = '2019-05-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 =" ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
            
            $query5b ="SELECT SUM(Total) 'Web_Pub_May',  SUM(Subtotal) 'Web_Net_May' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);
			$stmt5b->execute();
        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row["Web_Pub_May"]; if (empty($Web_Pub_May)) { $Web_Pub_May = 0 ;  }  
            $Web_Net_May = $row["Web_Net_May"]; if (empty($Web_Net_May)) { $Web_Net_May = 0 ;  }  
                  
            $query5a ="SELECT SUM(Total) 'Off_Pub_May',  SUM(Subtotal) 'Off_Net_May' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);
			$stmt5a->execute();
        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row["Off_Pub_May"]; if (empty($Off_Pub_May)) { $Off_Pub_May = 0 ;  }  
            $Off_Net_May = $row["Off_Net_May"]; if (empty($Off_Net_May)) { $Off_Net_May = 0 ;  }  
              
            $Tot_Pub_May = $Web_Pub_May +  $Off_Pub_May ;
			$Tot_Net_May = $Web_Net_May +  $Off_Net_May ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Mayo2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}


    
    
    

public function getJunio19(){
	 session_start();

	try {
      
        $Jun_1 = '2019-06-01';         $Jun_2 = '2019-06-30';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3 
                              AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) )
                              ORDER BY Id DESC ;";
           // print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
             $query6b ="SELECT SUM(Total) 'Web_Pub_Jun',  SUM(Subtotal) 'Web_Net_Jun' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)  ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row["Web_Pub_Jun"]; if (empty($Web_Pub_Jun)) { $Web_Pub_Jun = 0 ;  }  
            $Web_Net_Jun = $row["Web_Net_Jun"]; if (empty($Web_Net_Jun)) { $Web_Net_Jun = 0 ;  }  
                  
            $query6a ="SELECT SUM(Total) 'Off_Pub_Jun',  SUM(Subtotal) 'Off_Net_Jun' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)  ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row["Off_Pub_Jun"]; if (empty($Off_Pub_Jun)) { $Off_Pub_Jun = 0 ;  }  
            $Off_Net_Jun = $row["Off_Net_Jun"]; if (empty($Off_Net_Jun)) { $Off_Net_Jun = 0 ;  }  
              
            $Tot_Pub_Jun = $Web_Pub_Jun +  $Off_Pub_Jun ;
			$Tot_Net_Jun = $Web_Net_Jun +  $Off_Net_Jun ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Junio2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}

    

   
    
    
    
    public function getJulio19(){
	 session_start();

	try {
      
        $Jul_1 = '2019-07-01';         $Jul_2 = '2019-07-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
            $query6b ="SELECT SUM(Total) 'Web_Pub_Jul',  SUM(Subtotal) 'Web_Net_Jul' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)  ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row["Web_Pub_Jul"]; if (empty($Web_Pub_Jul)) { $Web_Pub_Jul = 0 ;  }  
            $Web_Net_Jul = $row["Web_Net_Jul"]; if (empty($Web_Net_Jul)) { $Web_Net_Jul = 0 ;  }  
                  
            $query6a ="SELECT SUM(Total) 'Off_Pub_Jul',  SUM(Subtotal) 'Off_Net_Jul' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)  ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row["Off_Pub_Jul"]; if (empty($Off_Pub_Jul)) { $Off_Pub_Jul = 0 ;  }  
            $Off_Net_Jul = $row["Off_Net_Jul"]; if (empty($Off_Net_Jul)) { $Off_Net_Jul = 0 ;  }  
              
            $Tot_Pub_Jul = $Web_Pub_Jul +  $Off_Pub_Jul ;
			$Tot_Net_Jul = $Web_Net_Jul +  $Off_Net_Jul ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Julio2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}
    
    
 
    
    
     public function getAgosto19(){
	 session_start();

	try {
      
        $Ago_1 = '2019-08-01';         $Ago_2 = '2019-08-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 =  " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
            $query8b ="SELECT SUM(Total) 'Web_Pub_Ago',  SUM(Subtotal) 'Web_Net_Ago' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3   AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);
			$stmt8b->execute();
        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row["Web_Pub_Ago"]; if (empty($Web_Pub_Ago)) { $Web_Pub_Ago = 0 ;  }  
            $Web_Net_Ago = $row["Web_Net_Ago"]; if (empty($Web_Net_Ago)) { $Web_Net_Ago = 0 ;  }  
                  
            $query8a ="SELECT SUM(Total) 'Off_Pub_Ago',  SUM(Subtotal) 'Off_Net_Ago' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);
			$stmt8a->execute();
        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row["Off_Pub_Ago"]; if (empty($Off_Pub_Ago)) { $Off_Pub_Ago = 0 ;  }  
            $Off_Net_Ago = $row["Off_Net_Ago"]; if (empty($Off_Net_Ago)) { $Off_Net_Ago = 0 ;  }  
              
            $Tot_Pub_Ago = $Web_Pub_Ago +  $Off_Pub_Ago ;
			$Tot_Net_Ago = $Web_Net_Ago +  $Off_Net_Ago ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Agosto2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}
    
    
    
    
    
    
    
     public function getSeptiembre19(){
	 session_start();

	try {
      
        $Sep_1 = '2019-09-01';         $Sep_2 = '2019-09-30';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 =" ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
             $query9b ="SELECT SUM(Total) 'Web_Pub_Sep',  SUM(Subtotal) 'Web_Net_Sep' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);
			$stmt9b->execute();
        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row["Web_Pub_Sep"]; if (empty($Web_Pub_Sep)) { $Web_Pub_Sep = 0 ;  }  
            $Web_Net_Sep = $row["Web_Net_Sep"]; if (empty($Web_Net_Sep)) { $Web_Net_Sep = 0 ;  }  
                  
            $query9a ="SELECT SUM(Total) 'Off_Pub_Sep',  SUM(Subtotal) 'Off_Net_Sep' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);
			$stmt9a->execute();
        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row["Off_Pub_Sep"]; if (empty($Off_Pub_Sep)) { $Off_Pub_Sep = 0 ;  }  
            $Off_Net_Sep = $row["Off_Net_Sep"]; if (empty($Off_Net_Sep)) { $Off_Net_Sep = 0 ;  }  
              
            $Tot_Pub_Sep = $Web_Pub_Sep +  $Off_Pub_Sep ;
			$Tot_Net_Sep = $Web_Net_Sep +  $Off_Net_Sep ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Septiembre2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}
    
    
    
    
    


     public function getOctubre19(){
	 session_start();

	try {
      
        $Oct_1 = '2019-10-01';         $Oct_2 = '2019-10-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
             $query10b ="SELECT SUM(Total) 'Web_Pub_Oct',  SUM(Subtotal) 'Web_Net_Oct' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);
			$stmt10b->execute();
        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row["Web_Pub_Oct"]; if (empty($Web_Pub_Oct)) { $Web_Pub_Oct = 0 ;  }  
            $Web_Net_Oct = $row["Web_Net_Oct"]; if (empty($Web_Net_Oct)) { $Web_Net_Oct = 0 ;  }  
                  
            $query10a ="SELECT SUM(Total) 'Off_Pub_Oct',  SUM(Subtotal) 'Off_Net_Oct' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);
			$stmt10a->execute();
        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row["Off_Pub_Oct"]; if (empty($Off_Pub_Oct)) { $Off_Pub_Oct = 0 ;  }  
            $Off_Net_Oct = $row["Off_Net_Oct"]; if (empty($Off_Net_Oct)) { $Off_Net_Oct = 0 ;  }  
              
            $Tot_Pub_Oct = $Web_Pub_Oct +  $Off_Pub_Oct ;
			$Tot_Net_Oct = $Web_Net_Oct +  $Off_Net_Oct ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Octubre2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}    
    
    
    
    public function getNoviembre19(){
	 session_start();

	try {
      
        $Nov_1 = '2019-11-01';         $Nov_2 = '2019-11-30';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
           $query11b ="SELECT SUM(Total) 'Web_Pub_Nov',  SUM(Subtotal) 'Web_Net_Nov' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3   AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);
			$stmt11b->execute();
        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row["Web_Pub_Nov"]; if (empty($Web_Pub_Nov)) { $Web_Pub_Nov = 0 ;  }  
            $Web_Net_Nov = $row["Web_Net_Nov"]; if (empty($Web_Net_Nov)) { $Web_Net_Nov = 0 ;  }  
                  
            $query11a ="SELECT SUM(Total) 'Off_Pub_Nov',  SUM(Subtotal) 'Off_Net_Nov' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);
			$stmt11a->execute();
        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row["Off_Pub_Nov"]; if (empty($Off_Pub_Nov)) { $Off_Pub_Nov = 0 ;  }  
            $Off_Net_Nov = $row["Off_Net_Nov"]; if (empty($Off_Net_Nov)) { $Off_Net_Nov = 0 ;  }  
              
            $Tot_Pub_Nov = $Web_Pub_Nov +  $Off_Pub_Nov ;
			$Tot_Net_Nov = $Web_Net_Nov +  $Off_Net_Nov ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		}

        include ("views/Sales/◣_◢-Vtas_Noviembre2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}    
    
    
    
    
    
    public function getDiciembre19(){
	 session_start();

	try {
      
        $Dic_1 = '2019-12-01';         $Dic_2 = '2019-12-31';
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = " ( SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)   AND  Id_Status = 3  
                              AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  )
                              UNION
                            (  SELECT Id, Customers_Name, LastName, SecondLastName,  Status_payments, Services_Name, DateTo, DateFrom, Total, 
                                             Subtotal, type_vending, TypeService, NameProvider, NoPeople 
                              FROM VISTA__GRAN_TOT_VTAS
                              WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                              AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE) )
                              ORDER BY Id DESC ;";
            //print $query1;
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setLastName($row['LastName']);
					$sale1->setSecondName($row['SecondLastName']);
                    $sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeVending($row['type_vending']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
           $query12b ="SELECT SUM(Total) 'Web_Pub_Dic',  SUM(Subtotal) 'Web_Net_Dic' 
                               FROM VISTA__GRAN_TOT_VTAS
                              WHERE Offline IN (0)  AND  Id_Status = 3   AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);
			$stmt12b->execute();
        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row["Web_Pub_Dic"]; if (empty($Web_Pub_Dic)) { $Web_Pub_Dic = 0 ;  }  
            $Web_Net_Dic = $row["Web_Net_Dic"]; if (empty($Web_Net_Dic)) { $Web_Net_Dic = 0 ;  }  
                  
            $query12a ="SELECT SUM(Total) 'Off_Pub_Dic',  SUM(Subtotal) 'Off_Net_Dic' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);
			$stmt12a->execute();
        	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row["Off_Pub_Dic"]; if (empty($Off_Pub_Dic)) { $Off_Pub_Dic = 0 ;  }  
            $Off_Net_Dic = $row["Off_Net_Dic"]; if (empty($Off_Net_Dic)) { $Off_Net_Dic = 0 ;  }  
              
            $Tot_Pub_Dic = $Web_Pub_Dic +  $Off_Pub_Dic ;
			$Tot_Net_Dic = $Web_Net_Dic +  $Off_Net_Dic ; 
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se puede mejorar: ".$e;  		} 

        include ("views/Sales/◣_◢-Vtas_Diciembre2019.php"); 
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}    

    
	
	
/* ███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░  */


    public function getEnero20(){
	 session_start();

	try {
        $Ene_1 = '2020-01-01';         $Ene_2 = '2020-01-31'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Ene_1_19 = '2019-01-01';         $Ene_2_19 = '2019-01-31'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Ene',  SUM(Subtotal) 'Off_Net_Ene' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Ene_1_19."' AS DATE) AND CAST('".$Ene_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ene = $row["Off_Pub_Ene"]; if (empty($Off_Pub_Ene)) { $Off_Pub_Ene = 0 ;  }  
            $Off_Net_Ene = $row["Off_Net_Ene"]; if (empty($Off_Net_Ene)) { $Off_Net_Ene = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Ene',  SUM(Subtotal) 'Web_Net_Ene' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Ene_1_19."' AS DATE) AND CAST('".$Ene_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ene = $row["Web_Pub_Ene"]; if (empty($Web_Pub_Ene)) { $Web_Pub_Ene = 0 ;  }  
            $Web_Net_Ene = $row["Web_Net_Ene"]; if (empty($Web_Net_Ene)) { $Web_Net_Ene = 0 ;  }  

			$Tot_Pub_Ene = $Web_Pub_Ene +  $Off_Pub_Ene ;
			$Tot_Net_Ene = $Web_Net_Ene +  $Off_Net_Ene ; 
			
			
			
			
			
	                	
						
			$query_0120 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0120', SUM(Subtotal) 'Todo_Neto_Web_Off_0120'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE) ;" ;
			$stmt_0120 = $conn->prepare($query_0120);
			$stmt_0120->execute();
        	$row = $stmt_0120->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0120 = $row["Todo_Publico_Web_Off_0120"]; if (empty($Todo_Publico_Web_Off_0120)) { $Todo_Publico_Web_Off_0120 = 0 ;  }  
            $Todo_Neto_Web_Off_0120 = $row["Todo_Neto_Web_Off_0120"]; if (empty($Todo_Neto_Web_Off_0120)) { $Todo_Neto_Web_Off_0120 = 0 ;  }  
		    /* print $query_0120; */
			
			
			$query_0120_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0120', SUM(total_neto) 'Todo_Neto_Traslados_0120' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE);";
					
			$stmt_0120_ = $conn->prepare($query_0120_);
			$stmt_0120_->execute();
        	$row = $stmt_0120_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0120 = $row["Todo_Publico_Traslados_0120"]; if (empty($Todo_Publico_Traslados_0120)) { $Todo_Publico_Traslados_0120 = 0 ;  }  
            $Todo_Neto_Traslados_0120 = $row["Todo_Neto_Traslados_0120"]; if (empty($Todo_Neto_Traslados_0120)) { $Todo_Neto_Traslados_0120 = 0 ;  }  
		    /* print $query_0120_; */
			
			$GRAN_TOT_PUBLICO_0120 = $Todo_Publico_Web_Off_0120 + $Todo_Publico_Traslados_0120;
			$GRAN_TOT_NETO_0120    = $Todo_Neto_Web_Off_0120 + $Todo_Neto_Traslados_0120;
			
			
			
			
			
			
			
			
			
			
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Enero2020.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}

  
  
   
  
  
  

    public function getFebrero20(){
	session_start();

	try {
        $Feb_1 = '2020-02-01';         $Feb_2 = '2020-02-29'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 > 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Feb_1_19 = '2019-02-01';         $Feb_2_19 = '2019-02-28'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Feb',  SUM(Subtotal) 'Off_Net_Feb' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Feb_1_19."' AS DATE) AND CAST('".$Feb_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row["Off_Pub_Feb"]; if (empty($Off_Pub_Feb)) { $Off_Pub_Feb = 0 ;  }  
            $Off_Net_Feb = $row["Off_Net_Feb"]; if (empty($Off_Net_Feb)) { $Off_Net_Feb = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Feb',  SUM(Subtotal) 'Web_Net_Feb' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Feb_1_19."' AS DATE) AND CAST('".$Feb_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row["Web_Pub_Feb"]; if (empty($Web_Pub_Feb)) { $Web_Pub_Feb = 0 ;  }  
            $Web_Net_Feb = $row["Web_Net_Feb"]; if (empty($Web_Net_Feb)) { $Web_Net_Feb = 0 ;  }  

			$Tot_Pub_Feb = $Web_Pub_Feb +  $Off_Pub_Feb ;
			$Tot_Net_Feb = $Web_Net_Feb +  $Off_Net_Feb ; 
			
			
			
			
			
	                	
						
			$query_0220 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0220', SUM(Subtotal) 'Todo_Neto_Web_Off_0220'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;" ;
			$stmt_0220 = $conn->prepare($query_0220);
			$stmt_0220->execute();
        	$row = $stmt_0220->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0220 = $row["Todo_Publico_Web_Off_0220"]; if (empty($Todo_Publico_Web_Off_0220)) { $Todo_Publico_Web_Off_0220 = 0 ;  }  
            $Todo_Neto_Web_Off_0220 = $row["Todo_Neto_Web_Off_0220"]; if (empty($Todo_Neto_Web_Off_0220)) { $Todo_Neto_Web_Off_0220 = 0 ;  }  
		    /* print $query_0220; */
			
			
			$query_0220_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0220', SUM(total_neto) 'Todo_Neto_Traslados_0220' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE);";
					
			$stmt_0220_ = $conn->prepare($query_0220_);
			$stmt_0220_->execute();
        	$row = $stmt_0220_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0220 = $row["Todo_Publico_Traslados_0220"]; if (empty($Todo_Publico_Traslados_0220)) { $Todo_Publico_Traslados_0220 = 0 ;  }  
            $Todo_Neto_Traslados_0220 = $row["Todo_Neto_Traslados_0220"]; if (empty($Todo_Neto_Traslados_0220)) { $Todo_Neto_Traslados_0220 = 0 ;  }  
		    /* print $query_0220_; */
			
			$GRAN_TOT_PUBLICO_0220 = $Todo_Publico_Web_Off_0220 + $Todo_Publico_Traslados_0220;
			$GRAN_TOT_NETO_0220    = $Todo_Neto_Web_Off_0220 + $Todo_Neto_Traslados_0220;
			
			
			
			
			
			
			
			
			
			
			
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Febrero2020.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}

	 
    

    

  public function getMarzo20(){
  	session_start();
	try {
        $Mar_1 = '2020-03-01';         $Mar_2 = '2020-03-31'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Mar_1_19 = '2019-03-01';         $Mar_2_19 = '2019-03-31'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Mar',  SUM(Subtotal) 'Off_Net_Mar' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Mar_1_19."' AS DATE) AND CAST('".$Mar_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row["Off_Pub_Mar"]; if (empty($Off_Pub_Mar)) { $Off_Pub_Mar = 0 ;  }  
            $Off_Net_Mar = $row["Off_Net_Mar"]; if (empty($Off_Net_Mar)) { $Off_Net_Mar = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Mar',  SUM(Subtotal) 'Web_Net_Mar' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Mar_1_19."' AS DATE) AND CAST('".$Mar_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row["Web_Pub_Mar"]; if (empty($Web_Pub_Mar)) { $Web_Pub_Mar = 0 ;  }  
            $Web_Net_Mar = $row["Web_Net_Mar"]; if (empty($Web_Net_Mar)) { $Web_Net_Mar = 0 ;  }  

	 $Tot_Pub_Mar = $Web_Pub_Mar +  $Off_Pub_Mar ;
	 $Tot_Net_Mar = $Web_Net_Mar +  $Off_Net_Mar ; 
			
	
	        $query_0320 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0320', SUM(Subtotal) 'Todo_Neto_Web_Off_0320'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;" ;
			$stmt_0320 = $conn->prepare($query_0320);
			$stmt_0320->execute();
        	$row = $stmt_0320->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0320 = $row["Todo_Publico_Web_Off_0320"]; if (empty($Todo_Publico_Web_Off_0320)) { $Todo_Publico_Web_Off_0320 = 0 ;  }  
            $Todo_Neto_Web_Off_0320 = $row["Todo_Neto_Web_Off_0320"]; if (empty($Todo_Neto_Web_Off_0320)) { $Todo_Neto_Web_Off_0320 = 0 ;  }  
		    /* print $query_0320; */
			
			
			$query_0320_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0320', SUM(total_neto) 'Todo_Neto_Traslados_0320' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE);";
					
			$stmt_0320_ = $conn->prepare($query_0320_);
			$stmt_0320_->execute();
        	$row = $stmt_0320_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0320 = $row["Todo_Publico_Traslados_0320"]; if (empty($Todo_Publico_Traslados_0320)) { $Todo_Publico_Traslados_0320 = 0 ;  }  
            $Todo_Neto_Traslados_0320 = $row["Todo_Neto_Traslados_0320"]; if (empty($Todo_Neto_Traslados_0320)) { $Todo_Neto_Traslados_0320 = 0 ;  }  
		    /* print $query_0320_; */
			
	$GRAN_TOT_PUBLICO_0320 = $Todo_Publico_Web_Off_0320 + $Todo_Publico_Traslados_0320;
	$GRAN_TOT_NETO_0320    = $Todo_Neto_Web_Off_0320 + $Todo_Neto_Traslados_0320;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Marzo2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   }

	
	

    
    

public function getAbril20(){
  session_start();
	try {
        $Abr_1 = '2020-04-01';         $Abr_2 = '2020-04-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Abr_1_19 = '2019-04-01';         $Abr_2_19 = '2019-04-30'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Abr',  SUM(Subtotal) 'Off_Net_Abr' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Abr_1_19."' AS DATE) AND CAST('".$Abr_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row["Off_Pub_Abr"]; if (empty($Off_Pub_Abr)) { $Off_Pub_Abr = 0 ;  }  
            $Off_Net_Abr = $row["Off_Net_Abr"]; if (empty($Off_Net_Abr)) { $Off_Net_Abr = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Abr',  SUM(Subtotal) 'Web_Net_Abr' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Abr_1_19."' AS DATE) AND CAST('".$Abr_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row["Web_Pub_Abr"]; if (empty($Web_Pub_Abr)) { $Web_Pub_Abr = 0 ;  }  
            $Web_Net_Abr = $row["Web_Net_Abr"]; if (empty($Web_Net_Abr)) { $Web_Net_Abr = 0 ;  }  

	 $Tot_Pub_Abr = $Web_Pub_Abr +  $Off_Pub_Abr ;
	 $Tot_Net_Abr = $Web_Net_Abr +  $Off_Net_Abr ; 
			
	
	        $query_0420 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0420', SUM(Subtotal) 'Todo_Neto_Web_Off_0420'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;" ;
			$stmt_0420 = $conn->prepare($query_0420);
			$stmt_0420->execute();
        	$row = $stmt_0420->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0420 = $row["Todo_Publico_Web_Off_0420"]; if (empty($Todo_Publico_Web_Off_0420)) { $Todo_Publico_Web_Off_0420 = 0 ;  }  
            $Todo_Neto_Web_Off_0420 = $row["Todo_Neto_Web_Off_0420"]; if (empty($Todo_Neto_Web_Off_0420)) { $Todo_Neto_Web_Off_0420 = 0 ;  }  
		    /* print $query_0420; */
			
			
			$query_0420_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0420', SUM(total_neto) 'Todo_Neto_Traslados_0420' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE);";
					
			$stmt_0420_ = $conn->prepare($query_0420_);
			$stmt_0420_->execute();
        	$row = $stmt_0420_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0420 = $row["Todo_Publico_Traslados_0420"]; if (empty($Todo_Publico_Traslados_0420)) { $Todo_Publico_Traslados_0420 = 0 ;  }  
            $Todo_Neto_Traslados_0420 = $row["Todo_Neto_Traslados_0420"]; if (empty($Todo_Neto_Traslados_0420)) { $Todo_Neto_Traslados_0420 = 0 ;  }  
		    /* print $query_0420_; */
			
	$GRAN_TOT_PUBLICO_0420 = $Todo_Publico_Web_Off_0420 + $Todo_Publico_Traslados_0420;
	$GRAN_TOT_NETO_0420    = $Todo_Neto_Web_Off_0420 + $Todo_Neto_Traslados_0420;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Abril2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   }


    
    public function getMayo20(){
    session_start();
	try {
        $May_1 = '2020-05-01';         $May_2 = '2020-05-31'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $May_1_19 = '2019-05-01';         $May_2_19 = '2019-05-31'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_May',  SUM(Subtotal) 'Off_Net_May' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$May_1_19."' AS DATE) AND CAST('".$May_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row["Off_Pub_May"]; if (empty($Off_Pub_May)) { $Off_Pub_May = 0 ;  }  
            $Off_Net_May = $row["Off_Net_May"]; if (empty($Off_Net_May)) { $Off_Net_May = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_May',  SUM(Subtotal) 'Web_Net_May' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$May_1_19."' AS DATE) AND CAST('".$May_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row["Web_Pub_May"]; if (empty($Web_Pub_May)) { $Web_Pub_May = 0 ;  }  
            $Web_Net_May = $row["Web_Net_May"]; if (empty($Web_Net_May)) { $Web_Net_May = 0 ;  }  

	 $Tot_Pub_May = $Web_Pub_May +  $Off_Pub_May ;
	 $Tot_Net_May = $Web_Net_May +  $Off_Net_May ; 
			
	
	        $query_0520 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0520', SUM(Subtotal) 'Todo_Neto_Web_Off_0520'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE) ;" ;
			$stmt_0520 = $conn->prepare($query_0520);
			$stmt_0520->execute();
        	$row = $stmt_0520->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0520 = $row["Todo_Publico_Web_Off_0520"]; if (empty($Todo_Publico_Web_Off_0520)) { $Todo_Publico_Web_Off_0520 = 0 ;  }  
            $Todo_Neto_Web_Off_0520 = $row["Todo_Neto_Web_Off_0520"]; if (empty($Todo_Neto_Web_Off_0520)) { $Todo_Neto_Web_Off_0520 = 0 ;  }  
		    /* print $query_0520; */
			
			
			$query_0520_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0520', SUM(total_neto) 'Todo_Neto_Traslados_0520' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE);";
					
			$stmt_0520_ = $conn->prepare($query_0520_);
			$stmt_0520_->execute();
        	$row = $stmt_0520_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0520 = $row["Todo_Publico_Traslados_0520"]; if (empty($Todo_Publico_Traslados_0520)) { $Todo_Publico_Traslados_0520 = 0 ;  }  
            $Todo_Neto_Traslados_0520 = $row["Todo_Neto_Traslados_0520"]; if (empty($Todo_Neto_Traslados_0520)) { $Todo_Neto_Traslados_0520 = 0 ;  }  
		    /* print $query_0520_; */
			
	$GRAN_TOT_PUBLICO_0520 = $Todo_Publico_Web_Off_0520 + $Todo_Publico_Traslados_0520;
	$GRAN_TOT_NETO_0520    = $Todo_Neto_Web_Off_0520 + $Todo_Neto_Traslados_0520;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Mayo2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   }


    
    
    

   public function getJunio20(){
	session_start();
	try {
        $Jun_1 = '2020-06-01';         $Jun_2 = '2020-06-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Jun_1_19 = '2019-06-01';         $Jun_2_19 = '2019-06-30'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Jun',  SUM(Subtotal) 'Off_Net_Jun' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Jun_1_19."' AS DATE) AND CAST('".$Jun_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row["Off_Pub_Jun"]; if (empty($Off_Pub_Jun)) { $Off_Pub_Jun = 0 ;  }  
            $Off_Net_Jun = $row["Off_Net_Jun"]; if (empty($Off_Net_Jun)) { $Off_Net_Jun = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Jun',  SUM(Subtotal) 'Web_Net_Jun' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Jun_1_19."' AS DATE) AND CAST('".$Jun_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row["Web_Pub_Jun"]; if (empty($Web_Pub_Jun)) { $Web_Pub_Jun = 0 ;  }  
            $Web_Net_Jun = $row["Web_Net_Jun"]; if (empty($Web_Net_Jun)) { $Web_Net_Jun = 0 ;  }  

	 $Tot_Pub_Jun = $Web_Pub_Jun +  $Off_Pub_Jun ;
	 $Tot_Net_Jun = $Web_Net_Jun +  $Off_Net_Jun ; 
			
	
	        $query_0620 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0620', SUM(Subtotal) 'Todo_Neto_Web_Off_0620'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;" ;
			$stmt_0620 = $conn->prepare($query_0620);
			$stmt_0620->execute();
        	$row = $stmt_0620->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0620 = $row["Todo_Publico_Web_Off_0620"]; if (empty($Todo_Publico_Web_Off_0620)) { $Todo_Publico_Web_Off_0620 = 0 ;  }  
            $Todo_Neto_Web_Off_0620 = $row["Todo_Neto_Web_Off_0620"]; if (empty($Todo_Neto_Web_Off_0620)) { $Todo_Neto_Web_Off_0620 = 0 ;  }  
		    /* print $query_0620; */
			
			
			$query_0620_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0620', SUM(total_neto) 'Todo_Neto_Traslados_0620' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE);";
					
			$stmt_0620_ = $conn->prepare($query_0620_);
			$stmt_0620_->execute();
        	$row = $stmt_0620_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0620 = $row["Todo_Publico_Traslados_0620"]; if (empty($Todo_Publico_Traslados_0620)) { $Todo_Publico_Traslados_0620 = 0 ;  }  
            $Todo_Neto_Traslados_0620 = $row["Todo_Neto_Traslados_0620"]; if (empty($Todo_Neto_Traslados_0620)) { $Todo_Neto_Traslados_0620 = 0 ;  }  
		    /* print $query_0620_; */
			
	$GRAN_TOT_PUBLICO_0620 = $Todo_Publico_Web_Off_0620 + $Todo_Publico_Traslados_0620;
	$GRAN_TOT_NETO_0620    = $Todo_Neto_Web_Off_0620 + $Todo_Neto_Traslados_0620;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Junio2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   }


   
    
    
    
    public function getJulio20(){
	 
	session_start();
	try {
        $Jul_1 = '2020-07-01';         $Jul_2 = '2020-07-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Jul_1_19 = '2019-07-01';         $Jul_2_19 = '2019-07-30'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Jul',  SUM(Subtotal) 'Off_Net_Jul' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Jul_1_19."' AS DATE) AND CAST('".$Jul_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row["Off_Pub_Jul"]; if (empty($Off_Pub_Jul)) { $Off_Pub_Jul = 0 ;  }  
            $Off_Net_Jul = $row["Off_Net_Jul"]; if (empty($Off_Net_Jul)) { $Off_Net_Jul = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Jul',  SUM(Subtotal) 'Web_Net_Jul' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Jul_1_19."' AS DATE) AND CAST('".$Jul_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row["Web_Pub_Jul"]; if (empty($Web_Pub_Jul)) { $Web_Pub_Jul = 0 ;  }  
            $Web_Net_Jul = $row["Web_Net_Jul"]; if (empty($Web_Net_Jul)) { $Web_Net_Jul = 0 ;  }  

	 $Tot_Pub_Jul = $Web_Pub_Jul +  $Off_Pub_Jul ;
	 $Tot_Net_Jul = $Web_Net_Jul +  $Off_Net_Jul ; 
			
	
	        $query_0720 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0720', SUM(Subtotal) 'Todo_Neto_Web_Off_0720'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;" ;
			$stmt_0720 = $conn->prepare($query_0720);
			$stmt_0720->execute();
        	$row = $stmt_0720->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0720 = $row["Todo_Publico_Web_Off_0720"]; if (empty($Todo_Publico_Web_Off_0720)) { $Todo_Publico_Web_Off_0720 = 0 ;  }  
            $Todo_Neto_Web_Off_0720 = $row["Todo_Neto_Web_Off_0720"]; if (empty($Todo_Neto_Web_Off_0720)) { $Todo_Neto_Web_Off_0720 = 0 ;  }  
		    /* print $query_0720; */
			
			
			$query_0720_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0720', SUM(total_neto) 'Todo_Neto_Traslados_0720' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE);";
					
			$stmt_0720_ = $conn->prepare($query_0720_);
			$stmt_0720_->execute();
        	$row = $stmt_0720_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0720 = $row["Todo_Publico_Traslados_0720"]; if (empty($Todo_Publico_Traslados_0720)) { $Todo_Publico_Traslados_0720 = 0 ;  }  
            $Todo_Neto_Traslados_0720 = $row["Todo_Neto_Traslados_0720"]; if (empty($Todo_Neto_Traslados_0720)) { $Todo_Neto_Traslados_0720 = 0 ;  }  
		    /* print $query_0720_; */
			
	$GRAN_TOT_PUBLICO_0720 = $Todo_Publico_Web_Off_0720 + $Todo_Publico_Traslados_0720;
	$GRAN_TOT_NETO_0720    = $Todo_Neto_Web_Off_0720 + $Todo_Neto_Traslados_0720;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Julio2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   } 
    
    
   public function getAgosto20(){
	session_start();
	try {
        $Ago_1 = '2020-08-01';         $Ago_2 = '2020-08-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Ago_1_19 = '2019-08-01';         $Ago_2_19 = '2019-08-30'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Ago',  SUM(Subtotal) 'Off_Net_Ago' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Ago_1_19."' AS DATE) AND CAST('".$Ago_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row["Off_Pub_Ago"]; if (empty($Off_Pub_Ago)) { $Off_Pub_Ago = 0 ;  }  
            $Off_Net_Ago = $row["Off_Net_Ago"]; if (empty($Off_Net_Ago)) { $Off_Net_Ago = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Ago',  SUM(Subtotal) 'Web_Net_Ago' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Ago_1_19."' AS DATE) AND CAST('".$Ago_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row["Web_Pub_Ago"]; if (empty($Web_Pub_Ago)) { $Web_Pub_Ago = 0 ;  }  
            $Web_Net_Ago = $row["Web_Net_Ago"]; if (empty($Web_Net_Ago)) { $Web_Net_Ago = 0 ;  }  

	 $Tot_Pub_Ago = $Web_Pub_Ago +  $Off_Pub_Ago ;
	 $Tot_Net_Ago = $Web_Net_Ago +  $Off_Net_Ago ; 
			
	
	        $query_0820 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0820', SUM(Subtotal) 'Todo_Neto_Web_Off_0820'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE) ;" ;
			$stmt_0820 = $conn->prepare($query_0820);
			$stmt_0820->execute();
        	$row = $stmt_0820->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0820 = $row["Todo_Publico_Web_Off_0820"]; if (empty($Todo_Publico_Web_Off_0820)) { $Todo_Publico_Web_Off_0820 = 0 ;  }  
            $Todo_Neto_Web_Off_0820 = $row["Todo_Neto_Web_Off_0820"]; if (empty($Todo_Neto_Web_Off_0820)) { $Todo_Neto_Web_Off_0820 = 0 ;  }  
		    /* print $query_0820; */
			
			
			$query_0820_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0820', SUM(total_neto) 'Todo_Neto_Traslados_0820' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE);";
					
			$stmt_0820_ = $conn->prepare($query_0820_);
			$stmt_0820_->execute();
        	$row = $stmt_0820_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0820 = $row["Todo_Publico_Traslados_0820"]; if (empty($Todo_Publico_Traslados_0820)) { $Todo_Publico_Traslados_0820 = 0 ;  }  
            $Todo_Neto_Traslados_0820 = $row["Todo_Neto_Traslados_0820"]; if (empty($Todo_Neto_Traslados_0820)) { $Todo_Neto_Traslados_0820 = 0 ;  }  
		    /* print $query_0820_; */
			
	$GRAN_TOT_PUBLICO_0820 = $Todo_Publico_Web_Off_0820 + $Todo_Publico_Traslados_0820;
	$GRAN_TOT_NETO_0820    = $Todo_Neto_Web_Off_0820 + $Todo_Neto_Traslados_0820;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Agosto2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   } 
   
    
    
    
    
     
	     
   public function getSeptiembre20(){
	session_start();
	try {
        $Sep_1 = '2020-09-01';         $Sep_2 = '2020-09-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Sep_1_19 = '2019-09-01';         $Sep_2_19 = '2019-09-30'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Sep',  SUM(Subtotal) 'Off_Net_Sep' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Sep_1_19."' AS DATE) AND CAST('".$Sep_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row["Off_Pub_Sep"]; if (empty($Off_Pub_Sep)) { $Off_Pub_Sep = 0 ;  }  
            $Off_Net_Sep = $row["Off_Net_Sep"]; if (empty($Off_Net_Sep)) { $Off_Net_Sep = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Sep',  SUM(Subtotal) 'Web_Net_Sep' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Sep_1_19."' AS DATE) AND CAST('".$Sep_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row["Web_Pub_Sep"]; if (empty($Web_Pub_Sep)) { $Web_Pub_Sep = 0 ;  }  
            $Web_Net_Sep = $row["Web_Net_Sep"]; if (empty($Web_Net_Sep)) { $Web_Net_Sep = 0 ;  }  

	 $Tot_Pub_Sep = $Web_Pub_Sep +  $Off_Pub_Sep ;
	 $Tot_Net_Sep = $Web_Net_Sep +  $Off_Net_Sep ; 
			
	
	        $query_0920 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_0920', SUM(Subtotal) 'Todo_Neto_Web_Off_0920'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE) ;" ;
			$stmt_0920 = $conn->prepare($query_0920);
			$stmt_0920->execute();
        	$row = $stmt_0920->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_0920 = $row["Todo_Publico_Web_Off_0920"]; if (empty($Todo_Publico_Web_Off_0920)) { $Todo_Publico_Web_Off_0920 = 0 ;  }  
            $Todo_Neto_Web_Off_0920 = $row["Todo_Neto_Web_Off_0920"]; if (empty($Todo_Neto_Web_Off_0920)) { $Todo_Neto_Web_Off_0920 = 0 ;  }  
		    /* print $query_0920; */
			
			
			$query_0920_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_0920', SUM(total_neto) 'Todo_Neto_Traslados_0920' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE);";
					
			$stmt_0920_ = $conn->prepare($query_0920_);
			$stmt_0920_->execute();
        	$row = $stmt_0920_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_0920 = $row["Todo_Publico_Traslados_0920"]; if (empty($Todo_Publico_Traslados_0920)) { $Todo_Publico_Traslados_0920 = 0 ;  }  
            $Todo_Neto_Traslados_0920 = $row["Todo_Neto_Traslados_0920"]; if (empty($Todo_Neto_Traslados_0920)) { $Todo_Neto_Traslados_0920 = 0 ;  }  
		    /* print $query_0920_; */
			
	$GRAN_TOT_PUBLICO_0920 = $Todo_Publico_Web_Off_0920 + $Todo_Publico_Traslados_0920;
	$GRAN_TOT_NETO_0920    = $Todo_Neto_Web_Off_0920 + $Todo_Neto_Traslados_0920;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Septiembre2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   } 
   
    

    
    
    


    public function getOctubre20(){
	session_start();
	try {
        $Oct_1 = '2020-10-01';         $Oct_2 = '2020-10-31'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Oct_1_19 = '2019-10-01';         $Oct_2_19 = '2019-10-31'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Oct',  SUM(Subtotal) 'Off_Net_Oct' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Oct_1_19."' AS DATE) AND CAST('".$Oct_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row["Off_Pub_Oct"]; if (empty($Off_Pub_Oct)) { $Off_Pub_Oct = 0 ;  }  
            $Off_Net_Oct = $row["Off_Net_Oct"]; if (empty($Off_Net_Oct)) { $Off_Net_Oct = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Oct',  SUM(Subtotal) 'Web_Net_Oct' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Oct_1_19."' AS DATE) AND CAST('".$Oct_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row["Web_Pub_Oct"]; if (empty($Web_Pub_Oct)) { $Web_Pub_Oct = 0 ;  }  
            $Web_Net_Oct = $row["Web_Net_Oct"]; if (empty($Web_Net_Oct)) { $Web_Net_Oct = 0 ;  }  

	 $Tot_Pub_Oct = $Web_Pub_Oct +  $Off_Pub_Oct ;
	 $Tot_Net_Oct = $Web_Net_Oct +  $Off_Net_Oct ; 
			
	
	        $query_1020 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_1020', SUM(Subtotal) 'Todo_Neto_Web_Off_1020'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE) ;" ;
			$stmt_1020 = $conn->prepare($query_1020);
			$stmt_1020->execute();
        	$row = $stmt_1020->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_1020 = $row["Todo_Publico_Web_Off_1020"]; if (empty($Todo_Publico_Web_Off_1020)) { $Todo_Publico_Web_Off_1020 = 0 ;  }  
            $Todo_Neto_Web_Off_1020 = $row["Todo_Neto_Web_Off_1020"]; if (empty($Todo_Neto_Web_Off_1020)) { $Todo_Neto_Web_Off_1020 = 0 ;  }  
		    /* print $query_1020; */
			
			
			$query_1020_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_1020', SUM(total_neto) 'Todo_Neto_Traslados_1020' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE);";
					
			$stmt_1020_ = $conn->prepare($query_1020_);
			$stmt_1020_->execute();
        	$row = $stmt_1020_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_1020 = $row["Todo_Publico_Traslados_1020"]; if (empty($Todo_Publico_Traslados_1020)) { $Todo_Publico_Traslados_1020 = 0 ;  }  
            $Todo_Neto_Traslados_1020 = $row["Todo_Neto_Traslados_1020"]; if (empty($Todo_Neto_Traslados_1020)) { $Todo_Neto_Traslados_1020 = 0 ;  }  
		    /* print $query_1020_; */
			
	$GRAN_TOT_PUBLICO_1020 = $Todo_Publico_Web_Off_1020 + $Todo_Publico_Traslados_1020;
	$GRAN_TOT_NETO_1020    = $Todo_Neto_Web_Off_1020 + $Todo_Neto_Traslados_1020;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Octubre2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   } 
   

	
	
	
    
    public function getNoviembre20(){
	session_start();
	try {
        $Nov_1 = '2020-11-01';         $Nov_2 = '2020-11-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Nov_1_19 = '2019-10-01';         $Nov_2_19 = '2019-10-30'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Nov',  SUM(Subtotal) 'Off_Net_Nov' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Nov_1_19."' AS DATE) AND CAST('".$Nov_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row["Off_Pub_Nov"]; if (empty($Off_Pub_Nov)) { $Off_Pub_Nov = 0 ;  }  
            $Off_Net_Nov = $row["Off_Net_Nov"]; if (empty($Off_Net_Nov)) { $Off_Net_Nov = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Nov',  SUM(Subtotal) 'Web_Net_Nov' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Nov_1_19."' AS DATE) AND CAST('".$Nov_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row["Web_Pub_Nov"]; if (empty($Web_Pub_Nov)) { $Web_Pub_Nov = 0 ;  }  
            $Web_Net_Nov = $row["Web_Net_Nov"]; if (empty($Web_Net_Nov)) { $Web_Net_Nov = 0 ;  }  

	 $Tot_Pub_Nov = $Web_Pub_Nov +  $Off_Pub_Nov ;
	 $Tot_Net_Nov = $Web_Net_Nov +  $Off_Net_Nov ; 
			
	
	        $query_1120 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_1120', SUM(Subtotal) 'Todo_Neto_Web_Off_1120'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE) ;" ;
			$stmt_1120 = $conn->prepare($query_1120);
			$stmt_1120->execute();
        	$row = $stmt_1120->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_1120 = $row["Todo_Publico_Web_Off_1120"]; if (empty($Todo_Publico_Web_Off_1120)) { $Todo_Publico_Web_Off_1120 = 0 ;  }  
            $Todo_Neto_Web_Off_1120 = $row["Todo_Neto_Web_Off_1120"]; if (empty($Todo_Neto_Web_Off_1120)) { $Todo_Neto_Web_Off_1120 = 0 ;  }  
		    /* print $query_1120; */
			
			
			$query_1120_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_1120', SUM(total_neto) 'Todo_Neto_Traslados_1120' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE);";
					
			$stmt_1120_ = $conn->prepare($query_1120_);
			$stmt_1120_->execute();
        	$row = $stmt_1120_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_1120 = $row["Todo_Publico_Traslados_1120"]; if (empty($Todo_Publico_Traslados_1120)) { $Todo_Publico_Traslados_1120 = 0 ;  }  
            $Todo_Neto_Traslados_1120 = $row["Todo_Neto_Traslados_1120"]; if (empty($Todo_Neto_Traslados_1120)) { $Todo_Neto_Traslados_1120 = 0 ;  }  
		    /* print $query_1120_; */
			
	$GRAN_TOT_PUBLICO_1120 = $Todo_Publico_Web_Off_1120 + $Todo_Publico_Traslados_1120;
	$GRAN_TOT_NETO_1120    = $Todo_Neto_Web_Off_1120 + $Todo_Neto_Traslados_1120;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Noviembre2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   } 
   
    
    
    
    
    public function getDiciembre20(){
	 session_start();
	try {
        $Dic_1 = '2020-12-01';         $Dic_2 = '2020-12-30'; 
	 	
		try {
			$db = new db();
			$conn = $db->conn_local();
			$query1 = "(SELECT Status_payments, Id, CONCAT(Customers_Name,' ', LastName) AS Customers_Name, NoPeople, Services_Name, NameProvider, 
					           TypeService, DateTo, DateFrom, Total, Subtotal
                        FROM  VISTA__GRAN_TOT_VTAS 
                        WHERE isDeleted = 0 AND Id_Status = 3 AND Offline IN (0, 1) 
					          AND DateTo BETWEEN CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)
							  ORDER BY Status_payments ASC
				      )
	                   UNION
	                  (SELECT Volaris, no_reserva, nombre_completo, paxxx, Volaris, Volaris, Name, fecha_llegada, fecha_salida, total_publico, total_neto
                       FROM   VISTA__OPERACION_COMPLETA
                       WHERE  isDeleted = 0 
					          AND fecha_llegada BETWEEN CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)
				      )";
	          // print $query1;
			   
			$stmt1 = $conn->prepare($query1);
			$stmt1->execute();
			$count1 = $stmt1->rowCount();
          if($count1 >= 0){
				$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
				$lista1 = array();
				
				foreach ($rows1 as $row) {
					
					$sale1 = new sale_row();
					$sale1->setId($row['Id']);
					$sale1->setCustomer($row['Customers_Name']);
					$sale1->setStatus($row['Status_payments']);
					$sale1->setService($row['Services_Name']);
					$sale1->setDateTo($row['DateTo']);
					$sale1->setDateFrom($row['DateFrom']);
					$sale1->setTotal($row['Total']);
					$sale1->setSubTotal($row['Subtotal']);
					$sale1->setTypeService($row['TypeService']);
					$sale1->setProvider($row['NameProvider']);
                    $sale1->setPaxxx($row['NoPeople']);
					array_push($lista1, $sale1);
				}
                   
				   
				   
		    $Dic_1_19 = '2019-12-01';         $Dic_2_19 = '2019-12-31'; 
            $query1a ="SELECT SUM(Total) 'Off_Pub_Dic',  SUM(Subtotal) 'Off_Net_Dic' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) AND DateTo BETWEEN   CAST('".$Dic_1_19."' AS DATE) AND CAST('".$Dic_2_19."' AS DATE)  ;"; 
			/*print 	$query1a;			   */
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row["Off_Pub_Dic"]; if (empty($Off_Pub_Dic)) { $Off_Pub_Dic = 0 ;  }  
            $Off_Net_Dic = $row["Off_Net_Dic"]; if (empty($Off_Net_Dic)) { $Off_Net_Dic = 0 ;  }  
			
			
			
			$query1b ="SELECT SUM(Total) 'Web_Pub_Dic',  SUM(Subtotal) 'Web_Net_Dic' 
                               FROM VISTA__GRAN_TOT_VTAS
                               WHERE Offline IN (0)  AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Dic_1_19."' AS DATE) AND CAST('".$Dic_2_19."' AS DATE)  ;"; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row["Web_Pub_Dic"]; if (empty($Web_Pub_Dic)) { $Web_Pub_Dic = 0 ;  }  
            $Web_Net_Dic = $row["Web_Net_Dic"]; if (empty($Web_Net_Dic)) { $Web_Net_Dic = 0 ;  }  

	 $Tot_Pub_Dic = $Web_Pub_Dic +  $Off_Pub_Dic ;
	 $Tot_Net_Dic = $Web_Net_Dic +  $Off_Net_Dic ; 
			
	
	        $query_1220 = " SELECT SUM(Total) 'Todo_Publico_Web_Off_1220', SUM(Subtotal) 'Todo_Neto_Web_Off_1220'
			                       FROM VISTA__GRAN_TOT_VTAS
						           WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0, 1) 
                                   AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE) ;" ;
			$stmt_1220 = $conn->prepare($query_1220);
			$stmt_1220->execute();
        	$row = $stmt_1220->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Web_Off_1220 = $row["Todo_Publico_Web_Off_1220"]; if (empty($Todo_Publico_Web_Off_1220)) { $Todo_Publico_Web_Off_1220 = 0 ;  }  
            $Todo_Neto_Web_Off_1220 = $row["Todo_Neto_Web_Off_1220"]; if (empty($Todo_Neto_Web_Off_1220)) { $Todo_Neto_Web_Off_1220 = 0 ;  }  
		    /* print $query_1220; */
			
			
			$query_1220_ = "SELECT SUM(total_publico) 'Todo_Publico_Traslados_1220', SUM(total_neto) 'Todo_Neto_Traslados_1220' 
                                   FROM   VISTA__OPERACION_COMPLETA
                                   WHERE  isDeleted = 0 
					               AND fecha_llegada BETWEEN CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE);";
					
			$stmt_1220_ = $conn->prepare($query_1220_);
			$stmt_1220_->execute();
        	$row = $stmt_1220_->fetch(PDO::FETCH_ASSOC);
			$Todo_Publico_Traslados_1220 = $row["Todo_Publico_Traslados_1220"]; if (empty($Todo_Publico_Traslados_1220)) { $Todo_Publico_Traslados_1220 = 0 ;  }  
            $Todo_Neto_Traslados_1220 = $row["Todo_Neto_Traslados_1220"]; if (empty($Todo_Neto_Traslados_1220)) { $Todo_Neto_Traslados_1220 = 0 ;  }  
		    /* print $query_1220_; */
			
	$GRAN_TOT_PUBLICO_1220 = $Todo_Publico_Web_Off_1220 + $Todo_Publico_Traslados_1220;
	$GRAN_TOT_NETO_1220    = $Todo_Neto_Web_Off_1220 + $Todo_Neto_Traslados_1220;
			}
			else
				$count =0;
     		} 
        catch (Exception $e) 
        {  		 	echo "Algo se debé mejorar: ".$e;  		}

        
        include ("views/Sales/◣_◢-Vtas_Diciembre2020.php");
   }
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

   } 
   
    


    


/* ███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░███▓▒░░  */
	
	
	
	
	
	
	
	
	
	
	
    /*---<> ||||||||||||||*>--------------------------------------------------------------------------------------------------------------------*/
    public function getGridvolaris(){
        
    session_start();
	try{

	 	$Fecha_2 = date("Y-m-d");
	 	$Fecha_1 = date("Y-m-d",strtotime($Fecha_2."- 1 month"));
	    $total_pax = 0;
        $total_registros = 0;
        
		$lista = array();
        $db = new db();
		$conn = $db->conn_local();
        //$query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
//                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
//	                                    hora_pickup_salida, unidad_salida, operador_salida
//                        FROM volaris WHERE isDeleted = 0 AND fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) 
//                        ORDER BY fecha_llegada  DESC ;";
//						
						
						
						
		//$query = "SELECT Id_Volaris, Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, 
//                 hora_pickup_llegada, paxxx, empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida,           
//                 servicio_salida, no_vuelo_salida, hora_vuelo_salida, hora_pickup_salida, unidad_salida, operador_salida,        
//                 fecha_captura, isDeleted, comentarios, Id_productos, total_publico, total_neto,
//                 Id, Name 
//           FROM VISTA__OPERACION_COMPLETA WHERE  isDeleted = 0 AND fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) 
//           ORDER BY fecha_llegada  DESC ;";
//						
						
		$query = "SELECT Id_Volaris, Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, 
                         hora_pickup_llegada, paxxx, empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida,           
                         servicio_salida, no_vuelo_salida, hora_vuelo_salida, hora_pickup_salida, unidad_salida, operador_salida,        
                         fecha_captura, isDeleted, comentarios, Id_productos, total_publico, total_neto,
                         Id, Name 
                 FROM VISTA__OPERACION_COMPLETA
				 WHERE  isDeleted = 0 
				 ORDER BY Id_Volaris  
				 DESC
				 LIMIT 250 ;";
		
		
		
		
	    //print $query;
		$stmt = $conn->prepare($query);             
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
				$volaris->setno_reserva($row['no_reserva']);
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				$volaris->setId_productos($row['Id_productos']);
				$volaris->settotal_publico($row['total_publico']);
				$volaris->settotal_neto($row['total_neto']);
				$volaris->setId($row['Id']);
				$volaris->setName($row['Name']);
				array_push($lista, $volaris);

			}
                
			$query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND  fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE)  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues

			}
			else
			    $bandera = 1; 	//echo "Falla en la sumatoria";
		}
		else
			$count= 0;
                       
         
	 	include ("views/Sales/Vtas_Volaris_Contenedor.php");


	} 
    catch (Exception $e)
    {
	 	echo "Error fatal: ".$e;
	 }

}
    
    
    
    
    
     public function getImprimirtrip(){
        
    session_start();
	try{

	 	$Fecha_2 = date("Y-m-d");
	 	$Fecha_1 = date("Y-m-d");
       
        
	    $total_pax = 0;
        $total_registros = 0;
        
		$lista = array();
        $db = new db();
		$conn = $db->conn_local();
        $query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida
                        FROM volaris WHERE isDeleted = 0 AND fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) 
                        ORDER BY Id_Volaris DESC ;";
	   //  print $query;
		$stmt = $conn->prepare($query);             
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
				$volaris->setno_reserva($row['no_reserva']);
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				array_push($lista, $volaris);

			}
                
			$query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND  fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE)  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues

			}
			else
			    $bandera = 1; 	//echo "Falla en la sumatoria";
		}
		else
			$count= 0;
                       
         
	 	include ("views/Sales/Imprimir_Tripulacion.php");


	} 
    catch (Exception $e)
    {
	 	echo "Error fatal: ".$e;
	 }

}
    
    
    
    

public function postGridvolaris() { 

	session_start();
	$lista = array();
  $Fecha_1 = $_POST["Fecha_1"];
  $Fecha_2 = $_POST["Fecha_2"];
//$nombre_completo    = $_POST["nombre_completo"];
//	$no_reserva                 = $_POST["no_reserva"];
//    print  $nombre_completo.'<------------$nombre_completo ' ;
  
    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{
		$db = new db();
		$conn = $db->conn_local();
  
 //$query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
//                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
//	                                    hora_pickup_salida, unidad_salida, operador_salida
//                   FROM volaris WHERE  isDeleted = 0  $Rango_Fechas  ORDER BY Id_Volaris DESC ;";
				   
				   
 $query = "SELECT Id_Volaris, Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, 
                 hora_pickup_llegada, paxxx, empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida,           
                 servicio_salida, no_vuelo_salida, hora_vuelo_salida, hora_pickup_salida, unidad_salida, operador_salida,        
                 fecha_captura, isDeleted, comentarios, Id_productos, total_publico, total_neto,
                 Id, Name 
           FROM VISTA__OPERACION_COMPLETA WHERE isDeleted = 0  $Rango_Fechas  ORDER BY Id_Volaris DESC ;";
			 
        
      //  print $query;
        $stmt = $conn->prepare($query);
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                $volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
								
				$volaris->setId_productos($row['Id_productos']);
				$volaris->settotal_publico($row['total_publico']);
				$volaris->settotal_neto($row['total_neto']);
				$volaris->setId($row['Id']);
				$volaris->setName($row['Name']);
				
				array_push($lista, $volaris);

			}

            $query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND   $Rango_Fechas_All  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues
            
			}
			else
				$bandera = 1; 	//echo "algo que checar con el sum";
		}
		else
			$count= 0;
        
        
        
        
        

	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Vtas_Volaris_Contenedor.php";	
}    

	 

    
    
    public function postImprimirtrip() { 

	session_start();
	$lista = array();
  $Fecha_1 = $_POST["Fecha_1"];
  $Fecha_2 = $_POST["Fecha_2"];
  $Fecha_3 = $_POST["Fecha_3"];
 
        
//$nombre_completo    = $_POST["nombre_completo"];
//	$no_reserva                 = $_POST["no_reserva"];
        
   if (empty ($Fecha_3)) 
        {
            $Fecha_3 = $Fecha_3;
        }
        else {
            $Fecha_1 = $Fecha_3;
            $Fecha_2 = $Fecha_3;
        }
        
   // print  $Fecha_1 .'<------------$ $Fecha_1 ' ;
//    print  $Fecha_2 .'<------------$ $Fecha_2 ' ;
//    print  $Fecha_3 .'<------------$ $Fecha_3 ' ;
        
  
    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{
		$db = new db();
		$conn = $db->conn_local();
  
 $query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida
                   FROM volaris WHERE  isDeleted = 0  $Rango_Fechas  ORDER BY hora_pickup_llegada ASC  ;";
        
       // print $query;
        $stmt = $conn->prepare($query);
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                 $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                
				
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				array_push($lista, $volaris);

			}

            $query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND   $Rango_Fechas_All  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues
            
			}
			else
				$bandera = 1; 	//echo "algo que checar con el sum";
		}
		else
			$count= 0;
        
        
        
        
        

	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Imprimir_Tripulacion.php";	
}    

	 

    

    
    
    
    
public function postImprimirtripout() { 

session_start();
  $lista = array();
  $Fecha_1 = $_POST["Fecha_1out"];
  $Fecha_2 = $_POST["Fecha_2out"];
    
 $Fecha_3 = $_POST["Fecha_3out"];
 
        
    
   if (empty ($Fecha_3)) 
        {
            $Fecha_3 = $Fecha_3;
        }
        else {
            $Fecha_1 = $Fecha_3;
            $Fecha_2 = $Fecha_3;
        }

    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND fecha_salida BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " fecha_salida BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{
		$db = new db();
		$conn = $db->conn_local();
  
 $query = " SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida
                   FROM volaris WHERE  isDeleted = 0  $Rango_Fechas  ORDER BY hora_pickup_salida ASC  ; ";
        
       // print $query;
        $stmt = $conn->prepare($query);
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row();  /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                
				
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				array_push($lista, $volaris);

			}

            $query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND   $Rango_Fechas_All  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues
            
			}
			else
				$bandera = 1; 	//echo "algo que checar con el sum";
		}
		else
			$count= 0;
        
        
        
        
        

	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Imprimir_TripulacionOut.php";	
}    

    
    
    
	
	
	
	
	
	
	
	
	    
public function postImp_op_completa_salidas() { 

session_start();
  $lista = array();
  $Fecha_1 = $_POST["Fecha_1out"];
  $Fecha_2 = $_POST["Fecha_2out"];
    
 $Fecha_3 = $_POST["Fecha_3out"];
 
        
    
   if (empty ($Fecha_3)) 
        {
            $Fecha_3 = $Fecha_3;
        }
        else {
            $Fecha_1 = $Fecha_3;
            $Fecha_2 = $Fecha_3;
        }

    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND fecha_salida BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " fecha_salida BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{
		$db = new db();
		$conn = $db->conn_local();
  
 $query = " SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida,
										Id_productos, total_publico, total_neto, Id, Name  
                   FROM VISTA__OPERACION_COMPLETA WHERE  isDeleted = 0  $Rango_Fechas  ORDER BY hora_pickup_salida ASC  ; ";
				   
				   
				   
        
       // print $query;
        $stmt = $conn->prepare($query);
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row();  /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                
				
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				$volaris->setName($row['Name']);
				array_push($lista, $volaris);

			}

            $query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND   $Rango_Fechas_All  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues
            
			}
			else
				$bandera = 1; 	//echo "algo que checar con el sum";
		}
		else
			$count= 0;
        
        
        
        
        

	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Imprimir_TripulacionOut_Ope_Com_Salidas.php";	
}    

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
    
    
    
    
    
    
 public function postImprimiroperador() {  

	session_start();
	$lista = array();
     $lista1 = array();
  $Fecha_1 = $_POST["Fecha_1"];
  $Fecha_2 = $_POST["Fecha_2"];
  $operador = TRIM($_POST["operador"]); //if (empty ($operador)) {$operador = '';}   
     
 $Fecha_3 = $_POST["Fecha_3"];
 
        
    
   if (empty ($Fecha_3)) 
        {
            $Fecha_3 = $Fecha_3;
        }
        else {
            $Fecha_1 = $Fecha_3;
            $Fecha_2 = $Fecha_3;
        }
  
    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
        $Rango_Fechass = " AND fecha_salida BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{
		$db = new db();
		$conn = $db->conn_local();
  
        $query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida
                   FROM volaris WHERE operador_llegada = '".$operador."'  AND   isDeleted = 0  $Rango_Fechas  ORDER BY hora_pickup_llegada ASC  ;";
        
     // print $query.'<---Primer query---|';
        $stmt = $conn->prepare($query);
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
          //  print_r ($rows); 
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                 $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                
				
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				array_push($lista, $volaris);

			}
             
            
            
            
            
            
        }
        
        
        $query1 = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida
                   FROM volaris WHERE operador_salida = '".$operador."'  AND   isDeleted = 0  $Rango_Fechass  ORDER BY hora_pickup_salida ASC  ;";
        
         //  print $query1 .'<---Segundo  query---|';
        
            $stmt1 = $conn->prepare($query1);
            $stmt1->execute();               
            $count1 = $stmt1->rowCount();
            if($count1 > 0){

                	$rows1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                   //  print_r ($rows1); 
                		$lista1 = array();
                foreach ($rows1 as $row) {
                
                				$volaris1 = new volarisuno_row(); /* nueva instancia   */
                                 $volaris1->setId_Volaris($row['Id_Volaris']);
                				$volaris1->setnombre_completo($row['nombre_completo']);
                				$volaris1->setfecha_llegada($row['fecha_llegada']);
                				$volaris1->setservicio_llegada($row['servicio_llegada']);
                				$volaris1->setno_vuelo_llegada($row['no_vuelo_llegada']);
                				$volaris1->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
                				$volaris1->setpaxxx($row['paxxx']);
                                $volaris1->sethora_pickup_llegada($row['hora_pickup_llegada']);
                                $volaris1->setempresa($row['empresa']);
                                $volaris1->setunidad_llegada($row['unidad_llegada']);
                                $volaris1->setoperador_llegada($row['operador_llegada']);
                                $volaris1->setno_reserva($row['no_reserva']);
                                
                				
                				$volaris1->setfecha_salida($row['fecha_salida']);
                				$volaris1->setno_vuelo_salida($row['no_vuelo_salida']);
                				$volaris1->sethora_vuelo_salida($row['hora_vuelo_salida']);
                				$volaris1->sethora_pickup_salida($row['hora_pickup_salida']);
                				$volaris1->setunidad_salida($row['unidad_salida']);
                				$volaris1->setoperador_salida($row['operador_salida']);
                				array_push($lista1, $volaris1);
                
                			}
            
            
            
           // print 'salescontroller-finaliza2do Si habia datos, arreglo'; 
            
            
            
            //$query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
//                              FROM volaris
//                              WHERE isDeleted = 0 AND   $Rango_Fechas_All  ;"; 
//            print $query2;  
//                print 'hasta aqui bien';
//       		$stmt2 = $conn->prepare($query2);
//			$stmt2->execute();
//			$count2 = $stmt2->rowCount();
//            if($count2 > 0){
//					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
//					//print_r($row);
//					$total_pax = $row['No_PAX'];
//					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues
//            
//			}
//			else
//				$bandera = 1; 	//echo "algo que checar con el sum";
		}
            else
              //   print '-- No tiene Registros --';
                $count= 0;
        
        
 
	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Imprimir_Operadores.php";	
}    

	 
    
    
    
    
    
    
	
	
	
	
	
	
public function postImp_op_completa_llegadas() { 
                    
	session_start();
	$lista = array();
  $Fecha_1 = $_POST["Fecha_1"];
  $Fecha_2 = $_POST["Fecha_2"];
  $Fecha_3 = $_POST["Fecha_3"];
 
        
//$nombre_completo    = $_POST["nombre_completo"];
//	$no_reserva                 = $_POST["no_reserva"];
        
   if (empty ($Fecha_3)) 
        {
            $Fecha_3 = $Fecha_3;
        }
        else {
            $Fecha_1 = $Fecha_3;
            $Fecha_2 = $Fecha_3;
        }
        
   // print  $Fecha_1 .'<------------$ $Fecha_1 ' ;
//    print  $Fecha_2 .'<------------$ $Fecha_2 ' ;
//    print  $Fecha_3 .'<------------$ $Fecha_3 ' ;
        
  
    $diagonal = substr($Fecha_1,2,1);
   if($diagonal == "/"){
		$d1 = substr($Fecha_1,3,2);		$m1 = substr($Fecha_1,0,2);  	$a1 = substr($Fecha_1,6,4);
        $d2 = substr($Fecha_2,3,2);   $m2 = substr($Fecha_2,0,2);  $a2 = substr($Fecha_2,6,4);
        $Fecha_1 = $a1."-".$m1."-".$d1;    	   $Fecha_2 = $a2."-".$m2."-".$d2;
		$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        $Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
	}
    if( $Fecha_1 != NULL and $Fecha_1 != ' ' and $Fecha_2 != NULL and $Fecha_2 != ' ' ){
		$Rango_Fechas = " AND fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
		$Rango_Fechas_All = " fecha_llegada BETWEEN   CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) ";
	}
	else        
		$Rango_Fechas = " ";
				
         
	try{
		$db = new db();
		$conn = $db->conn_local();
  
 $query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida, 
										Id_productos, total_publico, total_neto, Id, Name  
                   FROM VISTA__OPERACION_COMPLETA WHERE  isDeleted = 0  $Rango_Fechas  ORDER BY hora_pickup_llegada ASC  ;";
				   
				   
				   
 /*$query2 = "SELECT Id_Volaris, Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, 
                 hora_pickup_llegada, paxxx, empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida,           
                 servicio_salida, no_vuelo_salida, hora_vuelo_salida, hora_pickup_salida, unidad_salida, operador_salida,        
                 fecha_captura, isDeleted, comentarios, Id_productos, total_publico, total_neto,
                 Id, Name 
           FROM VISTA__OPERACION_COMPLETA WHERE Id_Volaris = $Id_Volaris  ;";*/
			 
        
       // print $query;
        $stmt = $conn->prepare($query);
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                 $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                
				
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				$volaris->setName($row['Name']);
				
				array_push($lista, $volaris);

			}

            $query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND   $Rango_Fechas_All  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues
            
			}
			else
				$bandera = 1; 	//echo "algo que checar con el sum";
		}
		else
			$count= 0;
        
        
        
        
        

	} 
    catch (Exception $e)
    {
        print_r($e);
	}    

	include "views/Sales/Imprimir_Tripulacion_Ope_Com_Llegadas.php";	
}    

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
    
    
    
    
    
    
    
 
    
public function getAltavolaris(){
	session_start();


	if(isset($_SESSION["user"])){
		$db = new databaseController();
		$db->setTable(tables::Agent);
		$agents = $db->where(
			array(
				array(
					"field" => "isDeleted",
					"value" => 0,
					"optMat" => "=",
					"optLog" => "AND Id <> 7"
				)
			)
		);
		echo $db->error;


		



		include("views/Sales/altavolaris.php");
	}
	else
	{
		header( "Location: /panel/login");
	}
}

    
public function postAltavolaris(){
try
	{
        
$nombre_completo        = $_POST["nombre_completo"];
$no_reserva                     = $_POST["no_reserva"];
//$empresa                         = $_POST["empresa"];
$paxxx                              = $_POST["paxxx"];
$fecha_llegada = $_POST["fecha_llegada"]; if (empty($fecha_llegada)) { $fecha_llegada = 0 ;  } else { $fecha_llegada = $_POST['fecha_llegada'] ; } 
$servicio_llegada = $_POST["servicio_llegada"]; if (empty($servicio_llegada)) { $servicio_llegada = 0 ;  } else { $servicio_llegada = $_POST['servicio_llegada'] ; } 
$no_vuelo_llegada = $_POST["no_vuelo_llegada"]; if (empty($no_vuelo_llegada)) { $no_vuelo_llegada = 0 ;  } else { $no_vuelo_llegada = $_POST['no_vuelo_llegada'] ; } 
$hora_vuelo_llegada = $_POST["hora_vuelo_llegada"]; if (empty($hora_vuelo_llegada)) { $hora_vuelo_llegada = '00:00' ;  } else { $hora_vuelo_llegada = $_POST['hora_vuelo_llegada'] ; }     
$hora_pickup_llegada = $_POST["hora_pickup_llegada"]; if (empty($hora_pickup_llegada)) { $hora_pickup_llegada = '00:00' ;  } else { $hora_pickup_llegada = $_POST['hora_pickup_llegada'] ; }     
$uni_llegada                   = $_POST["uni_llegada"];
$operador_llegada        = $_POST["operador_llegada"];
$fecha_salida = $_POST["fecha_salida"]; if (empty($fecha_salida)) { $fecha_salida = 0 ;  } else { $fecha_salida = $_POST['fecha_salida'] ; } 
$servicio_salida = $_POST["servicio_salida"]; if (empty($servicio_salida)) { $servicio_salida = 0 ;  } else { $servicio_salida = $_POST['servicio_salida'] ; }     
$no_vuelo_salida = $_POST["no_vuelo_salida"]; if (empty($no_vuelo_salida)) { $no_vuelo_salida = 0 ;  } else { $no_vuelo_salida = $_POST['no_vuelo_salida'] ; } 
$hora_vuelo_salida = $_POST["hora_vuelo_salida"]; if (empty($hora_vuelo_salida)) { $hora_vuelo_salida = '00:00' ;  } else { $hora_vuelo_salida = $_POST['hora_vuelo_salida'] ; }     
$hora_pickup_salida = $_POST["hora_pickup_salida"]; if (empty($hora_pickup_salida)) { $hora_pickup_salida = '00:00' ;  } else { $hora_pickup_salida = $_POST['hora_pickup_salida'] ; }     
$uni_salida           = $_POST["uni_salida"];
$operador_salida           = $_POST["operador_salida"];
$comentarios = $_POST["comentarios"]; if (empty($comentarios)) { $comentarios = 's/c' ;  } else { $comentarios = $_POST['comentarios'] ; }
$Id_productos = $_POST["Id_productos"];
$total_publico = $_POST["total_publico"]; if (empty($total_publico)) { $total_publico = 0 ;  } else { $total_publico = $_POST['total_publico'] ; } 
$total_neto = $_POST["total_neto"]; if (empty($total_neto)) { $total_neto = 0 ;  } else { $total_neto = $_POST['total_neto'] ; } 

  //  print  $operador_llegada.'<------------$unidad_llegada '. $operador_salida.'<---$unidad_salida' ;  
    
        $d1 = substr($fecha_llegada,3,2);		$m1 = substr($fecha_llegada,0,2);  	$a1 = substr($fecha_llegada,6,4);
        $d2 = substr($fecha_salida,3,2);   $m2 = substr($fecha_salida,0,2);  $a2 = substr($fecha_salida,6,4);
        $fecha_llegada = $a1."-".$m1."-".$d1;    	   $fecha_salida = $a2."-".$m2."-".$d2;
		//$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        //$Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
    
    

          
$db = new db();
$conn = $db->conn_local();
$query2 =" INSERT INTO volaris (nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida, 
                                hora_pickup_salida, unidad_salida, operador_salida, fecha_captura, comentarios, Id_productos, total_publico, total_neto  )
	                     VALUES ('$nombre_completo', '$fecha_llegada', '$servicio_llegada', $no_vuelo_llegada, '$hora_vuelo_llegada', '$hora_pickup_llegada', $paxxx, '$empresa', $uni_llegada, '$operador_llegada', $no_reserva, '$fecha_salida', '$servicio_salida',
	                              $no_vuelo_salida, '$hora_vuelo_salida' , '$hora_pickup_salida', $uni_salida, '$operador_salida', NOW(), '$comentarios', $Id_productos, $total_publico, $total_neto   ) ;"; 
// print $query2;
$stmt2 = $conn->prepare($query2);
$stmt2->execute();

  header( "Location: /ventas/altavolaris");   

	}
            catch(Exception $e)
            {
                print_r($e);
            }

}


    

    
    
    
public function getEditavolaris(){
	session_start();
try {
  $Id_Volaris = $_GET['Id_Volaris'];      //  echo $Id_Volaris.'si';  echo date("d/m/Y H:i:s"); 
       
 $db = new db();
 $conn = $db->conn_local();
 /*$query2 =" SELECT  Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                    empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida, 
                    hora_pickup_salida, unidad_salida, operador_salida, fecha_captura, comentarios, Id_productos, total_publico, total_neto  
             FROM volaris  WHERE Id_Volaris = $Id_Volaris  ;";     //print $query2; */
			 
 $query2 = "SELECT Id_Volaris, Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, 
                 hora_pickup_llegada, paxxx, empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida,           
                 servicio_salida, no_vuelo_salida, hora_vuelo_salida, hora_pickup_salida, unidad_salida, operador_salida,        
                 fecha_captura, isDeleted, comentarios, Id_productos, total_publico, total_neto,
                 Id, Name 
           FROM VISTA__OPERACION_COMPLETA WHERE Id_Volaris = $Id_Volaris  ;";
			 
			 
			 
			 
			 
			 
			 
$stmt2 = $conn->prepare($query2);
$stmt2->execute();

    
 $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {
            	$volaris = new volaris_row(); /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
                $volaris->setfecha_llegada($row['fecha_llegada']);
                $volaris->setservicio_llegada($row['servicio_llegada']);
                $volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
                $volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setpaxxx($row['paxxx']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                $volaris->setfecha_salida($row['fecha_salida']);
                $volaris->setservicio_salida($row['servicio_salida']);
                $volaris->setno_vuelo_salida($row['no_vuelo_salida']);
                $volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
                $volaris->sethora_pickup_salida($row['hora_pickup_salida']);
                $volaris->setunidad_salida($row['unidad_salida']);
                $volaris->setoperador_salida($row['operador_salida']);
                $volaris->setcomentarios($row['comentarios']);
				$volaris->setId_productos($row['Id_productos']);
				$volaris->settotal_publico($row['total_publico']);
				$volaris->settotal_neto($row['total_neto']);
				$volaris->setId($row['Id']);
				$volaris->setName($row['Name']);
				
            array_push($lista, $volaris);
			}
    
    $Id_Volaris = $row['Id_Volaris'];
    $nombre_completo = $row['nombre_completo'];
    $fecha_llegada = $row['fecha_llegada'];
    $servicio_llegada = $row['servicio_llegada'];
    $no_vuelo_llegada = $row['no_vuelo_llegada'];
    $hora_vuelo_llegada = $row['hora_vuelo_llegada'];
    $hora_pickup_llegada = $row['hora_pickup_llegada'];
    $paxxx = $row['paxxx'];
    $empresa = $row['empresa'];
    $unidad_llegada = $row['unidad_llegada'];
    $operador_llegada = $row['operador_llegada'];
    $no_reserva = $row['no_reserva'];
    $fecha_salida = $row['fecha_salida'];
    $servicio_salida = $row['servicio_salida'];
    $no_vuelo_salida = $row['no_vuelo_salida'];
    $hora_vuelo_salida = $row['hora_vuelo_salida'];
    $hora_pickup_salida = $row['hora_pickup_salida'];
    $unidad_salida = $row['unidad_salida'];
    $operador_salida = $row['operador_salida'];
    $comentarios = $row['comentarios'];
	$Id_productos = $row['Id_productos'];
	$total_publico = $row['total_publico'];
	$total_neto = $row['total_neto'];
	$Id = $row['Id'];
	$Name = $row['Name'];
    
    
    
    
     //  header( "Location: /ventas/altavolaris");   

    include("views/Sales/editavolaris.php");
	}
        catch(Exception $e)   {
		        print_r($e);
             	}
	}

    
    
    
    
    
    
    
public function postEditavolaris(){
try
	{
        
$nombre_completo        = $_POST["nombre_completo"];
$no_reserva                     = $_POST["no_reserva"];
$empresa                         = $_POST["empresa"];
$paxxx                              = $_POST["paxxx"];
$fecha_llegada = $_POST["fecha_llegada"]; if (empty($fecha_llegada)) { $fecha_llegada = 0 ;  } else { $fecha_llegada = $_POST['fecha_llegada'] ; } 
$servicio_llegada = $_POST["servicio_llegada"]; if (empty($servicio_llegada)) { $servicio_llegada = 0 ;  } else { $servicio_llegada = $_POST['servicio_llegada'] ; } 
$no_vuelo_llegada = $_POST["no_vuelo_llegada"]; if (empty($no_vuelo_llegada)) { $no_vuelo_llegada = 0 ;  } else { $no_vuelo_llegada = $_POST['no_vuelo_llegada'] ; } 
$hora_vuelo_llegada = $_POST["hora_vuelo_llegada"]; if (empty($hora_vuelo_llegada)) { $hora_vuelo_llegada = '00:00' ;  } else { $hora_vuelo_llegada = $_POST['hora_vuelo_llegada'] ; }     
$hora_pickup_llegada = $_POST["hora_pickup_llegada"]; if (empty($hora_pickup_llegada)) { $hora_pickup_llegada = '00:00' ;  } else { $hora_pickup_llegada = $_POST['hora_pickup_llegada'] ; }     
$uni_llegada                   = $_POST["uni_llegada"];
$operador_llegada        = $_POST["operador_llegada"];
$fecha_salida = $_POST["fecha_salida"]; if (empty($fecha_salida)) { $fecha_salida = 0 ;  } else { $fecha_salida = $_POST['fecha_salida'] ; } 
$servicio_salida = $_POST["servicio_salida"]; if (empty($servicio_salida)) { $servicio_salida = 0 ;  } else { $servicio_salida = $_POST['servicio_salida'] ; }     
$no_vuelo_salida = $_POST["no_vuelo_salida"]; if (empty($no_vuelo_salida)) { $no_vuelo_salida = 0 ;  } else { $no_vuelo_salida = $_POST['no_vuelo_salida'] ; } 
$hora_vuelo_salida = $_POST["hora_vuelo_salida"]; if (empty($hora_vuelo_salida)) { $hora_vuelo_salida = '00:00' ;  } else { $hora_vuelo_salida = $_POST['hora_vuelo_salida'] ; }     
$hora_pickup_salida = $_POST["hora_pickup_salida"]; if (empty($hora_pickup_salida)) { $hora_pickup_salida = '00:00' ;  } else { $hora_pickup_salida = $_POST['hora_pickup_salida'] ; }     
$uni_salida           = $_POST["uni_salida"];
$operador_salida           = $_POST["operador_salida"];
$comentarios = $_POST["comentarios"]; if (empty($comentarios)) { $comentarios = 's/c' ;  } else { $comentarios = $_POST['comentarios'] ; }     



  //  print  $operador_llegada.'<------------$unidad_llegada '. $operador_salida.'<---$unidad_salida' ;  
    
        $d1 = substr($fecha_llegada,3,2);		$m1 = substr($fecha_llegada,0,2);  	$a1 = substr($fecha_llegada,6,4);
        $d2 = substr($fecha_salida,3,2);   $m2 = substr($fecha_salida,0,2);  $a2 = substr($fecha_salida,6,4);
        $fecha_llegada = $a1."-".$m1."-".$d1;    	   $fecha_salida = $a2."-".$m2."-".$d2;
		//$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        //$Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
    
    

          
$db = new db();
$conn = $db->conn_local();
$query2 =" INSERT INTO volaris (nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                                           empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida, 
                                                           hora_pickup_salida, unidad_salida, operador_salida, fecha_captura)
	                                     VALUES ('$nombre_completo', '$fecha_llegada', '$servicio_llegada', $no_vuelo_llegada, '$hora_vuelo_llegada', '$hora_pickup_llegada', $paxxx, '$empresa', $uni_llegada, '$operador_llegada', $no_reserva, '$fecha_salida', '$servicio_salida',
	                                                       $no_vuelo_salida, '$hora_vuelo_salida' , '$hora_pickup_salida', $uni_salida, '$operador_salida', NOW()   ) ;"; 
// print $query2;
$stmt2 = $conn->prepare($query2);
$stmt2->execute();

     //     echo 'registro grabado correctamente' ;
          
          
 
        
 //header("location: http://oktrip:8080/ventas/altavolaris"); 
   header( "Location: /ventas/altavolaris");   

// include("views/Sales/altavolaris.php");   
 //	include("views/Sales/altavolaris.php");
// return true ;		


	}
	catch(Exception $e)
	{
		print_r($e);
	}

}

    
    
 
    
    
    public function postCambiovolaris(){
try
	{
$Id_Volaris      = $_POST["Id_Volaris"];
$nombre_completo        = $_POST["nombre_completo"];
$no_reserva                     = $_POST["no_reserva"];
$empresa                         = $_POST["empresa"];
$paxxx                              = $_POST["paxxx"];
$fecha_llegada = $_POST["fecha_llegada"]; if (empty($fecha_llegada)) { $fecha_llegada = 0 ;  } else { $fecha_llegada = $_POST['fecha_llegada'] ; } 
$servicio_llegada = $_POST["servicio_llegada"]; if (empty($servicio_llegada)) { $servicio_llegada = 0 ;  } else { $servicio_llegada = $_POST['servicio_llegada'] ; } 
$no_vuelo_llegada = $_POST["no_vuelo_llegada"]; if (empty($no_vuelo_llegada)) { $no_vuelo_llegada = 0 ;  } else { $no_vuelo_llegada = $_POST['no_vuelo_llegada'] ; } 
$hora_vuelo_llegada = $_POST["hora_vuelo_llegada"]; if (empty($hora_vuelo_llegada)) { $hora_vuelo_llegada = '00:00' ;  } else { $hora_vuelo_llegada = $_POST['hora_vuelo_llegada'] ; }     
$hora_pickup_llegada = $_POST["hora_pickup_llegada"]; if (empty($hora_pickup_llegada)) { $hora_pickup_llegada = '00:00' ;  } else { $hora_pickup_llegada = $_POST['hora_pickup_llegada'] ; }     
$uni_llegada                   = $_POST["uni_llegada"];
$operador_llegada        = $_POST["operador_llegada"];
$fecha_salida = $_POST["fecha_salida"]; if (empty($fecha_salida)) { $fecha_salida = 0 ;  } else { $fecha_salida = $_POST['fecha_salida'] ; } 
$servicio_salida = $_POST["servicio_salida"]; if (empty($servicio_salida)) { $servicio_salida = 0 ;  } else { $servicio_salida = $_POST['servicio_salida'] ; }     
$no_vuelo_salida = $_POST["no_vuelo_salida"]; if (empty($no_vuelo_salida)) { $no_vuelo_salida = 0 ;  } else { $no_vuelo_salida = $_POST['no_vuelo_salida'] ; } 
$hora_vuelo_salida = $_POST["hora_vuelo_salida"]; if (empty($hora_vuelo_salida)) { $hora_vuelo_salida = '00:00' ;  } else { $hora_vuelo_salida = $_POST['hora_vuelo_salida'] ; }     
$hora_pickup_salida = $_POST["hora_pickup_salida"]; if (empty($hora_pickup_salida)) { $hora_pickup_salida = '00:00' ;  } else { $hora_pickup_salida = $_POST['hora_pickup_salida'] ; }     
$uni_salida           = $_POST["uni_salida"];
$operador_salida           = $_POST["operador_salida"];
$comentarios = $_POST["comentarios"]; if (empty($comentarios)) { $comentarios = 's/c' ;  } else { $comentarios = $_POST['comentarios'] ; }     
$Id_productos = $_POST["Id_productos"];
$total_publico = $_POST["total_publico"]; if (empty($total_publico)) { $total_publico = 0 ;  } else { $total_publico = $_POST['total_publico'] ; } 
$total_neto = $_POST["total_neto"]; if (empty($total_neto)) { $total_neto = 0 ;  } else { $total_neto = $_POST['total_neto'] ; } 


  //  print  $operador_llegada.'<------------$unidad_llegada '. $operador_salida.'<---$unidad_salida' ;  
    
        $d1 = substr($fecha_llegada,3,2);		$m1 = substr($fecha_llegada,0,2);  	$a1 = substr($fecha_llegada,6,4);
        $d2 = substr($fecha_salida,3,2);   $m2 = substr($fecha_salida,0,2);  $a2 = substr($fecha_salida,6,4);
        $fecha_llegada = $a1."-".$m1."-".$d1;    	   $fecha_salida = $a2."-".$m2."-".$d2;
		
    
    

          
$db = new db();
$conn = $db->conn_local();

$query2 = " UPDATE volaris SET nombre_completo = '$nombre_completo', fecha_llegada = '$fecha_llegada', servicio_llegada = '$servicio_llegada', 
                    no_vuelo_llegada = $no_vuelo_llegada, hora_vuelo_llegada = '$hora_vuelo_llegada', hora_pickup_llegada = '$hora_pickup_llegada',
					paxxx = '$paxxx', empresa = '$empresa', unidad_llegada = '$uni_llegada', operador_llegada = '$operador_llegada', 
	                no_reserva = '$no_reserva', fecha_salida = '$fecha_salida', servicio_salida = '$servicio_salida', no_vuelo_salida = '$no_vuelo_salida',
					hora_vuelo_salida = '$hora_vuelo_salida', hora_pickup_salida = '$hora_pickup_salida', unidad_salida = '$uni_salida',
				    operador_salida = '$operador_salida', fecha_captura = '$fecha_captura', comentarios='$comentarios',   
					Id_productos = '$Id_productos', total_publico = '$total_publico', total_neto = '$total_neto'  
					WHERE Id_Volaris = $Id_Volaris ; ";
    
// print $query2;
$stmt2 = $conn->prepare($query2);
$stmt2->execute();

  header( "Location: /ventas/gridvolaris");   

	}
            catch(Exception $e)
            {
                print_r($e);
            }

}

 
    
    
    
    public function getBorrarvolaris(){
   
	session_start();
try {
  $Id_Volaris = $_GET['Id_Volaris'];      //  echo $Id_Volaris.'si';  echo date("d/m/Y H:i:s"); 
       
 $db = new db();
 $conn = $db->conn_local();
 									
$query2 = "SELECT Id_Volaris, Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, 
                 hora_pickup_llegada, paxxx, empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida,           
                 servicio_salida, no_vuelo_salida, hora_vuelo_salida, hora_pickup_salida, unidad_salida, operador_salida,        
                 fecha_captura, isDeleted, comentarios, Id_productos, total_publico, total_neto,
                 Id, Name 
           FROM VISTA__OPERACION_COMPLETA WHERE Id_Volaris = $Id_Volaris  ;";
		   
 $stmt2 = $conn->prepare($query2);
$stmt2->execute();

    
 $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {
            	$volaris = new volaris_row(); /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
                $volaris->setfecha_llegada($row['fecha_llegada']);
                $volaris->setservicio_llegada($row['servicio_llegada']);
                $volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
                $volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
                $volaris->sethora_pickup_llegada($row['hora_pickup_llegada']);
                $volaris->setpaxxx($row['paxxx']);
                $volaris->setempresa($row['empresa']);
                $volaris->setunidad_llegada($row['unidad_llegada']);
                $volaris->setoperador_llegada($row['operador_llegada']);
                $volaris->setno_reserva($row['no_reserva']);
                $volaris->setfecha_salida($row['fecha_salida']);
                $volaris->setservicio_salida($row['servicio_salida']);
                $volaris->setno_vuelo_salida($row['no_vuelo_salida']);
                $volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
                $volaris->sethora_pickup_salida($row['hora_pickup_salida']);
                $volaris->setunidad_salida($row['unidad_salida']);
                $volaris->setoperador_salida($row['operador_salida']);
                $volaris->setcomentarios($row['comentarios']);
				$volaris->setId_productos($row['Id_productos']);
				$volaris->settotal_publico($row['total_publico']);
				$volaris->settotal_neto($row['total_neto']);
				$volaris->setId($row['Id']);
				$volaris->setName($row['Name']);
            array_push($lista, $volaris);
			}
    
    $Id_Volaris = $row['Id_Volaris'];
    $nombre_completo = $row['nombre_completo'];
    $fecha_llegada = $row['fecha_llegada'];
    $servicio_llegada = $row['servicio_llegada'];
    $no_vuelo_llegada = $row['no_vuelo_llegada'];
    $hora_vuelo_llegada = $row['hora_vuelo_llegada'];
    $hora_pickup_llegada = $row['hora_pickup_llegada'];
    $paxxx = $row['paxxx'];
    $empresa = $row['empresa'];
    $unidad_llegada = $row['unidad_llegada'];
    $operador_llegada = $row['operador_llegada'];
    $no_reserva = $row['no_reserva'];
    $fecha_salida = $row['fecha_salida'];
    $servicio_salida = $row['servicio_salida'];
    $no_vuelo_salida = $row['no_vuelo_salida'];
    $hora_vuelo_salida = $row['hora_vuelo_salida'];
    $hora_pickup_salida = $row['hora_pickup_salida'];
    $unidad_salida = $row['unidad_salida'];
    $operador_salida = $row['operador_salida'];
    $comentarios = $row['comentarios'];
	$Id_productos = $row['Id_productos'];
	$total_publico = $row['total_publico'];
	$total_neto = $row['total_neto'];
	$Id = $row['Id'];
	$Name = $row['Name'];
    
    
    
    
     //  header( "Location: /ventas/altavolaris");   

    include("views/Sales/bajavolaris.php");
	}
        catch(Exception $e)   {
		        print_r($e);
             	}
	}

    
    
    
  
    
    
    
public function postBorrarvolaris(){
try
	{
$Id_Volaris      = $_POST["Id_Volaris"];

    
        
    

          
$db = new db();
$conn = $db->conn_local();
   
    
    
$query2 = "  UPDATE volaris SET isDeleted = 1  WHERE Id_Volaris = $Id_Volaris ;    ";
    
// print $query2;
$stmt2 = $conn->prepare($query2);
$stmt2->execute();

  header( "Location: /ventas/gridvolaris");   

	}
            catch(Exception $e)
            {
                print_r($e);
            }

}

    
    
    
    
    
   
    public function getEcharts(){
	session_start();
    try {
        
$Ene_1 = '2019-01-01';  $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01'; $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01';  $Mar_2 = '2019-03-31';  $Abr_1 = '2019-04-01'; $Abr_2 = '2019-04-30';
$May_1 = '2019-05-01'; $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01'; $Jun_2 = '2019-06-30'; $Jul_1 = '2019-07-01'; $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01';  $Ago_2 = '2019-08-31';
$Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30';  $Oct_1 = '2019-10-01'; $Oct_2 = '2019-10-31'; $Nov_1 = '2019-11-01'; $Nov_2 = '2019-11-30'; $Dic_1 = '2019-12-01';   $Dic_2 = '2019-12-31';
	 	
			$db = new db();
			$conn = $db->conn_local();
	/*		$query1a ="SELECT SUM(Total) 'Tot_Pub_Ene',  SUM(Subtotal) 'Tot_Net_Ene' ,  SUM(NoPeople) 'Tot_Pax_Ene'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0,1) 
                                AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE) ORDER BY Id DESC ;"; 
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Tot_Pub_Ene = $row['Tot_Pub_Ene'];
			$Tot_Net_Ene = $row['Tot_Net_Ene'];
            $Tot_Pax_Ene = $row['Tot_Pax_Ene'];  Enero no se calculo, fueron datos fijos*/
        
         $query2b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Feb',  ROUND(SUM(Subtotal)) 'Web_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2b = $conn->prepare($query2b);
			$stmt2b->execute();
        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row['Web_Pub_Feb'];
			$Web_Net_Feb = $row['Web_Net_Feb'];
            $Web_Pax_Feb = $row['Web_Pax_Feb'];
        
            $query2a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Feb',  ROUND(SUM(Subtotal)) 'Off_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2a = $conn->prepare($query2a);
			$stmt2a->execute();
        	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row['Off_Pub_Feb'];
			$Off_Net_Feb = $row['Off_Net_Feb'];
            $Off_Pax_Feb = $row['Off_Pax_Feb'];
        
$Tot_Pub_Feb = $Web_Pub_Feb + $Off_Pub_Feb;
$Tot_Net_Feb = $Web_Net_Feb + $Off_Net_Feb;
$Tot_Pax_Feb = $Web_Pax_Feb + $Off_Pax_Feb ; 
        
        
        
        
        $query3b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Mar',  ROUND(SUM(Subtotal)) 'Web_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3b = $conn->prepare($query3b);
			$stmt3b->execute();
        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row['Web_Pub_Mar'];
			$Web_Net_Mar = $row['Web_Net_Mar'];
            $Web_Pax_Mar = $row['Web_Pax_Mar'];
        
        
        $query3a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Mar',  ROUND(SUM(Subtotal)) 'Off_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3a = $conn->prepare($query3a);
			$stmt3a->execute();
        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row['Off_Pub_Mar'];
			$Off_Net_Mar = $row['Off_Net_Mar'];
            $Off_Pax_Mar = $row['Off_Pax_Mar'];
        
$Tot_Pub_Mar = $Web_Pub_Mar + $Off_Pub_Mar;
$Tot_Net_Mar = $Web_Net_Mar + $Off_Net_Mar;
$Tot_Pax_Mar = $Web_Pax_Mar + $Off_Pax_Mar ;
        
        
        
        
        
        
        
        
        $query4b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Abr',  ROUND(SUM(Subtotal)) 'Web_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4b = $conn->prepare($query4b);
			$stmt4b->execute();
        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row['Web_Pub_Abr'];
			$Web_Net_Abr = $row['Web_Net_Abr'];
            $Web_Pax_Abr = $row['Web_Pax_Abr'];
        
        
        
        $query4a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Abr',  ROUND(SUM(Subtotal)) 'Off_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4a = $conn->prepare($query4a);
			$stmt4a->execute();
        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row['Off_Pub_Abr'];
			$Off_Net_Abr = $row['Off_Net_Abr'];
            $Off_Pax_Abr = $row['Off_Pax_Abr'];
        
        
$Tot_Pub_Abr = $Web_Pub_Abr + $Off_Pub_Abr;
$Tot_Net_Abr = $Web_Net_Abr + $Off_Net_Abr;
$Tot_Pax_Abr = $Web_Pax_Abr + $Off_Pax_Abr ;
        
        
        
        
       
        
         $query5b ="SELECT ROUND(SUM(Total)) 'Web_Pub_May',  ROUND(SUM(Subtotal)) 'Web_Net_May' ,  ROUND(SUM(NoPeople)) 'Web_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);
			$stmt5b->execute();
        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row['Web_Pub_May'];
			$Web_Net_May = $row['Web_Net_May'];
            $Web_Pax_May = $row['Web_Pax_May'];
        
        
        $query5a ="SELECT ROUND(SUM(Total)) 'Off_Pub_May',  ROUND(SUM(Subtotal)) 'Off_Net_May' ,  ROUND(SUM(NoPeople)) 'Off_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);
			$stmt5a->execute();
        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row['Off_Pub_May'];
			$Off_Net_May = $row['Off_Net_May'];
            $Off_Pax_May = $row['Off_Pax_May'];
        
        
$Tot_Pub_May = $Web_Pub_May + $Off_Pub_May;
$Tot_Net_May = $Web_Net_May + $Off_Net_May;
$Tot_Pax_May = $Web_Pax_May + $Off_Pax_May ;
			
		    
        
        $query6b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jun',  ROUND(SUM(Subtotal)) 'Web_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row['Web_Pub_Jun'];
			$Web_Net_Jun = $row['Web_Net_Jun'];
            $Web_Pax_Jun = $row['Web_Pax_Jun'];
        
        $query6a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jun',  ROUND(SUM(Subtotal)) 'Off_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row['Off_Pub_Jun'];
			$Off_Net_Jun = $row['Off_Net_Jun'];
            $Off_Pax_Jun = $row['Off_Pax_Jun'];
        
$Tot_Pub_Jun = $Web_Pub_Jun + $Off_Pub_Jun;
$Tot_Net_Jun = $Web_Net_Jun + $Off_Net_Jun;
$Tot_Pax_Jun = $Web_Pax_Jun + $Off_Pax_Jun ;
        
        
        
        
        $query7b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jul',  ROUND(SUM(Subtotal)) 'Web_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7b = $conn->prepare($query7b);
			$stmt7b->execute();
        	$row = $stmt7b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row['Web_Pub_Jul'];
			$Web_Net_Jul = $row['Web_Net_Jul'];
            $Web_Pax_Jul = $row['Web_Pax_Jul'];
        
        $query7a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jul',  ROUND(SUM(Subtotal)) 'Off_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7a = $conn->prepare($query7a);
			$stmt7a->execute();
        	$row = $stmt7a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row['Off_Pub_Jul'];
			$Off_Net_Jul = $row['Off_Net_Jul'];
            $Off_Pax_Jul = $row['Off_Pax_Jul'];
        
$Tot_Pub_Jul = $Web_Pub_Jul + $Off_Pub_Jul;
$Tot_Net_Jul = $Web_Net_Jul + $Off_Net_Jul;
$Tot_Pax_Jul = $Web_Pax_Jul + $Off_Pax_Jul ;
        
        
        
        
        $query8b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Ago',  ROUND(SUM(Subtotal)) 'Web_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);
			$stmt8b->execute();
        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row['Web_Pub_Ago'];
			$Web_Net_Ago = $row['Web_Net_Ago'];
            $Web_Pax_Ago = $row['Web_Pax_Ago'];
        
         $query8a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Ago',  ROUND(SUM(Subtotal)) 'Off_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);
			$stmt8a->execute();
        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row['Off_Pub_Ago'];
			$Off_Net_Ago = $row['Off_Net_Ago'];
            $Off_Pax_Ago = $row['Off_Pax_Ago'];
        
$Tot_Pub_Ago = $Web_Pub_Ago + $Off_Pub_Ago;
$Tot_Net_Ago = $Web_Net_Ago + $Off_Net_Ago;
$Tot_Pax_Ago = $Web_Pax_Ago + $Off_Pax_Ago ;
        
        
        
        
        $query9b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Sep',  ROUND(SUM(Subtotal)) 'Web_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);
			$stmt9b->execute();
        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row['Web_Pub_Sep'];
			$Web_Net_Sep = $row['Web_Net_Sep'];
            $Web_Pax_Sep = $row['Web_Pax_Sep'];
        
        $query9a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Sep',  ROUND(SUM(Subtotal)) 'Off_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);
			$stmt9a->execute();
        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row['Off_Pub_Sep'];
			$Off_Net_Sep = $row['Off_Net_Sep'];
            $Off_Pax_Sep = $row['Off_Pax_Sep'];
        
$Tot_Pub_Sep = $Web_Pub_Sep + $Off_Pub_Sep;
$Tot_Net_Sep = $Web_Net_Sep + $Off_Net_Sep;
$Tot_Pax_Sep = $Web_Pax_Sep + $Off_Pax_Sep ;
        
        
        $query10b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Oct',  ROUND(SUM(Subtotal)) 'Web_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);
			$stmt10b->execute();
        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row['Web_Pub_Oct'];
			$Web_Net_Oct = $row['Web_Net_Oct'];
            $Web_Pax_Oct = $row['Web_Pax_Oct'];
        
        $query10a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Oct',  ROUND(SUM(Subtotal)) 'Off_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);
			$stmt10a->execute();
        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row['Off_Pub_Oct'];
			$Off_Net_Oct = $row['Off_Net_Oct'];
            $Off_Pax_Oct = $row['Off_Pax_Oct'];
        
$Tot_Pub_Oct = $Web_Pub_Oct + $Off_Pub_Oct;
$Tot_Net_Oct = $Web_Net_Oct + $Off_Net_Oct;
$Tot_Pax_Oct = $Web_Pax_Oct + $Off_Pax_Oct ;
        
        
        
        
         $query11b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Nov',  ROUND(SUM(Subtotal)) 'Web_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);
			$stmt11b->execute();
        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row['Web_Pub_Nov'];
			$Web_Net_Nov = $row['Web_Net_Nov'];
            $Web_Pax_Nov = $row['Web_Pax_Nov'];
        
        $query11a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Nov',  ROUND(SUM(Subtotal)) 'Off_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);
			$stmt11a->execute();
        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row['Off_Pub_Nov'];
			$Off_Net_Nov = $row['Off_Net_Nov'];
            $Off_Pax_Nov = $row['Off_Pax_Nov'];
        
$Tot_Pub_Nov = $Web_Pub_Nov + $Off_Pub_Nov;
$Tot_Net_Nov = $Web_Net_Nov + $Off_Net_Nov;
$Tot_Pax_Nov = $Web_Pax_Nov + $Off_Pax_Nov ;
        
        
        $query12b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Dic',  ROUND(SUM(Subtotal)) 'Web_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);
			$stmt12b->execute();
        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row['Web_Pub_Dic'];
			$Web_Net_Dic = $row['Web_Net_Dic'];
            $Web_Pax_Dic = $row['Web_Pax_Dic'];
        
        $query12a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Dic',  ROUND(SUM(Subtotal)) 'Off_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);
			$stmt12a->execute();
        	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row['Off_Pub_Dic'];
			$Off_Net_Dic = $row['Off_Net_Dic'];
            $Off_Pax_Dic = $row['Off_Pax_Dic'];
        
$Tot_Pub_Dic = $Web_Pub_Dic + $Off_Pub_Dic;
$Tot_Net_Dic = $Web_Net_Dic + $Off_Net_Dic;
$Tot_Pax_Dic = $Web_Pax_Dic + $Off_Pax_Dic ; 
			
        
        
        
        
        
        
        
		include("views/Sales/◣_◢-Echarts_weboff_public.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }


	
}

    
    
    

    
     public function getEchartsoff(){
	session_start();
    try {
        
$Ene_1 = '2019-01-01';  $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01'; $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01';  $Mar_2 = '2019-03-31';  $Abr_1 = '2019-04-01'; $Abr_2 = '2019-04-30';
$May_1 = '2019-05-01'; $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01'; $Jun_2 = '2019-06-30'; $Jul_1 = '2019-07-01'; $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01';  $Ago_2 = '2019-08-31';
$Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30';  $Oct_1 = '2019-10-01'; $Oct_2 = '2019-10-31'; $Nov_1 = '2019-11-01'; $Nov_2 = '2019-11-30'; $Dic_1 = '2019-12-01';   $Dic_2 = '2019-12-31';
	 	
			$db = new db();
			$conn = $db->conn_local();
	
        
        
        
            $query2a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Feb',  ROUND(SUM(Subtotal)) 'Off_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2a = $conn->prepare($query2a); 			$stmt2a->execute();         	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row['Off_Pub_Feb'];			$Off_Net_Feb = $row['Off_Net_Feb'];            $Off_Pax_Feb = $row['Off_Pax_Feb'];
        

        
            $query3a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Mar',  ROUND(SUM(Subtotal)) 'Off_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3a = $conn->prepare($query3a); 			$stmt3a->execute();        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row['Off_Pub_Mar'];			$Off_Net_Mar = $row['Off_Net_Mar'];            $Off_Pax_Mar = $row['Off_Pax_Mar'];
 
            $query4a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Abr',  ROUND(SUM(Subtotal)) 'Off_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4a = $conn->prepare($query4a);			$stmt4a->execute();        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row['Off_Pub_Abr'];			$Off_Net_Abr = $row['Off_Net_Abr'];            $Off_Pax_Abr = $row['Off_Pax_Abr'];
        
        $query5a ="SELECT ROUND(SUM(Total)) 'Off_Pub_May',  ROUND(SUM(Subtotal)) 'Off_Net_May' ,  ROUND(SUM(NoPeople)) 'Off_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);			$stmt5a->execute();        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row['Off_Pub_May'];			$Off_Net_May = $row['Off_Net_May'];            $Off_Pax_May = $row['Off_Pax_May'];
           
        
        $query6a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jun',  ROUND(SUM(Subtotal)) 'Off_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6a = $conn->prepare($query6a);			$stmt6a->execute();        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row['Off_Pub_Jun'];			$Off_Net_Jun = $row['Off_Net_Jun'];            $Off_Pax_Jun = $row['Off_Pax_Jun'];
        

        $query7a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jul',  ROUND(SUM(Subtotal)) 'Off_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7a = $conn->prepare($query7a);			$stmt7a->execute();        	$row = $stmt7a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row['Off_Pub_Jul'];			$Off_Net_Jul = $row['Off_Net_Jul'];            $Off_Pax_Jul = $row['Off_Pax_Jul'];
        
         $query8a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Ago',  ROUND(SUM(Subtotal)) 'Off_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);			$stmt8a->execute();        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row['Off_Pub_Ago'];			$Off_Net_Ago = $row['Off_Net_Ago'];            $Off_Pax_Ago = $row['Off_Pax_Ago'];
        
        $query9a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Sep',  ROUND(SUM(Subtotal)) 'Off_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);			$stmt9a->execute();        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row['Off_Pub_Sep'];			$Off_Net_Sep = $row['Off_Net_Sep'];            $Off_Pax_Sep = $row['Off_Pax_Sep'];
                
        $query10a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Oct',  ROUND(SUM(Subtotal)) 'Off_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);			$stmt10a->execute();        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row['Off_Pub_Oct'];			$Off_Net_Oct = $row['Off_Net_Oct'];            $Off_Pax_Oct = $row['Off_Pax_Oct'];
        
        $query11a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Nov',  ROUND(SUM(Subtotal)) 'Off_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);			$stmt11a->execute();        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row['Off_Pub_Nov'];			$Off_Net_Nov = $row['Off_Net_Nov'];            $Off_Pax_Nov = $row['Off_Pax_Nov'];
        

        $query12a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Dic',  ROUND(SUM(Subtotal)) 'Off_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);			$stmt12a->execute();         	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row['Off_Pub_Dic'];			$Off_Net_Dic = $row['Off_Net_Dic'];            $Off_Pax_Dic = $row['Off_Pax_Dic'];
                
		include("views/Sales/◣_◢-EchartsOff.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }

}


    
    
    
    
     public function getEchartsweb(){
	session_start();
    try {
        
$Ene_1 = '2019-01-01';  $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01'; $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01';  $Mar_2 = '2019-03-31';  $Abr_1 = '2019-04-01'; $Abr_2 = '2019-04-30';
$May_1 = '2019-05-01'; $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01'; $Jun_2 = '2019-06-30'; $Jul_1 = '2019-07-01'; $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01';  $Ago_2 = '2019-08-31';
$Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30';  $Oct_1 = '2019-10-01'; $Oct_2 = '2019-10-31'; $Nov_1 = '2019-11-01'; $Nov_2 = '2019-11-30'; $Dic_1 = '2019-12-01';   $Dic_2 = '2019-12-31';
	 	
			$db = new db();
			$conn = $db->conn_local();
	
        
         $query2b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Feb',  ROUND(SUM(Subtotal)) 'Web_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2b = $conn->prepare($query2b);			$stmt2b->execute();        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row['Web_Pub_Feb'];			$Web_Net_Feb = $row['Web_Net_Feb'];            $Web_Pax_Feb = $row['Web_Pax_Feb'];
        
            
        
        
        
        
        $query3b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Mar',  ROUND(SUM(Subtotal)) 'Web_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3b = $conn->prepare($query3b);			$stmt3b->execute();        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row['Web_Pub_Mar'];			$Web_Net_Mar = $row['Web_Net_Mar'];            $Web_Pax_Mar = $row['Web_Pax_Mar'];
        
        
                
        $query4b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Abr', ROUND(SUM(Subtotal)) 'Web_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4b = $conn->prepare($query4b);			$stmt4b->execute();        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row['Web_Pub_Abr'];			$Web_Net_Abr = $row['Web_Net_Abr'];            $Web_Pax_Abr = $row['Web_Pax_Abr'];
            
       
        
         $query5b ="SELECT ROUND(SUM(Total)) 'Web_Pub_May',  ROUND(SUM(Subtotal)) 'Web_Net_May' ,  ROUND(SUM(NoPeople)) 'Web_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);			$stmt5b->execute();        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row['Web_Pub_May'];			$Web_Net_May = $row['Web_Net_May'];            $Web_Pax_May = $row['Web_Pax_May'];
        
        
        
			
		    
        
        $query6b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jun',  ROUND(SUM(Subtotal)) 'Web_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6b = $conn->prepare($query6b);			$stmt6b->execute();        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row['Web_Pub_Jun'];			$Web_Net_Jun = $row['Web_Net_Jun'];            $Web_Pax_Jun = $row['Web_Pax_Jun'];
        
       
        
        
        
        $query7b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jul',  ROUND(SUM(Subtotal)) 'Web_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7b = $conn->prepare($query7b);			$stmt7b->execute();        	$row = $stmt7b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row['Web_Pub_Jul'];			$Web_Net_Jul = $row['Web_Net_Jul'];            $Web_Pax_Jul = $row['Web_Pax_Jul'];
        
        
        
        $query8b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Ago',  ROUND(SUM(Subtotal)) 'Web_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);			$stmt8b->execute();        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row['Web_Pub_Ago'];			$Web_Net_Ago = $row['Web_Net_Ago'];            $Web_Pax_Ago = $row['Web_Pax_Ago'];
            
        
        
        
        $query9b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Sep',  ROUND(SUM(Subtotal)) 'Web_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);			$stmt9b->execute();        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row['Web_Pub_Sep'];			$Web_Net_Sep = $row['Web_Net_Sep'];            $Web_Pax_Sep = $row['Web_Pax_Sep'];
        
        
        
        
        $query10b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Oct',  ROUND(SUM(Subtotal)) 'Web_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);			$stmt10b->execute();        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row['Web_Pub_Oct'];			$Web_Net_Oct = $row['Web_Net_Oct'];            $Web_Pax_Oct = $row['Web_Pax_Oct'];
        
        
        
        
         $query11b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Nov',  ROUND(SUM(Subtotal)) 'Web_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);			$stmt11b->execute();        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row['Web_Pub_Nov'];			$Web_Net_Nov = $row['Web_Net_Nov'];            $Web_Pax_Nov = $row['Web_Pax_Nov'];
        
       
        
        
        $query12b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Dic',  ROUND(SUM(Subtotal)) 'Web_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);			$stmt12b->execute();        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row['Web_Pub_Dic'];			$Web_Net_Dic = $row['Web_Net_Dic'];            $Web_Pax_Dic = $row['Web_Pax_Dic'];
            
        
        
		include("views/Sales/◣_◢-EchartsWeb.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }


	
}

    



    
public function getEchartspax(){
	session_start();
    try {
        
$Ene_1 = '2019-01-01';  $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01'; $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01';  $Mar_2 = '2019-03-31';  $Abr_1 = '2019-04-01'; $Abr_2 = '2019-04-30';
$May_1 = '2019-05-01'; $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01'; $Jun_2 = '2019-06-30'; $Jul_1 = '2019-07-01'; $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01';  $Ago_2 = '2019-08-31';
$Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30';  $Oct_1 = '2019-10-01'; $Oct_2 = '2019-10-31'; $Nov_1 = '2019-11-01'; $Nov_2 = '2019-11-30'; $Dic_1 = '2019-12-01';   $Dic_2 = '2019-12-31';
	 	
			$db = new db();
			$conn = $db->conn_local();
	    
           $query2b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) AND  Id_Status = 3  AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2b = $conn->prepare($query2b);
			$stmt2b->execute();
        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Feb = $row['Web_Pax_Feb'];
        
        
            $query2c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Feb' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ; "; 
       		$stmt2c = $conn->prepare($query2c);
			$stmt2c->execute();
        	$row = $stmt2c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Feb = $row['V_Paxxx_Feb']; if (empty($V_Paxxx_Feb)) {$V_Paxxx_Feb = 0; }
            
          
        
            $query2a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2a = $conn->prepare($query2a);
			$stmt2a->execute();
        	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Feb = $row['Off_Pax_Feb'] + $V_Paxxx_Feb;
        
$Tot_Pax_Feb = $Web_Pax_Feb + $Off_Pax_Feb ; 
$TotPaxFebOff_V = $Off_Pax_Feb + $V_Paxxx_Feb ;
        
        
        
        
        $query3b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3b = $conn->prepare($query3b);
			$stmt3b->execute();
        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Mar = $row['Web_Pax_Mar'];
        
        
            $query3c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Mar' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ; "; 
       		$stmt3c = $conn->prepare($query3c);
			$stmt3c->execute();
        	$row = $stmt3c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Mar = $row['V_Paxxx_Mar']; if (empty($V_Paxxx_Mar)) {$V_Paxxx_Mar = 0; }
            
        
        
        $query3a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3a = $conn->prepare($query3a);
			$stmt3a->execute();
        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Mar = $row['Off_Pax_Mar'] + $V_Paxxx_Mar ;
        
$Tot_Pax_Mar = $Web_Pax_Mar + $Off_Pax_Mar ;
$TotPaxMarOff_V = $Off_Pax_Mar + $V_Paxxx_Mar ;
        
        
        
        
        
        
        
        
        $query4b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4b = $conn->prepare($query4b);
			$stmt4b->execute();
        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Abr = $row['Web_Pax_Abr'];
        
        
        
            $query4c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Abr' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ; "; 
       		$stmt4c = $conn->prepare($query4c);
			$stmt4c->execute();
        	$row = $stmt4c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Abr = $row['V_Paxxx_Abr']; if (empty($V_Paxxx_Abr)) {$V_Paxxx_Abr = 0; }
        
        
        
        $query4a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4a = $conn->prepare($query4a);
			$stmt4a->execute();
        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Abr = $row['Off_Pax_Abr'] + $V_Paxxx_Abr ;
        
        
$Tot_Pax_Abr = $Web_Pax_Abr + $Off_Pax_Abr ;
$TotPaxAbrOff_V = $Off_Pax_Abr + $V_Paxxx_Abr ;
        
        
        
        
       
        
         $query5b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);
			$stmt5b->execute();
        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_May = $row['Web_Pax_May'];
        
        $query5c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_May' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE) ; "; 
       		$stmt5c = $conn->prepare($query5c);
			$stmt5c->execute();
        	$row = $stmt5c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_May = $row['V_Paxxx_May']; if (empty($V_Paxxx_May)) {$V_Paxxx_May = 0; }
        
        
        
        $query5a ="SELECT  ROUND(SUM(NoPeople)) 'Off_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);
			$stmt5a->execute();
        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_May = $row['Off_Pax_May'];
        
        
$Tot_Pax_May = $Web_Pax_May + $Off_Pax_May ;
$TotPaxMayOff_V = $Off_Pax_May + $V_Paxxx_May ;
			
		    
        
        $query6b ="SELECT  ROUND(SUM(NoPeople)) 'Web_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Jun = $row['Web_Pax_Jun'];
        
        $query6c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Jun' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ; "; 
       		$stmt6c = $conn->prepare($query6c);
			$stmt6c->execute();
        	$row = $stmt6c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Jun = $row['V_Paxxx_Jun']; if (empty($V_Paxxx_Jun)) {$V_Paxxx_Jun = 0; }
        
        
        $query6a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Jun = $row['Off_Pax_Jun'];
        
$Tot_Pax_Jun = $Web_Pax_Jun + $Off_Pax_Jun ;
$TotPaxJunOff_V = $Off_Pax_Jun + $V_Paxxx_Jun ;
        
        
        
        
        $query7b ="SELECT  ROUND(SUM(NoPeople)) 'Web_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7b = $conn->prepare($query7b);
			$stmt7b->execute();
        	$row = $stmt7b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Jul = $row['Web_Pax_Jul'];
        
        $query7c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Jul' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ; "; 
       		$stmt7c = $conn->prepare($query7c);
			$stmt7c->execute();
        	$row = $stmt7c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Jul = $row['V_Paxxx_Jul']; if (empty($V_Paxxx_Jul)) {$V_Paxxx_Jul = 0; }
        
        $query7a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7a = $conn->prepare($query7a);
			$stmt7a->execute();
        	$row = $stmt7a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Jul = $row['Off_Pax_Jul'];
        
$Tot_Pax_Jul = $Web_Pax_Jul + $Off_Pax_Jul ;
$TotPaxJulOff_V = $Off_Pax_Jul + $V_Paxxx_Jul ;
        
        
        
        
        $query8b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);
			$stmt8b->execute();
        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Ago = $row['Web_Pax_Ago'];
        
        $query8c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Ago' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE) ; "; 
       		$stmt8c = $conn->prepare($query8c);
			$stmt8c->execute();
        	$row = $stmt8c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Ago = $row['V_Paxxx_Ago']; if (empty($V_Paxxx_Ago)) {$V_Paxxx_Ago = 0; }
        
         $query8a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);
			$stmt8a->execute();
        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Ago = $row['Off_Pax_Ago'];
        
$Tot_Pax_Ago = $Web_Pax_Ago + $Off_Pax_Ago ;
$TotPaxAgoOff_V = $Off_Pax_Ago + $V_Paxxx_Ago ;
        
        
        
        
        $query9b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);
			$stmt9b->execute();
        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Sep = $row['Web_Pax_Sep'];
        
        $query9c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Sep' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE) ; "; 
       		$stmt9c = $conn->prepare($query9c);
			$stmt9c->execute();
        	$row = $stmt9c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Sep = $row['V_Paxxx_Sep']; if (empty($V_Paxxx_Sep)) {$V_Paxxx_Sep = 0; }
        
        $query9a ="SELECT  ROUND(SUM(NoPeople)) 'Off_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);
			$stmt9a->execute();
        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Sep = $row['Off_Pax_Sep'];
        
$Tot_Pax_Sep = $Web_Pax_Sep + $Off_Pax_Sep ;
$TotPaxSepOff_V = $Off_Pax_Sep + $V_Paxxx_Sep ;
        
        
        $query10b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);
			$stmt10b->execute();
        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Oct = $row['Web_Pax_Oct'];
        
        $query10c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Oct' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE) ; "; 
       		$stmt10c = $conn->prepare($query10c);
			$stmt10c->execute();
        	$row = $stmt10c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Oct = $row['V_Paxxx_Oct']; if (empty($V_Paxxx_Oct)) {$V_Paxxx_Oct = 0; }
        
        
        $query10a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);
			$stmt10a->execute();
        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Oct = $row['Off_Pax_Oct'];
        
$Tot_Pax_Oct = $Web_Pax_Oct + $Off_Pax_Oct ;
$TotPaxOctOff_V = $Off_Pax_Oct + $V_Paxxx_Oct ;
        
        
        
        
         $query11b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);
			$stmt11b->execute();
        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Nov = $row['Web_Pax_Nov'];
        
        $query11c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Nov' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE) ; "; 
       		$stmt11c = $conn->prepare($query11c);
			$stmt11c->execute();
        	$row = $stmt11c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Nov = $row['V_Paxxx_Nov']; if (empty($V_Paxxx_Nov)) {$V_Paxxx_Nov = 0; }
        
        $query11a ="SELECT  ROUND(SUM(NoPeople)) 'Off_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);
			$stmt11a->execute();
        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Nov = $row['Off_Pax_Nov'];
        
$Tot_Pax_Nov = $Web_Pax_Nov + $Off_Pax_Nov ;
$TotPaxNovOff_V = $Off_Pax_Nov + $V_Paxxx_Nov ;
        
        
        $query12b ="SELECT   ROUND(SUM(NoPeople)) 'Web_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND  Id_Status = 3  
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);
			$stmt12b->execute();
        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pax_Dic = $row['Web_Pax_Dic'];
        
        $query2c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Dic' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE) ; "; 
       		$stmt2c = $conn->prepare($query2c);
			$stmt2c->execute();
        	$row = $stmt2c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Dic = $row['V_Paxxx_Dic']; if (empty($V_Paxxx_Dic)) {$V_Paxxx_Dic = 0; }
        
        $query12a ="SELECT   ROUND(SUM(NoPeople)) 'Off_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);
			$stmt12a->execute();
        	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pax_Dic = $row['Off_Pax_Dic'];
        
$Tot_Pax_Dic = $Web_Pax_Dic + $Off_Pax_Dic ; 
$TotPaxDicOff_V = $Off_Pax_Dic + $V_Paxxx_Dic ;
			
		include("views/Sales/◣_◢-EchartsPax.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }


	
}
    
    
 
    
     public function getDashboardoktrip____(){
        
    session_start();
	try{

	 	$Fecha_2 = date("Y-m-d");
	 	$Fecha_1 = date("Y-m-d");
       
        
	    $total_pax = 0;
        $total_registros = 0;
        
		$lista = array();
        $db = new db();
		$conn = $db->conn_local();
        $query = "SELECT Id_Volaris, nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                        empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida,
	                                    hora_pickup_salida, unidad_salida, operador_salida
                        FROM volaris WHERE isDeleted = 0 AND fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE) 
                        ORDER BY Id_Volaris DESC ;";
	   //  print $query;
		$stmt = $conn->prepare($query);             
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$volaris = new volaris_row(); /* nueva instancia   */
                $volaris->setId_Volaris($row['Id_Volaris']);
				$volaris->setnombre_completo($row['nombre_completo']);
				$volaris->setfecha_llegada($row['fecha_llegada']);
				$volaris->setservicio_llegada($row['servicio_llegada']);
				$volaris->setno_vuelo_llegada($row['no_vuelo_llegada']);
				$volaris->sethora_vuelo_llegada($row['hora_vuelo_llegada']);
				$volaris->setpaxxx($row['paxxx']);
				$volaris->setno_reserva($row['no_reserva']);
				$volaris->setfecha_salida($row['fecha_salida']);
				$volaris->setno_vuelo_salida($row['no_vuelo_salida']);
				$volaris->sethora_vuelo_salida($row['hora_vuelo_salida']);
				$volaris->sethora_pickup_salida($row['hora_pickup_salida']);
				$volaris->setunidad_salida($row['unidad_salida']);
				$volaris->setoperador_salida($row['operador_salida']);
				array_push($lista, $volaris);

			}
                
			$query2 ="SELECT SUM(paxxx) 'No_PAX', SUM(Id_Volaris) 'Tot_Registros' 
                              FROM volaris
                              WHERE isDeleted = 0 AND  fecha_llegada BETWEEN  CAST('".$Fecha_1."' AS DATE) AND CAST('".$Fecha_2."' AS DATE)  ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['No_PAX'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues

			}
			else
			    $bandera = 1; 	//echo "Falla en la sumatoria";
		}
		else
			$count= 0;
                       
         
	 	include ("views/Sales/dashboard-oktrip.php");


	} 
    catch (Exception $e)
    {
	 	echo "Error fatal: ".$e;
	 }

}
    
    
    public function getDashboardoktrip(){
	session_start();
    try {
        
$Ene_1 = '2019-01-01';  $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01'; $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01';  $Mar_2 = '2019-03-31';  $Abr_1 = '2019-04-01'; $Abr_2 = '2019-04-30';
$May_1 = '2019-05-01'; $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01'; $Jun_2 = '2019-06-30'; $Jul_1 = '2019-07-01'; $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01';  $Ago_2 = '2019-08-31';
$Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30';  $Oct_1 = '2019-10-01'; $Oct_2 = '2019-10-31'; $Nov_1 = '2019-11-01'; $Nov_2 = '2019-11-30'; $Dic_1 = '2019-12-01';   $Dic_2 = '2019-12-31';
	 	
			$db = new db();
			$conn = $db->conn_local();
        
        
        
        
            $query3 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_WEB',   SUM(Total) 'PUBLICO_2019_VTAS_WEB',
                               SUM(NoPeople) 'TOTAL_PAX_WEB_2019'    
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE  offline = 0  AND  Id_Status = 3  AND DateTo 
                               BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   ";  // print $query3; 
           	$stmt3 = $conn->prepare($query3);
			$stmt3->execute();
        	$row = $stmt3->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_WEB = $row["NETO_2019_VTAS_WEB"]; if (empty($NETO_2019_VTAS_WEB)) { $NETO_2019_VTAS_WEB =   9096 ;  } else { $NETO_2019_VTAS_WEB = $row['NETO_2019_VTAS_WEB'] + 9096; } 
            $PUBLICO_2019_VTAS_WEB = $row["PUBLICO_2019_VTAS_WEB"]; if (empty($PUBLICO_2019_VTAS_WEB)) { $PUBLICO_2019_VTAS_WEB =  11087 ;  } else { $PUBLICO_2019_VTAS_WEB = $row['PUBLICO_2019_VTAS_WEB'] + 11087 ; } 
            $TOTAL_PAX_WEB_2019 = $row["TOTAL_PAX_WEB_2019"]; if (empty($TOTAL_PAX_WEB_2019)) { $TOTAL_PAX_WEB_2019 = 0 ;  } else { $TOTAL_PAX_WEB_2019 = $row['TOTAL_PAX_WEB_2019'] ; } 
            
            
            
            $query4 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_OFFLINE',   SUM(Total) 'PUBLICO_2019_VTAS_OFFLINE',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_2019'  
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL  
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND Id_Agents IN (0, 7) AND Commission = 0  
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
            $stmt4 = $conn->prepare($query4);
			$stmt4->execute();
        	$row = $stmt4->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_OFFLINE = $row["NETO_2019_VTAS_OFFLINE"]; if (empty($NETO_2019_VTAS_OFFLINE)) { $NETO_2019_VTAS_OFFLINE =   6683 ;  } else { $NETO_2019_VTAS_OFFLINE = $row['NETO_2019_VTAS_OFFLINE'] + 6683; } 
            $PUBLICO_2019_VTAS_OFFLINE = $row["PUBLICO_2019_VTAS_OFFLINE"]; if (empty($PUBLICO_2019_VTAS_OFFLINE)) { $PUBLICO_2019_VTAS_OFFLINE =  8036 ;  } else { $PUBLICO_2019_VTAS_OFFLINE = $row['PUBLICO_2019_VTAS_OFFLINE'] + 8036 ; } 
            $TOTAL_PAX_OFFLINE_2019 = $row["TOTAL_PAX_OFFLINE_2019"]; if (empty($TOTAL_PAX_OFFLINE_2019)) { $TOTAL_PAX_OFFLINE_2019 = 0 ;  } else { $TOTAL_PAX_OFFLINE_2019 = $row['TOTAL_PAX_OFFLINE_2019'] ; } 
            
            
            
            $query5 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_OFFLINE_REPS',   SUM(Total) 'PUBLICO_2019_VTAS_OFFLINE_REPS',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_REPS_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND  Id_Agents NOT IN (0, 7) AND Commission <> 0 
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
       		$stmt5 = $conn->prepare($query5);
			$stmt5->execute();
        	$row = $stmt5->fetch(PDO::FETCH_ASSOC);
           $NETO_2019_VTAS_OFFLINE_REPS = $row["NETO_2019_VTAS_OFFLINE_REPS"]; if (empty($NETO_2019_VTAS_OFFLINE_REPS)) { $NETO_2019_VTAS_OFFLINE_REPS =   158277 ;  } else { $NETO_2019_VTAS_OFFLINE_REPS = $row['NETO_2019_VTAS_OFFLINE_REPS'] + 158277; } 
            $PUBLICO_2019_VTAS_OFFLINE_REPS = $row["PUBLICO_2019_VTAS_OFFLINE_REPS"]; if (empty($PUBLICO_2019_VTAS_OFFLINE_REPS)) { $PUBLICO_2019_VTAS_OFFLINE_REPS =  186047 ;  } else { $PUBLICO_2019_VTAS_OFFLINE_REPS = $row['PUBLICO_2019_VTAS_OFFLINE_REPS'] + 186047 ; } 
            $TOTAL_PAX_OFFLINE_REPS_2019 = $row["TOTAL_PAX_OFFLINE_REPS_2019"]; if (empty($TOTAL_PAX_OFFLINE_REPS_2019)) { $TOTAL_PAX_OFFLINE_REPS_2019 = 0 ;  } else { $TOTAL_PAX_OFFLINE_REPS_2019 = $row['TOTAL_PAX_OFFLINE_REPS_2019'] ; } 
            
            
            
            
            $query6 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_TRAS_7USD',   SUM(Total) 'PUBLICO_2019_VTAS_TRAS_7USD', 
                               SUM(NoPeople) 'TOTAL_PAX_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 232 
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
       		$stmt6 = $conn->prepare($query6);
			$stmt6->execute();
        	$row = $stmt6->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_TRAS_7USD = $row["NETO_2019_VTAS_TRAS_7USD"]; if (empty($NETO_2019_VTAS_TRAS_7USD)) { $NETO_2019_VTAS_TRAS_7USD =   2473 ;  } else { $NETO_2019_VTAS_TRAS_7USD = $row['NETO_2019_VTAS_TRAS_7USD'] + 2473; } 
            $PUBLICO_2019_VTAS_TRAS_7USD = $row["PUBLICO_2019_VTAS_TRAS_7USD"]; if (empty($PUBLICO_2019_VTAS_TRAS_7USD)) { $PUBLICO_2019_VTAS_TRAS_7USD =  5346 ;  } else { $PUBLICO_2019_VTAS_TRAS_7USD = $row['PUBLICO_2019_VTAS_TRAS_7USD'] + 5346 ; } 
            $TOT_PAX_2019 = $row["TOTAL_PAX_2019"]; if (empty($TOT_PAX_2019)) { $TOT_PAX_2019 = 21 ;  } else { $TOT_PAX_2019 = $row['TOTAL_PAX_2019'] + 21 ; } 
            
            
            
            // $query7 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ULTRAMAR',   SUM(Total) 'PUBLICO_2019_VTAS_ULTRAMAR', 
//                               SUM(NoPeople) 'TOTAL_PAX_ULTRAMAR_2019' 
//	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
//	                           WHERE isDeleted = 0 AND  Services_Name  = TRIM('VUELO') AND offline = 1 AND Id_Status = 3
//                               AND TypeService = TRIM('Aerolínea') AND Id_productos = 276 
//                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
//            
            $query7 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ULTRAMAR',   SUM(Total) 'PUBLICO_2019_VTAS_ULTRAMAR', 
                               SUM(NoPeople) 'TOTAL_PAX_ULTRAMAR_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 276  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt7 = $conn->prepare($query7);
			$stmt7->execute();
        	$row = $stmt7->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_ULTRAMAR = $row["NETO_2019_VTAS_ULTRAMAR"]; if (empty($NETO_2019_VTAS_ULTRAMAR)) { $NETO_2019_VTAS_ULTRAMAR =  18359 ;  } else { $NETO_2019_VTAS_ULTRAMAR = $row['NETO_2019_VTAS_ULTRAMAR'] + 18359; } 
            $PUBLICO_2019_VTAS_ULTRAMAR = $row["PUBLICO_2019_VTAS_ULTRAMAR"]; if (empty($PUBLICO_2019_VTAS_ULTRAMAR)) { $PUBLICO_2019_VTAS_ULTRAMAR =  22624 ;  } else { $PUBLICO_2019_VTAS_ULTRAMAR = $row['PUBLICO_2019_VTAS_ULTRAMAR'] + 22624 ; } 
            $TOTAL_PAX_ULTRAMAR_2019 = $row["TOTAL_PAX_ULTRAMAR_2019"]; if (empty($TOTAL_PAX_ULTRAMAR_2019)) { $TOTAL_PAX_ULTRAMAR_2019 = 0 ;  } else { $TOTAL_PAX_ULTRAMAR_2019 = $row['TOTAL_PAX_ULTRAMAR_2019'] ; } 
            
            
        $query9 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ALOHAKAI',   SUM(Total) 'PUBLICO_2019_VTAS_ALOHAKAI', 
                               SUM(NoPeople) 'TOTAL_PAX_ALOHAKAI_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 283  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt9 = $conn->prepare($query9);
			$stmt9->execute();
        	$row = $stmt9->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_ALOHAKAI = $row["NETO_2019_VTAS_ALOHAKAI"]; if (empty($NETO_2019_VTAS_ALOHAKAI)) { $NETO_2019_VTAS_ALOHAKAI =  0 ;  } 
            $PUBLICO_2019_VTAS_ALOHAKAI = $row["PUBLICO_2019_VTAS_ALOHAKAI"]; if (empty($PUBLICO_2019_VTAS_ALOHAKAI)) { $PUBLICO_2019_VTAS_ALOHAKAI =  0 ;  } 
            $TOTAL_PAX_ALOHAKAI_2019 = $row["TOTAL_PAX_ALOHAKAI_2019"]; if (empty($TOTAL_PAX_ALOHAKAI_2019)) { $TOTAL_PAX_ALOHAKAI_2019 = 0 ;  }  
            
        
        
        
           $query10 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_AZULTRAVEL',   SUM(Total) 'PUBLICO_2019_VTAS_AZULTRAVEL', 
                               SUM(NoPeople) 'TOTAL_PAX_AZULTRAVEL_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 284  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt10 = $conn->prepare($query10);
			$stmt10->execute();
        	$row = $stmt10->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_AZULTRAVEL = $row["NETO_2019_VTAS_AZULTRAVEL"]; if (empty($NETO_2019_VTAS_AZULTRAVEL)) { $NETO_2019_VTAS_AZULTRAVEL =  0 ;  } 
            $PUBLICO_2019_VTAS_AZULTRAVEL = $row["PUBLICO_2019_VTAS_AZULTRAVEL"]; if (empty($PUBLICO_2019_VTAS_AZULTRAVEL)) { $PUBLICO_2019_VTAS_AZULTRAVEL =  0 ;  }  
            $TOTAL_PAX_AZULTRAVEL_2019 = $row["TOTAL_PAX_AZULTRAVEL_2019"]; if (empty($TOTAL_PAX_AZULTRAVEL_2019)) { $TOTAL_PAX_AZULTRAVEL_2019 = 0 ;  } 
            
        
        
        
        
        
        $query8 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_GPH',   SUM(Total) 'PUBLICO_2019_VTAS_GPH', 
                               SUM(NoPeople) 'TOTAL_PAX_GPH_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 278  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt8 = $conn->prepare($query8);
			$stmt8->execute();
        	$row = $stmt8->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_GPH = $row["NETO_2019_VTAS_GPH"]; if (empty($NETO_2019_VTAS_GPH)) { $NETO_2019_VTAS_GPH =  $NETO_2019_VTAS_GPH ;  } else { $NETO_2019_VTAS_GPH = $row['NETO_2019_VTAS_GPH'] ; } 
            $PUBLICO_2019_VTAS_GPH = $row["PUBLICO_2019_VTAS_GPH"]; if (empty($PUBLICO_2019_VTAS_GPH)) { $PUBLICO_2019_VTAS_GPH =  $PUBLICO_2019_VTAS_GPH ;  } else { $PUBLICO_2019_VTAS_GPH = $row['PUBLICO_2019_VTAS_GPH']  ; } 
            $TOTAL_PAX_GPH_2019 = $row["TOTAL_PAX_GPH_2019"]; if (empty($TOTAL_PAX_GPH_2019)) { $TOTAL_PAX_GPH_2019 = 0 ;  } else { $TOTAL_PAX_GPH_2019 = $row['TOTAL_PAX_GPH_2019'] ; } 
            
        
        
        
        
        
         $query1b =" SELECT SUM(NoPeople) 'TOTAL_PAX_GRATIS_2019' 
	                            FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                            WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 233 
	                            AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
            $TOTAL_PAX_GRATIS_2019 = $row["TOTAL_PAX_GRATIS_2019"]; if (empty($TOTAL_PAX_GRATIS_2019)) { $TOTAL_PAX_GRATIS_2019 = 3 ;  } else { $TOTAL_PAX_GRATIS_2019 = $row['TOTAL_PAX_GRATIS_2019'] + 3 ; } 
            
        


          $query1c =" SELECT   SUM(paxxx) 'TOT_PAX_IN_2019'  FROM volaris WHERE fecha_llegada <> '0000-00-00'
                            AND isDeleted = 0   AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt1c = $conn->prepare($query1c);
			$stmt1c->execute();
        	$row = $stmt1c->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_IN_2019 = $row["TOT_PAX_IN_2019"]; if (empty($TOT_PAX_IN_2019)) { $TOT_PAX_IN_2019 = 348 ;  } else { $TOT_PAX_IN_2019 = $row['TOT_PAX_IN_2019'] + 348 ; } 
            $TOT_PAX_IN_2019 = $row["TOT_PAX_IN_2019"]; if (empty($TOT_PAX_IN_2019)) { $TOT_PAX_IN_2019 = $TOT_PAX_IN_2019 ;  } else { $TOT_PAX_IN_2019 = $row['TOT_PAX_IN_2019']  ; } 
         
        
        
        $query1d =" SELECT   SUM(paxxx) 'TOT_PAX_OUT_2019'  FROM volaris WHERE fecha_salida <> '0000-00-00'
                                             AND isDeleted = 0   AND fecha_salida BETWEEN CAST('2019-01-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt1d = $conn->prepare($query1d);
			$stmt1d->execute();
        	$row = $stmt1d->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_OUT_2019 = $row["TOT_PAX_OUT_2019"]; if (empty($TOT_PAX_OUT_2019)) { $TOT_PAX_OUT_2019 = 346 ;  } else { $TOT_PAX_OUT_2019 = $row['TOT_PAX_OUT_2019'] + 346 ; } 
            $TOT_PAX_OUT_2019 = $row["TOT_PAX_OUT_2019"]; if (empty($TOT_PAX_OUT_2019)) { $TOT_PAX_OUT_2019 = $TOT_PAX_OUT_2019 ;  } else { $TOT_PAX_OUT_2019 = $row['TOT_PAX_OUT_2019'] ; } 
            
            
        
        
$TOT_N_2019  = $NETO_2019_VTAS_WEB + $NETO_2019_VTAS_OFFLINE +  $NETO_2019_VTAS_OFFLINE_REPS + $NETO_2019_VTAS_TRAS_7USD + $NETO_2019_VTAS_ULTRAMAR + $NETO_2019_VTAS_GPH + $NETO_2019_VTAS_ALOHAKAI + $NETO_2019_VTAS_AZULTRAVEL ;
$TOT_P_2019  = $PUBLICO_2019_VTAS_WEB + $PUBLICO_2019_VTAS_OFFLINE + $PUBLICO_2019_VTAS_OFFLINE_REPS +  $PUBLICO_2019_VTAS_TRAS_7USD + $PUBLICO_2019_VTAS_ULTRAMAR + $PUBLICO_2019_VTAS_GPH + $PUBLICO_2019_VTAS_ALOHAKAI + $PUBLICO_2019_VTAS_AZULTRAVEL  ;
$TOT_PAX      =  $TOTAL_PAX_WEB_2019 + $TOTAL_PAX_OFFLINE_2019 + $TOTAL_PAX_OFFLINE_REPS_2019 +  $TOT_PAX_2019 + $TOTAL_PAX_GRATIS_2019 + $TOTAL_PAX_ULTRAMAR_2019 + $TOT_PAX_IN_2019 + $TOT_PAX_OUT_2019 + $TOTAL_PAX_GPH_2019 + $TOTAL_PAX_ALOHAKAI_2019 + $TOTAL_PAX_AZULTRAVEL_2019  ;
$GRAN_TOT = $TOT_N_2019 + $TOT_P_2019;         

            
       /* Hasta aqui son los grandes totales, los que se muestran de manera individual */
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	/*		$query1a ="SELECT SUM(Total) 'Tot_Pub_Ene',  SUM(Subtotal) 'Tot_Net_Ene' ,  SUM(NoPeople) 'Tot_Pax_Ene'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0,1) 
                                AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE) ORDER BY Id DESC ;"; 
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Tot_Pub_Ene = $row['Tot_Pub_Ene'];
			$Tot_Net_Ene = $row['Tot_Net_Ene'];
            $Tot_Pax_Ene = $row['Tot_Pax_Ene'];  Enero no se calculo, fueron datos fijos*/
        
         $query2b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Feb',  ROUND(SUM(Subtotal)) 'Web_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2b = $conn->prepare($query2b);
			$stmt2b->execute();
        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row['Web_Pub_Feb'];
			$Web_Net_Feb = $row['Web_Net_Feb'];
            $Web_Pax_Feb = $row['Web_Pax_Feb'];
        
         $query2a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Feb',  ROUND(SUM(Subtotal)) 'Off_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2a = $conn->prepare($query2a);
			$stmt2a->execute();
        	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row['Off_Pub_Feb'];
			$Off_Net_Feb = $row['Off_Net_Feb'];
            $Off_Pax_Feb = $row['Off_Pax_Feb'];
        
         $query2c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Feb' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ; "; 
       		$stmt2c = $conn->prepare($query2c);
			$stmt2c->execute();
        	$row = $stmt2c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Feb = $row['V_Paxxx_Feb']; if (empty($V_Paxxx_Feb)) {$V_Paxxx_Feb = 0; }
            $TotPaxFebOff_V = $Off_Pax_Feb + $V_Paxxx_Feb ;
        
$Tot_Pub_Feb = $Web_Pub_Feb + $Off_Pub_Feb;
$Tot_Net_Feb = $Web_Net_Feb + $Off_Net_Feb;
$Tot_Pax_Feb = $Web_Pax_Feb + $Off_Pax_Feb ; 
        
        
        
        
        $query3b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Mar',  ROUND(SUM(Subtotal)) 'Web_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3b = $conn->prepare($query3b);
			$stmt3b->execute();
        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row['Web_Pub_Mar'];
			$Web_Net_Mar = $row['Web_Net_Mar'];
            $Web_Pax_Mar = $row['Web_Pax_Mar'];
        
        
        $query3a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Mar',  ROUND(SUM(Subtotal)) 'Off_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3a = $conn->prepare($query3a);
			$stmt3a->execute();
        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row['Off_Pub_Mar'];
			$Off_Net_Mar = $row['Off_Net_Mar'];
            $Off_Pax_Mar = $row['Off_Pax_Mar'];
        
        $query3c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Mar' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ; "; 
       		$stmt3c = $conn->prepare($query3c);
			$stmt3c->execute();
        	$row = $stmt3c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Mar = $row['V_Paxxx_Mar']; if (empty($V_Paxxx_Mar)) {$V_Paxxx_Mar = 0; }
         $TotPaxMarOff_V = $Off_Pax_Mar + $V_Paxxx_Mar ;
        
$Tot_Pub_Mar = $Web_Pub_Mar + $Off_Pub_Mar;
$Tot_Net_Mar = $Web_Net_Mar + $Off_Net_Mar;
$Tot_Pax_Mar = $Web_Pax_Mar + $Off_Pax_Mar ;
        
        
        
        
        
        
        
        
        $query4b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Abr',  ROUND(SUM(Subtotal)) 'Web_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4b = $conn->prepare($query4b);
			$stmt4b->execute();
        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row['Web_Pub_Abr'];
			$Web_Net_Abr = $row['Web_Net_Abr'];
            $Web_Pax_Abr = $row['Web_Pax_Abr'];
        
        
        
        $query4a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Abr',  ROUND(SUM(Subtotal)) 'Off_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4a = $conn->prepare($query4a);
			$stmt4a->execute();
        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row['Off_Pub_Abr'];
			$Off_Net_Abr = $row['Off_Net_Abr'];
            $Off_Pax_Abr = $row['Off_Pax_Abr'];
        
            $query4c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Abr' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ; "; 
       		$stmt4c = $conn->prepare($query4c);
			$stmt4c->execute();
        	$row = $stmt4c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Abr = $row['V_Paxxx_Abr']; if (empty($V_Paxxx_Abr)) {$V_Paxxx_Abr = 0; }
            $TotPaxAbrOff_V = $Off_Pax_Abr + $V_Paxxx_Abr ;   
        
$Tot_Pub_Abr = $Web_Pub_Abr + $Off_Pub_Abr;
$Tot_Net_Abr = $Web_Net_Abr + $Off_Net_Abr;
$Tot_Pax_Abr = $Web_Pax_Abr + $Off_Pax_Abr ;
        
        
        
        
       
        
         $query5b ="SELECT ROUND(SUM(Total)) 'Web_Pub_May',  ROUND(SUM(Subtotal)) 'Web_Net_May' ,  ROUND(SUM(NoPeople)) 'Web_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);
			$stmt5b->execute();
        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row['Web_Pub_May'];
			$Web_Net_May = $row['Web_Net_May'];
            $Web_Pax_May = $row['Web_Pax_May'];
        
        
        $query5a ="SELECT ROUND(SUM(Total)) 'Off_Pub_May',  ROUND(SUM(Subtotal)) 'Off_Net_May' ,  ROUND(SUM(NoPeople)) 'Off_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);
			$stmt5a->execute();
        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row['Off_Pub_May'];
			$Off_Net_May = $row['Off_Net_May'];
            $Off_Pax_May = $row['Off_Pax_May'];
        
          $query5c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_May' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE) ; "; 
       		$stmt5c = $conn->prepare($query5c);
			$stmt5c->execute();
        	$row = $stmt5c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_May = $row['V_Paxxx_May']; if (empty($V_Paxxx_May)) {$V_Paxxx_May = 0; }
            $TotPaxMayOff_V = $Off_Pax_May + $V_Paxxx_May ;
        
        
$Tot_Pub_May = $Web_Pub_May + $Off_Pub_May;
$Tot_Net_May = $Web_Net_May + $Off_Net_May;
$Tot_Pax_May = $Web_Pax_May + $Off_Pax_May ;
			
		    
        
        $query6b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jun',  ROUND(SUM(Subtotal)) 'Web_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row['Web_Pub_Jun'];
			$Web_Net_Jun = $row['Web_Net_Jun'];
            $Web_Pax_Jun = $row['Web_Pax_Jun'];
        
        $query6a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jun',  ROUND(SUM(Subtotal)) 'Off_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row['Off_Pub_Jun'];
			$Off_Net_Jun = $row['Off_Net_Jun'];
            $Off_Pax_Jun = $row['Off_Pax_Jun'];
    
           $query6c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Jun' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ; "; 
       		$stmt6c = $conn->prepare($query6c);
			$stmt6c->execute();
        	$row = $stmt6c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Jun = $row['V_Paxxx_Jun']; if (empty($V_Paxxx_Jun)) {$V_Paxxx_Jun = 0; }
            $TotPaxJunOff_V = $Off_Pax_Jun + $V_Paxxx_Jun ;
        
        
        
$Tot_Pub_Jun = $Web_Pub_Jun + $Off_Pub_Jun;
$Tot_Net_Jun = $Web_Net_Jun + $Off_Net_Jun;
$Tot_Pax_Jun = $Web_Pax_Jun + $Off_Pax_Jun ;
        
        
        
        
        $query7b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jul',  ROUND(SUM(Subtotal)) 'Web_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7b = $conn->prepare($query7b);
			$stmt7b->execute();
        	$row = $stmt7b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row['Web_Pub_Jul'];
			$Web_Net_Jul = $row['Web_Net_Jul'];
            $Web_Pax_Jul = $row['Web_Pax_Jul'];
        
        $query7a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jul',  ROUND(SUM(Subtotal)) 'Off_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7a = $conn->prepare($query7a);
			$stmt7a->execute();
        	$row = $stmt7a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row['Off_Pub_Jul'];
			$Off_Net_Jul = $row['Off_Net_Jul'];
            $Off_Pax_Jul = $row['Off_Pax_Jul'];
        
        $query7c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Jul' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ; "; 
       		$stmt7c = $conn->prepare($query7c);
			$stmt7c->execute();
        	$row = $stmt7c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Jul = $row['V_Paxxx_Jul']; if (empty($V_Paxxx_Jul)) {$V_Paxxx_Jul = 0; }
            $TotPaxJulOff_V = $Off_Pax_Jul + $V_Paxxx_Jul ;
        
        
$Tot_Pub_Jul = $Web_Pub_Jul + $Off_Pub_Jul;
$Tot_Net_Jul = $Web_Net_Jul + $Off_Net_Jul;
$Tot_Pax_Jul = $Web_Pax_Jul + $Off_Pax_Jul ;
        
        
        
        
        $query8b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Ago',  ROUND(SUM(Subtotal)) 'Web_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);
			$stmt8b->execute();
        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row['Web_Pub_Ago'];
			$Web_Net_Ago = $row['Web_Net_Ago'];
            $Web_Pax_Ago = $row['Web_Pax_Ago'];
        
         $query8a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Ago',  ROUND(SUM(Subtotal)) 'Off_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);
			$stmt8a->execute();
        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row['Off_Pub_Ago'];
			$Off_Net_Ago = $row['Off_Net_Ago'];
            $Off_Pax_Ago = $row['Off_Pax_Ago'];
        
        $query8c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Ago' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE) ; "; 
       		$stmt8c = $conn->prepare($query8c);
			$stmt8c->execute();
        	$row = $stmt8c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Ago = $row['V_Paxxx_Ago']; if (empty($V_Paxxx_Ago)) {$V_Paxxx_Ago = 0; }
            $TotPaxAgoOff_V = $Off_Pax_Ago + $V_Paxxx_Ago ;
        
        
$Tot_Pub_Ago = $Web_Pub_Ago + $Off_Pub_Ago;
$Tot_Net_Ago = $Web_Net_Ago + $Off_Net_Ago;
$Tot_Pax_Ago = $Web_Pax_Ago + $Off_Pax_Ago ;
        
        
        
        
        $query9b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Sep',  ROUND(SUM(Subtotal)) 'Web_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);
			$stmt9b->execute();
        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row['Web_Pub_Sep'];
			$Web_Net_Sep = $row['Web_Net_Sep'];
            $Web_Pax_Sep = $row['Web_Pax_Sep'];
        
        $query9a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Sep',  ROUND(SUM(Subtotal)) 'Off_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);
			$stmt9a->execute();
        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row['Off_Pub_Sep'];
			$Off_Net_Sep = $row['Off_Net_Sep'];
            $Off_Pax_Sep = $row['Off_Pax_Sep'];
       
        $query9c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Sep' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE) ; "; 
       		$stmt9c = $conn->prepare($query9c);
			$stmt9c->execute();
        	$row = $stmt9c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Sep = $row['V_Paxxx_Sep']; if (empty($V_Paxxx_Sep)) {$V_Paxxx_Sep = 0; }
            $TotPaxSepOff_V = $Off_Pax_Sep + $V_Paxxx_Sep ;
        
        
$Tot_Pub_Sep = $Web_Pub_Sep + $Off_Pub_Sep;
$Tot_Net_Sep = $Web_Net_Sep + $Off_Net_Sep;
$Tot_Pax_Sep = $Web_Pax_Sep + $Off_Pax_Sep ;
        
        
        $query10b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Oct',  ROUND(SUM(Subtotal)) 'Web_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);
			$stmt10b->execute();
        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row['Web_Pub_Oct'];
			$Web_Net_Oct = $row['Web_Net_Oct'];
            $Web_Pax_Oct = $row['Web_Pax_Oct'];
        
        $query10a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Oct',  ROUND(SUM(Subtotal)) 'Off_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);
			$stmt10a->execute();
        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row['Off_Pub_Oct'];
			$Off_Net_Oct = $row['Off_Net_Oct'];
            $Off_Pax_Oct = $row['Off_Pax_Oct'];
    
        $query10c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Oct' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE) ; "; 
       		$stmt10c = $conn->prepare($query10c);
			$stmt10c->execute();
        	$row = $stmt10c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Oct = $row['V_Paxxx_Oct']; if (empty($V_Paxxx_Oct)) {$V_Paxxx_Oct = 0; }
            $TotPaxOctOff_V = $Off_Pax_Oct + $V_Paxxx_Oct ;
        
        
$Tot_Pub_Oct = $Web_Pub_Oct + $Off_Pub_Oct;
$Tot_Net_Oct = $Web_Net_Oct + $Off_Net_Oct;
$Tot_Pax_Oct = $Web_Pax_Oct + $Off_Pax_Oct ;
        
        
        
        
         $query11b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Nov',  ROUND(SUM(Subtotal)) 'Web_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);
			$stmt11b->execute();
        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row['Web_Pub_Nov'];
			$Web_Net_Nov = $row['Web_Net_Nov'];
            $Web_Pax_Nov = $row['Web_Pax_Nov'];
        
        $query11a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Nov',  ROUND(SUM(Subtotal)) 'Off_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);
			$stmt11a->execute();
        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row['Off_Pub_Nov'];
			$Off_Net_Nov = $row['Off_Net_Nov'];
            $Off_Pax_Nov = $row['Off_Pax_Nov'];
        
        $query11c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Nov' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE) ; "; 
       		$stmt11c = $conn->prepare($query11c);
			$stmt11c->execute();
        	$row = $stmt11c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Nov = $row['V_Paxxx_Nov']; if (empty($V_Paxxx_Nov)) {$V_Paxxx_Nov = 0; }
            $TotPaxNovOff_V = $Off_Pax_Nov + $V_Paxxx_Nov ;
        
        
$Tot_Pub_Nov = $Web_Pub_Nov + $Off_Pub_Nov;
$Tot_Net_Nov = $Web_Net_Nov + $Off_Net_Nov;
$Tot_Pax_Nov = $Web_Pax_Nov + $Off_Pax_Nov ;
        
        
        $query12b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Dic',  ROUND(SUM(Subtotal)) 'Web_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);
			$stmt12b->execute();
        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row['Web_Pub_Dic'];
			$Web_Net_Dic = $row['Web_Net_Dic'];
            $Web_Pax_Dic = $row['Web_Pax_Dic'];
        
        $query12a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Dic',  ROUND(SUM(Subtotal)) 'Off_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);
			$stmt12a->execute();
        	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row['Off_Pub_Dic'];
			$Off_Net_Dic = $row['Off_Net_Dic'];
            $Off_Pax_Dic = $row['Off_Pax_Dic'];
      
        $query12c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Dic' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE) ; "; 
       		$stmt12c = $conn->prepare($query12c);
			$stmt12c->execute();
        	$row = $stmt12c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Dic = $row['V_Paxxx_Dic']; if (empty($V_Paxxx_Dic)) {$V_Paxxx_Dic = 0; }
            $TotPaxDicOff_V = $Off_Pax_Dic + $V_Paxxx_Dic ;
        
		$Tot_Pub_Dic = $Web_Pub_Dic + $Off_Pub_Dic;
		$Tot_Net_Dic = $Web_Net_Dic + $Off_Net_Dic;
		$Tot_Pax_Dic = $Web_Pax_Dic + $Off_Pax_Dic; 
			
        
        
        
        
        
        
        
		include("views/Sales/dashboard-oktrip.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }


	
}

    






 public function getDashboard_indicators_oktrip() {
                
	session_start();
    try {
date_default_timezone_set("America/Cancun");   $eterno = date("Y"); $mes = date("m");  

$Ene_1 = $eterno.'-01-01'; $Ene_2 = '2019-01-31';  $Feb_1 = '2019-02-01'; $Feb_2 = '2019-02-28'; $Mar_1 = '2019-03-01'; $Mar_2 = '2019-03-31'; 
$Abr_1 = '2019-04-01'; $Abr_2 = '2019-04-30';  $May_1 = '2019-05-01'; $May_2 = '2019-05-31'; $Jun_1 = '2019-06-01'; $Jun_2 = '2019-06-30'; 
$Jul_1 = '2019-07-01'; $Jul_2 = '2019-07-31';  $Ago_1 = '2019-08-01'; $Ago_2 = '2019-08-31'; $Sep_1 = '2019-09-01'; $Sep_2 = '2019-09-30';
$Oct_1 = '2019-10-01'; $Oct_2 = '2019-10-31';  $Nov_1 = '2019-11-01'; $Nov_2 = '2019-11-30'; $Dic_1 = '2019-12-01'; $Dic_2 = '2019-12-31';
	 	echo $Ene_1; 
			$db = new db();
			$conn = $db->conn_local();
        $query3_2020 =" SELECT SUM(Subtotal) 'NETO_2020_VTAS_WEB',   SUM(Total) 'PUBLICO_2020_VTAS_WEB',
                               SUM(NoPeople) 'TOTAL_PAX_WEB_2020'    
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND offline = 0  AND  Id_Status = 3  AND DateTo 
                               BETWEEN CAST('2020-01-01' AS DATE) AND CAST('2020-12-31' AS DATE) ;   ";  // print $query3; 
        
            $query3 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_WEB',   SUM(Total) 'PUBLICO_2019_VTAS_WEB',
                               SUM(NoPeople) 'TOTAL_PAX_WEB_2019'    
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE  offline = 0  AND  Id_Status = 3  AND DateTo 
                               BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   ";  // print $query3; 
           	$stmt3 = $conn->prepare($query3);
			$stmt3->execute();
        	$row = $stmt3->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_WEB = $row["NETO_2019_VTAS_WEB"]; if (empty($NETO_2019_VTAS_WEB)) { $NETO_2019_VTAS_WEB =   9096 ;  } else { $NETO_2019_VTAS_WEB = $row['NETO_2019_VTAS_WEB'] + 9096; } 
            $PUBLICO_2019_VTAS_WEB = $row["PUBLICO_2019_VTAS_WEB"]; if (empty($PUBLICO_2019_VTAS_WEB)) { $PUBLICO_2019_VTAS_WEB =  11087 ;  } else { $PUBLICO_2019_VTAS_WEB = $row['PUBLICO_2019_VTAS_WEB'] + 11087 ; } 
            $TOTAL_PAX_WEB_2019 = $row["TOTAL_PAX_WEB_2019"]; if (empty($TOTAL_PAX_WEB_2019)) { $TOTAL_PAX_WEB_2019 = 0 ;  } else { $TOTAL_PAX_WEB_2019 = $row['TOTAL_PAX_WEB_2019'] ; } 
            
            
            
            $query4 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_OFFLINE',   SUM(Total) 'PUBLICO_2019_VTAS_OFFLINE',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_2019'  
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL  
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND Id_Agents IN (0, 7) AND Commission = 0  
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
            $stmt4 = $conn->prepare($query4);
			$stmt4->execute();
        	$row = $stmt4->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_OFFLINE = $row["NETO_2019_VTAS_OFFLINE"]; if (empty($NETO_2019_VTAS_OFFLINE)) { $NETO_2019_VTAS_OFFLINE =   6683 ;  } else { $NETO_2019_VTAS_OFFLINE = $row['NETO_2019_VTAS_OFFLINE'] + 6683; } 
            $PUBLICO_2019_VTAS_OFFLINE = $row["PUBLICO_2019_VTAS_OFFLINE"]; if (empty($PUBLICO_2019_VTAS_OFFLINE)) { $PUBLICO_2019_VTAS_OFFLINE =  8036 ;  } else { $PUBLICO_2019_VTAS_OFFLINE = $row['PUBLICO_2019_VTAS_OFFLINE'] + 8036 ; } 
            $TOTAL_PAX_OFFLINE_2019 = $row["TOTAL_PAX_OFFLINE_2019"]; if (empty($TOTAL_PAX_OFFLINE_2019)) { $TOTAL_PAX_OFFLINE_2019 = 0 ;  } else { $TOTAL_PAX_OFFLINE_2019 = $row['TOTAL_PAX_OFFLINE_2019'] ; } 
            
            
            
            $query5 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_OFFLINE_REPS',   SUM(Total) 'PUBLICO_2019_VTAS_OFFLINE_REPS',
                              SUM(NoPeople) 'TOTAL_PAX_OFFLINE_REPS_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND  Id_Agents NOT IN (0, 7) AND Commission <> 0 
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
       		$stmt5 = $conn->prepare($query5);
			$stmt5->execute();
        	$row = $stmt5->fetch(PDO::FETCH_ASSOC);
           $NETO_2019_VTAS_OFFLINE_REPS = $row["NETO_2019_VTAS_OFFLINE_REPS"]; if (empty($NETO_2019_VTAS_OFFLINE_REPS)) { $NETO_2019_VTAS_OFFLINE_REPS =   158277 ;  } else { $NETO_2019_VTAS_OFFLINE_REPS = $row['NETO_2019_VTAS_OFFLINE_REPS'] + 158277; } 
            $PUBLICO_2019_VTAS_OFFLINE_REPS = $row["PUBLICO_2019_VTAS_OFFLINE_REPS"]; if (empty($PUBLICO_2019_VTAS_OFFLINE_REPS)) { $PUBLICO_2019_VTAS_OFFLINE_REPS =  186047 ;  } else { $PUBLICO_2019_VTAS_OFFLINE_REPS = $row['PUBLICO_2019_VTAS_OFFLINE_REPS'] + 186047 ; } 
            $TOTAL_PAX_OFFLINE_REPS_2019 = $row["TOTAL_PAX_OFFLINE_REPS_2019"]; if (empty($TOTAL_PAX_OFFLINE_REPS_2019)) { $TOTAL_PAX_OFFLINE_REPS_2019 = 0 ;  } else { $TOTAL_PAX_OFFLINE_REPS_2019 = $row['TOTAL_PAX_OFFLINE_REPS_2019'] ; } 
            
            
            
            
            $query6 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_TRAS_7USD',   SUM(Total) 'PUBLICO_2019_VTAS_TRAS_7USD', 
                               SUM(NoPeople) 'TOTAL_PAX_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                          WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 232 
	                          AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;   "; 
       		$stmt6 = $conn->prepare($query6);
			$stmt6->execute();
        	$row = $stmt6->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_TRAS_7USD = $row["NETO_2019_VTAS_TRAS_7USD"]; if (empty($NETO_2019_VTAS_TRAS_7USD)) { $NETO_2019_VTAS_TRAS_7USD =   2473 ;  } else { $NETO_2019_VTAS_TRAS_7USD = $row['NETO_2019_VTAS_TRAS_7USD'] + 2473; } 
            $PUBLICO_2019_VTAS_TRAS_7USD = $row["PUBLICO_2019_VTAS_TRAS_7USD"]; if (empty($PUBLICO_2019_VTAS_TRAS_7USD)) { $PUBLICO_2019_VTAS_TRAS_7USD =  5346 ;  } else { $PUBLICO_2019_VTAS_TRAS_7USD = $row['PUBLICO_2019_VTAS_TRAS_7USD'] + 5346 ; } 
            $TOT_PAX_2019 = $row["TOTAL_PAX_2019"]; if (empty($TOT_PAX_2019)) { $TOT_PAX_2019 = 21 ;  } else { $TOT_PAX_2019 = $row['TOTAL_PAX_2019'] + 21 ; } 
            
            
            
            // $query7 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ULTRAMAR',   SUM(Total) 'PUBLICO_2019_VTAS_ULTRAMAR', 
//                               SUM(NoPeople) 'TOTAL_PAX_ULTRAMAR_2019' 
//	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
//	                           WHERE isDeleted = 0 AND  Services_Name  = TRIM('VUELO') AND offline = 1 AND Id_Status = 3
//                               AND TypeService = TRIM('Aerolínea') AND Id_productos = 276 
//                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
//            
            $query7 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ULTRAMAR',   SUM(Total) 'PUBLICO_2019_VTAS_ULTRAMAR', 
                               SUM(NoPeople) 'TOTAL_PAX_ULTRAMAR_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 276  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt7 = $conn->prepare($query7);
			$stmt7->execute();
        	$row = $stmt7->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_ULTRAMAR = $row["NETO_2019_VTAS_ULTRAMAR"]; if (empty($NETO_2019_VTAS_ULTRAMAR)) { $NETO_2019_VTAS_ULTRAMAR =  18359 ;  } else { $NETO_2019_VTAS_ULTRAMAR = $row['NETO_2019_VTAS_ULTRAMAR'] + 18359; } 
            $PUBLICO_2019_VTAS_ULTRAMAR = $row["PUBLICO_2019_VTAS_ULTRAMAR"]; if (empty($PUBLICO_2019_VTAS_ULTRAMAR)) { $PUBLICO_2019_VTAS_ULTRAMAR =  22624 ;  } else { $PUBLICO_2019_VTAS_ULTRAMAR = $row['PUBLICO_2019_VTAS_ULTRAMAR'] + 22624 ; } 
            $TOTAL_PAX_ULTRAMAR_2019 = $row["TOTAL_PAX_ULTRAMAR_2019"]; if (empty($TOTAL_PAX_ULTRAMAR_2019)) { $TOTAL_PAX_ULTRAMAR_2019 = 0 ;  } else { $TOTAL_PAX_ULTRAMAR_2019 = $row['TOTAL_PAX_ULTRAMAR_2019'] ; } 
            
            
        $query9 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_ALOHAKAI',   SUM(Total) 'PUBLICO_2019_VTAS_ALOHAKAI', 
                               SUM(NoPeople) 'TOTAL_PAX_ALOHAKAI_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 283  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt9 = $conn->prepare($query9);
			$stmt9->execute();
        	$row = $stmt9->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_ALOHAKAI = $row["NETO_2019_VTAS_ALOHAKAI"]; if (empty($NETO_2019_VTAS_ALOHAKAI)) { $NETO_2019_VTAS_ALOHAKAI =  0 ;  } 
            $PUBLICO_2019_VTAS_ALOHAKAI = $row["PUBLICO_2019_VTAS_ALOHAKAI"]; if (empty($PUBLICO_2019_VTAS_ALOHAKAI)) { $PUBLICO_2019_VTAS_ALOHAKAI =  0 ;  } 
            $TOTAL_PAX_ALOHAKAI_2019 = $row["TOTAL_PAX_ALOHAKAI_2019"]; if (empty($TOTAL_PAX_ALOHAKAI_2019)) { $TOTAL_PAX_ALOHAKAI_2019 = 0 ;  }  
            
        
        
        
           $query10 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_AZULTRAVEL',   SUM(Total) 'PUBLICO_2019_VTAS_AZULTRAVEL', 
                               SUM(NoPeople) 'TOTAL_PAX_AZULTRAVEL_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 284  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt10 = $conn->prepare($query10);
			$stmt10->execute();
        	$row = $stmt10->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_AZULTRAVEL = $row["NETO_2019_VTAS_AZULTRAVEL"]; if (empty($NETO_2019_VTAS_AZULTRAVEL)) { $NETO_2019_VTAS_AZULTRAVEL =  0 ;  } 
            $PUBLICO_2019_VTAS_AZULTRAVEL = $row["PUBLICO_2019_VTAS_AZULTRAVEL"]; if (empty($PUBLICO_2019_VTAS_AZULTRAVEL)) { $PUBLICO_2019_VTAS_AZULTRAVEL =  0 ;  }  
            $TOTAL_PAX_AZULTRAVEL_2019 = $row["TOTAL_PAX_AZULTRAVEL_2019"]; if (empty($TOTAL_PAX_AZULTRAVEL_2019)) { $TOTAL_PAX_AZULTRAVEL_2019 = 0 ;  } 
            
        
        
        
        
        
        $query8 =" SELECT SUM(Subtotal) 'NETO_2019_VTAS_GPH',   SUM(Total) 'PUBLICO_2019_VTAS_GPH', 
                               SUM(NoPeople) 'TOTAL_PAX_GPH_2019' 
	                           FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                           WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3
                                 AND Id_productos = 278  
                               AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt8 = $conn->prepare($query8);
			$stmt8->execute();
        	$row = $stmt8->fetch(PDO::FETCH_ASSOC);
            $NETO_2019_VTAS_GPH = $row["NETO_2019_VTAS_GPH"]; if (empty($NETO_2019_VTAS_GPH)) { $NETO_2019_VTAS_GPH =  $NETO_2019_VTAS_GPH ;  } else { $NETO_2019_VTAS_GPH = $row['NETO_2019_VTAS_GPH'] ; } 
            $PUBLICO_2019_VTAS_GPH = $row["PUBLICO_2019_VTAS_GPH"]; if (empty($PUBLICO_2019_VTAS_GPH)) { $PUBLICO_2019_VTAS_GPH =  $PUBLICO_2019_VTAS_GPH ;  } else { $PUBLICO_2019_VTAS_GPH = $row['PUBLICO_2019_VTAS_GPH']  ; } 
            $TOTAL_PAX_GPH_2019 = $row["TOTAL_PAX_GPH_2019"]; if (empty($TOTAL_PAX_GPH_2019)) { $TOTAL_PAX_GPH_2019 = 0 ;  } else { $TOTAL_PAX_GPH_2019 = $row['TOTAL_PAX_GPH_2019'] ; } 
            
        
        
        
        
        
         $query1b =" SELECT SUM(NoPeople) 'TOTAL_PAX_GRATIS_2019' 
	                            FROM VISTA__CIFRAS_OKTRIP_CONSOLIDADO_FINAL 
	                            WHERE isDeleted = 0 AND  offline = 1 AND Id_Status = 3 AND TypeService = 'Transportación' AND Id_productos = 233 
	                            AND DateTo BETWEEN CAST('2019-02-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt1b = $conn->prepare($query1b);
			$stmt1b->execute();
        	$row = $stmt1b->fetch(PDO::FETCH_ASSOC);
            $TOTAL_PAX_GRATIS_2019 = $row["TOTAL_PAX_GRATIS_2019"]; if (empty($TOTAL_PAX_GRATIS_2019)) { $TOTAL_PAX_GRATIS_2019 = 3 ;  } else { $TOTAL_PAX_GRATIS_2019 = $row['TOTAL_PAX_GRATIS_2019'] + 3 ; } 
            
        


          $query1c =" SELECT   SUM(paxxx) 'TOT_PAX_IN_2019'  FROM volaris WHERE fecha_llegada <> '0000-00-00'
                            AND isDeleted = 0   AND fecha_llegada BETWEEN CAST('2019-01-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt1c = $conn->prepare($query1c);
			$stmt1c->execute();
        	$row = $stmt1c->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_IN_2019 = $row["TOT_PAX_IN_2019"]; if (empty($TOT_PAX_IN_2019)) { $TOT_PAX_IN_2019 = 348 ;  } else { $TOT_PAX_IN_2019 = $row['TOT_PAX_IN_2019'] + 348 ; } 
            $TOT_PAX_IN_2019 = $row["TOT_PAX_IN_2019"]; if (empty($TOT_PAX_IN_2019)) { $TOT_PAX_IN_2019 = $TOT_PAX_IN_2019 ;  } else { $TOT_PAX_IN_2019 = $row['TOT_PAX_IN_2019']  ; } 
         
        
        
        $query1d =" SELECT   SUM(paxxx) 'TOT_PAX_OUT_2019'  FROM volaris WHERE fecha_salida <> '0000-00-00'
                                             AND isDeleted = 0   AND fecha_salida BETWEEN CAST('2019-01-01' AS DATE) AND CAST('2019-12-31' AS DATE) ;  "; 
       		$stmt1d = $conn->prepare($query1d);
			$stmt1d->execute();
        	$row = $stmt1d->fetch(PDO::FETCH_ASSOC);
        // $TOT_PAX_OUT_2019 = $row["TOT_PAX_OUT_2019"]; if (empty($TOT_PAX_OUT_2019)) { $TOT_PAX_OUT_2019 = 346 ;  } else { $TOT_PAX_OUT_2019 = $row['TOT_PAX_OUT_2019'] + 346 ; } 
            $TOT_PAX_OUT_2019 = $row["TOT_PAX_OUT_2019"]; if (empty($TOT_PAX_OUT_2019)) { $TOT_PAX_OUT_2019 = $TOT_PAX_OUT_2019 ;  } else { $TOT_PAX_OUT_2019 = $row['TOT_PAX_OUT_2019'] ; } 
            
            
        
        
$TOT_N_2019  = $NETO_2019_VTAS_WEB + $NETO_2019_VTAS_OFFLINE +  $NETO_2019_VTAS_OFFLINE_REPS + $NETO_2019_VTAS_TRAS_7USD + $NETO_2019_VTAS_ULTRAMAR + $NETO_2019_VTAS_GPH + $NETO_2019_VTAS_ALOHAKAI + $NETO_2019_VTAS_AZULTRAVEL ;
$TOT_P_2019  = $PUBLICO_2019_VTAS_WEB + $PUBLICO_2019_VTAS_OFFLINE + $PUBLICO_2019_VTAS_OFFLINE_REPS +  $PUBLICO_2019_VTAS_TRAS_7USD + $PUBLICO_2019_VTAS_ULTRAMAR + $PUBLICO_2019_VTAS_GPH + $PUBLICO_2019_VTAS_ALOHAKAI + $PUBLICO_2019_VTAS_AZULTRAVEL  ;
$TOT_PAX      =  $TOTAL_PAX_WEB_2019 + $TOTAL_PAX_OFFLINE_2019 + $TOTAL_PAX_OFFLINE_REPS_2019 +  $TOT_PAX_2019 + $TOTAL_PAX_GRATIS_2019 + $TOTAL_PAX_ULTRAMAR_2019 + $TOT_PAX_IN_2019 + $TOT_PAX_OUT_2019 + $TOTAL_PAX_GPH_2019 + $TOTAL_PAX_ALOHAKAI_2019 + $TOTAL_PAX_AZULTRAVEL_2019  ;
$GRAN_TOT = $TOT_N_2019 + $TOT_P_2019;         

            
       /* Hasta aqui son los grandes totales, los que se muestran de manera individual */
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
	/*		$query1a ="SELECT SUM(Total) 'Tot_Pub_Ene',  SUM(Subtotal) 'Tot_Net_Ene' ,  SUM(NoPeople) 'Tot_Pax_Ene'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (0,1) 
                                AND DateTo BETWEEN   CAST('".$Ene_1."' AS DATE) AND CAST('".$Ene_2."' AS DATE) ORDER BY Id DESC ;"; 
       		$stmt1a = $conn->prepare($query1a);
			$stmt1a->execute();
        	$row = $stmt1a->fetch(PDO::FETCH_ASSOC);
			$Tot_Pub_Ene = $row['Tot_Pub_Ene'];
			$Tot_Net_Ene = $row['Tot_Net_Ene'];
            $Tot_Pax_Ene = $row['Tot_Pax_Ene'];  Enero no se calculo, fueron datos fijos*/
        
         $query2b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Feb',  ROUND(SUM(Subtotal)) 'Web_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0)  AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2b = $conn->prepare($query2b);
			$stmt2b->execute();
        	$row = $stmt2b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Feb = $row['Web_Pub_Feb'];
			$Web_Net_Feb = $row['Web_Net_Feb'];
            $Web_Pax_Feb = $row['Web_Pax_Feb'];
        
         $query2a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Feb',  ROUND(SUM(Subtotal)) 'Off_Net_Feb' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Feb'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ;"; 
       		$stmt2a = $conn->prepare($query2a);
			$stmt2a->execute();
        	$row = $stmt2a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Feb = $row['Off_Pub_Feb'];
			$Off_Net_Feb = $row['Off_Net_Feb'];
            $Off_Pax_Feb = $row['Off_Pax_Feb'];
        
         $query2c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Feb' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Feb_1."' AS DATE) AND CAST('".$Feb_2."' AS DATE) ; "; 
       		$stmt2c = $conn->prepare($query2c);
			$stmt2c->execute();
        	$row = $stmt2c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Feb = $row['V_Paxxx_Feb']; if (empty($V_Paxxx_Feb)) {$V_Paxxx_Feb = 0; }
            $TotPaxFebOff_V = $Off_Pax_Feb + $V_Paxxx_Feb ;
        
$Tot_Pub_Feb = $Web_Pub_Feb + $Off_Pub_Feb;
$Tot_Net_Feb = $Web_Net_Feb + $Off_Net_Feb;
$Tot_Pax_Feb = $Web_Pax_Feb + $Off_Pax_Feb ; 
        
        
        
        
        $query3b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Mar',  ROUND(SUM(Subtotal)) 'Web_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3b = $conn->prepare($query3b);
			$stmt3b->execute();
        	$row = $stmt3b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Mar = $row['Web_Pub_Mar'];
			$Web_Net_Mar = $row['Web_Net_Mar'];
            $Web_Pax_Mar = $row['Web_Pax_Mar'];
        
        
        $query3a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Mar',  ROUND(SUM(Subtotal)) 'Off_Net_Mar' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Mar'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ;"; 
       		$stmt3a = $conn->prepare($query3a);
			$stmt3a->execute();
        	$row = $stmt3a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Mar = $row['Off_Pub_Mar'];
			$Off_Net_Mar = $row['Off_Net_Mar'];
            $Off_Pax_Mar = $row['Off_Pax_Mar'];
        
        $query3c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Mar' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Mar_1."' AS DATE) AND CAST('".$Mar_2."' AS DATE) ; "; 
       		$stmt3c = $conn->prepare($query3c);
			$stmt3c->execute();
        	$row = $stmt3c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Mar = $row['V_Paxxx_Mar']; if (empty($V_Paxxx_Mar)) {$V_Paxxx_Mar = 0; }
         $TotPaxMarOff_V = $Off_Pax_Mar + $V_Paxxx_Mar ;
        
$Tot_Pub_Mar = $Web_Pub_Mar + $Off_Pub_Mar;
$Tot_Net_Mar = $Web_Net_Mar + $Off_Net_Mar;
$Tot_Pax_Mar = $Web_Pax_Mar + $Off_Pax_Mar ;
        
        
        
        
        
        
        
        
        $query4b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Abr',  ROUND(SUM(Subtotal)) 'Web_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4b = $conn->prepare($query4b);
			$stmt4b->execute();
        	$row = $stmt4b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Abr = $row['Web_Pub_Abr'];
			$Web_Net_Abr = $row['Web_Net_Abr'];
            $Web_Pax_Abr = $row['Web_Pax_Abr'];
        
        
        
        $query4a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Abr',  ROUND(SUM(Subtotal)) 'Off_Net_Abr' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Abr'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ;"; 
       		$stmt4a = $conn->prepare($query4a);
			$stmt4a->execute();
        	$row = $stmt4a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Abr = $row['Off_Pub_Abr'];
			$Off_Net_Abr = $row['Off_Net_Abr'];
            $Off_Pax_Abr = $row['Off_Pax_Abr'];
        
            $query4c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Abr' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Abr_1."' AS DATE) AND CAST('".$Abr_2."' AS DATE) ; "; 
       		$stmt4c = $conn->prepare($query4c);
			$stmt4c->execute();
        	$row = $stmt4c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Abr = $row['V_Paxxx_Abr']; if (empty($V_Paxxx_Abr)) {$V_Paxxx_Abr = 0; }
            $TotPaxAbrOff_V = $Off_Pax_Abr + $V_Paxxx_Abr ;   
        
$Tot_Pub_Abr = $Web_Pub_Abr + $Off_Pub_Abr;
$Tot_Net_Abr = $Web_Net_Abr + $Off_Net_Abr;
$Tot_Pax_Abr = $Web_Pax_Abr + $Off_Pax_Abr ;
        
        
        
        
       
        
         $query5b ="SELECT ROUND(SUM(Total)) 'Web_Pub_May',  ROUND(SUM(Subtotal)) 'Web_Net_May' ,  ROUND(SUM(NoPeople)) 'Web_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5b = $conn->prepare($query5b);
			$stmt5b->execute();
        	$row = $stmt5b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_May = $row['Web_Pub_May'];
			$Web_Net_May = $row['Web_Net_May'];
            $Web_Pax_May = $row['Web_Pax_May'];
        
        
        $query5a ="SELECT ROUND(SUM(Total)) 'Off_Pub_May',  ROUND(SUM(Subtotal)) 'Off_Net_May' ,  ROUND(SUM(NoPeople)) 'Off_Pax_May'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE)  ;"; 
       		$stmt5a = $conn->prepare($query5a);
			$stmt5a->execute();
        	$row = $stmt5a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_May = $row['Off_Pub_May'];
			$Off_Net_May = $row['Off_Net_May'];
            $Off_Pax_May = $row['Off_Pax_May'];
        
          $query5c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_May' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$May_1."' AS DATE) AND CAST('".$May_2."' AS DATE) ; "; 
       		$stmt5c = $conn->prepare($query5c);
			$stmt5c->execute();
        	$row = $stmt5c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_May = $row['V_Paxxx_May']; if (empty($V_Paxxx_May)) {$V_Paxxx_May = 0; }
            $TotPaxMayOff_V = $Off_Pax_May + $V_Paxxx_May ;
        
        
$Tot_Pub_May = $Web_Pub_May + $Off_Pub_May;
$Tot_Net_May = $Web_Net_May + $Off_Net_May;
$Tot_Pax_May = $Web_Pax_May + $Off_Pax_May ;
			
		    
        
        $query6b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jun',  ROUND(SUM(Subtotal)) 'Web_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6b = $conn->prepare($query6b);
			$stmt6b->execute();
        	$row = $stmt6b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jun = $row['Web_Pub_Jun'];
			$Web_Net_Jun = $row['Web_Net_Jun'];
            $Web_Pax_Jun = $row['Web_Pax_Jun'];
        
        $query6a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jun',  ROUND(SUM(Subtotal)) 'Off_Net_Jun' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jun'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ;"; 
       		$stmt6a = $conn->prepare($query6a);
			$stmt6a->execute();
        	$row = $stmt6a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jun = $row['Off_Pub_Jun'];
			$Off_Net_Jun = $row['Off_Net_Jun'];
            $Off_Pax_Jun = $row['Off_Pax_Jun'];
    
           $query6c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Jun' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Jun_1."' AS DATE) AND CAST('".$Jun_2."' AS DATE) ; "; 
       		$stmt6c = $conn->prepare($query6c);
			$stmt6c->execute();
        	$row = $stmt6c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Jun = $row['V_Paxxx_Jun']; if (empty($V_Paxxx_Jun)) {$V_Paxxx_Jun = 0; }
            $TotPaxJunOff_V = $Off_Pax_Jun + $V_Paxxx_Jun ;
        
        
        
$Tot_Pub_Jun = $Web_Pub_Jun + $Off_Pub_Jun;
$Tot_Net_Jun = $Web_Net_Jun + $Off_Net_Jun;
$Tot_Pax_Jun = $Web_Pax_Jun + $Off_Pax_Jun ;
        
        
        
        
        $query7b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Jul',  ROUND(SUM(Subtotal)) 'Web_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7b = $conn->prepare($query7b);
			$stmt7b->execute();
        	$row = $stmt7b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Jul = $row['Web_Pub_Jul'];
			$Web_Net_Jul = $row['Web_Net_Jul'];
            $Web_Pax_Jul = $row['Web_Pax_Jul'];
        
        $query7a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Jul',  ROUND(SUM(Subtotal)) 'Off_Net_Jul' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Jul'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ;"; 
       		$stmt7a = $conn->prepare($query7a);
			$stmt7a->execute();
        	$row = $stmt7a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Jul = $row['Off_Pub_Jul'];
			$Off_Net_Jul = $row['Off_Net_Jul'];
            $Off_Pax_Jul = $row['Off_Pax_Jul'];
        
        $query7c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Jul' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Jul_1."' AS DATE) AND CAST('".$Jul_2."' AS DATE) ; "; 
       		$stmt7c = $conn->prepare($query7c);
			$stmt7c->execute();
        	$row = $stmt7c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Jul = $row['V_Paxxx_Jul']; if (empty($V_Paxxx_Jul)) {$V_Paxxx_Jul = 0; }
            $TotPaxJulOff_V = $Off_Pax_Jul + $V_Paxxx_Jul ;
        
        
$Tot_Pub_Jul = $Web_Pub_Jul + $Off_Pub_Jul;
$Tot_Net_Jul = $Web_Net_Jul + $Off_Net_Jul;
$Tot_Pax_Jul = $Web_Pax_Jul + $Off_Pax_Jul ;
        
        
        
        
        $query8b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Ago',  ROUND(SUM(Subtotal)) 'Web_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8b = $conn->prepare($query8b);
			$stmt8b->execute();
        	$row = $stmt8b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Ago = $row['Web_Pub_Ago'];
			$Web_Net_Ago = $row['Web_Net_Ago'];
            $Web_Pax_Ago = $row['Web_Pax_Ago'];
        
         $query8a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Ago',  ROUND(SUM(Subtotal)) 'Off_Net_Ago' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Ago'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE)  ;"; 
       		$stmt8a = $conn->prepare($query8a);
			$stmt8a->execute();
        	$row = $stmt8a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Ago = $row['Off_Pub_Ago'];
			$Off_Net_Ago = $row['Off_Net_Ago'];
            $Off_Pax_Ago = $row['Off_Pax_Ago'];
        
        $query8c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Ago' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Ago_1."' AS DATE) AND CAST('".$Ago_2."' AS DATE) ; "; 
       		$stmt8c = $conn->prepare($query8c);
			$stmt8c->execute();
        	$row = $stmt8c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Ago = $row['V_Paxxx_Ago']; if (empty($V_Paxxx_Ago)) {$V_Paxxx_Ago = 0; }
            $TotPaxAgoOff_V = $Off_Pax_Ago + $V_Paxxx_Ago ;
        
        
$Tot_Pub_Ago = $Web_Pub_Ago + $Off_Pub_Ago;
$Tot_Net_Ago = $Web_Net_Ago + $Off_Net_Ago;
$Tot_Pax_Ago = $Web_Pax_Ago + $Off_Pax_Ago ;
        
        
        
        
        $query9b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Sep',  ROUND(SUM(Subtotal)) 'Web_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9b = $conn->prepare($query9b);
			$stmt9b->execute();
        	$row = $stmt9b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Sep = $row['Web_Pub_Sep'];
			$Web_Net_Sep = $row['Web_Net_Sep'];
            $Web_Pax_Sep = $row['Web_Pax_Sep'];
        
        $query9a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Sep',  ROUND(SUM(Subtotal)) 'Off_Net_Sep' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Sep'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE)  ;"; 
       		$stmt9a = $conn->prepare($query9a);
			$stmt9a->execute();
        	$row = $stmt9a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Sep = $row['Off_Pub_Sep'];
			$Off_Net_Sep = $row['Off_Net_Sep'];
            $Off_Pax_Sep = $row['Off_Pax_Sep'];
       
        $query9c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Sep' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Sep_1."' AS DATE) AND CAST('".$Sep_2."' AS DATE) ; "; 
       		$stmt9c = $conn->prepare($query9c);
			$stmt9c->execute();
        	$row = $stmt9c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Sep = $row['V_Paxxx_Sep']; if (empty($V_Paxxx_Sep)) {$V_Paxxx_Sep = 0; }
            $TotPaxSepOff_V = $Off_Pax_Sep + $V_Paxxx_Sep ;
        
        
$Tot_Pub_Sep = $Web_Pub_Sep + $Off_Pub_Sep;
$Tot_Net_Sep = $Web_Net_Sep + $Off_Net_Sep;
$Tot_Pax_Sep = $Web_Pax_Sep + $Off_Pax_Sep ;
        
        
        $query10b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Oct',  ROUND(SUM(Subtotal)) 'Web_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10b = $conn->prepare($query10b);
			$stmt10b->execute();
        	$row = $stmt10b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Oct = $row['Web_Pub_Oct'];
			$Web_Net_Oct = $row['Web_Net_Oct'];
            $Web_Pax_Oct = $row['Web_Pax_Oct'];
        
        $query10a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Oct',  ROUND(SUM(Subtotal)) 'Off_Net_Oct' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Oct'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE)  ;"; 
       		$stmt10a = $conn->prepare($query10a);
			$stmt10a->execute();
        	$row = $stmt10a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Oct = $row['Off_Pub_Oct'];
			$Off_Net_Oct = $row['Off_Net_Oct'];
            $Off_Pax_Oct = $row['Off_Pax_Oct'];
    
        $query10c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Oct' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Oct_1."' AS DATE) AND CAST('".$Oct_2."' AS DATE) ; "; 
       		$stmt10c = $conn->prepare($query10c);
			$stmt10c->execute();
        	$row = $stmt10c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Oct = $row['V_Paxxx_Oct']; if (empty($V_Paxxx_Oct)) {$V_Paxxx_Oct = 0; }
            $TotPaxOctOff_V = $Off_Pax_Oct + $V_Paxxx_Oct ;
        
        
$Tot_Pub_Oct = $Web_Pub_Oct + $Off_Pub_Oct;
$Tot_Net_Oct = $Web_Net_Oct + $Off_Net_Oct;
$Tot_Pax_Oct = $Web_Pax_Oct + $Off_Pax_Oct ;
        
        
        
        
         $query11b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Nov',  ROUND(SUM(Subtotal)) 'Web_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11b = $conn->prepare($query11b);
			$stmt11b->execute();
        	$row = $stmt11b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Nov = $row['Web_Pub_Nov'];
			$Web_Net_Nov = $row['Web_Net_Nov'];
            $Web_Pax_Nov = $row['Web_Pax_Nov'];
        
        $query11a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Nov',  ROUND(SUM(Subtotal)) 'Off_Net_Nov' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Nov'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE)  ;"; 
       		$stmt11a = $conn->prepare($query11a);
			$stmt11a->execute();
        	$row = $stmt11a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Nov = $row['Off_Pub_Nov'];
			$Off_Net_Nov = $row['Off_Net_Nov'];
            $Off_Pax_Nov = $row['Off_Pax_Nov'];
        
        $query11c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Nov' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Nov_1."' AS DATE) AND CAST('".$Nov_2."' AS DATE) ; "; 
       		$stmt11c = $conn->prepare($query11c);
			$stmt11c->execute();
        	$row = $stmt11c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Nov = $row['V_Paxxx_Nov']; if (empty($V_Paxxx_Nov)) {$V_Paxxx_Nov = 0; }
            $TotPaxNovOff_V = $Off_Pax_Nov + $V_Paxxx_Nov ;
        
        
$Tot_Pub_Nov = $Web_Pub_Nov + $Off_Pub_Nov;
$Tot_Net_Nov = $Web_Net_Nov + $Off_Net_Nov;
$Tot_Pax_Nov = $Web_Pax_Nov + $Off_Pax_Nov ;
        
        
        $query12b ="SELECT ROUND(SUM(Total)) 'Web_Pub_Dic',  ROUND(SUM(Subtotal)) 'Web_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Web_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE  Offline IN (0) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12b = $conn->prepare($query12b);
			$stmt12b->execute();
        	$row = $stmt12b->fetch(PDO::FETCH_ASSOC);
			$Web_Pub_Dic = $row['Web_Pub_Dic'];
			$Web_Net_Dic = $row['Web_Net_Dic'];
            $Web_Pax_Dic = $row['Web_Pax_Dic'];
        
        $query12a ="SELECT ROUND(SUM(Total)) 'Off_Pub_Dic',  ROUND(SUM(Subtotal)) 'Off_Net_Dic' ,  ROUND(SUM(NoPeople)) 'Off_Pax_Dic'  
                                FROM VISTA__GRAN_TOT_VTAS
                                WHERE isDeleted = 0 AND  Id_Status = 3 AND Offline IN (1) 
                                AND DateTo BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE)  ;"; 
       		$stmt12a = $conn->prepare($query12a);
			$stmt12a->execute();
        	$row = $stmt12a->fetch(PDO::FETCH_ASSOC);
			$Off_Pub_Dic = $row['Off_Pub_Dic'];
			$Off_Net_Dic = $row['Off_Net_Dic'];
            $Off_Pax_Dic = $row['Off_Pax_Dic'];
      
        $query12c ="SELECT ROUND(SUM(Paxxx)) 'V_Paxxx_Dic' FROM volaris 
                              WHERE isDeleted = 0 AND fecha_llegada  BETWEEN   CAST('".$Dic_1."' AS DATE) AND CAST('".$Dic_2."' AS DATE) ; "; 
       		$stmt12c = $conn->prepare($query12c);
			$stmt12c->execute();
        	$row = $stmt12c->fetch(PDO::FETCH_ASSOC);
			$V_Paxxx_Dic = $row['V_Paxxx_Dic']; if (empty($V_Paxxx_Dic)) {$V_Paxxx_Dic = 0; }
            $TotPaxDicOff_V = $Off_Pax_Dic + $V_Paxxx_Dic ;
        
		$Tot_Pub_Dic = $Web_Pub_Dic + $Off_Pub_Dic;
		$Tot_Net_Dic = $Web_Net_Dic + $Off_Net_Dic;
		$Tot_Pax_Dic = $Web_Pax_Dic + $Off_Pax_Dic; 
			
        
        
        
        
        
        
        
		include("views/Sales/dashboard_indicators_oktrip.php");
}
        catch (Exception $e)
        {
	 	echo "Algo se debe solucionar: ".$e;
        }


	
}

    






/* █████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████████*/    
/* █████████████████████████████████████████████████████████٩(●̮̮̃•̃)۶	٩(●̮̮̃•̃)۶ █████████████████████████████████████████████████████████████████*/
	
	

	
public function getTourscontenedor(){
        
    session_start();
	try{

	 
        $total_registros = 0;
        
		$lista = array();
        $db = new db();
		$conn = $db->conn_local();
		
		  
		  
		  
		  
		
$query_xlocalidades = "SELECT Id_xlocalidades, xlocalidades FROM xlocalidades WHERE isdeleted = 0 ORDER BY Id_xlocalidades ASC ;";   			
//print $query_xlocalidades;
$stmt_xlocalidades = $conn->prepare($query_xlocalidades);
$stmt_xlocalidades->execute();
$rows = $stmt_xlocalidades->fetchAll(PDO::FETCH_ASSOC);
//print_r($rows);
$combo_xlocalidades = array();
foreach ($rows as $row) {

				$i_xlocalidades = new ttoouurrss_row(); 
                $i_xlocalidades->setId_xlocalidades($row['Id_xlocalidades']);
				$i_xlocalidades->setxlocalidades($row['xlocalidades']);
				array_push($combo_xlocalidades, $i_xlocalidades);

			}
		 
		//print $query;
		$stmt = $conn->prepare($query);             
        $stmt->execute();               
		$count = $stmt->rowCount();
		if($count > 0){

			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$lista = array();
			foreach ($rows as $row) {

				$ttoouurrss = new ttoouurrss_row(); /* nueva instancia   */
                $ttoouurrss->setId_xtours($row['Id_xtours']);
				$ttoouurrss->settitulo($row['titulo']);
				$ttoouurrss->setsemblanza($row['semblanza']);
				$ttoouurrss->setId_xtipotours($row['Id_xtipotours']);
				$ttoouurrss->setId_xcategorias($row['Id_xcategorias']);
				$ttoouurrss->setId_xproveedores($row['Id_xproveedores']);
				$ttoouurrss->setId_xlocalidades($row['Id_xlocalidades']);
				$ttoouurrss->setpath_imagen($row['path_imagen']);
				$ttoouurrss->setdescripcion($row['descripcion']);
				$ttoouurrss->setincluye($row['incluye']);
				$ttoouurrss->setinformacion_adicional($row['informacion_adicional']);
				$ttoouurrss->setprecio_pesos($row['precio_pesos']);
				$ttoouurrss->setdescription($row['description']);
				$ttoouurrss->setincludes($row['includes']);
				$ttoouurrss->setadditional_info($row['additional_info']);
				$ttoouurrss->setprice_dollars($row['price_dollars']);
				$ttoouurrss->setxcategorias($row['xcategorias']);
				$ttoouurrss->setxlocalidades($row['xlocalidades']);
				$ttoouurrss->setxproveedores($row['xproveedores']);
				$ttoouurrss->setxtipotours($row['xtipotours']);
				array_push($lista, $ttoouurrss);

			}
              
			  
			  
			  
			$query2 ="SELECT  SUM(Id_xtours) 'Tot_Registros' 
                              FROM VISTA__TOURS
                              WHERE isdeleted = 0 ;"; 
           // print $query2;
       		$stmt2 = $conn->prepare($query2);
			$stmt2->execute();
			$count2 = $stmt2->rowCount();
            if($count2 > 0){
					$row = $stmt2->fetch(PDO::FETCH_ASSOC);
					//print_r($row);
					$total_pax = $row['Id_xtours'];
					$total_registros = $count2; // <--ojo con este, hay que checarlo con calma despues

			}
			else
			    $bandera = 1; 	//echo "Falla en la sumatoria";
		}
		else
			$count= 0;
                       
         
	 	include ("views/Sales/Vtas_Tours_Contenedor.php");


	} 
    catch (Exception $e)
    {
	 	echo "Error fatal: ".$e;
	 }

}
 
	
	
	
	public function getAltatoursss(){
	session_start();


	if(isset($_SESSION["user"])){
		$db = new databaseController();
		
		include("views/Sales/◣_◢   alta de tours.php");
	}
	else
	{
		header( "Location: /panel/login");
	}
  }

	
	
	
	
	
	
	
	
	public function postAltatoursss(){
try
	{
        
$nombre_completo        = $_POST["nombre_completo"];
$no_reserva                     = $_POST["no_reserva"];
$empresa                         = $_POST["empresa"];
$paxxx                              = $_POST["paxxx"];
$fecha_llegada = $_POST["fecha_llegada"]; if (empty($fecha_llegada)) { $fecha_llegada = 0 ;  } else { $fecha_llegada = $_POST['fecha_llegada'] ; } 
$servicio_llegada = $_POST["servicio_llegada"]; if (empty($servicio_llegada)) { $servicio_llegada = 0 ;  } else { $servicio_llegada = $_POST['servicio_llegada'] ; } 
$no_vuelo_llegada = $_POST["no_vuelo_llegada"]; if (empty($no_vuelo_llegada)) { $no_vuelo_llegada = 0 ;  } else { $no_vuelo_llegada = $_POST['no_vuelo_llegada'] ; } 
$hora_vuelo_llegada = $_POST["hora_vuelo_llegada"]; if (empty($hora_vuelo_llegada)) { $hora_vuelo_llegada = '00:00' ;  } else { $hora_vuelo_llegada = $_POST['hora_vuelo_llegada'] ; }     
$hora_pickup_llegada = $_POST["hora_pickup_llegada"]; if (empty($hora_pickup_llegada)) { $hora_pickup_llegada = '00:00' ;  } else { $hora_pickup_llegada = $_POST['hora_pickup_llegada'] ; }     
$uni_llegada                   = $_POST["uni_llegada"];
$operador_llegada        = $_POST["operador_llegada"];
$fecha_salida = $_POST["fecha_salida"]; if (empty($fecha_salida)) { $fecha_salida = 0 ;  } else { $fecha_salida = $_POST['fecha_salida'] ; } 
$servicio_salida = $_POST["servicio_salida"]; if (empty($servicio_salida)) { $servicio_salida = 0 ;  } else { $servicio_salida = $_POST['servicio_salida'] ; }     
$no_vuelo_salida = $_POST["no_vuelo_salida"]; if (empty($no_vuelo_salida)) { $no_vuelo_salida = 0 ;  } else { $no_vuelo_salida = $_POST['no_vuelo_salida'] ; } 
$hora_vuelo_salida = $_POST["hora_vuelo_salida"]; if (empty($hora_vuelo_salida)) { $hora_vuelo_salida = '00:00' ;  } else { $hora_vuelo_salida = $_POST['hora_vuelo_salida'] ; }     
$hora_pickup_salida = $_POST["hora_pickup_salida"]; if (empty($hora_pickup_salida)) { $hora_pickup_salida = '00:00' ;  } else { $hora_pickup_salida = $_POST['hora_pickup_salida'] ; }     
$uni_salida           = $_POST["uni_salida"];
$operador_salida           = $_POST["operador_salida"];
$comentarios = $_POST["comentarios"]; if (empty($comentarios)) { $comentarios = 's/c' ;  } else { $comentarios = $_POST['comentarios'] ; }     
  //  print  $operador_llegada.'<------------$unidad_llegada '. $operador_salida.'<---$unidad_salida' ;  
    
        $d1 = substr($fecha_llegada,3,2);		$m1 = substr($fecha_llegada,0,2);  	$a1 = substr($fecha_llegada,6,4);
        $d2 = substr($fecha_salida,3,2);   $m2 = substr($fecha_salida,0,2);  $a2 = substr($fecha_salida,6,4);
        $fecha_llegada = $a1."-".$m1."-".$d1;    	   $fecha_salida = $a2."-".$m2."-".$d2;
		//$Objeto_Fecha_1 = date_create_from_format('Y-m-d', $Fecha_1); 
        //$Objeto_Fecha_2 = date_create_from_format('Y-m-d', $Fecha_2);
    
    

          
$db = new db();
$conn = $db->conn_local();
$query2 =" INSERT INTO volaris (nombre_completo, fecha_llegada, servicio_llegada, no_vuelo_llegada, hora_vuelo_llegada, hora_pickup_llegada, paxxx,
                                                           empresa, unidad_llegada, operador_llegada, no_reserva, fecha_salida, servicio_salida, no_vuelo_salida, hora_vuelo_salida, 
                                                           hora_pickup_salida, unidad_salida, operador_salida, fecha_captura, comentarios)
	                                     VALUES ('$nombre_completo', '$fecha_llegada', '$servicio_llegada', $no_vuelo_llegada, '$hora_vuelo_llegada', '$hora_pickup_llegada', $paxxx, '$empresa', $uni_llegada, '$operador_llegada', $no_reserva, '$fecha_salida', '$servicio_salida',
	                                                       $no_vuelo_salida, '$hora_vuelo_salida' , '$hora_pickup_salida', $uni_salida, '$operador_salida', NOW(), '$comentarios' ) ;"; 
// print $query2;
$stmt2 = $conn->prepare($query2);
$stmt2->execute();

  header( "Location: /ventas/◣_◢   alta de tours.php");   

	}
            catch(Exception $e)
            {
                print_r($e);
            }

}


 
	
	
	
	
	
	
  /* 
 ¸.•´¸.•*´¨)    ¸.•*´¨)    ¸.•*´¨) 
 -------------█║▌│█│║▌║││█║▌│║▌║--███▓▒░░.****.░░▒▓███--------*´¨) -◣_◢   ٩(●̮̮̃•̃)۶    --٩͡[๏̯͡๏]۶ ------------------------------------*/  
 public function getTest() {

	 include ("views/Sales/Test.php");
}

    
public function getFondo(){

	 include ("views/Sales/Vtas_Tot_Fondo.php");
}


public function getFiltro(){

	 include ("views/Sales/Vtas_Tot_Filtros.php");
}


public function postTabla(){

	 include ("views/Sales/Vtas_Tot_Grid_Resultados.php");
}



private function getIdEnumTypeService($enum){
	$this->db->setTable(tables::TypeService);
	return $this->db->where(
		array(
			array(
				"field" => "Enum",
				"value" => (EnumTypeService::isValidValue($enum)) ? $enum : EnumTypeService::Hotel,
				"optMat" => "=",
				"optLog" => NULL
			)
		),
		array("Id")
	)[0]["Id"];
}

	

//GET: ../ventas/crear
public function getCrear(){
	session_start();
	if(isset($_SESSION["user"])){
		$db = new databaseController();
		$db->setTable(tables::Agent);
		$agents = $db->where(
			array(
				array(
					"field" => "isDeleted",
					"value" => 0,
					"optMat" => "=",
					"optLog" => "AND Id <> 7"
				)
			)
		);
		echo $db->error;


		$db->setTable(tables::TypeService);
		$typeservices = $db->where(
			array(
				array(
					"field" => "isDeleted",
					"value" => 0,
					"optMat" => "=",
					"optLog" => NULL
				)
			)
		);
		echo $db->error;

		$db->setTable(tables::Provider);

		$providers = $db->where(
			//WHERE
			array(
				array(
					"field" => "isDeleted",
					"value" => 0,
					"optMat" => "=",
					"optLog" => null
				)
			)
			/*null,
			array(
				array(
					"field" => "Nombre",
					"value" => "HotelDo",
					"opts" => "DESC"
				)
			)*/
		);
		echo $db->error;
		$db->setTable(tables::Product);

		$products = $db->where(
			array(
				array(
					"field" => "id_Provider",
					"value" => $providers[0]["Id"],
					"optMat" => "=",
					"optLog" => "AND"
				),
				array(
					"field" => "isDeleted",
					"value" => 0,
					"optMat" => "=",
					"optLog" => NULL
				)
			)
		);
		echo $db->error;
		$status = array(
			array(1,"No efectiva"),
			array(2,"Pendiente"),
			array(3,"Autorizada"),
			array(4,"Declinada"),
			array(5,"Cancelada"),
			array(6,"Aprobada sin capturar"),
			array(8,"En proceso")
		);



		include("views/Sales/create.php");
	}
	else
	{
		header( "Location: /panel/login");
	}
}

public function postCrear(){

	try
	{
		$db = new databaseController();

		$Customer_id = "";
		$Payment_id = "";
		$Commission_id = "";
		$Service_id = "";

		$sale = new sale();
		$sale->Key_ = $this->nextKeySale();
		$sale->Date = date("Y-m-d H:i:s");
		$sale->lastUpdate = date("Y-m-d H:i:s");

		//print_r($_POST);
		$customer = new customer();
		$customer->Name = $_POST["customer"]["name"];
		$customer->LastName = $_POST["customer"]["lastname"];
		$customer->Email = $_POST["customer"]["email"];
		$customer->Phone = $_POST["customer"]["phone"];
		$customer->Country = $_POST["customer"]["country"];
		$customer->State = $_POST["customer"]["state"];
		$customer->City = $_POST["customer"]["city"];
		$customer->Address = $_POST["customer"]["address"];
		$customer->lastUpdate = date("Y-m-d H:i:s");
		//print_r($customer);
		$db->setTable(tables::Customer);
		$db->Add($customer);
		$customer_id = $db->lastId;
		echo $db->error;
		$discount = (100-$_POST['payment']['subtotal'])/100;
		$payment = new payment();
		$payment->Reference = "OKT-".$_POST["payment"]["reference"];
		$payment->AuthorizationNo = "OKT-".$_POST["payment"]["autorization"];
		$payment->ExchangeRate = $_POST["payment"]["exchangerate"];
		if($_POST['payment']['exchangerate'] != 0){
			$payment->Total = $_POST['payment']['total']*$_POST['payment']['exchangerate'];
			/*$payment->Subtotal = ($_POST['payment']['total']*$discount)*$_POST['payment']['exchangerate'];*/
			$payment->Subtotal = $_POST['payment']['subtotal'];
		}
		else{  

			$payment->Total = $_POST["payment"]["total"];
			/*$payment->Subtotal = $_POST['payment']['total']*$discount;*/
			$payment->Subtotal = $_POST['payment']['subtotal'];
		}
		$payment->PaymentMethod = $_POST["payment"]["paymentmethod"];
		$payment->Status = $_POST["payment"]["status"];
		$payment->Currency = $_POST["payment"]["currency"];
		$payment->lastUpdate = date("Y-m-d H:i:s");
		$db->setTable(tables::Payment);
		$db->Add($payment);
		$payment_id = $db->lastId;
		echo $db->error;

		/*Datos de servicio*/
		$typeService = $_POST["service"]["typeService"];
		$service = new service_();
		if ($typeService != 1) {
			$service->Name = $_POST['service']['product'];
		}
		else{
			$service->Name = $_POST['service']['hotelname'];
		}
		switch ($typeService) {
			case 1:
				$nameService = "Hotel";
				break;
			case 2:
				$nameService = "Tour";
				break;
			case 3:
				$nameService = "Transportación";
				break;
			case 4:
				$nameService = "Aerolínea";
				break;
			default:
				$nameService = "Hotel";
				break;
		}
		$service->NameProvider = $_POST['service']['provider'];
		$service->TypeService = $nameService;
		$service->DateTo = $_POST["service"]["from"];
		$service->DateFrom = $_POST["service"]["to"];
		$service->Comments = $_POST['service']['descrip'];
		$service->NoPeople = $_POST['service']['adults'] + $_POST['service']['kids'];
		$service->Offline = 1;
        $service->lastUpdate = date("Y-m-d H:i:s");
        $service->Id_productos = $_POST['service']['Idproductos'];
        $service->Id_providers = $_POST['service']['Idproviders'];
        
		$db->setTable(tables::Service);
		$db->Add($service);
		echo $db->error;
		$Service_id = $db->lastId;

		/* Datos de comision del RP */
		$comision = new commission();
		$comision->Agent_id = $_POST['comission']['agent'];
		$comision->Commission = $_POST['comission']['cake'];
		$comision->lastUpdate = date("Y-m-d H:i:s");
		$db->setTable(tables::Comission);
		$db->Add($comision);
		$commission_id = $db->lastId;
		echo $db->error;

		if($typeService == 1){
			/* Datos de hotel (HotelDo u HotelBeds) */
			$hotel = new hotel_();
			$hotel->Id = $Service_id;
			$hotel->IdHotelDo = 0;
			$hotel->Key_ = "N/A";
			$hotel->City = "Cancún-Centro";
			$hotel->Country = "México";
			$hotel->NoRooms = $_POST["service"]["room"];
			$hotel->MealPlan = "Solo Habitación";
			$hotel->CategoryRoom = "Estandar";
			$hotel->PeoplePerRoom = "";
			$db->setTable(tables::Hotel);
			$db->Add($hotel);
			echo $db->error;

			$sale->Provider = "Oktrip";
			$sale->Customer_id = $customer_id;
			$sale->Service_id = $Service_id;
			$sale->Payment_id = $payment_id;
			$sale->Commission_id = $commission_id;
			$db->setTable(tables::Sales);
			$db->Add($sale);
			echo $db->error;



		}
		else if($typeService == 2){
			/* Primero se agregan los datos de coupon */
			$coupon = new coupon();
			$coupon->Name = "N/A";
			$coupon->Provider = "N/A";
			$coupon->Key_ = "N/A";
			$coupon->HourPickup = "N/A";
			$coupon->Hotel = "N/A";
			$coupon->Room = "N/A";
			$coupon->NoPax = "N/A";
			$coupon->NetRate = 0;
			$coupon->PublicRate = 0;
			$coupon->Payment = "N/A";
			$coupon->Comments = "N/A";
			$coupon->lastUpdate = date("Y-m-d H:i:s");
			$db->setTable(tables::Coupon);
			$db->Add($coupon);
			echo $db->error;
			$coupon_id = $db->lastId;
			/* Datos para Tours */
			$tour = new tours();
			$tour->Id = $Service_id;
			$tour->Coupon_id = $coupon_id;
			$db->setTable(tables::Tours);
			$db->Add($tour);
			echo $db->error;

			$sale->Provider = "Oktrip";
			$sale->Customer_id = $customer_id;
			$sale->Service_id = $Service_id;
			$sale->Payment_id = $payment_id;
			$sale->Commission_id = $commission_id;
			$db->setTable(tables::Sales);
			$db->Add($sale);
			echo $db->error;



		}
		else if($typeService == 3){
			/* Datos para Transportacion */
			$transportation = new transportation();
			$transportation->Id = $Service_id;
			$db->setTable(tables::Transportation);
			$db->Add($transportation);
			echo $db->error;

			$sale->Provider = "Oktrip";
			$sale->Customer_id = $customer_id;
			$sale->Service_id = $Service_id;
			$sale->Payment_id = $payment_id;
			$sale->Commission_id = $commission_id;
			$db->setTable(tables::Sales);
			$db->Add($sale);
			echo $db->error;

		}
		else if($typeService == 4){
			/* Datos para Vuelos */
			$vuelo = new transportation();
			$vuelo->Id = $Service_id;
			$vuelo->Airline = $_POST["service"]["provider"];
			$db->setTable(tables::Flights);
			$db->Add($vuelo);

			$sale->Provider = "Oktrip";
			$sale->Customer_id = $customer_id;
			$sale->Service_id = $Service_id;
			$sale->Payment_id = $payment_id;
			$sale->Commission_id = $commission_id;
			$db->setTable(tables::Sales);
			$db->Add($sale);
			echo $db->error;

		}

		echo json_encode(array("type" => "success","message" => "La reservación se registró exitosamente."));

	}
	catch(Exception $e)
	{
		print_r($e);
	}

}

	
//GET: ../ventas/editar/:id
public function getEditar($id){
	session_start();
	if(isset($_SESSION["user"])){
		$sale = $this->searchSale($id);
		$agents = $this->getAgents();

		include("views/Sales/edit.php");
	}
	else
	{
		header( "Location: /login");
	}
}

//POST ../ventas/editar/
public function postEditar(){
	try
	{
		$date = $_POST["sale"]["date"]." ".$_POST["sale"]["hour"];
		$provider = $_POST["sale"]["provider"];




		$db = new db();
		$conn = $db->conn_local();

		$query = "UPDATE sales SET Date = ?, Provider = ? WHERE Id = '".$_POST['sale']['id']."';";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1,$date);
		$stmt->bindParam(2,$provider);
		$stmt->execute();

		/* Consulta de los ID's apartir del id de la venta */
		$query = "SELECT Customer_id, Service_id, Payment_id, Commission_id FROM sales WHERE Id = '".$_POST['sale']['id']."';";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			$customer_id = $row["Customer_id"];
			$payment_id = $row["Payment_id"];
			$commission_id = $row["Commission_id"];
			$service_id = $row["Service_id"];

			/*Editar datos de cliente*/
			$aux = "Name='".$_POST["customer"]['name']."', ";
			$aux .= "LastName='".$_POST["customer"]['lastname']."', ";
			$aux .= "SecondLastName='".$_POST["customer"]['secondlastname']."', ";
			$aux .= "Phone='".$_POST["customer"]['phone']."', ";
			$aux .= "Email='".$_POST["customer"]['email']."', ";
			$aux .= "Country='".$_POST["customer"]['country']."', ";
			$aux .= "State='".$_POST["customer"]['state']."', ";
			$aux .= "City='".$_POST["customer"]['city']."', ";
			$aux .= "Address='".$_POST["customer"]['address']."', ";
			$aux .= "Postal_code='".$_POST["customer"]['postalcode']."', ";
			$aux .= "Comments='".$_POST["customer"]['comments']."'";

			$query = "UPDATE customers SET ".$aux." WHERE Id = '".$customer_id."';";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$date);
			$stmt->execute();

			/*Editar datos de servicio*/
			$aux = "Name='".$_POST["service"]['name']."', ";
			$aux .= "DateTo ='".$_POST["service"]['to']."', ";
			$aux .= "DateFrom ='".$_POST["service"]['from']."', ";
			$aux .= "Comments ='".$_POST["service"]['comments']."', ";
			$aux .= "NoPeople ='".$_POST["service"]['nopeople']."'";

			$query = "UPDATE services SET ".$aux." WHERE Id = '".$service_id."';";
			$stmt = $conn->prepare($query);

			$stmt->execute();

			/*Editar tipo de servicio*/
			$query = "SELECT TypeService FROM services WHERE Id = '".$service_id."';";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowCount();
			if($count > 0)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				switch ($row["TypeService"]) {

					case 'Hotel':
					$aux = "Hotel_id='".$_POST["service"]['idhoteldo']."', ";
					$aux = "Key_='".$_POST["service"]['key']."', ";
					$aux .= "City ='".$_POST["service"]['city']."', ";
					$aux .= "Country ='".$_POST["service"]['country']."', ";
					$aux .= "NoRooms ='".$_POST["service"]['norooms']."', ";
					$aux .= "MealPlan ='".$_POST["service"]['mealplan']."', ";
					$aux .= "CategoryRoom ='".$_POST["service"]['categoryroom']."'";

					$query = "UPDATE hotels SET ".$aux." WHERE Id = '".$service_id."';";
					$stmt = $conn->prepare($query);
					$stmt->execute();

					break;
					case 'Tour':

					$query = "SELECT Coupon_id FROM tours WHERE Id = '".$service_id."';";
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowCount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$Coupon_id = $row["Coupon_id"];
						$aux = "Name='".$_POST["coupon"]['name']."', ";
						$aux .= "Provider='".$_POST["coupon"]['provider']."', ";
						$aux .= "Key_='".$_POST["coupon"]['key']."', ";
						$aux .= "HourPickup='".$_POST["coupon"]['hourpickup']."', ";
						$aux .= "Hotel='".$_POST["coupon"]['hotel']."', ";
						$aux .= "Room='".$_POST["coupon"]['room']."', ";
						$aux .= "NoPax='".$_POST["coupon"]['nopax']."', ";
						$aux .= "NetRate='".$_POST["coupon"]['netrate']."', ";
						$aux .= "PublicRate='".$_POST["coupon"]['publicrate']."', ";
						$aux .= "Payment='".$_POST["coupon"]['payment']."', ";
						$aux .= "Comments='".$_POST["coupon"]['comments']."'";

						$query = "UPDATE coupons SET ".$aux." WHERE Id = '".$Coupon_id."';";
						$stmt = $conn->prepare($query);
						$stmt->execute();
					}
					break;
					case 'Transportación':

					$aux = "Key_='".$_POST["service"]['key']."', ";
					$aux .= "Origin='".$_POST["service"]['origin']."', ";
					$aux .= "Destiny='".$_POST["service"]['destiny']."'";

					$query = "UPDATE transportations SET ".$aux." WHERE Id = '".$service_id."';";
					$stmt = $conn->prepare($query);
					$stmt->execute();

					$query = "SELECT Coupon_id FROM transportations WHERE Id = '".$service_id."';";
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowCount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);

						$Coupon_id = $row["Coupon_id"];
						$aux = "Name='".$_POST["coupon"]['name']."', ";
						$aux .= "Provider='".$_POST["coupon"]['provider']."', ";
						$aux .= "Key_='".$_POST["coupon"]['key']."', ";
						$aux .= "HourPickup='".$_POST["coupon"]['hourpickup']."', ";
						$aux .= "Hotel='".$_POST["coupon"]['hotel']."', ";
						$aux .= "Room='".$_POST["coupon"]['room']."', ";
						$aux .= "NoPax='".$_POST["coupon"]['nopax']."', ";
						$aux .= "NetRate='".$_POST["coupon"]['netrate']."', ";
						$aux .= "PublicRate='".$_POST["coupon"]['publicrate']."', ";
						$aux .= "Payment='".$_POST["coupon"]['payment']."', ";
						$aux .= "Comments='".$_POST["coupon"]['comments']."'";

						$query = "UPDATE coupons SET ".$aux." WHERE Id = '".$Coupon_id."';";
						$stmt = $conn->prepare($query);
						$stmt->execute();
					}

					break;
					case 'Renta':

					$aux = "TypeVehicle='".$_POST["service"]['typevehicle']."', ";
					$aux .= "DeliveryCity='".$_POST["service"]['deliverycity']."', ";
					$aux .= "ReturnCity='".$_POST["service"]['returncity']."'";

					$query = "UPDATE rents SET ".$aux." WHERE Id = '".$service_id."';";
					$stmt = $conn->prepare($query);
					$stmt->execute();

					break;
					case 'Producto':
						//Nothing
					break;
					case 'Rep':
						//Nothing
					break;
					case 'Vuelo':

					$aux = "Key_='".$_POST["service"]['key']."', ";
					$aux .= "Airline='".$_POST["service"]['airline']."', ";
					$aux .= "Status='".$_POST["service"]['status']."', ";
					$aux .= "Invoice='".$_POST["service"]['invoice']."', ";
					$aux .= "DateTo='".$_POST["service"]['dateto']."', ";
					$aux .= "DateFrom='".$_POST["service"]['datefrom']."'";

					$query = "UPDATE flights SET ".$aux." WHERE Id = '".$service_id."';";
					$stmt = $conn->prepare($query);
					$stmt->execute();

					break;

					default:
					break;
				}
			}

			/*Editar datos de pago*/
			$aux = "Reference='".$_POST["payment"]['reference']."', ";
			$aux .= "Total ='".$_POST["payment"]['total']."', ";
			$aux .= "Subtotal ='".$_POST["payment"]['subtotal']."', ";
			//$aux .= "Discount ='".$_POST["payment"]['discount']."', ";
			$aux .= "PaymentMethod ='".$_POST["payment"]['paymentmethod']."', ";
			$aux .= "Status ='".$_POST["payment"]['status']."', ";
			$aux .= "Currency ='".$_POST["payment"]['currency']."', ";
			$aux .= "ExchangeRate ='".$_POST["payment"]['exchangerate']."', ";
			$aux .= "lastUpdate ='".date("Y-m-d H:i:s")."'";

			$query = "UPDATE payments SET ".$aux." WHERE Id = '".$payment_id."';";
			$stmt = $conn->prepare($query);
			$stmt->execute();

			/*Editar comisión*/
			$aux = "Commission='".$_POST["commission"]['commission']."', ";
			$aux .= "Agent_id='".$_POST["commission"]['rep_id']."'";

			$query = "UPDATE commissions SET ".$aux." WHERE Id = '".$commission_id."';";
			$stmt = $conn->prepare($query);
			$stmt->execute();

		}
		echo json_encode(
			array(
				"type" => "success" ,
				"title" => "Alta exitosa",
				"message" => "Los datos han sido guardados con éxito."
			)
		);
	}
	catch (Exception $e) {

		echo json_encode(
			array(
				"type" => "error" ,
				"title" => "Ocurrió un problema",
				"message" => "Hubo un problema, favor de comunicarse con Dpto. de Desarrollo. <br>".$e
			)
		);

	}
}

//GET: ../ventas/detalles/:id
public function getDetalles($id){
	session_start();
	if(isset($_SESSION["user"])){
		//echo "Id de ventas: ".$id."<br>";
		$sale = $this->searchSale($id);
		include("views/Sales/details.php");
	}
	else
	{
		header( "Location: /login");
	}
}

//POST: ../ventas/detalles/:id
public function postEliminar($id){

	try
	{
		$db = new db();
		$conn = $db->conn_local();

		$query = "UPDATE sales SET isDeleted = 1 WHERE Id = ? ;";

		$stmt = $conn->prepare($query);
		$stmt->bindParam(1,$id);
		$stmt->execute();

		$count = $stmt->rowcount();
		if($count > 0)
		{
			echo json_encode(
				array(
					"type" => "success" ,
					"title" => "Eliminado",
					"message" => "Se ha eliminado el registro con id: ".$id
				)
			);
		}
		else
		{
			echo json_encode(
				array(
					"type" => "error" ,
					"title" => "Hubo un error",
					"message" => "No se pudo eliminar el registro. "
				)
			);
		}
		$conn = null;
	}
	catch (Exception $e)
	{
		echo json_encode(
			array(
				"type" => "error" ,
				"title" => "Hubo un error",
				"message" => "No se pudo eliminar el registro. ".$e
			)
		);
	}
	return false; 
}

public function getAgents(){
	try
	{
		$db = new db();
		$conn = $db->conn_local();
		$query = "SELECT * FROM agents WHERE isDeleted = 0 AND Id <> 7 ;" ;
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowcount();
		$agentslist = array();

		if($count > 0)
		{
			$rows = $stmt->fetchall(PDO::FETCH_ASSOC);
			foreach ($rows as $row) {

				$agent = new agent();
				$agent->setId($row['Id']);
				$agent->setName($row['Name']);
				$agent->setLastName($row['LastName']);
				$agent->setSecondLastName($row['SecondLastName']);
				$agent->setNoEmployee($row['EmployeeNumber']);
				array_push($agentslist, $agent);
			}

		}

		return $agentslist;
	}
	catch (Exception $e)
	{
		return array();
	}
}

public function searchAgent($name){
	try {
		$db = new db();
		$conn = $db->conn_local();
		$query = "SELECT * FROM agents WHERE Name = '".$name."' ;" ;
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowcount();
		if($count > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$agent = new agent();
			$agent->setId(((isset($row["Id"])) ? $row["Id"] : ""));
			$agent->setName(((isset($row["Name"])) ? $row["Name"] : ""));
			$agent->setSecondLastName(((isset($row["SecondLastName"])) ? $row["SecondLastName"] : ""));
			$agent->setNoEmployee(((isset($row["EmployeeNumber"])) ? $row["EmployeeNumber"] : ""));
			$agent->setIsDeleted(((isset($row["isDeleted"])) ? $row["isDeleted"] : ""));
			return $agent;
		}
		else
		{
			$agent = new agent();
			$agent->setId("7");
			$agent->setName("Not Found");
			$agent->setLastName("Not Found");
			$agent->setSecondLastName("Not Found");
			$agent->setNoEmployee("Not Found");
			$agent->setIsDeleted(0);
			return $agent;
		}
		$conn = null;
	}
	catch (Exception $e)
	{
		return false;
	}
}

	

public function searchSale($id){

	//Rehacer

	try {
		$db = new db();
		$conn = $db->conn_local();
		$query = "SELECT * FROM sales WHERE Id = '".$id."' AND isDeleted = 0 ;" ;
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowcount();

		$sale = new sale();
		$customer = new customer();
		$payment = new payment();
		$commission = new commission();
		$agent = new agent();

		if($count > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			//print_r($row);
			$customer_id = $row["Customer_id"];
			$payment_id = $row["Payment_id"];
			$commission_id = $row["Commission_id"];
			$service_id = $row["Service_id"];

			$sale->setId($row["Id"]);
			//$sale->setKey($row["Key_"]);
			$sale->setXml($row["Xml"]);
			$sale->setProvider($row["Provider"]);
			$sale->setDate($row["Date"]);
			$sale->setLastUpdate($row["lastUpdate"]);
			$sale->setIsDeleted($row["isDeleted"]);

			$query = "SELECT * FROM customers WHERE Id = '".$customer_id."' ;" ;
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();

			if($count > 0)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$customer->setId($row["Id"]);
				$customer->setName($row["Name"]);
				$customer->setLastName($row["LastName"]);
				$customer->setSecondLastName($row["SecondLastName"]);
				$customer->setPhone($row["Phone"]);
				$customer->setEmail($row["Email"]);
				$customer->setCountry($row["Country"]);
				$customer->setState($row["State"]);
				$customer->setCity($row["City"]);
				$customer->setPostalCode($row["Postal_code"]);
				$customer->setAddress($row["Address"]);
				$customer->setComments($row["Comments"]);
			}

			$query = "SELECT * FROM payments WHERE Id = '".$payment_id."' ;" ;
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$payment->setId($row["Id"]);
				$payment->setReference($row["Reference"]);
				//$payment->setDiscount($row["Discount"]);
				$payment->setSubtotal($row["Subtotal"]);
				$payment->setTotal($row["Total"]);
				$payment->setPaymentMethod($row["PaymentMethod"]);
				$payment->setStatus($row["Status"]);
				$payment->setCurrency($row["Currency"]);
				$payment->setExchangeRate($row["ExchangeRate"]);
			}

			$query = "SELECT * FROM commissions WHERE Id = '".$commission_id."' ;" ;
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$commission->setId($row["Id"]);
				$commission->setCommission($row["Commission"]);

				$query = "SELECT * FROM agents WHERE Id = '".$row["Agent_id"]."' ;" ;
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$count = $stmt->rowcount();
				if($count > 0)
				{
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					$agent->setId($row["Id"]);
					$agent->setName($row["Name"]);
					$agent->setLastName($row["LastName"]);
					$agent->setSecondLastName($row["SecondLastName"]);
					$agent->setNoEmployee($row["EmployeeNumber"]);
				}

				$commission->setAgent_Id($agent);
				$sale->setCommission($commission);
			}

			$query = "SELECT * FROM services WHERE Id = '".$service_id."' ;" ;
			$stmt = $conn->prepare($query);
			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0)
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				switch ($row["TypeService"]) {

					case 'Hotel':
					$hotel = new hotel_();
					$hotel->setId($row["Id"]);
					$hotel->setName($row["Name"]);
					$hotel->setTypeService($row["TypeService"]);
					$hotel->setDateTo($row["DateTo"]);
					$hotel->setDateFrom($row["DateFrom"]);
					$hotel->setComments($row["Comments"]);
					$hotel->setNoPeople($row["NoPeople"]);

					$query = "SELECT * FROM hotels WHERE Id = '".$service_id."' ;" ;
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowcount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$hotel->setIdHotelDo($row["IdHotelDo"]);
						//$hotel->setKey($row["Key_"]);
						$hotel->setCity($row["City"]);
						$hotel->setCountry($row["Country"]);
						$hotel->setNoRooms($row["NoRooms"]);
						$hotel->setMealPlan($row["MealPlan"]);
						$hotel->setCategoryRoom($row["CategoryRoom"]);
						$hotel->setRooms($row["Rooms"]);

						$sale->setService($hotel);
					}

					break;
					case 'Transportación':

					$transportation = new transportation();
					$coupon = new coupon();
					$transportation->setId($row["Id"]);
					$transportation->setName($row["Name"]);
					$transportation->setTypeService($row["TypeService"]);
					$transportation->setDateTo($row["DateTo"]);
					$transportation->setDateFrom($row["DateFrom"]);
					$transportation->setComments($row["Comments"]);
					$transportation->setNoPeople($row["NoPeople"]);

					/*$query = "SELECT * FROM transportations WHERE Id = '".$service_id."' ;" ;
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowcount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$coupon_id = $row["Coupon_id"];

						$transportation->setId($row["Id"]);
						$transportation->setKey($row["Key_"]);
						$transportation->setOrigin($row["Origin"]);
						$transportation->setDestiny($row["Destiny"]);

						$query = "SELECT * FROM coupons WHERE Id = '".$coupon_id."' ;" ;
						$stmt = $conn->prepare($query);
						$stmt->execute();
						$count = $stmt->rowcount();
						if($count > 0)
						{
							$row = $stmt->fetch(PDO::FETCH_ASSOC);
							$coupon->setId($row["Id"]);
							$coupon->setName($row["Name"]);
							$coupon->setProvider($row["Provider"]);
							$coupon->setKey($row["Key_"]);
							$coupon->setHourPickup($row["HourPickup"]);
							$coupon->setHotel($row["Hotel"]);
							$coupon->setRoom($row["Room"]);
							$coupon->setNoPax($row["NoPax"]);
							$coupon->setNetRate($row["NetRate"]);
							$coupon->setPublicRate($row["PublicRate"]);
							$coupon->setPayment($row["Payment"]);
							$coupon->setComments($row["Comments"]);

							$transportation->setCoupon($coupon);
						}

					}*/
					$sale->setService($transportation);

					break;
					case 'Rep':

					$product = new product();
					$product->setId($row["Id"]);
					$product->setName($row["Name"]);
					$product->setTypeService($row["TypeService"]);
					$product->setDateTo($row["DateTo"]);
					$product->setDateFrom($row["DateFrom"]);
					$product->setComments($row["Comments"]);
					$product->setNoPeople($row["NoPeople"]);
					$sale->setService($product);

					break;
					case 'Tour':
					$tour = new tours();
					$coupon = new coupon();
					$tour->setId($row["Id"]);
					$tour->setName($row["Name"]);
					$tour->setTypeService($row["TypeService"]);
					$tour->setDateTo($row["DateTo"]);
					$tour->setDateFrom($row["DateFrom"]);
					$tour->setComments($row["Comments"]);
					$tour->setNoPeople($row["NoPeople"]);

					$query = "SELECT * FROM tours WHERE Id = '".$service_id."' ;" ;
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowcount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$coupon_id = $row["Coupon_id"];

						$query = "SELECT * FROM coupons WHERE Id = '".$coupon_id."' ;" ;
						$stmt = $conn->prepare($query);
						$stmt->execute();
						$count = $stmt->rowcount();
						if($count > 0)
						{
							$row = $stmt->fetch(PDO::FETCH_ASSOC);
							$coupon->setId($row["Id"]);
							$coupon->setName($row["Name"]);
							$coupon->setProvider($row["Provider"]);
							$coupon->setKey_($row["Key_"]);
							$coupon->setHourPickup($row["HourPickup"]);
							$coupon->setHotel($row["Hotel"]);
							$coupon->setRoom($row["Room"]);
							$coupon->setNoPax($row["NoPax"]);
							$coupon->setNetRate($row["NetRate"]);
							$coupon->setPublicRate($row["PublicRate"]);
							$coupon->setPayment($row["Payment"]);
							$coupon->setComments($row["Comments"]);

							$tour->setCoupon($coupon);
						}
						$sale->setService($tour);

					}
					break;
					case 'Aerolínea':

					$flight = new tours();
					$flight->setId($row["Id"]);
					$flight->setName($row["Name"]);
					$flight->setTypeService($row["TypeService"]);
					$flight->setDateTo($row["DateTo"]);
					$flight->setDateFrom($row["DateFrom"]);
					$flight->setComments($row["Comments"]);
					$flight->setNoPeople($row["NoPeople"]);

					/*$query = "SELECT * FROM flights WHERE Id = '".$service_id."' ;" ;
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowcount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$flight->setAirline($row["Airline"]);
						$flight->setStatus($row["Status"]);
						$flight->setKey($row["Key_"]);
						$flight->setInvoice($row["Invoice"]);
						$flight->setDateTo($row["DateTo"]);
						$flight->setDateFrom($row["DateFrom"]);

					}*/
					$sale->setService($flight);
					break;
					case 'Renta':

					$rent = new rent();
					$rent->setId($row["Id"]);
					$rent->setName($row["Name"]);
					$rent->setTypeService($row["TypeService"]);
					$rent->setDateTo($row["DateTo"]);
					$rent->setDateFrom($row["DateFrom"]);
					$rent->setComments($row["Comments"]);
					$rent->setNoPeople($row["NoPeople"]);

					$query = "SELECT * FROM rents WHERE Id = '".$service_id."' ;" ;
					$stmt = $conn->prepare($query);
					$stmt->execute();
					$count = $stmt->rowcount();
					if($count > 0)
					{
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
						$rent->set($row["TypeVehicle"]);
						$rent->set($row["DeliveryCity"]);
						$rent->set($row["ReturnCity"]);
						$sale->setService($rent);
					}

					break;
					case 'Producto':
					$product = new product();
					$product->setId($row["Id"]);
					$product->setName($row["Name"]);
					$product->setTypeService($row["TypeService"]);
					$product->setDateTo($row["DateTo"]);
					$product->setDateFrom($row["DateFrom"]);
					$product->setComments($row["Comments"]);
					$product->setNoPeople($row["NoPeople"]);
					$sale->setService($product);

					break;
					default:
					break;
				}

			}


			$sale->setPayment($payment);
			$sale->setCustomer($customer);

			return $sale;
		}
		$conn = null;
	}
	catch (Exception $e)
	{
		return false;
	}
}

public function saveSale($sale){
	try {


		$statusService = false;
		$statusPayment = false;
		$statusCommission = false;
		$statusCustomer = false;
		$statusSale = false;

		$db = new db();
		$conn = $db->conn_local();

		$service = $sale->getService();
		$payment = $sale->getPayment();
		$customer = $sale->getCustomer();

		$lastIdSale = 0;
		$lastIdPayment = 0;
		$lastIdCustomer = 0;
		$lastIdService = 0;
		$messageStatus = "";

		$query = "INSERT INTO services (Name, TypeService, DateTo, DateFrom, Comments, NoPeople, lastUpdate, Id_productos, Id_providers) VALUES (?,?,?,?,?,?,?,?,?);" ;
		$stmt = $conn->prepare($query);

		$stmt->bindParam(1,$service->getName());
		$stmt->bindParam(2,$service->getTypeService());
		$stmt->bindParam(3,$service->getDateTo());
		$stmt->bindParam(4,$service->getDateFrom());
		$stmt->bindParam(5,$service->getComments());
		$stmt->bindParam(6,$service->getNoPeople());
		$stmt->bindParam(7,date("Y-m-d H:i:s"));
        $stmt->bindParam(8,$service->getIdproductos());
        $stmt->bindParam(9,$service->getIdproviders());
        
       

		$stmt->execute();
		$count = $stmt->rowcount();
		if($count > 0)
		{

			$lastIdService = $conn->lastInsertId();

			switch (get_class($service)) {
				case 'hotel_':

				$query = "INSERT INTO hotels (Id, Key_, City, Country, NoRooms, MealPlan, CategoryRoom, Rooms, IdHotelDo) VALUES (?,?,?,?,?,?,?,?,?);" ;
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$lastIdService);
				$stmt->bindParam(2,$service->getKey_());
				$stmt->bindParam(3,$service->getCity());
				$stmt->bindParam(4,$service->getCountry());
				$stmt->bindParam(5,$service->getNoRooms());
				$stmt->bindParam(6,$service->getMealPlan());
				$stmt->bindParam(7,$service->getCategoryRoom());
				$stmt->bindParam(8,$service->getRooms());
				$stmt->bindParam(9,$service->getIdHotelDo());
				$stmt->execute();
				$count = $stmt->rowcount();

				if($count > 0)
				{
					$statusService = true;
					//return "<span style='color:green;'>Hotel: Alta exitosa! ".$lastIdService."</span>";
				}

				break;
				case 'product':

				$query = "INSERT INTO products (Id) VALUES (?);" ;
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$lastIdService);

				$stmt->execute();
				$count = $stmt->rowcount();

				if($count > 0)
				{
					$statusService = true;
				}

				break;

				case 'tour':

				$query = "INSERT INTO coupons (Name, Provider, Key_, HourPickup, Hotel, Room, NoPax, NetRate, PublicRate, Payment, Comments, lastUpdate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);" ;
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$service->Coupon->getName());
				$stmt->bindParam(2,$service->Coupon->getProvider());
				$stmt->bindParam(3,$service->Coupon->getKey());
				$stmt->bindParam(4,$service->Coupon->getHourPickup());
				$stmt->bindParam(5,$service->Coupon->getHotel());
				$stmt->bindParam(6,$service->Coupon->getRoom());
				$stmt->bindParam(7,$service->Coupon->getNoPax());
				$stmt->bindParam(8,$service->Coupon->getNetRate());

				$stmt->bindParam(9,$service->Coupon->getPublicRate());
				$stmt->bindParam(10,$service->Coupon->getPayment());
				$stmt->bindParam(11,$service->Coupon->getComments());
				$stmt->bindParam(12,date("Y-m-d H:i:s"));

				$stmt->execute();
				$count = $stmt->rowcount();

				if($count > 0)
				{
					$lastIdCoupon = $conn->lastInsertId();

					$query = "INSERT INTO tours (Id, Coupon_id) VALUES (?,?);" ;
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1, $lastIdService);
					$stmt->bindParam(2, $lastIdCoupon);

					$stmt->execute();
					$count = $stmt->rowcount();

					if($count > 0)
					{
						$statusService = true;

					}

				}

				break;
				case 'transportation':

				$query = "INSERT INTO coupons (Name, Provider, Key_, HourPickup, Hotel, Room, NoPax, NetRate, PublicRate, Payment, Comments, lastUpdate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);" ;
				$stmt = $conn->prepare($query);
				$stmt->bindParam(1,$service->Coupon->getName());
				$stmt->bindParam(2,$service->Coupon->getProvider());
				$stmt->bindParam(3,$service->Coupon->getKey());
				$stmt->bindParam(4,$service->Coupon->getHourPickup());
				$stmt->bindParam(5,$service->Coupon->getHotel());
				$stmt->bindParam(6,$service->Coupon->getRoom());
				$stmt->bindParam(7,$service->Coupon->getNoPax());
				$stmt->bindParam(8,$service->Coupon->getNetRate());

				$stmt->bindParam(9,$service->Coupon->getPublicRate());
				$stmt->bindParam(10,$service->Coupon->getPayment());
				$stmt->bindParam(11,$service->Coupon->getComments());
				$stmt->bindParam(12,date("Y-m-d H:i:s"));

				$stmt->execute();
				$count = $stmt->rowcount();

				if($count > 0)
				{
					$lastIdCoupon = $conn->lastInsertId();

					$query = "INSERT INTO transportations (Id, Coupon_id, Key_ , Origin, Destiny) VALUES (?,?,?,?,?);" ;
					$stmt = $conn->prepare($query);
					$stmt->bindParam(1, $lastIdService);
					$stmt->bindParam(2, $lastIdCoupon);
					$stmt->bindParam(3, $service->getKey());
					$stmt->bindParam(4, $service->getOrigin());
					$stmt->bindParam(5, $service->getDestiny());

					$stmt->execute();
					$count = $stmt->rowcount();

					if($count > 0)
					{
						$statusService = true;

					}

				}

				break;
				default:
				return "<span style='color:red;'> No se encontró nada lel :(</span>";
				break;
			}
		}

		$query = "INSERT INTO payments (Reference, Total, Subtotal, Discount, PaymentMethod, Status, Currency, ExchangeRate, lastUpdate) VALUES (?,?,?,?,?,?,?,?,?);" ;
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1,$payment->getReference());
		$stmt->bindParam(2,$payment->getTotal());
		$stmt->bindParam(3,$payment->getSubtotal());
		$stmt->bindParam(4,$payment->getDiscount());
		$stmt->bindParam(5,$payment->getPaymentMethod());
		$stmt->bindParam(6,$payment->getStatus());
		$stmt->bindParam(7,$payment->getCurrency());
		$stmt->bindParam(8,$payment->getExchangeRate());
		$stmt->bindParam(9,date("Y-m-d H:i:s"));
		$stmt->execute();
		$count = $stmt->rowcount();
		if($count > 0)
		{
			$lastIdPayment = $conn->lastInsertId();
			$statusPayment = true;
		}

		$query = "INSERT INTO customers (Name, LastName, SecondLastName, Phone, Email, Country, State, City, Address, Postal_code, Comments, lastUpdate) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);" ;
		$stmt = $conn->prepare($query);
		$stmt->bindParam(1,$customer->getName());
		$stmt->bindParam(2,$customer->getLastName());
		$stmt->bindParam(3,$customer->getSecondLastName());
		$stmt->bindParam(4,$customer->getPhone());
		$stmt->bindParam(5,$customer->getEmail());
		$stmt->bindParam(6,$customer->getCountry());
		$stmt->bindParam(7,$customer->getState());
		$stmt->bindParam(8,$customer->getCity());
		$stmt->bindParam(9,$customer->getAddress());
		$stmt->bindParam(10,$customer->getPostalCode());
		$stmt->bindParam(11,$customer->getComments());
		$stmt->bindParam(12,date("Y-m-d H:i:s"));

		$stmt->execute();
		$count = $stmt->rowcount();
		if($count > 0)
		{
			$lastIdCustomer = $conn->lastInsertId();
			$statusCustomer = true;
		}

		if($statusService)
			{$messageStatus .= "<span style='color:green;'> Service: Done! </span><br>"; }
		else
			{$messageStatus .= "<span style='color:red;'> Service: Fail! </span><br>";}

		if($statusPayment)
			{$messageStatus .= "<span style='color:green;'> Payment: Done! </span><br>";}
		else
			{$messageStatus .= "<span style='color:red;'> Payment: Fail! </span><br>";}
		if($statusCustomer)
			{$messageStatus .= "<span style='color:green;'> Customer: Done! </span><br>";}
		else
			{$messageStatus .= "<span style='color:red;'> Customer: Fail! </span><br>";}


		$commission = $sale->getCommission();
		if(isset($commission)){

			$query = "INSERT INTO commissions (Agent_id, Commission, lastUpdate) VALUES (?,?,?);" ;
			$stmt = $conn->prepare($query);
			$stmt->bindParam(1,$commission->Agent->getId());
			$stmt->bindParam(2,$commission->getCommission());
			$stmt->bindParam(3,date("Y-m-d H:i:s"));

			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0)
			{
				$lastIdCommission = $conn->lastInsertId();
				$statusCommission = true;
			}

			if($statusCommission)
				{$messageStatus .= "<span style='color:green;'> Commission: Done! </span><br>";}
			else
				{$messageStatus .= "<span style='color:red;'> Commission: Fail! </span><br>";}

			$query = "INSERT INTO sales (Date, Key_, Xml, Provider, Customer_id, Service_id, Payment_id, Commission_id, lastUpdate, isDeleted) VALUES (?,?,?,?,?,?,?,?,?,?);" ;
			$stmt = $conn->prepare($query);

			$stmt->bindParam(1,$sale->getDate());
			$stmt->bindParam(2,$sale->getKey());
			$stmt->bindParam(3,$sale->getXml());
			$stmt->bindParam(4,$sale->getProvider());
			$stmt->bindParam(5,$lastIdCustomer);
			$stmt->bindParam(6,$lastIdService);
			$stmt->bindParam(7,$lastIdPayment);
			$stmt->bindParam(8,$lastIdCommission);
			$stmt->bindParam(9,date("Y-m-d H:i:s"));
			$stmt->bindParam(10,$sale->getIsDeleted());

			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0) {
				$statusSale = true;
				$lastIdSale = $conn->lastInsertId();

			}

		}
		else
		{

			$query = "INSERT INTO sales (Date, Key_, Xml, Customer_id, Service_id, Payment_id, lastUpdate, isDeleted) VALUES (?,?,?,?,?,?,?,?);" ;
			$stmt = $conn->prepare($query);

			$stmt->bindParam(1,$sale->getDate());
			$stmt->bindParam(2,$sale->getKey());
			$stmt->bindParam(3,$sale->getXml());
			$stmt->bindParam(4,$lastIdCustomer);
			$stmt->bindParam(5,$lastIdService);
			$stmt->bindParam(6,$lastIdPayment);
			$stmt->bindParam(7,date("Y-m-d H:i:s"));
			$stmt->bindParam(8,$sale->getIsDeleted());

			$stmt->execute();
			$count = $stmt->rowcount();
			if($count > 0){
				$statusSale = true;
				$lastIdSale = $conn->lastInsertId();

			}

		}


		if($statusSale)
			{$messageStatus .= "<span style='color:green;'> Sale: Done! </span><br>";}
		else
			{$messageStatus .= "<span style='color:red;'> Sale: Fail! </span><br>";}

		$conn = null;
		return array($messageStatus, $lastIdSale, true );

	}
	catch (Exception $e)
	{
		return array($e, 0, false );;
	}
}

public function KillerIt(){
	try {

		$db = new db();
		$conn = $db->conn_remote();

		$query = "SELECT * FROM reservations";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowcount();
		if($count > 0)
		{
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {

				$status = "";

				switch ($row["estatus"]) {
					case 1:
					$status = "No efectiva";
					break;
					case 2:
					$status = "Pendiente";
					break;
					case 3:
					$status = "Autorizada";
					break;
					case 4:
					$status = "Declinada";
					break;
					case 5:
					$status = "Cancelada";
					break;
					case 6:
					$status = "Aprobada sin capturar";
					break;
					case 8:
					$status = "En proceso";
					break;
					default:
					$status = "Sin Estado";
					break;
				}


				$sale = new sale();
				$sale->setKey($row["idres"]);
				$sale->setDate($row["datetransaction"]);
				$sale->setXml($row["xmldata"]);
				$sale->setProvider($row["bdproveedor"]);
				$sale->setIsDeleted($row["deleted"]);

				$customer = new customer();
				$porciones = explode(" ", $row['lastname']);
				$customer->setName($row["firstname"]);
				$customer->setLastName($porciones[0]);
				$customer->setSecondLastName(((isset($porciones[1])) ? $porciones[1] : "N/A"));
				$customer->setPhone((!empty($row["phone"])) ? $row["phone"] : "N/A");
				$customer->setEmail((!empty($row["email"])) ? $row["email"] : "N/A");
				$customer->setCountry((!empty($row["country"])) ? $row["country"] : "N/A");
				$customer->setState((!empty($row["estate"])) ? $row["estate"] : "N/A");
				$customer->setCity((!empty($row["city"])) ? $row["city"] : "N/A");
				$customer->setPostalCode("N/A");
				$customer->setAddress("N/A");
				$customer->setComments((!empty($row["comments"])) ? $row["comments"] : "N/A");

				$payment = new payment();
				$payment->setReference("N/A");
				$payment->setTotal($row["total"]);
				$payment->setSubtotal($row["total"]);
				$payment->setDiscount(0);
				$payment->setPaymentMethod($row["gateway"]);
				$payment->setStatus($row["estatus"]);
				$payment->setCurrency($row["currency"]);
				$payment->setExchangeRate("N/A");

				echo "<br><b>ID -> ".$row["idres"].": ".$row["bdservicio"]."</b><br>";

				switch ($row["bdservicio"]) {
					case 'Hotel':
					case 'hotel':

					$hotel = new hotel_();
					$hotel->setName((!empty($row["hotel"])) ? $row["hotel"] : "NO DATA");
					$hotel->setTypeService("Hotel");
					$hotel->setComments((!empty($row["bddescription"])) ? $row["bddescription"] : "NO COMMENTS" );
					$hotel->setDateTo($row["salida"]);
					$hotel->setDateFrom($row["llegada"]);
					$hotel->setNoPeople(0);
					$hotel->setKey("N/A");
					$hotel->setCity("N/A");
					$hotel->setCountry("N/A");
					$hotel->setNoRooms(0);
					$hotel->setMealPlan("N/A");
					$hotel->setCategoryRoom("N/A");
					$hotel->setRooms("{}");

					$sale->setService($hotel);

					break;
					case 'Transportación':

					$coupon = new coupon();
					$coupon->setName("N/A");
					$coupon->setProvider("N/A");
					$coupon->setKey("N/A");
					$coupon->setHourPickup("N/A");
					$coupon->setHotel("N/A");
					$coupon->setRoom("N/A");
					$coupon->setNoPax("N/A");
					$coupon->setNetRate(0);
					$coupon->setPublicRate(0);
					$coupon->setPayment("N/A");
					$coupon->setComments((!empty($row["notes"])) ?$row["notes"] : "NO DATA" );

					$transportation = new transportation();
					$transportation->setName((!empty($row["hotel"])) ? $row["hotel"] : "NO DATA");
					$transportation->setTypeService("Transportación");
					$transportation->setComments((!empty($row["bddescription"])) ? $row["bddescription"] : "NO COMMENTS" );
					$transportation->setDateTo($row["salida"]);
					$transportation->setDateFrom($row["llegada"]);
					$transportation->setNoPeople(0);
					$transportation->setKey("N/A");
					$transportation->setOrigin("N/A");
					$transportation->setDestiny("N/A");
					$transportation->setCoupon($coupon);

					$sale->setService($transportation);


					break;
					case 'tour':
					case 'Tour':

					$coupon = new coupon();
					$coupon->setName("N/A");
					$coupon->setProvider("N/A");
					$coupon->setKey("N/A");
					$coupon->setHourPickup("N/A");
					$coupon->setHotel("N/A");
					$coupon->setRoom("N/A");
					$coupon->setNoPax("N/A");
					$coupon->setNetRate(0);
					$coupon->setPublicRate(0);
					$coupon->setPayment("N/A");
					$coupon->setComments((!empty($row["notes"])) ?$row["notes"] : "NO DATA" );

					$tour = new tour();
					$tour->setName((!empty($row["hotel"])) ? $row["hotel"] : "NO DATA");
					$tour->setTypeService("Tour");
					$tour->setComments((!empty($row["bddescription"])) ? $row["bddescription"] : "NO COMMENTS" );
					$tour->setDateTo($row["salida"]);
					$tour->setDateFrom($row["llegada"]);
					$tour->setNoPeople(0);
					$tour->setCoupon($coupon);

					$sale->setService($tour);

					break;

					case 'Rep':
					case 'Representante':

															//if(strcmp($row["nombre_rp"], "nobody") < 0 ){

					$product = new product();
					$product->setName((!empty($row["hotel"])) ? $row["hotel"] : "NO DATA");
					$product->setTypeService("Rep");
					$product->setComments((!empty($row["bddescription"])) ? $row["bddescription"] : "NO COMMENTS" );
					$product->setDateTo($row["salida"]);
					$product->setDateFrom($row["llegada"]);
					$product->setNoPeople(0);

					$sale->setService($product);

															//}

					break;

					default:

					$product = new product();
					$product->setName((!empty($row["hotel"])) ? $row["hotel"] : "NO DATA");
					$product->setTypeService((!empty($row["bdservicio"])) ? $row["bdservicio"] : "Producto" );
					$product->setComments((!empty($row["bddescription"])) ? $row["bddescription"] : "NO COMMENTS" );
					$product->setDateTo($row["salida"]);
					$product->setDateFrom($row["llegada"]);
					$product->setNoPeople(0);
					$sale->setService($product);

					break;
				}

				$agent = $this->searchAgent($row["nombre_rp"]);
				$commission = new commission();
				$commission->setAgent($agent);
				$commission->setCommission((!empty($row["comision"])) ? $row["comision"] : 0);

				echo "<br>";
				echo "Representante (".$agent->getId()."): ".$agent->getName()."<br>";
				echo "Comisión: ".(!empty($row["comision"])) ? $row["comision"] : 0;
				echo "<br>";

				$sale->setCommission($commission);
				$sale->setCustomer($customer);
				$sale->setPayment($payment);

				$response = $this->saveSale($sale);

				echo $response[0];

			}
		}
		$conn = null;
		echo "FINISH";
	}
	catch (Exception $e)
	{
		return false;
	}
}

public function buildXML($sale){

	$customer = $sale->getCustomer();
	$payment = $sale->getPayment();
	$service = $sale->getService();

	$xml_data =$xml_data.'<Request Type="Reservation" Version="1.0">';
	$xml_data =$xml_data.'<affiliateid>OKTRA</affiliateid>';
	$xml_data =$xml_data.'<language>esp</language>';
	$xml_data =$xml_data.'<currency>PE</currency>';
	$xml_data =$xml_data.'<uid>'.$idsession.'</uid>';
	$xml_data =$xml_data.'<ip>'.$_SERVER['REMOTE_ADDR'].'</ip>';
	$xml_data =$xml_data.'<firstname>'.$customer->getName().'</firstname>';
	$xml_data =$xml_data.'<lastname>'.$customer->getLastName()." ".$customer->getSecondLastName().'</lastname>';
	$xml_data =$xml_data.'<emailaddress>'.$customer->getEmail().'</emailaddress>';
	$xml_data =$xml_data.'<country>'.$customer->getCountry().'</country>';
	$xml_data =$xml_data.'<clientcountry>'.$customer->getCountry().'</clientcountry>';
	$xml_data =$xml_data.'<address>'.$customer->getAddress().'</address>';
	$xml_data =$xml_data.'<city>'.$customer->getCity().'</city>';
	$xml_data =$xml_data.'<state>'.$customer->getState().'</state>';
	$xml_data =$xml_data.'<zip>'.$customer->getPostalCode().'</zip>';


	$xml_data =$xml_data.'<total>'.$payment->getTotal().'</total>';
	$xml_data =$xml_data.'<phones>';
	$xml_data =$xml_data.'<phone>';
	$xml_data =$xml_data.'<type>1</type>';
	$xml_data =$xml_data.'<number>'.$customer->getPayment().'</number>';
	$xml_data =$xml_data.'</phone>';
	$xml_data =$xml_data.'</phones>';

	$xml_data =$xml_data.'<hotels>';
	$xml_data =$xml_data.'<hotel>';
	$xml_data =$xml_data.'<hotelid>'.$hotelid.'</hotelid>';
	$xml_data =$xml_data.'<roomtype>'.$roomid.'</roomtype>';

	$xml_data =$xml_data.'<mealplan>'.$mealplan.'</mealplan>';
	$xml_data =$xml_data.'<datearrival>'.$llegada.'</datearrival>';
	$xml_data =$xml_data.'<datedeparture>'.$salida.'</datedeparture>';
	$xml_data =$xml_data.'<marketid>'.$market.'</marketid>';
	$xml_data =$xml_data.'<contractid>'.$contract.'</contractid>';
	$xml_data =$xml_data.'<dutypercent>0</dutypercent>';

	$xml_data =$xml_data.'<rooms>';

	if($nrooms>0){ /* si es 1 cuarto*/
		$xml_data =$xml_data.'<room>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'<status>AV</status>';
		$xml_data =$xml_data.'<ratekey>'.$ratekey.'</ratekey>';
		$xml_data =$xml_data.'<adults>'.$r1a.'</adults>';
		$xml_data =$xml_data.'<kids>'.$r1k.'</kids>';
		$xml_data =$xml_data.'<infants>0</infants>';
		$xml_data =$xml_data.'<k1a>'.$r1k1a.'</k1a>';
		$xml_data =$xml_data.'<k2a>'.$r1k2a.'</k2a>';
		$xml_data =$xml_data.'<k3a>'.$r1k3a.'</k3a>';
		$xml_data =$xml_data.'</room>';
	}
	if($nrooms>1){ /* si es 2 cuarto*/
		$xml_data =$xml_data.'<room>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'<status>AV</status>';
		$xml_data =$xml_data.'<ratekey>'.$ratekey.'</ratekey>';
		$xml_data =$xml_data.'<adults>'.$r2a.'</adults>';
		$xml_data =$xml_data.'<kids>'.$r2k.'</kids>';
		$xml_data =$xml_data.'<infants>0</infants>';
		$xml_data =$xml_data.'<k1a>'.$r2k1a.'</k1a>';
		$xml_data =$xml_data.'<k2a>'.$r2k2a.'</k2a>';
		$xml_data =$xml_data.'<k3a>'.$r2k3a.'</k3a>';
		$xml_data =$xml_data.'</room>';
	}

	if($nrooms>2){ /* si es 3 cuarto */
		$xml_data =$xml_data.'<room>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'<status>AV</status>';
		$xml_data =$xml_data.'<ratekey>'.$ratekey.'</ratekey>';
		$xml_data =$xml_data.'<adults>'.$r3a.'</adults>';
		$xml_data =$xml_data.'<kids>'.$r3k.'</kids>';
		$xml_data =$xml_data.'<infants>0</infants>';
		$xml_data =$xml_data.'<k1a>'.$r3k1a.'</k1a>';
		$xml_data =$xml_data.'<k2a>'.$r3k2a.'</k2a>';
		$xml_data =$xml_data.'<k3a>'.$r3k3a.'</k3a>';
		$xml_data =$xml_data.'</room>';
	}

	if($nrooms>3){ /* si es 4 cuarto */
		$xml_data =$xml_data.'<room>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'<status>AV</status>';
		$xml_data =$xml_data.'<ratekey>'.$ratekey.'</ratekey>';
		$xml_data =$xml_data.'<adults>'.$r4a.'</adults>';
		$xml_data =$xml_data.'<kids>'.$r4k.'</kids>';
		$xml_data =$xml_data.'<infants>0</infants>';
		$xml_data =$xml_data.'<k1a>'.$r4k1a.'</k1a>';
		$xml_data =$xml_data.'<k2a>'.$r4k2a.'</k2a>';
		$xml_data =$xml_data.'<k3a>'.$r4k3a.'</k3a>';
		$xml_data =$xml_data.'</room>';
	}
	if($nrooms>4){ /* si es 5 cuarto*/
		$xml_data =$xml_data.'<room>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'<status>AV</status>';
		$xml_data =$xml_data.'<ratekey>'.$ratekey.'</ratekey>';
		$xml_data =$xml_data.'<adults>'.$r5a.'</adults>';
		$xml_data =$xml_data.'<kids>'.$r5k.'</kids>';
		$xml_data =$xml_data.'<infants>0</infants>';
		$xml_data =$xml_data.'<k1a>'.$r5k1a.'</k1a>';
		$xml_data =$xml_data.'<k2a>'.$r5k2a.'</k2a>';
		$xml_data =$xml_data.'<k3a>'.$r5k3a.'</k3a>';
		$xml_data =$xml_data.'</room>';
	}

	$xml_data =$xml_data.'</rooms>';
	$xml_data =$xml_data.'</hotel>';
	$xml_data =$xml_data.'</hotels>';

	if ($gate=="bd"){
		$ventacom="bd";

		$xml_data =$xml_data.'<payments>';
		$xml_data =$xml_data.'<cardpayment>';
		$xml_data =$xml_data.'<type>'.$cardtypev.'</type>';
		$xml_data =$xml_data.'<bank>'.$vbankid.'</bank>';
		$xml_data =$xml_data.'<number>'.$cardnumber.'</number>';
		$xml_data =$xml_data.'<securitycode>'.$cardcode.'</securitycode>';
		$xml_data =$xml_data.'<expirationmonth>'.$cardmonth.'</expirationmonth>';
		$xml_data =$xml_data.'<monthlyinterest>'.$meses.'</monthlyinterest>';
		$xml_data =$xml_data.'<expirationyear>'.$cardyear.'</expirationyear>';
		$xml_data =$xml_data.'<holdername>'.$cardholder.'</holdername>';
		$xml_data =$xml_data.'<address>'.trim($address).'</address>';
		$xml_data =$xml_data.'<city>'.$city.'</city>';
		$xml_data =$xml_data.'<state>'.$estate.'</state>';
		$xml_data =$xml_data.'<country>'.$country.'</country>';
		$xml_data =$xml_data.'<zip>'.$zipcode.'</zip>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'</cardpayment>';
		$xml_data =$xml_data.'</payments>';

	}else{ /* si es a credito en bestday */

		$xml_data =$xml_data.'<payments>';
		$xml_data =$xml_data.'<agencycreditpayment>';
		$xml_data =$xml_data.'<type>CREPMX</type>';
		$xml_data =$xml_data.'<currency>PE</currency>';
		$xml_data =$xml_data.'<amount>'.$subtotal.'</amount>';
		$xml_data =$xml_data.'</agencycreditpayment>';
		$xml_data =$xml_data.'</payments>';
	}

	$xml_data =$xml_data.'</Request>';
}

public function nextKeySale(){
	try
	{
		$db = new db();
		$conn = $db->conn_local();
		$query = "SELECT Key_ FROM sales ORDER BY Key_ DESC LIMIT 1";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0)
		{
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['Key_'] + 1;
		}

	}
	catch (Exception $e)
	{
		return 0;
	}
	return 0;
}

}


?>
