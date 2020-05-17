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
	$module = $_GET['module'];
	
	if ($module == 'bbm' && $act == 'print')
	{
		$bbmID = $_GET['bbmID'];
		$nofaktur = $_GET['nofaktur'];
		$bbmFaktur = $_GET['bbmFaktur'];
		$now = date('Y-m-d');
		
		$filename="unit_bbm.pdf";
		$content = ob_get_clean();
		
		// showing up the main transfer data
		$queryMain = "SELECT * FROM faktur_beli WHERE bbmID = '$bbmID' AND bbmFaktur = '$bbmFaktur'";
		$sqlMain = mysqli_query($connect, $queryMain);
		$dataMain = mysqli_fetch_array($sqlMain);
		
		$tanggal = tgl_indo2($dataMain['tanggal']);
		$tglfaktur = tgl_indo2($dataMain['tglfaktur']);
		
		$content = "<table style='padding-bottom: 10px; width: 240mm;'>
						<tr valign='top'>
							<td style='width: 150mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PT. LOTTE MART INDONESIA CABANG MAKASSAR
								</div>
							</td>
							<td style='width: 83mm;'></td>
						</tr>
						<tr valign='top'>
							<td><span style='font-size: 8pt;'>Mall Panakukang, Jl.Boulevard Raya No.1<br>Makassar, Sulawesi Selatan, Indonesia
								</span>
							</td>
							<td>
								<span style='font-size: 12pt;'><b>FAKTUR PEMBELIAN</b></span>
							</td>
						</tr>
					</table>
					<table cellpadding='0' cellspacing='0' style='width: 240mm;'>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Nomor Faktur / PO</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 3mm;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 100mm;'>$dataMain[nofaktur] / $dataMain[spbNo]</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt; width: 28mm;'>Kepada Yth,</td>
							<td colspan='2'></td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$tglfaktur</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[namaSupplier]</td>
						</tr>
						<tr>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>Tgl. Order</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>:</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$tanggal</td>
							<td style='padding: 2px 0px 2px 0px; font-size: 9pt;' colspan='3'>$dataMain[supplierAddress]</td>
						</tr>
					</table>
					<br>
					<table cellpadding='0' cellspacing='0' style='width: 240mm; border-bottom: 1px solid #000;'>
						<tr>
							<th style='width: 10mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NO.</th>
							<th style='width: 120mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000;'>NAMA BARANG</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>HARGA</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: center;'>QTY</th>
							<th style='width: 35mm; padding: 2px 0px 2px 0px; font-size: 9pt; border-top: 1px solid #000; border-bottom: 1px solid #000; text-align: right;'>SUBTOTAL</th>
						</tr>";
						
						// showing the bbm detail
						$queryBbmDetail = "SELECT * FROM detail_fakturbeli WHERE nofaktur = '$nofaktur' ORDER BY detailID ASC";
						$sqlBbmDetail = mysqli_query($connect, $queryBbmDetail);
						
						// fetch data
						$i = 1;
						while ($dtBbmDetail = mysqli_fetch_array($sqlBbmDetail))
						{
							$productName = chunk_split($dtBbmDetail['productName'], 50, "<br>");
							$subtotal = ($dtBbmDetail['qty'] * $dtBbmDetail['price']);
							$price = rupiah($dtBbmDetail['price']);
							$grand += $subtotal;
							$content .= "
									<tr valign='top'>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$i</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt;'>$productName</td>
										<td style='padding: 2px 30px 2px 0px; font-size: 9pt; text-align: right;'>$price</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: center;'>$dtBbmDetail[qty]</td>
										<td style='padding: 2px 0px 2px 0px; font-size: 9pt; text-align: right;'>$subtotal,00</td>
									</tr>
							";
							
							$i++;
						}
			$grandtotal = rupiah($grand);			
			$content .= 
						"
						
					</table>
					
					<table cellpadding='0' cellspacing='0' style='width: 230mm;'>
						<tr valign='top'>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: center; width: 130mm;' rowspan='5'><br><br><br>HORMAT KAMI,<br><br><br><br><br><br>Administrasi</td>
							<td style='padding: 5px 0px 5px 0px; font-size: 9pt; text-align: right; width: 100mm;'>
								<table>
									
									<tr>
										<td style='width: 85mm; text-align: right;'><b>TOTAL</b></td>
										<td>:</td>
										<td style='text-align: right;'><b>$grandtotal</b></td>
									</tr>
								</table>
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