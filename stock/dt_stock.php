<?php
header('Content-type: text/html; charset=utf-8');

if (!empty($_POST) ) {
		//print_r($_POST);
		//die();
    /*
     * Database Configuration and Connection using mysqli


    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DB", "zarate");

    $connection = new mysqli(HOST, USER, PASSWORD, DB);
		if ($connection->connect_error) {
    	die("No se puede conectar a MySQLi...");
		}
		$connection->set_charset("utf8");
    /* END DB Config and connection */

		include('../includes/db_connect.php');
		define("TablaActual", "fc_clientes");

    /* Useful $_POST Variables coming from the plugin */
    $draw = $_POST["draw"];//counter used by DataTables to ensure that the Ajax returns from server-side processing requests are drawn in sequence by DataTables
    $orderByColumnIndex  = $_POST['order'][0]['column'];// index of the sorting column (0 index based - i.e. 0 is the first record)
    $orderBy = $_POST['columns'][$orderByColumnIndex]['data'];//Get name of the sorting column from its index
    $orderType = $_POST['order'][0]['dir']; // ASC or DESC
    $start  = $_POST["start"];//Paging first record indicator.
    $length = $_POST['length'];//Number of records that the table can display in the current draw
    /* END of POST variables */

    $recordsTotal = count(getData("SELECT * FROM " . TablaActual));

    /* SEARCH CASE : Filtered data */
    if(!empty($_POST['search']['value'])){

        /* WHERE Clause for searching */
        for($i=0 ; $i < (count($_POST['columns'])-1);$i++){
            $column = $_POST['columns'][$i]['data'];//we get the name of each column using its index from POST request
            $where[]="$column like '%".$_POST['search']['value']."%'";
        }
        $where = "WHERE ".implode(" OR " , $where);// id like '%searchValue%' or name like '%searchValue%' ....
        /* End WHERE */

        $sql = sprintf("SELECT * FROM %s %s", TablaActual , $where);//Search query without limit clause (No pagination)

        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s %s ORDER BY %s %s limit %d , %d ", TablaActual , $where ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);
    }   /* END SEARCH */

		// Busco por Tema
		else if ($_POST['columns'][3]['search']['value'] <> '') {
				$f_tema = $_POST['columns'][3]['search']['value'];

        $sql = sprintf("SELECT * FROM %s WHERE Tema = %d", TablaActual , $f_tema);//Search query without limit clause (No pagination)
        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s WHERE Tema = %d ORDER BY %s %s limit %d , %d ", TablaActual , $f_tema ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);

		}

		// Busco por Destino
		else if ($_POST['columns'][4]['search']['value'] <> '') {
				$f_tema = $_POST['columns'][4]['search']['value'];

				$sql = sprintf("SELECT * FROM %s WHERE Destino = %d", TablaActual , $f_tema);//Search query without limit clause (No pagination)
        $recordsFiltered = count(getData($sql));//Count of search result

        /* SQL Query for search with limit and orderBy clauses*/
        $sql = sprintf("SELECT * FROM %s WHERE Destino = %d ORDER BY %s %s limit %d , %d ", TablaActual , $f_tema ,$orderBy, $orderType ,$start,$length  );
        $data = getData($sql);

		}

    else {
        $sql = sprintf("SELECT * FROM %s ORDER BY %s %s limit %d , %d ", TablaActual ,$orderBy,$orderType ,$start , $length);
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

		global $mysqli;//we use connection already opened
		$resultado = $mysqli->query($sql);
		$data = array();
		while ($row = $resultado->fetch_array(MYSQLI_ASSOC)) {
				$data[] = $row ;

				// print_r($row);
				// echo $row["Tema"];
		}
		return $data;
}

function buscar_tema($indice) {
	global $connection ;
	$t_sql = sprintf("SELECT * FROM me_tema_nt WHERE Id = %d ", $indice);
	if ($t_query = $connection->query($t_sql)) {
		$fila = $t_query->fetch_row();
		return $fila[1];
	} else {
		return "Error...";
	}
}

function buscar_destino($indice) {
	global $connection ;
	$t_sql = sprintf("SELECT * FROM me_destino_nt WHERE Id = %d ", $indice);
	if ($t_query = $connection->query($t_sql)) {
		$fila = $t_query->fetch_row();
		return $fila[1];
	} else {
		return "Error...";
	}
}
?>
