<?php
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    ob_start();
    require_once(dirname(__FILE__).'/../html2pdf-4.4.0/html2pdf.class.php');

    if(@$_GET['page']=='') {
	    include(dirname(__FILE__).'/konten/exemple00.php');
    	$content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "coba.pdf";
	}
	else if(@$_GET['page']=='npjl_offline') {
	    include(dirname(__FILE__).'/konten/npjl_offline.php');
    	$content = ob_get_clean();
        $format = new HTML2PDF('P', 'A7', 'en');
        $nama_file = "notapenjualan_offline_".$no_penjualan.".pdf";
	}
    else if(@$_GET['page']=='laporan_penjualan_detail') {
        include(dirname(__FILE__).'/konten/laporan_penjualan_detail.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_penjualan_detail.pdf";
    }
    else if(@$_GET['page']=='laporan_penjualan_rangkuman') {
        include(dirname(__FILE__).'/konten/laporan_penjualan_rangkuman.php');
        $content = ob_get_clean();
        $format = new HTML2PDF('P', 'A4', 'en');
        $nama_file = "laporan_penjualan_rangkuman.pdf";
    }


    // convert in PDF
    try
    {
        $html2pdf = $format;
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output($nama_file);
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
