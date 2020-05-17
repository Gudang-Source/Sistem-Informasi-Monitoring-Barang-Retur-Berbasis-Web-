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
		$categoryID = mysqli_real_escape_string($connect, $_GET['categoryID']);
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
								<span style='font-size: 11pt;'><b>LAPORAN STOK BARANG</b><br>Tanggal : $date</span> 
							</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 30mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 115mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>KODE - NAMA BARANG</th>
							<th style='width: 50mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>SATUAN</th>
							<th style='width: 40mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align:center;'>STOCK</th>
						
						</tr>";
						
						// showing up the receivable data
						if ($categoryID != '')
						{
							$queryStock = "SELECT * FROM barang WHERE categoryID = '$categoryID' ORDER BY productCode ASC";
						}
						else
						{
							$queryStock = "SELECT * FROM barang ORDER BY productCode ASC";
						}
						
						$sqlStock = mysqli_query($connect, $queryStock);
						
						// fetch data
						$i = 1;
						while ($dataStock = mysqli_fetch_array($sqlStock))
						{
							if ($dataStock['unit'] == '1')
							{
								$unit = "PCS";
							}
							elseif ($dataStock['unit'] == '2')
							{
								$unit = "SACHET";
							}
							elseif ($dataStock['unit'] == '3')
							{
								$unit = "BOX";
							}
							elseif ($dataStock['unit'] == '4')
							{
								$unit = "PAK";
							}

							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$dataStock[productName]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$unit</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align:center;'>$dataStock[stock]</td>
										
						
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