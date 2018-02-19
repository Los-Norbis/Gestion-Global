<?php
header('Content-type: text/html; charset=utf-8');

if (!empty($_POST) ) {
		//print_r($_POST);
		//die();
		
		include('../includes/db_connect.php');
		define("TablaActual", "cartas LEFT JOIN transportes ON cartas.Tr_Id=transportes.Id LEFT JOIN cargas ON cartas.TipoCarga=cargas.Id");

    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $recordsTotal = count(getData("SELECT * FROM cartas"));

    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i < (count($_POST['columns'])-1);$i++){
					$casi = trim($_POST['columns'][$i]['searchable']);
					if ($casi == 'true') {
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
					}
        }
        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */
				
				die($where);

        $sql = sprintf("SELECT cartas.*, transportes.*, cargas.Nombre AS Carga FROM %s %s", TablaActual, $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT cartas.*, transportes.*, cargas.Nombre AS Carga FROM %s %s ORDER BY %s %s limit %d , %d ", TablaActual , $where ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
    }   /* END SEARCH */
    
    else {
        $sql = sprintf("SELECT cartas.*, transportes.Nombre AS Trans, cargas.Nombre AS Carga FROM %s ORDER BY %s %s limit %d , %d ", TablaActual ,$orderBy,$orderType ,$start , $length);
        $data = getData($sql);

        $recordsFiltered = $recordsTotal;
    }

    /* Response to client before JSON encoding */
    $response = array(
        "draw" => intval($draw),
        "recordsTotal" => $recordsTotal,
        "recordsFiltered" => $recordsFiltered,
        "data" => $data
    );
		// print_r($data);
    echo json_encode($response);

} else {
    echo "NO POST Query from DataTable";
}

/*
 * @param (string) SQL Query
 * @return multidim array containing data array(array('column1'=>value2,'column2'=>value2...))
 *
 */
function getData($sql){

		global $mysqli;
		//die($sql);
		$resultado = $mysqli->query($sql);
		$data = array();
		while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
				//print_r($row);
				//$row["Tr_Id"] = buscar_transporte ($row["Tr_Id"]);
				//
				$row['Tarifa'] = number_format($row['Tarifa'], 2, ',', '.');
				$row['KgCarga'] = number_format($row['KgCarga'], 0, ',', '.');
				$row['KgDescarga'] = number_format($row['KgDescarga'], 0, ',', '.');
				$row["TipoCarga"] = number_format( cp_total($row["Id"]) , 2, ',', '.');
				$data[] = $row ;
									
				// echo $row["Tema"];
		}
		return $data;
}

function cp_total ($indice) {
	global $mysqli ;
	$t_sql = sprintf("SELECT Importe FROM trans_cc WHERE CP_Id = %d AND Tipo = 0", $indice);
	if ($t_query = $mysqli->query($t_sql)) {
		$fila = $t_query->fetch_row();
		return $fila[0];
	} else {
		return "Error...";
	}
}

?>