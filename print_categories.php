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
		
		$filename="category.pdf";
		$content = ob_get_clean();
		
		$content = "<table style='border-bottom: 1px solid #999999; padding-bottom: 10px; width: 290mm;'>
						<tr valign='top'>
							<td style='width: 290mm;' valign='middle'>
								<div style='font-weight: bold; padding-bottom: 5px; font-size: 12pt;'>
									PT. LOTTE MART INDONESIA CABANG MAKASSAR
								</div>
								<span style='font-size: 10pt;'>Mall Panakukang, Jl. Boulevard Raya No.1, Makassar, Sulawesi Selatan, Indonesia</span>
							</td>
						</tr>
					</table>
					<p style='width: 290mm; font-size: 11pt;'><span style='font-size: 10pt;'><b>DATA KATEGORI</b></span></p>
					<table cellpadding='0' cellspacing='0' style='width: 290mm;'>
						<tr>
							<th style='width: 10mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>No.</th>
							<th style='width: 100mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Nama Kategori</th>
							<th style='width: 30mm; padding: 5px 0px 5px 0px; font-size: 10pt; border-top: 1px solid #999999; border-bottom: 1px solid #999999;'>Status</th>
						</tr>";
						
						// showing the categories
						if ($q != '')
						{
							$queryCategory = "SELECT * FROM as_categories WHERE categoryName LIKE '%$q%' ORDER BY categoryName ASC";
						}
						else
						{
							$queryCategory = "SELECT * FROM as_categories ORDER BY categoryName ASC";
						}
						$sqlCategory = mysqli_query($connect, $queryCategory);
						
						// fetch data
						$i = 1;
						while ($dtCategory = mysqli_fetch_array($sqlCategory))
						{
							
							$content .= "
								<tr valign='top'>
									<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$i</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtCategory[categoryName]</td>
									<td style='padding: 5px 0px 5px 0px; font-size: 10pt;'>$dtCategory[status]</td>
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