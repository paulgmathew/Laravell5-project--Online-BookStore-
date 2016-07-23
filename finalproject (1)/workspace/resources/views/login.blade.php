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
    <div class="login">
      <div class="login__check"></div>
      <div class="login__form" style="top:180px">
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
      <form id="myForm" action='{{route("user.login")}}' method="post">
        <div class="login__row">
          
          <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
          </svg>
          <input type="text" name="username" class="login__input name" placeholder="Username"/>
        </div>
        <div class="login__row">
          <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
          </svg>
          <input type="password" name="password" class="login__input pass" placeholder="Password"/>
        </div>
        <button type="button" class="login__submit">Sign in</button>
        <p class="login__signup">Don't have an account? &nbsp;<a href={{route("user.signupform")}}>Sign up</a></p>
        <input type="hidden" value="{{Session::token()}}" name="_token">
      </form>
      </div>
    </div>
    
   <!-- **********************************************************************************888-->
      <div class="login signup">
      <div class="login__form" style="top:70px">
        @if (count($errors) > 0)
        <div style="color:white;font-size:16px">
          <ul style="font-size:small">
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
          <input type="password" id="email" name="email" class="login__input pass" placeholder="Email"/>
        </div>
        <button id="signup" type="button" class="login__submit">Register</button>
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
    <div class="app">
      <div class="app__top">
        <div class="app__menu-btn">
          <span></span>
        </div>
        <svg class="app__icon search svg-icon" viewBox="0 0 20 20">
          <!-- yeap, its purely hardcoded numbers straight from the head :D (same for svg above) -->
          <path d="M20,20 15.36,15.36 a9,9 0 0,1 -12.72,-12.72 a 9,9 0 0,1 12.72,12.72" />
        </svg>
        <p class="app__hello">Good Morning!</p>
        <div class="app__user">
          <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/142996/profile/profile-512_5.jpg" alt="" class="app__user-photo" />
          <span class="app__user-notif">3</span>
        </div>
        <div class="app__month">
          <span class="app__month-btn left"></span>
          <p class="app__month-name">March</p>
          <span class="app__month-btn right"></span>
        </div>
      </div>
      <div class="app__bot">
        <div class="app__days">
          <div class="app__day weekday">Sun</div>
          <div class="app__day weekday">Mon</div>
          <div class="app__day weekday">Tue</div>
          <div class="app__day weekday">Wed</div>
          <div class="app__day weekday">Thu</div>
          <div class="app__day weekday">Fri</div>
          <div class="app__day weekday">Sad</div>
          <div class="app__day date">8</div>
          <div class="app__day date">9</div>
          <div class="app__day date">10</div>
          <div class="app__day date">11</div>
          <div class="app__day date">12</div>
          <div class="app__day date">13</div>
          <div class="app__day date">14</div>
        </div>
        <div class="app__meetings">
          <div class="app__meeting">
            <img src="//http://s3-us-west-2.amazonaws.com/s.cdpn.io/142996/profile/profile-80_5.jpg" alt="" class="app__meeting-photo" />
            <p class="app__meeting-name">Feed the cat</p>
            <p class="app__meeting-info">
              <span class="app__meeting-time">8 - 10am</span>
              <span class="app__meeting-place">Real-life</span>
            </p>
          </div>
          <div class="app__meeting">
            <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/142996/profile/profile-512_5.jpg" alt="" class="app__meeting-photo" />
            <p class="app__meeting-name">Feed the cat!</p>
            <p class="app__meeting-info">
              <span class="app__meeting-time">1 - 3pm</span>
              <span class="app__meeting-place">Real-life</span>
            </p>
          </div>
          <div class="app__meeting">
            <img src="//s3-us-west-2.amazonaws.com/s.cdpn.io/142996/profile/profile-512_5.jpg" alt="" class="app__meeting-photo" />
            <p class="app__meeting-name">FEED THIS CAT ALREADY!!!</p>
            <p class="app__meeting-info">
              <span class="app__meeting-time">This button is just for demo ></span>
            </p>
          </div>
        </div>
      </div>
      <div class="app__logout">
        <svg class="app__logout-icon svg-icon" viewBox="0 0 20 20">
          <path d="M6,3 a8,8 0 1,0 8,0 M10,0 10,12"/>
        </svg>
      </div>
    </div>
  </div>
</div>
</form>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="{{ URL::secure('src/js/login.js') }}"></script>

    
   
  
  </body>
</html>
