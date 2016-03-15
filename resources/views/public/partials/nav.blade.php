<header class="navigation" role="banner">
	<div class="navigation-wrapper">
		<a href="javascript:void(0)" class="logo">
			<img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo Image">
		</a>
		<a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
		<nav role="navigation">
			<ul id="js-navigation-menu" class="navigation-menu show">
				<li class="nav-link"><a href="/blog">Blog</a></li>
				@if(auth()->user())
					<li class="nav-link nav-link-right"><a href="{{ route('logout') }}">Logout</a></li>
				@else
					<li class="nav-link nav-link-right"><a href="{{ route('register.show') }}">Register</a></li>
					<li style="right: 65px;" class="nav-link nav-link-right"><a href="{{ route('login') }}">Login</a></li>
				@endif
			</ul>
		</nav>
	</div>
</header>
