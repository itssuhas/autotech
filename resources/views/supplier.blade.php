@extends('base')
@section('page-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
     <b>Supplier Details</b>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Supplier Details</li>
        </ol>
    </section>
    <!-- Main content -->
      <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <!--div class="box-header with-border">
                <h3 class="box-title">Title</h3>
            </div-->
            <div class="box-body">
                @if(Session::has('alert'))
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
                @endif
                <div class="box-body">
                    <div class="row">
                 

                        <div class="col-md-12">
                            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#addRetailer">Add Supplier</button>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    @if(isset($supplier))
                
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-hover retailer-search">
                                    <thead>
                                    <tr>
                                       <th>id</th>
                                       <th>Name</th>
                                       <th>Mob No</th>
                                       <th>Gmail</th>
                                       <th>Address</th>
                                       <th>Update</th>
                                       <th>Delete</th>
                                     </tr>
                                     </thead>
                                     @php($i=1)
                                      @foreach($supplier as $item)
                                        <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->mob}}</td>
                                        <td>{{$item->gmail}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>                               <a href="{{URL::to('supplierupdate/'.$item->id) }}">
                                       <span class="glyphicon glyphicon-edit">
                                          Update
                                       </span> </a></td>
                                       <td>
                                        <a href="{{URL::to('Supplierdelete/'.$item->id) }}">
                                       <span style="color:red;" class="fa fa-trash" onclick="return confirm('Are you sure......?')">
                                          Delete
                                       </span> </a>

                                        </td>
                                        </tr>
                                 @endforeach
                            </table>
                            </div>
                            <div class="retailer-pagination">
                            </div>
                        @else
                            <table class="table table-responsive table-hover">
                                <tr><th>No Record focund</th></tr>
                            </table>
                @endif
                </div>
            </div>
            <!-- /.box-body -->
            <!--div class="box-footer">
                Footer
            </div-->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="addRetailer" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Supplier</h4>
                </div>
                <div class="modal-body">
                    <form action="supplier_deatils" method="post" id="retailerreg" name="retailerreg" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="box-body">
                            
                            <div class="row">
                                <div class="col-md-12 name  {{($errors->has('name'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" value="{{old('name')}}"
                                         name="name" class="form-control"
                                               id="name" placeholder="Enter Name">
                                        @if ($errors->has('name'))
                                            <small class="help-block">
                                                {{ $errors->first('name') }}
                                            </small>
                                        @endif

                                    </div>
                                </div>
                                   <div class="col-md-12  mob  {{($errors->has('mob'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mob</label>
                                        <input type="text" value="{{old('mob')}}"
                                         name="mob" class="form-control"
                                               id="mob" placeholder="Enter Mob No">
                                        @if ($errors->has('mob'))
                                            <small class="help-block">
                                                {{ $errors->first('mob') }}
                                            </small>
                                        @endif

                                    </div>
                                </div>
                          </div>
                        <div class="row">
                                <div class="col-md-12 gmail  {{($errors->has('gmail'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gmail</label>
                                        <input type="text" value="{{old('gmail')}}"
                                         name="gmail" class="form-control"
                                               id="gmail" placeholder="Enter gmail">
                                        @if ($errors->has('gmail'))
                                            <small class="help-block">
                                                {{ $errors->first('gmail') }}
                                            </small>
                                        @endif

                                    </div>
                                </div>
                                   <div class="col-md-12  address  {{($errors->has('address'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" value="{{old('address')}}"
                                         name="address" class="form-control"
                                               id="address" placeholder="Enter Address">
                                        @if ($errors->has('address'))
                                            <small class="help-block">
                                                {{ $errors->first('address') }}
                                            </small>
                                        @endif

                                    </div>
                                </div>
                          </div>
                        <div class="row">
                                <div class="col-md-12 password  {{($errors->has('password'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="text" value="{{old('password')}}"
                                         name="password" class="form-control"
                                               id="password" placeholder="Enter Password">
                                        @if ($errors->has('password'))
                                            <small class="help-block">
                                                {{ $errors->first('password') }}
                                            </small>
                                        @endif

                                    </div>
                                </div>
                          </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pull-right">Submit</button>
                            </div>
                        </div><!-- /.box-body -->
                    </form>
                </div>
            </div>
        </div>
    </div>

   
   
    </div>
    </div>
@endsection
@section('page-scripts')
    @if(Session::has('errorModal'))
        $errorModal = Session::get('errorModal')
        @if($errorModal='retailerRegistration')
            <script>
                $(document).ready(function() {
                    $('#addRetailer').modal('show');
                });
            </script>
        @endif

        @if($errorModal='retailerAssignIds')
            <script>
                $(document).ready(function() {
                    //$('#modalAssignIds').modal('show');
                });
            </script>
        @endif
    @endif

    <script type="text/javascript">
        $(document).ready(function () {

            $('#retailerreg')
                .formValidation({
                    framework: 'bootstrap',
                    icon: {},
                    fields: {

                        name: {
                            validators: {
                                notEmpty: {
                                    message: 'city name is required'
                                }
                            }
                        },
                    mob: {
                            validators: {
                                notEmpty: {
                                    message: 'Mob No is required'
                                }
                            }
                        },
                    gmail: {
                            validators: {
                                notEmpty: {
                                    message: 'Gmail is required'
                                }
                            }
                        },
                address: {
                            validators: {
                                notEmpty: {
                                    message: 'Address is required'
                                }
                            }
                        },
                password: {
                            validators: {
                                notEmpty: {
                                    message: 'Password is required'
                                }
                            }
                        },
                   
                    },
                })


        });
    </script>
@endsection