@extends('layouts.app')
 
@section('content')
<h1>Enter Your Details.</h1>
{!! Form::open(['action'=> 'DashController@store', 'method'=>'POST']) !!}
<div class="form-group">
<div class="row">
<div class="col">    

    {{Form::label('first_name','First Name :')}}
    {{Form::text('first_name','',['class'=>'form-control','placeholder'=>'First Name', 'required'])}}


</div>
<div class="col">

        {{Form::label('second_name','Second Name :')}}
        {{Form::text('second_name','',[ 'class'=>'form-control','placeholder'=>'Second Name', 'required'])}}

  
</div>
<div class="col">
  
        {{Form::label('last_name','Last Name :')}}
        {{Form::text('last_name','',[ 'class'=>'form-control ','placeholder'=>'Last Name', 'required'])}}

  
</div>
</div>
</div>
 <div class="form-group">
     <div class="row">
         <div class="col">
            {{Form::label('dob','Date of Birth :')}}
            {{Form::date('dob','',[ 'class'=>'form-control ','placeholder'=>'Date of Birth', 'required'])}}
         </div>
         <div class="col">
            {{Form::label('age','Age :')}}
            {{Form::number('age','',[ 'class'=>'form-control col-2','placeholder'=>'Age', 'required'])}}
         </div>
     </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-3">
        {{Form::label('gender','Gender :')}}<br>
        {{Form::label('gender','Male :')}}
        {{Form::radio('gender','Male',[ 'class'=>'form-control '])}}
        {{Form::label('gender','Female :')}}
        {{Form::radio('gender','Female',[ 'class'=>'form-control '])}}
        </div>
        <div class="col-4">
        {{Form::label('nic','NIC :')}}
        {{Form::text('nic','',[ 'class'=>'form-control ','placeholder'=>'NIC Number', 'required'])}}
        </div>
    </div>
</div>
  
  <div class="form-group">
        {{Form::label('address','Address :')}}
        {{Form::text('address','',[ 'class'=>'form-control ','placeholder'=>'Address', 'required'])}}
</div>
<div class="form-group">
        <div class="row">
                <div class="col">
        {{Form::label('m_tp_no','Mobile :')}}
        {{Form::number('m_tp_no','',[ 'class'=>'form-control ','placeholder'=>'Contact Number', 'required'])}}
    </div>
    <div class="col">
        {{Form::label('h_tp_no','Land line :')}}
        {{Form::number('h_tp_no','',[ 'class'=>'form-control ','placeholder'=>'Contact Number', 'required'])}}
    </div>
    </div>
    </div>
    <div class="form-group">
            {{Form::label('email','Email :')}}
            {{Form::text('email','',['class'=>'form-control  col-md-6','placeholder'=>'Email', 'required'])}}
        
        </div>
        <br>
        <hr>
        <h4>User Emergency Details</h4>
        <hr>
        <br>
        <div class="form-group">
                {{Form::label('b_grp','Blood Group :')}}
                {{Form::text('b_grp','',['class'=>'form-control  col-md-2','placeholder'=>'Blood Groop', 'required'])}}
            
            </div>


<div class="form-group">
    <div class="row">
        <div class="col">
            <hr>
            {{Form::label('emg_one','Emergency Contact 1 :')}}<hr>
            {{Form::label('emg_one_name','Name :')}}
            {{Form::text('emg_one_name','',['class'=>'form-control ','placeholder'=>'Name', 'required'])}}
            {{Form::label('emg_one_relationto_user','Relation to User :')}}
            {{Form::text('emg_one_relationto_user','',['class'=>'form-control ','placeholder'=>'Relation to User', 'required'])}}
            {{Form::label('emg_one','Contact Number :')}}
            {{Form::number('emg_one','',['class'=>'form-control ','placeholder'=>'Contact Number', 'required'])}}
        </div>
        <div class="col">
                <hr>
            {{Form::label('emg_two','Emergency Contact 2 :')}}<hr>
            {{Form::label('emg_two_name','Name :')}}
            {{Form::text('emg_two_name','',['class'=>'form-control ','placeholder'=>'Name', 'required'])}}
            {{Form::label('emg_two_relationto_user','Relation to User :')}}
            {{Form::text('emg_two_relationto_user','',['class'=>'form-control  ','placeholder'=>'Relation to User', 'required'])}}
            {{Form::label('emg_two','Contact Number :')}}
            {{Form::number('emg_two','',['class'=>'form-control ','placeholder'=>'Contact Number', 'required'])}}
        </div>
    </div>
    </div>
    <div class="form-group">
            {{Form::label('description','Description :')}}
            {{Form::textarea('description','',[ 'id'=>'article-ckeditor','class'=>'form-control ','placeholder'=>'Description'])}}

  </div>
   
    {{Form::submit('Save',['class'=>'btn btn-success'])}} 
{!! Form::close() !!}  
</div>
@endsection