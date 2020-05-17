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
	$q = mysqli_real_escape_string($connect, $_GET['q']);
	
	if ($act == 'print')
	{
		$now = date('Y-m-d');
		
		$filename="customer.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt; text-align:center;'>
									PT. LOTTE MART INDONESIA CABANG MAKASSAR
								</div>
								<div style='font-size: 10pt; text-align:center;'>Mall Panakukang, Jl.Boulevard Raya No.1, Makassar, Sulawesi Selatan, Indonesia</div>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt; '><span style='font-size: 10pt;'><b>DATA DIVISI</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NO</th>
							<th style='width: 85mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>KODE DIVISI</th>
							<th style='width: 95mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>NAMA DIVISI</th>
							<th style='width: 82mm; padding: 5px 0px 5px 0px; font-size: 9pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>TLP</th>
						</tr>";
						
						// showing the divisi
						if ($q != '')
						{
							$queryDivisi = "SELECT * FROM divisi WHERE kodeDivisi LIKE '%$q%' OR namaDivisi LIKE '%$q%' ORDER BY kodeDivisi ASC";
						}
						else
						{
							$queryDivisi = "SELECT * FROM divisi ORDER BY kodeDivisi ASC";
						}
						$sqlDivisi = mysqli_query($connect, $queryDivisi);
						
						// fetch data
						$i = 1;
						while ($dtDivisi = mysqli_fetch_array($sqlDivisi))
						{
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtDivisi[kodeDivisi]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtDivisi[namaDivisi]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 8pt;'>$dtDivisi[noTelp]</td>
								</tr>
							";
							$i++;
						}
			$content .= 
						"
						
					</table>
				
					";
	}
	
	ob_end_clean();
	// conversion HTML => PDF
	try
	{
		$html2pdf = new HTML2PDF('L', 'A4','fr', false, 'ISO-8859-15',array(2, 2, 2, 2)); //setting ukuran kertas dan margin pada dokumen anda
		// $html2pdf->setModeDebug();
		$html2pdf->setDefaultFont('Arial');
		$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
		$html2pdf->Output($filename);
	}
	catch(HTML2PDF_exception $e) { echo $e; }
}
?>