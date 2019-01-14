<!-- Sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item {{\Route::current()->getName() == 'home' ? 'active' : ''}}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Trades</h6>
            <a class="dropdown-item {{\Route::is('trades.*') ? 'active' : ''}}" href="/trades">Trades</a>
            <a class="dropdown-item {{\Route::is('watchlist.*') ? 'active' : ''}}" href="/watchlist">Watchlist</a>
            <a class="dropdown-item {{\Route::is('history.*') ? 'active' : ''}}" href="/history">History</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Admin</h6>
            <a class="dropdown-item {{\Route::is('currencyPairs.*') ? 'active' : ''}}" href="/currency/pairs">Currency Pairs</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Auth</h6>
            <a class="dropdown-item" href="/logout">Logout</a>
        </div>
    </li>
    <li class="nav-item {{\Route::current()->getName() == 'charts' ? 'active' : ''}}">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
        </a>
    </li>
</ul>