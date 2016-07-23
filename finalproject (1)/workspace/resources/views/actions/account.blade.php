@extends('layouts.master')
@section('content')
<script>
</script>
<div style="width:95%;height:50%;border:2px solid #dedede;margin-left:10px">
    <h1>User Details</h1>
      @if (count($errors) > 0)
        <div style="color:red;font-size:16px">
          <ul>
            @foreach($errors -> all() as $error)
              {{$error}}
            @endforeach
          </ul>
        </div>
        @endif
        @if(Session::has('success'))
         <div style="color:green;font-size:16px">
           {{ Session::get('success') }}
        </div>
        @endif
	<form  action='{{route("useredit")}}' method="post">			
	@foreach($user as $users )
	<input type="hidden" name="id" id="id" value="{{$users->id}}"></input>
    <table>
    <tr>
    <td height="36" width="100" >Fullname</td>
    <td height="36" width="200" ><input type="text" name="fullname" id="fullname" value="{{$users->fullName}}"></input> </td>
    </tr>    
    <tr>
    <td>Address</td></td>
    <td><textarea class="{{$users->id}}" type="text" name="address" id="address" rows="4" cols="50" value="{{$users->address}}">{{$users->address}}</textarea> </td>
    </tr>    
    <tr>
    <td>Phone</td>
    <td><input class="{{$users->id}}" type="text" name="phone" id="phone" value="{{$users->phone}}"></input> </td>
    </tr>    
     <tr>
    <td>Email</td>
    <td><input class="{{$users->id}}" type="text"  name="email" id="email" value="{{$users->email}}"></input></td>
    </tr>   
    
    <tr>
    <td><!--<div style="background-color:#DEDEDE;
  border-radius:5px;
  height:31px;
  text-align:center;
  width:33px;"><a id="edit" name="Edit" value="Edit">Edit</a></div>-->
  <input type ="button" id="edit" value="Edit" style="width:40px;"></input></td>
    <td><input type ="submit" value="Submit"></input>  <input type="hidden" value="{{Session::token()}}" name="_token"/></td>
    </tr>   
    </table>
    @endforeach
    </form>

</div>
<script>
$(document).ready(function(){
   $("textarea").prop("readonly", true);
     $("input").prop("readonly", true);
     $("#checkOutLink").hide();
     
     
     $("#edit").click(function(){
          $("textarea").prop("readonly", false);
     $("input").prop("readonly", false);
     
         
     });
     
     
     
});
</script>
@endsection