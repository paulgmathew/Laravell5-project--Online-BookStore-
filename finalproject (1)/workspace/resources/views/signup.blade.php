<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login/Logout animation concept</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    
    
    <link rel='stylesheet prefetch' href='//http://fonts.googleapis.com/css?family=Open+Sans'>

        <link rel="stylesheet" href="{{ URL::secure('src/css/main.css') }}">

    
    
    
  </head>

  <body>

    <div class="cont">
  <div class="demo">
  
    
   <!-- **********************************************************************************888-->
      <div class="login signup">
      <div class="login__form" style="top:70px">
        @if (count($errors) > 0)
        <div style="color:white;font-size:16px">
          <ul>
            @foreach($errors -> all() as $error)
              {{$error}}
            @endforeach
          </ul>
        </div>
        @endif
        @if (Session::has('fail'))
        <div style="color:white;font-size:16px">
          <ul>
           {{Session::get('fail') }}
          </ul>
        </div>
        @endif
      <!--  <form id="myForm" action='{{route("check")}}' method="post">-->
      <form id="signupform" action='{{route("user.signup")}}' method="post">
        <div class="login__row">
          
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" id="username"  name="username" class="login__input name" placeholder="Username"/>
        </div>
         <div class="login__row">
          
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" id="fullname" name="fullname" class="login__input name" placeholder="Fullname"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" id="password" name="password" class="login__input pass" placeholder="Password"/>
        </div><div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password"  id="repassword" name="repassword" class="login__input pass" placeholder="Rewrite Password"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="text" id="email" name="email" class="login__input pass" placeholder="Email"/>
        </div>
        <button id="signup" type="button" class="login__submit">Register</button>
           <p class="login__signup"><a href={{route("user.login")}}>Login</a></p>
        <input type="hidden" value="{{Session::token()}}" name="_token">
      </form>
      </div>
    </div>
  <!--  <div style="background:white;position:relative;float:left;height:80%;width:117%;border:2px solid #dedede;color:black;display:none">
      <form id="signupform" action='{{route("user.signup")}}' method="post">
        <table>
        <tr>
          <td>Username</td>
          <td><input type="text" name="username"  placeholder="Username" /></td>
        </tr>
        <tr>
          <td>Fullname</td>
          <td><input type="text" name="fullname"  placeholder="Fullname"/></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="password" name="password" class="login__input name" placeholder="Password"/></td>
        </tr>
        <tr>
          <td>Password again</td>
          <td><input type="text" name="repassword"  placeholder="rewrite password"/></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><input type="text" name="email"  placeholder="Email ID"/></td>
        </tr>
      </table>
       
         <input type="submit" name="submit" value="submit">Submit</input>
          <input type="hidden" value="{{Session::token()}}" name="_token">
        
      </form>
    </div>-->
  </div>
</div>
</form>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="{{ URL::secure('src/js/login.js') }}"></script>

    
   <script>
   
$('document').ready(function(){ 
 $("#username").focusout(function(e) {
     
    if($("#username").val()!="")
    {
  	$.ajax({
  			type:"POST",
  			url:"{{route('checkUserName')}}",
 			data:{username:$("#username").val(),_token:"{{Session::token()}}"},
  			}).done(function(data) {
				alert(data);
      });
    }
  
      submitForm();
      
  
   });
});   

   </script>
  
  </body>
</html>
