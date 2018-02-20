<?php
header('Content-type: text/html; charset=utf-8');

if (!empty($_POST) ) {
		//print_r($_POST);
		//die();
		session_start();
		$usr_level = $_SESSION['levelSession'];

		include('../includes/db_connect.php');
		define("TablaActual", "usuarios");

    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $recordsTotal = count(getData("SELECT * FROM " . TablaActual . " WHERE user_level > " . $usr_level));

    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i < (count($_POST['columns'])-1);$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE user_level > " . $usr_level . " AND (" .implode(" OR " , $where) . ")";// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        $sql = sprintf("SELECT * FROM %s %s", TablaActual , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", TablaActual , $where ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
    }   /* END SEARCH */

    else {
        $sql = sprintf("SELECT * FROM %s WHERE user_level > %s ORDER BY %s %s limit %d , %d ", TablaActual ,$usr_level,$orderBy,$orderType ,$start , $length);
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
    echo "No hay Registros...";
}

function getData($sql){

		global $mysqli;//we use connection already opened
		$resultado = $mysqli->query($sql);
		$data = array();
		while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
			$row["user_area"] = buscar_destino ($row["user_area"]);
			//$row['Precio'] = number_format($row['Precio'], 2, ',', '.');
			$data[] = $row ;
			// print_r($row);
			// echo $row["Tema"];
		}
		return $data;
}

function buscar_destino($indice) {
	global $mysqli;
	$t_sql = sprintf("SELECT * FROM me_destino_exp WHERE Id = %d ", $indice);
	if ($t_query = $mysqli->query($t_sql)) {
		$fila = $t_query->fetch_row();
		return $fila[1];
	} else {
		return "Error...";
	}
}
?>
