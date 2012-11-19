<?php 
//
//    ///////////////TEST MODE\\\\\\\\\\\\\\\
//    function getCountryByIp($ipAddress)
//    {
//        $ipDetail=array();
//        $f = file_get_contents("http://api.hostip.info/?ip=".$ipAddress);
//        //Получаем код страны
//        preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si", $f, $countryCode);
//        $ipDetail['countryCode'] = $countryCode[1];
//
//        return $ipDetail;
//    }
//    $ip = $_SERVER['REMOTE_ADDR'];
//    $ip = '204.79.229.0';
//    $ipDetail = getCountryByIp($ip);
//    $country = $ipDetail['countryCode'];
//    $connect = mysql_connect('localhost', 'root', '123456');
//    mysql_select_db('pdf');
//    $query = "SELECT COUNT(*) FROM pdf WHERE country='".$country."'";
//    $result = mysql_query($query);
//    $row = mysql_fetch_row($result);
//    $total = $row[0];
//    if($total > 4) die('This is a test mode. I set limitation');
//    $sql = " INSERT INTO pdf (country) VALUES
//         ('$country') ";
//    $result1 = mysql_query($sql);
//    mysql_close($connect);
//    /////////////////////////////////////////
//    
    
    
    
    $qr = '';
    if($_POST['qr-code'] == 1){
        $qr = time().'test1.png';
        include 'libraries/phpqrcode/qrlib.php';
        $url = $_POST['web'];
        if(strpos($url, 'https://') === FALSE){
           $url = str_replace('http://', '', $url);
           $url =  'http://' . $url;
        }
        $qr = $_POST['name'].'.png';
        QRcode::png($url, $qr, 'L', 2, 0);
        chmod($qr, 0777);
    }

    include 'libraries/html2pdf/html2pdf.class.php';
    ob_start();
    include(dirname(__FILE__).'/table.php');
    $front = ob_get_clean();
    ob_end_clean();
    $html2pdf = new HTML2PDF('L','A4','en', true, 'UTF-8', 0);
    $html2pdf->writeHTML($front);
    
    ob_start();
    include(dirname(__FILE__).'/back.php');
    $back = ob_get_clean();
    $html2pdf->writeHTML($back);
    $html2pdf->Output($_POST['name'] . '.pdf', 'D');
    @unlink($qr);
?>