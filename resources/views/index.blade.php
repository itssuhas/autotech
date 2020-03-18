@extends('base')

@section('page-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <b>Dashboard</b>
            <small><b></b></small>
            <br>

        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">dashboard</li>
        </ol>
    </section>
 <div class="box-body">
      @if(Session::has('alert'))
                 <div class="box-body1">
                    @php ($alert = Session::get('alert'))
                    @if($alert['type']=='error')
                        <div class='alert alert-danger'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×
                            </button>
                            {{$alert['message']}}</div>
                    @else
                        <div class='alert alert-success'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                            {{$alert['message']}}</div>

                    @endif
                    {{Session::forget('alert')}}
                    </div>
                @endif
            </div>

    <!-- Main content -->

    <section class="content">

      <div class="container-fluid">
              <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" style="background-color:#17a2b8!important">
              <div class="inner">
                <h3>150</h3>

                <p><b>Inspectors</b></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="inspector_deatils" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success" style="background-color:#28a745!important">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p><b>Approvers</b></p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="approver_deatils" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" style="background-color: #ffc107!important">
              <div class="inner">
                <h3>44</h3>
                <p><b>Suppliers</b></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="supplier_deatils" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color: #dc3545!important">
              <div class="inner">
                <h3>65</h3>

                <p><b>Defected Parts</b></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
                    <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" style="background-color: #dc3545!important">
              <div class="inner">
                <h3>65</h3>

                <p><b>Total Tickets</b></p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>
    </section>
    
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function(){
            $('.check').on('change', function () {
            if ($(this).is(':checked'))
                $("input[type='checkbox']").prop('checked', true);
            else
                $("input[type='checkbox']").prop('checked', false);
        });
        });
    </script>
@endsection