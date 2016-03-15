<i id="admin-nav-toggler" class="fa fa-bars"></i>

<nav id="sliding-nav" class="js-menu sliding-panel-content">
  <ul>
    <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.user.index') }}">Users</a></li>
    <li><a href="{{ route('admin.post.index') }}">Blog</a></li>
  </ul>
</nav>

<div id="admin-overlay" class="js-menu-screen sliding-panel-fade-screen"></div>