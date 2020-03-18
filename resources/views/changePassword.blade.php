@extends('base')

@section('page-content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2>
           <b>Update Profile</b>
        </h2>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Update Profile</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <!--div class="box-header with-border">
                <h3 class="box-title">Title</h3>
            </div-->
        <!--     <div class="box-body">
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
              
         
            </div> -->
            <!-- /.box-body -->
            <!--div class="box-footer">
                Footer
            </div-->
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->
         
                <div class="container">
                    @foreach($pack as $values)
                    <form action="{{ route('apassword') }}" method="post" id="retailerreg" name="retailerreg" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="{{$values->id}}">
                            <div class="row">

                                 <div class="col-md-5 name  {{($errors->has('name'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                    <input type="text" value="{{$values->name}}"
                                         name="name" class="form-control"
                                               id="name" placeholder="Enter Name">
                                        @if ($errors->has('name'))
                                            <small class="help-block">
                                                {{ $errors->first('name') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                                  <div class="col-md-5  mob  {{($errors->has('mob'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mob</label>
                                    <input type="text" value="{{$values->mob}}"
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
                                <div class="col-md-5 gmail  {{($errors->has('gmail'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" value="{{$values->gmail}}"
                                         name="gmail" class="form-control"
                                               id="gmail" placeholder="Enter gmail" readonly="">
                                        @if ($errors->has('gmail'))
                                            <small class="help-block">
                                                {{ $errors->first('gmail') }}
                                            </small>
                                        @endif

                                    </div>
                                </div>
                                   <div class="col-md-5  address  {{($errors->has('address'))?'has-error':''}}">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" value="{{$values->address}}"
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
      <div class="col-md-5 current_password  {{($errors->has('current_password'))?'has-error':''}}">
         <div class="form-group">
          <label>Current Password</label><span style="color: red"> *</span>
          <input type="password" id="current_password" name="current_password" placeholder="Enter old password"
                 class="form-control" required>
          @if ($errors->has('current_password'))
              <small class="help-block">
                  {{ $errors->first('current_password') }}
              </small>
          @endif
      </div>
      </div>
  
      <div class="col-md-5 new_password  {{($errors->has('new_password'))?'has-error':''}}">
                 <div class="form-group">
          <label>New Password</label><span style="color: red"> *</span>
          <input type="password" id="new_password" name="new_password" placeholder="Enter new password"
                 class="form-control" required>
          @if ($errors->has('new_password'))
              <small class="help-block">
                  {{ $errors->first('new_password') }}
              </small>
          @endif
      </div>
      </div>
</div>
<div class="row">
  <div class="col-md-5 new_confirm_password  {{($errors->has('new_confirm_password'))?'has-error':''}}">
                     <div class="form-group">
      <label>Confirm Password</label><span style="color: red"> *</span>
      <input type="password" id="new_confirm_password" name="new_confirm_password" placeholder="Confirm password"
             class="form-control" required>
      @if ($errors->has('new_confirm_password'))
          <small class="help-block">
              {{ $errors->first('new_confirm_password') }}
          </small>
      @endif
  </div>
  </div>
    <div class="col-md-5 image  {{($errors->has('image'))?'has-error':''}}">
                     <div class="form-group">
      <label>Image</label><span style="color: red"> *</span>
      <input type="file" id="image" name="image"
             class="form-control" required>
      @if ($errors->has('image'))
          <small class="help-block">
              {{ $errors->first('image') }}
          </small>
      @endif
  </div>
  </div>
</div>
                            <button type="submit" class="btn btn-info">Update</button>
                        </div><!-- /.box-body -->
                    </form>
                    @endforeach

                </div>
            </div>
    </section>
    <!-- /.content -->
    <!-- Modal -->
  
            <!-- Modal content-->
    
     

    <!-- Modal -->
   
    </div>
    <!-- Modal -->
  

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
                                    message: 'Name is required'
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
                address: {
                            validators: {
                                notEmpty: {
                                    message: 'Address is required'
                                }
                            }
                        },
                image: {
                            validators: {
                                notEmpty: {
                                    message: 'Image is required'
                                }
                            }
                        },
                       
                    },
                })
     });

    </script>
    <script>
    </script>

@endsection