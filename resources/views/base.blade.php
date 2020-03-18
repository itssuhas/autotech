<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Auto Tech</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" media="print">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
     
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="/css/customStyle.css">

<style type="text/css">
    table {
  font-size: 16px!important;
  background-color: transparent;
}
label
{
    font-size: 16px!important;

}
</style>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <!--   <script src="/bower_components/jquery/dist/jquery.printPage.js"></script> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link href="/css/formValidation.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">

{{--@if(count($data['notificationArr'])>0)
    <div style="position: relative; height: 0px;z-index: 9999;right: 250px !important;top: 49px;float: right;">
        <ul class="dots">
            <li>
                <a href="#near" role="button"  data-modal-position="relative" data-toggle="modal" data-placement="left" style="position: absolute; left: 50px; top: 10px;">
                    <span class="glyphicon glyphicon-bell" style="background-color: #ddd"><mark>{{$data['notificationArr'][0]['paginate']->total()}}</mark></span>
                </a>
            </li>
        </ul>

    </div>
@endif--}}

<!-- Site wrapper -->
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="/dashboard" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>T</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Auto Tech</b>
            </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/dist/img/{{ Auth::user()->image}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="/dist/img/{{ Auth::user()->image}}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }} - {{ Auth::user()->user_type }}
                                    <small>Auto Tech</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                <a href="{{route('apassword')}}" class="btn btn-default btn-flat"><b>Profile</b>
                                </a>
                            </div>
                               <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat"><b>Sign out</b>
                                </a>
                            </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="/dist/img/{{ Auth::user()->image}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i>Auto Tech</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
             @if(Auth ::user()->user_type == 'ADMIN')
                <li class="treeview">
                    <a href="dashboard">
                        <i class="fa fa-tachometer"></i> <span>DASHBOARD</span>
                        <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                </li>
                @endif
                @if(Auth ::user()->user_type == 'ADMIN')
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-user-o"></i> <span>Manage Inspector</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                     
                        <li>
                            <a href="inspector_deatils">
                                <i class="fa fa-circle-o"></i> <span>Add Inspector</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth ::user()->user_type == 'ADMIN')
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-user-o"></i> <span>Manage Approver</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                    
                         <li>
                            <a href="approver_deatils">
                                <i class="fa fa-circle-o"></i> <span>Add Approver</span>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                @endif
               @if(Auth ::user()->user_type == 'ADMIN')
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-user-o"></i> <span>Manage Supplier</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="supplier_deatils">
                                <i class="fa fa-circle-o"></i> <span>Add Suppliers</span>
                            </a>
                        </li>
                    
                    </ul>
                </li>
                @endif
                @if(Auth ::user()->user_type == 'INSPECTOR')
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-user-o"></i> <span>Manage Inspector</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                     
                        <li>
                            <a href="inspector_deatils">
                                <i class="fa fa-circle-o"></i> <span>Add Controlled Copy</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if(Auth ::user()->user_type == 'APPROVER')
                <li class="treeview">
                    <a href="javascript:void(0);">
                        <i class="fa fa-user-o"></i> <span>Manage Approver</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                     
                        <li>
                            <a href="inspector_deatils">
                                <i class="fa fa-circle-o"></i> <span>Manage Controlled Copy</span>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

</ul>
</section>
<!-- /.sidebar -->
</aside>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
@yield('page-content')
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
<div class="pull-right hidden-xs">
<b>Laravel Version</b> 5.8
</div>
<!-- ./wrapper -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  -->
<!-- <script src="/bower_components/jquery/dist/jquery.printPage.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/dist/js/demo.js"></script>

<link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/js/formValidation.min.js"></script>
<script src="/plugins/formvalidation/framework/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
    $('.changepass').formValidation({
        framework: 'bootstrap',
        icon: {},
        fields: {
            oldpass: {
                validators: {
                    notEmpty: {
                        message: 'Enter old Password'
                    }
                }
            },
            newpass: {
                validators: {
                    notEmpty: {
                        message: 'Enter new Password'
                    }
                }
            },
            cnewpass: {
                validators: {
                    notEmpty: {
                        message: 'Enter new Password'
                    },
                    identical: {
                        field: 'newpass',
                        message: 'The password and its confirm are not the same'
                    }
                }
            }
        }
    });

$(document).ready(function () {
$('.sidebar-menu').tree()
(function($){
$('#header').popover('show');
})(jQuery);
});


    $(function () {
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'dd-M-yyyy'
        })
    });

    $(function () {
        $('#datepickers').datepicker({
            autoclose: true,
            format: 'dd-M-yyyy'
        })
    })
</script>
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<script type="text/javascript" src="/js/bootstrap-modal-popover.js"></script>
@yield('page-scripts')
</body>
</html>

