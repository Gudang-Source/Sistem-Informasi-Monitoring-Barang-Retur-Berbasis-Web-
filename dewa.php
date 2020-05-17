<?php
  include "header.php";
  $page = "report_kadaluarsa.tpl";
  $module = $_GET['module'];
  $act = $_GET['act'];

  $conn = mysqli_connect('localhost','root','','dbinventory');
  $request= $_POST['request'];

  $sekarang= date('Y-m-d');
  $min1bulan= date('Y-m-d', strtotime("+1 months",strtotime($sekarang)));
  $sql = ("SELECT * FROM detail_barang where mep <='".$min1bulan . "' AND $request=1 AND qty_brg>0");
  $output=mysqli_query($conn,$sql);
 // $query="SELECT * FROM detail_barang WHERE productCode='$request'";

  
echo '<div class="table-responsive" id="table-container">';
echo '<table id="example1" class="table table-bordered table-striped">';
    echo '<tr>
      <th> NO <i class="fa fa-sort"></i></th>
      <th>NOMOR DETAIL BARANG <i class="fa fa-sort"></i></th>
      <th>KODE - NAMA BARANG <i class="fa fa-sort"></i></th>
      <th>NAMA SUPPLIER<i class="fa fa-sort"></i></th>
      <th style="text-align: center">STATUS KADALUARSA <i class="fa fa-sort"></i></th>
      <th style="text-align: center">QTY <i class="fa fa-sort"></i></th>
    </tr>';
         $i = 1;
  $dewa = "SELECT DATEDIFF(mep,now()) as date_difference from detail_barang where mep <='".$min1bulan . "'";
    $dewa1 = mysqli_query($conn, $dewa);
  while($fetch = mysqli_fetch_assoc($output))
     {
     $fetch1 = mysqli_fetch_assoc($dewa1);
           echo '<tr>';
           echo '<td>'.$i.'</td>';
           echo '<td>'.$fetch['no_detail_brg'].'</td>';
           echo '<td>'.$fetch['productCode'].'</td>';
           echo '<td>'.substr($fetch['namaSupplier'],6).'</td>';
           echo '<td style="text-align: center; color:red;">'.$fetch1['date_difference']. " hari lagi kadaluarsa".'</td>';
           echo '<td style="text-align: center">'.$fetch['qty_brg'].'</td>';
           echo '</tr>';
            $i++;
        
    }


    $sql2 = ("SELECT * FROM detail_barang where $request=2");
    $output2=mysqli_query($conn,$sql2);
    $datedif = "SELECT DATEDIFF(mep,now()) as date_difference from detail_barang";
    $datedifquery = mysqli_query($conn, $datedif);
    while($fetch2 = mysqli_fetch_assoc($output2))
     {
     $fetch1 = mysqli_fetch_assoc($datedifquery);
           echo '<tr>';
           echo '<td>'.$i.'</td>';
           echo '<td>'.$fetch2['no_detail_brg'].'</td>';
           echo '<td>'.$fetch2['productCode'].'</td>';
           echo '<td>'.substr($fetch2['namaSupplier'],6).'</td>';
           echo '<td style="text-align: center; color:red;">'.$fetch1['date_difference']. " hari lagi kadaluarsa".'</td>';
           echo '<td style="text-align: center">'.$fetch2['qty_brg'].'</td>';
           echo '</tr>';
            $i++;
        
    }

echo '</table>';
echo '</div>';
 ?>