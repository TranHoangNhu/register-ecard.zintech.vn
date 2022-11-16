<?php 
require('lib/db.php');
require('lib/clsKhachHang.php');
require('functions/lichsuphieu.php');
$sgDep = new clsKhachHang($conn);
@session_start();	

$ghinodv = $_POST['ghinodv'];
$ghinott = $_POST['ghinott'];
$vipcode = $_POST['vipcode']; 

$data = [];

$output = "";

if($ghinodv == 1)
{
    $rs = $sgDep->getTheGhiNoDV( $vipcode);
}
else if($ghinott == 1)
{
    $rs = $sgDep->getTheGhiNoTT( $vipcode);
}

if($ghinodv == 1 || $ghinott == 1)
{
    try
    {
        if($rs != false)
        {
	       foreach($rs as $r)
	       {
		      $output = $output.'<tr>
    	       <td class="sorting_1">' . $r["MaTheVip"]  .' </td>
    	       <td>'. $r["TenHangBan"] . '</td>
    	       <td>' . $r["TongGiaTri"] .'</td>
    	       <td>' . $r["DaSuDung"] . '</td>
    	       <td>' . $r["ConLai"] . '</td>
  		        </tr>';
                //array_push( $data, $output);
	       }
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}

echo $output;
//echo json_encode($data);
