<?php 

//    ///////////////TEST MODE\\\\\\\\\\\\\\\
    function getCountryByIp($ipAddress)
    {
        $ipDetail=array();
        $f = file_get_contents("http://api.hostip.info/?ip=".$ipAddress);
        //Получаем код страны
        preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si", $f, $countryCode);
        $ipDetail['countryCode'] = $countryCode[1];

        return $ipDetail;
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip = '204.79.229.0';
    $ipDetail = getCountryByIp($ip);
    $country = $ipDetail['countryCode'];
    $connect = mysql_connect('localhost', 'root', '123456');
    mysql_select_db('pdf');
    $query = "SELECT COUNT(*) FROM pdf WHERE country='".$country."'";
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    $total = $row[0];
    if($total > 4) die('This is a test mode. I set limitation');
    $sql = " INSERT INTO pdf (country) VALUES
         ('$country') ";
    $result1 = mysql_query($sql);
    mysql_close($connect);
//    /////////////////////////////////////////
 
    
    
    
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
    require_once('libraries/tcpdf/config/lang/eng.php');
    require_once('libraries/tcpdf/tcpdf.php');
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 007');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(0, 0);
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
    $pdf->SetAutoPageBreak(TRUE, '');
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->setLanguageArray($l);
    $pdf->setFontSubsetting(false);
    
    
    // ---------------------FRONT--------------------------- //
    $pdf->AddPage();
    $style_left = "<style>
                          @font-face {font-family: 'name'; src: url('font/itcavantgardeprobold.ttf') format('truetype');}        
                          @font-face {font-family: 'post'; src: url('font/itcavantgardeprobk.ttf') format('truetype');}
                          .name{font-family: name; font-size: 2.8mm; line-height: 3.13mm;}
                          #post{font-family: post; font-size: 2.30mm;}
                   </style>";
    
    $style_right = "<style>
                           @font-face{font-family: 'logo'; src: url('font/scalasansrglfsc.ttf') format('truetype');}
                           @font-face{font-family: 'name'; src: url('font/itcavantgardeprobold.ttf') format('truetype');}
                           .logo{font-family: logo; font-size: 3mm; line-height: 3.76mm;}
                           .logo_bold{font-family: name; font-size: 3.1mm; line-height: 3.7mm;}
                    </style>";
    
    $left_column = $style_left.'<br><br><span class="name">'.$_POST['name'] . '</span><br>' . $_POST['funct'].'<br>'.$_POST['title1'].(!empty($_POST['title2']) ? ' / ' . $_POST['title2'] : '');
    
    if($_POST['color'] == 1){
        $pdf->SetFillColor(60, 40, 20, 100);
        $pdf->SetTextColor(255,255,255);
    }else{
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(60, 40, 20, 100);        
    }
    
    $right_column = $style_right . $pdf->ImageSVG($file='img/' . ($_POST['color'] == 1 ? 'b' : 'w') . 
            'logo_obrez.svg', $x=42.69, $y=4.75).'<br><br><br><span class="'.($_POST['dba-font'] == 1 ? 'logo_bold' : 'logo').'">'
            .(!empty($_POST['dba']) ? ($_POST['dba-font'] == 1 ? strtoupper($_POST['dba']) : $_POST['dba'])  : "").'</span><br><br style="line-height: 0.35mm">'.
            $_POST['street'].'<br style="line-height: 0.40mm">'.
            $_POST['zip'].'<br style="line-height: 0.42mm">'.
            '<span style="font-family: name">T '.$_POST['phone'].'</span>'.'<br style="line-height: 0.43mm">'.
            'F '.$_POST['fax'].'<br style="line-height: 0.43mm">'.
            'M '.$_POST['mobile'].'<br style="line-height: 0.43mm">'.
            $_POST['email'].'<br style="line-height: 0.43mm">'.
            $_POST['web']
            ;

//    $pdf->writeHTMLCell($w,   $h,    $x, $y, $html, $border, $ln, $fill, $reseth, $align);
    $color_border = array('LTRB' => array('width' => -5, 'color' =>($_POST['color'] == 1 ?  array(60, 40, 20, 100) : array(255, 255, 255))));
    $pdf->writeHTMLCell(6.88, 54.07, '', '', '', $color_border, 0, 1, true, 'J', true);
    $pdf->SetFont('post', '', 6.6);
    $pdf->writeHTMLCell(35.3, 54.05, 6.88, '', $left_column, $color_border, 0, 1, true, 'J', true);
    $pdf->SetFont('post', 'b', 7.4);
    $pdf->writeHTMLCell(51.80, 54.05, '', '', $right_column, $color_border, 0, 1, true, 'J', true); 
    $pdf->SetFont('post', 'b', 4);
    $pdf->writeHTMLCell(1, 54.05, 6.5, 0, '', $color_border, 0, 1, true, 'J', true);
    $pdf->writeHTMLCell(1, 54.05, 41.5, 0, '', $color_border, 0, 1, true, 'J', true);
    $pdf->writeHTMLCell(1, 54.05, 93.5, 0, '', $color_border, 0, 1, true, 'J', true);
    $pdf->writeHTMLCell(88.05, 5.95, 6.8, 48.12055, 'Jedes CENTURY 21 Büro ist rechtlich und wirtschaftlich ein selbstständiges Unternehmen.', $color_border, 0, 1, true, 'J', true);
    $pdf->writeHTMLCell(94.05, 5.95, 0, 48.12055, '', $color_border, 0, 1, true, 'J', true);
    $pdf->lastPage();

    // ---------------------END FRONT---------------------- //
    
    
    // ---------------------BACK--------------------------- //
    
    $pdf->AddPage();
    $pdf->setFontSubsetting(false);
    
    if($_POST['color'] == 1){
        $pdf->SetFillColor(60, 40, 20, 100);
        $pdf->SetTextColor(255,255,255);
    }else{
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(60, 40, 20, 100);        
    }
    $right_column = '';
    if($_POST['qr-code'] == 1){
        $right_column = $pdf->Image($_POST['name'].'.png', 74, 38, 12, 12);
    }
    
    $pdf->writeHTMLCell(6.78, 54.05, '', '', '', $color_border, 0, 1, true, 'J', true);
    $pdf->SetFont('post', '', 6.5);
    $pdf->writeHTMLCell(35.3, 54.05, '', '', '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br style="line-height: 0.565mm">facebook.com/century21de', $color_border, 0, 1, true, 'J', true);
    $pdf->writeHTMLCell(1, 54.05, 6.5, 0, '', $color_border, 0, 1, true, 'J', true);
    
    if($_POST['color'] != 1){
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(255,255,255);
    }else{
        $pdf->SetFillColor(60, 40, 20, 100);
        $pdf->SetTextColor(60, 40, 20, 100);        
    }
    $pdf->writeHTMLCell(52, 54.05, 42, '', $right_column, $color_border, 0, 1, true, 'J', true); 
    $pdf->writeHTMLCell(3, 54.05, 41.5, '', '', $color_border, 0, 1, true, 'J', true); 
    $pdf->writeHTMLCell(94.05, 5.95, 0, 48.12055, '', $color_border, 0, 1, true, 'J', true);
    
    $pdf->lastPage();
    
    // ---------------------END FRONT--------------------------- //
    
    
    $pdf->Output($_POST['name'].'.pdf', 'D');
    @unlink($qr);
?>
