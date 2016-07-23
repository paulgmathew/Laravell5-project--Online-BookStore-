    <div class="header">
	<div class="logo">
	<div id="logoimage">
	</div>
	</div>
	<div id="top">
	<nav id="mainNav">
               <a href="/html/">Welcome  {{Session::get('username') }}</a>
                <a href="{{route('account')}}">Your Account</a> 
              <!--  <a id="checkOutLink">Cart:<!--<img id="cart"  src="images/emptyCart.png"/>--></a><!-- href="{{route('niceaction',['action' => 'checkout'])}}"-->
                <a id="checkOutLink"  href="{{route('cart')}}">Cart:</a>
                 @if(Auth::check())
                 	<a href="{{route('user.logout')}}">Logout</a>
                 @endif
                  @if(!Auth::check())
                 	<a href="{{route('user.login')}}">Login</a>
                 @endif
</nav>
	</div>
	<div id="middle">
	<input type="text" id="searchInput"></input> 
	<div id="search"></div>
	</div>
	
	
	<div id="bottom">
<nav>
  <a  href="{{route('home')}}">HOME</a> <span style="color:#dedede">|</span>
  <a href="{{route('purchaseHistory')}}">HISTORY</a> <span style="color:#dedede"> |</span>
</nav>
	</div>
	</div>
	
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	 <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	 
	 <script src="{{ URL::secure('src/js/home.js') }}"></script>

   
<script>
</script>
