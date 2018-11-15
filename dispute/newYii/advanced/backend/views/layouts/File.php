<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>后台管理</title>
    <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
    <style>
              body {
                padding-top: 70px;
                padding-bottom: 30px;
              }

              body,
              .navbar-fixed-top,
              .navbar-fixed-bottom {
                min-width: 970px;
              }

              .lead {
                font-size: 16px;
              }

              .page-header {
                margin-bottom: 30px;
              }
              .page-header .lead {
                margin-bottom: 10px;
              }

              .container {
                width: 970px;
                max-width: none !important;
              }

              .col-xs-4 {
                padding-top: 15px;
                padding-bottom: 15px;
                background-color: #eee;
                background-color: rgba(86,61,124,.15);
                border: 1px solid #ddd;
                border: 1px solid rgba(86,61,124,.2);
              }

              .container .navbar-header,
              .container .navbar-collapse {
                margin-right: 0;
                margin-left: 0;
              }
              .navbar-header {
                float: left;
              }
              .navbar-collapse {
                display: block !important;
                height: auto !important;
                padding-bottom: 0;
                overflow: visible !important;
                visibility: visible !important;
              }

              .navbar-toggle {
                display: none;
              }
              .navbar-collapse {
                border-top: 0;
              }

              .navbar-brand {
                margin-left: -15px;
              }

              .navbar-nav {
                float: left;
                margin: 0;
              }
              .navbar-nav > li {
                float: left;
              }
              .navbar-nav > li > a {
                padding: 15px;
              }

              .navbar-nav.navbar-right {
                float: right;
              }
              .navbar .navbar-nav .open .dropdown-menu {
                position: absolute;
                float: left;
                background-color: #fff;
                border: 1px solid #ccc;
                border: 1px solid rgba(0, 0, 0, .15);
                border-width: 0 1px 1px;
                border-radius: 0 0 4px 4px;
                -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
                        box-shadow: 0 6px 12px rgba(0, 0, 0, .175);
              }
              .navbar-default .navbar-nav .open .dropdown-menu > li > a {
                color: #333;
              }
              .navbar .navbar-nav .open .dropdown-menu > li > a:hover,
              .navbar .navbar-nav .open .dropdown-menu > li > a:focus,
              .navbar .navbar-nav .open .dropdown-menu > .active > a,
              .navbar .navbar-nav .open .dropdown-menu > .active > a:hover,
              .navbar .navbar-nav .open .dropdown-menu > .active > a:focus {
                color: #fff !important;
                background-color: #428bca !important;
              }
              .navbar .navbar-nav .open .dropdown-menu > .disabled > a,
              .navbar .navbar-nav .open .dropdown-menu > .disabled > a:hover,
              .navbar .navbar-nav .open .dropdown-menu > .disabled > a:focus {
                color: #999 !important;
                background-color: transparent !important;
              }


              .navbar-form {
                float: left;
                width: auto;
                padding-top: 0;
                padding-bottom: 0;
                margin-right: 0;
                margin-left: 0;
                border: 0;
                -webkit-box-shadow: none;
                        box-shadow: none;
              }

              .navbar-form .form-group {
                display: inline-block;
                margin-bottom: 0;
                vertical-align: middle;
              }

              .navbar-form .form-control {
                display: inline-block;
                width: auto;
                vertical-align: middle;
              }

              .navbar-form .form-control-static {
                display: inline-block;
              }

              .navbar-form .input-group {
                display: inline-table;
                vertical-align: middle;
              }

              .navbar-form .input-group .input-group-addon,
              .navbar-form .input-group .input-group-btn,
              .navbar-form .input-group .form-control {
                width: auto;
              }

              .navbar-form .input-group > .form-control {
                width: 100%;
              }

              .navbar-form .control-label {
                margin-bottom: 0;
                vertical-align: middle;
              }

              .navbar-form .radio,
              .navbar-form .checkbox {
                display: inline-block;
                margin-top: 0;
                margin-bottom: 0;
                vertical-align: middle;
              }

              .navbar-form .radio label,
              .navbar-form .checkbox label {
                padding-left: 0;
              }

              .navbar-form .radio input[type="radio"],
              .navbar-form .checkbox input[type="checkbox"] {
                position: relative;
                margin-left: 0;
              }

              .navbar-form .has-feedback .form-control-feedback {
                top: 0;
              }

              .form-inline .form-group {
                display: inline-block;
                margin-bottom: 0;
                vertical-align: middle;
              }

              .form-inline .form-control {
                display: inline-block;
                width: auto;
                vertical-align: middle;
              }

              .form-inline .form-control-static {
                display: inline-block;
              }

              .form-inline .input-group {
                display: inline-table;
                vertical-align: middle;
              }
              .form-inline .input-group .input-group-addon,
              .form-inline .input-group .input-group-btn,
              .form-inline .input-group .form-control {
                width: auto;
              }

              .form-inline .input-group > .form-control {
                width: 100%;
              }

              .form-inline .control-label {
                margin-bottom: 0;
                vertical-align: middle;
              }

              .form-inline .radio,
              .form-inline .checkbox {
                display: inline-block;
                margin-top: 0;
                margin-bottom: 0;
                vertical-align: middle;
              }
              .form-inline .radio label,
              .form-inline .checkbox label {
                padding-left: 0;
              }

              .form-inline .radio input[type="radio"],
              .form-inline .checkbox input[type="checkbox"] {
                position: relative;
                margin-left: 0;
              }

              .form-inline .has-feedback .form-control-feedback {
                top: 0;
              }
    </style>
  </head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="javascript:void(0)">Wechat</a>
        </div>

        <div id="navbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="javascript:void(0)">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>

             <li class="dropdown">
              <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$val['power_name']?> <span class="caret"></span></a>

              <ul class="dropdown-menu">
                  <li><a href="index.php?r=<?=$v['controller'].'/'.$v['action']?>"></a></li>

              </ul>
            </li>
          
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li style="margin-left:10px;">  
                <button type="button" class="btn btn-default btn-lg remove">
                   <span class="glyphicon glyphicon-off"></span> Off
                </button>
             </li>
          </ul>
        </div>
      </div>
    </nav>
    <?=$content?> 
 </body>
</html>



