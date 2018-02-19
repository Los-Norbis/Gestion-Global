<?php
header('Content-type: text/html; charset=utf-8');

if (!empty($_POST) ) {
		print_r($_POST);
		die();
    /*
     * Database Configuration and Connection using mysqli
     */
    include('../includes/db_connect.php');
		define("MyTable", "me_expedientes");

    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $recordsTotal = count(getData("SELECT * FROM ".MyTable));
		die($recordsTotal);
		
    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i < (count($_POST['columns'])-1);$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        $sql = sprintf("SELECT * FROM %s %s", MyTable , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", MyTable , $where ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
    }   /* END SEARCH */
    
		// Busco por Tema
		else if ($_POST['columns'][6]['search']['value'] <> '') {
				$f_tema = $_POST['columns'][6]['search']['value'];

        $sql = sprintf("SELECT * FROM %s WHERE Tema = %d", MyTable , $f_tema);//Search query without limit clause (No pagination)
        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s WHERE Tema = %d ORDER BY %s %s limit %d , %d ", MyTable , $f_tema ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
				
		}
		
		// Busco por Destino
		else if ($_POST['columns'][7]['search']['value'] <> '') {
				$f_tema = $_POST['columns'][7]['search']['value'];

				$sql = sprintf("SELECT * FROM %s WHERE Destino = %d", MyTable , $f_tema);//Search query without limit clause (No pagination)
        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s WHERE Destino = %d ORDER BY %s %s limit %d , %d ", MyTable , $f_tema ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
				
		}

    else {
        $sql = sprintf("SELECT * FROM %s ORDER BY %s %s limit %d , %d ", MyTable ,$orderBy,$orderType ,$start , $length);
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
		print_r($data);
		die();
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

		global $mysqli;//we use connection already opened
		$resultado = $mysqli->query($sql);
		$data = array();
		while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
				$row["Tema"] = buscar_tema ($row["Tema"]);
				$row["Destino"] = buscar_destino ($row["Destino"]);
				$data[] = $row ;
					
				// print_r($row);
				// echo $row["Tema"];
		}
		return $data;
}

function buscar_tema($indice) {
	global $mysqli ;
	$t_sql = sprintf("SELECT * FROM me_tema_exp WHERE Id = %d ", $indice);
	if ($t_query = $mysqli->query($t_sql)) {
		$fila = $t_query->fetch_row();
		return $fila[1];
	} else {
		return "Error...";
	}
}

function buscar_destino($indice) {
	global $mysqli ;
	$t_sql = sprintf("SELECT * FROM me_destino_exp WHERE Id = %d ", $indice);
	if ($t_query = $mysqli->query($t_sql)) {
		$fila = $t_query->fetch_row();
		return $fila[1];
	} else {
		return "Error...";
	}
}
?>