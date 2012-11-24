<html lang="en" class=" chrome"><head>
    <meta charset="utf-8">
    <title>Generate PDF</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 10px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 350px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .btn{
          margin-top: 15px;
      }    
      .control-group {
          margin: 0;
      }    
      .form-signin input[type="text"]{
        font-size: 16px;
        width: 330px;
        height: auto;
        margin-top: 15px;
        margin-bottom: 2px;
        padding: 7px 9px;
      }
      span.valid {
          width: 24px;
          height: 24px;
          background: url(img/valid.png) center center no-repeat;
          position: absolute;
          margin-top: 21px !important;
          margin-left: 9px;
          display: inline-block;
          text-indent: -9999px;
      }
      span.error {
          font-weight: bold;
          color: red;
          padding: 2px 2px;
          margin-top: 2px;
      }
      .color-card {
        margin-top: 20px;
        float: left;
        margin-right: 48px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="container">
      <form class="form-signin" action="handler.php" method="POST">
        <h2 class="form-signin-heading">Please fill out all fields</h2>
        <div class="control-group">
            <input type="text" class="input-block-level" name="name" placeholder="Name">
        </div>
        <div class="control-group">
            <input type="text" class="input-block-level" name="funct" placeholder="Function">
        </div>
        <div class="control-group">
            <input type="text" class="input-block-level" name="title1" placeholder="Title 1">
        </div>   
        <div class="control-group">
            <input type="text" class="input-block-level" name="title2" placeholder="Title 2">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="dba" placeholder="DBA">
        </div>
        <div class="control-group ">
            <div class="color-card">
                <span class="label label-info">DBA Font:</span>
            </div>
            <div class="btn-group dba" data-toggle="buttons-radio">
                <button type="button" data-font="1" class="btn btn-info active">Bold</button>
                <input type="hidden" name="dba-font" value="1">
                <button type="button" data-font="0" class="btn btn-info">Normal</button>
            </div>
        </div>
        <div class="control-group">
            <input type="text" class="input-block-level" name="street" placeholder="Street">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="zip" placeholder="Zip / City">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="phone" placeholder="Phone">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="fax" placeholder="Fax">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="mobile" placeholder="Mobile">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="email" placeholder="Email">
        </div>    
        <div class="control-group">
            <input type="text" class="input-block-level" name="web" placeholder="Web-Address">
        </div>
        <div class="control-group ">
            <div class="color-card">
                <span class="label label-info">Color business card:</span>
            </div>
            <div class="btn-group color" data-toggle="buttons-radio">
                <button type="button" data-color="1" class="btn btn-info active">Black</button>
                <input type="hidden" name="color" value="1">
                <button type="button" data-color="0" class="btn btn-info">White</button>
            </div>
        </div>
        <div class="control-group">
            <div class="color-card">
                <span class="label label-warning">Pages:</span>
            </div>
            <div style="padding-left: 76px;" class="btn-group page" data-toggle="buttons-radio">
                <button type="button" data-page="1" class="btn btn-warning active">1-Page</button>
                <input type="hidden" name="pages" value="1">
                <button type="button" data-page="2" class="btn btn-warning">2-Pages</button>
            </div>
        </div>
        <div class="control-group">
            <div class="color-card">
                <span class="label label-success">Generate QR code?:</span>
            </div>
            <div class="btn-group qr" data-toggle="buttons-radio">
                <button type="button" data-qr="1" class="btn btn-success active">Yes</button>
                <input type="hidden" name="qr-code" value="1">
                <button type="button" data-qr="0" class="btn btn-success">No</button>
            </div>
        </div>
        <button class="btn btn-large btn-primary" type="submit">Generate</button>
      </form>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script>
        $(document).ready(function(){
            $('.color .btn').click(function(){
                $('input[name="color"]').val($(this).attr('data-color'));
            });
            $('.qr .btn').click(function(){
                $('input[name="qr-code"]').val($(this).attr('data-qr'));
            });
            $('.dba .btn').click(function(){
                $('input[name="dba-font"]').val($(this).attr('data-font'));
            });
            $('.page .btn').click(function(){
                $('input[name="pages"]').val($(this).attr('data-page'));
            });
            $('.form-signin').validate(
            {
             rules: {
               name: {
                 required: true
               },
               funct: {
                 required: true
               },
               title1: {
                 required: true
               },
//               title2: {
//                 required: true
//               },
//               unit: {
//                 required: true
//               },
               street: {
                 required: true
               },
               zip: {
                 required: true
               },
               phone: {
                 required: true
               },
               fax: {
                 required: true
               },
               email: {
                 required: true,
                 email: true
               },
               web: {
                 required: true
               },
               mobile: {
                 required: true
               }
             },
             highlight: function(label) {
               $(label).closest('.control-group').addClass('error');
             },
             success: function(label) {
               label
                 .text('OK!').addClass('valid')
                 .closest('.control-group').addClass('success');
             }
            });
       });
    </script>

  

</body>
</html>