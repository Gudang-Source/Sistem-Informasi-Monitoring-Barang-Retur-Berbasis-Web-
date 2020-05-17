<?php
include "header.php";

// if session is null, showing up the text and exit
if ($_SESSION['staffID'] == '' && $_SESSION['email'] == '')
{
	// show up the text and exit
	echo "You have not authorization for access the modules.";
	exit();
}

else{
	
	ob_start();
	require ("includes/html2pdf/html2pdf.class.php");
	
	$act = $_GET['act'];
	
	if ($act == 'print')
	{
		$no_detail_brg = mysqli_real_escape_string($connect, $_GET['no_detail_brg']);
		$now = date('Y-m-d');
		
		$filename="laporan_stok_produk.pdf";
		$content = ob_get_clean();
		
		$date = date('d-m-Y');
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 140mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PT. LOTTE MART INDONESIA CABANG MAKASSAR
								</div>
							</td>
							<td style='width: 93mm;'></td>
						</tr>
						<tr valign='top'>
							<td><span style='font-size: 8pt;'>Mall Panakukang, Jl.Boulevard Raya No.1<br>Makassar, Sulawesi Selatan, Indonesia
								</span>
							</td>
							<td>
								<span style='font-size: 11pt;'><b>LAPORAN BARANG KADALUARSA</b><br>Tanggal : $date</span> 
							</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 12mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 27mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO BARANG</th>
							<th style='width: 75mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>KODE - NAMA BARANG</th>
							<th style='width: 35mm; padding: 12px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>KODE - NAMA SUPPLIER</th>
							<th style='width: 40mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:center;'>STATUS KADALUARSA</th>
							<th style='width: 40mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:center;'>QTY</th>
						
						</tr>";
					
						
						 // $sekarang= date('Y-m-d');
						 // $min1bulan= date('Y-m-d', strtotime("+1 months",strtotime($sekarang)));
						//  $sql = ("SELECT * FROM detail_barang where mep <='".$min1bulan . "'AND qty_brg>0");
						//  $output=mysqli_query($connect,$sql);

						$sekarang= date('Y-m-d');
						$min1bulan= date('Y-m-d', strtotime("+1 months",strtotime($sekarang)));
						$queryStock = "SELECT * FROM detail_barang where mep <='".$min1bulan . "' AND qty_brg>0";
						$sqlStock = mysqli_query($connect, $queryStock);

						$dewa = "SELECT DATEDIFF(mep,now()) as date_difference from detail_barang where mep <='".$min1bulan . "'";
					    $dewa1 = mysqli_query($connect, $dewa);

						$i = 1;
						while ($dataStock = mysqli_fetch_array($sqlStock))
						{
							$dataStock1 = mysqli_fetch_array($dewa1);
							$content .= "
									<tr valign='top'>
										<td style='padding: 4px 0px 7px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 4px 0px 7px 0px; font-size: 9pt;'>$dataStock[no_detail_brg]</td>
										<td style='padding: 4px 0px 7px 0px; font-size: 9pt;'>$dataStock[productCode]</td>
										<td style='padding: 4px 0px 7px 0px; font-size: 9pt;'>$dataStock[namaSupplier]</td>
										<td style='padding: 4px 0px 7px 0px; font-size: 9pt; text-align:center;' >$dataStock1[date_difference] hari lagi kadaluarsa</td>
										<td style='padding: 4px 0px 7px 0px; font-size: 9pt; text-align:center;'>$dataStock[qty_brg]</td>
										
						
									</tr>
							"; 
							
							$i++;
						}
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr valign='top'>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 130mm;' rowspan='5'></td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 100mm;'>
								<br><br>HORMAT KAMI,<br><br><br><br><br><br>Administrasi
							</td>
						</tr>
					</table>
					";
	}
	
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', array('240', '130'),'fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>