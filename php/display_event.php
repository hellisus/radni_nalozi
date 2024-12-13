<?php                

require  'config.php';
if (!isset($_SESSION['Ime'])) {
    header("location:../index.php");
}


//require 'database_connection.php'; 
//$display_query = "select event_id,event_name,event_start_date,event_end_date from calendar_event_master";             
//$results = mysqli_query($con,$display_query);   
//$count = mysqli_num_rows($results);  

$podatci = new CRUD();
$podatci->table = "nalozi";
$results = $podatci->select(['*'], ['*'], "SELECT br_naloga, tip_naloga, datum_zakazan, kome_zaduzen FROM `nalozi` ");


$count = count($results);
if($count>0) 
{
	$data_arr=array();
    $i=1;
	while($i < $count)
	{
		if($results[$i]['datum_zakazan'] != '0000-00-00'){
			$data_arr[$i]['id'] = $results[$i]['br_naloga'];
			$data_arr[$i]['title'] = $results[$i]['tip_naloga'];
			$data_arr[$i]['start'] = date("Y-m-d", strtotime($results[$i]['datum_zakazan']));
			$data_arr[$i]['end'] = date("Y-m-d", strtotime($results[$i]['datum_zakazan']));
		}
	$i++;
	}
	
	$data = array(
               'status' => true,
              'msg' => 'successfully!',
				'data' => $data_arr
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Error!'				
            );
}
echo json_encode($data);
?>