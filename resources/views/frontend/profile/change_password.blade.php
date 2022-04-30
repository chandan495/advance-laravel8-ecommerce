@extends('frontend.main_master')
@section('content')

@php 
$user = DB::table('users')->where('id',Auth::user()->id)->first();
@endphp
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2"><br/>
            <img class="card-img-top" style="border-radius:50%"  src="{{ (!empty($user->profile_photo_path))? url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg') }}" alt="User Avatar" height="100%" width="100%"><br/><br/>
            <ul class="list-group list-group-flush">
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
                <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
               <a href="{{ route('change.password') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                <a href="{{ route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
            </ul>
            </div>
            <div class="col-md-1">
            
            </div>
            <div class="col-md-8">
                <div class="card">
                    <h3 class="text-center">
                    <span class="text-danger">Hi...</span><strong>{{ Auth::user()->name }}</strong> Update your Password
                    </h3>

                     <div class="card-body">
                        <form method="post" action="{{ route('user.password.update') }}">
                        @csrf
                      
                    <div class="form-group">
                       <h5>Current Password <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="password" id="current_password" name="oldpassword" class="form-control" required value="" > </div>
                   </div>

                   <div class="form-group">
                       <h5>New Password <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="password" id="password" name="password" class="form-control" required value="" > </div>
                   </div>

                   <div class="form-group">
                       <h5>Confirm Password <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required value="" > </div>
                   </div>
                  
                    
                    
               
               <div class="form-group">
                   <input type="submit" name="submit" class="btn btn-danger mb-5" value="Update"/>
               </div>
                        </form>
                     </div>   
                
                </div>
            </div>
        </div>
    </div>
</div>

@endsection