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
         <?php if($_POST['color'] == 0):?>
         <style>
              table {
                 background: #ffffff; /* Цвет фона таблицы */
                 color: #24262B;
              }
         </style>
         <?php endif;?>
    </head>
    <body>
        <table>
            <tr>
                <th class="name" valign="top" align="left" >
                    <?php echo $_POST['name']?><br>
                    <span id="post"><?php echo $_POST['funct']?></span>
                    <span style="margin-right: 20px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </th>
                <th class="right" rowspan="2" align="left" >
                    <img src="img/<?php echo $_POST['color'] == 0 ? 'wlogo.png' : 'blogo.png'?>" alt="logo">
                </th>
            </tr>
            <tr>

            </tr>
               <tr>
                 <th>

                 </th>
                 <th align="left" class="details" valign="top">
                                                  <span id="logo"><?php echo $_POST['title1']?><?php echo !empty($_POST['title2']) ? ' / ' . $_POST['title2'] : ''?></span><br>
                                                  <br>
                                                  <?php echo $_POST['street']?> <br>
                                                  <?php echo $_POST['zip']?> <br>
                                                  <span id="bold"> T <?php echo $_POST['phone']?></span><br>
                                                  F <?php echo $_POST['fax']?><br>
                                                  M <?php echo $_POST['mobile']?><br>
                                                  <?php echo $_POST['email']?><br>
                                                  <?php echo $_POST['web']?>
                 </th>
               </tr>
               <tr>
                <th class="footer" colspan="2" valign="top" align="left">Jedes CENTURY 21 Büro ist rechttlich und wirschaftlich ein selbstständiges Unternehmen</th>
               </tr>
               <tr>

               </tr>
        </table>
    </body>
</html>
