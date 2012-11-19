<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="css/bc.css" rel="stylesheet" type="text/css" />
    </head>
    <?php if($_POST['color'] == 0):?>
    <style>
         table {
            background: #f4f5fa; /* Цвет фона таблицы */
            color: #24262B;
         }
    </style>
    <?php endif;?>
    <body>
        <div>
            <table>
               <tr>
                    <th class="back" align="left">
                        <span>facebook.com/century21de</span>
                    </th>
                    <th align="left"> 
                        <?php if(!empty($qr)):?>
                        <img id="rq" src="<?php echo $qr?>" alt="qr">
                        <?php else:?>
                        <img id="rq" <?php echo $_POST['color'] == 1 ? 'style="margin-bottom: 37px;"' : ''?> src="img/<?php echo $_POST['color'] == 0 ? 'qrwhite' : 'qrblack'?>.png" alt="qr">
                        <?php endif;?>
                    </th>
               </tr>
            </table>
            
        </div>
    </body>
</html>
