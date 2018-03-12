<nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/dashboard') }}"><img src="{{asset('images/favicon.png')}}" width="30" alt="{{ config('app.name', 'Sistema de orçamentos') }}"> {{ config('app.name', 'Sistema de orçamentos') }}</a>
    <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav ml-auto"> 
        @guest
            <li class="nav-item active" ><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Cadastrar</a></li>
        @else
        <li class="nav-item"><a class="nav-link" href="{{ route('customers') }}"><i class="fa fa-users"></i> Clientes</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('products') }}"><i class="fa fa-cubes"></i> Produtos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('orders') }}"><i class="fa fa-dollar-sign"></i> Orçamentos</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-unlock-alt"></i> {{Auth::user()->name}}</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="{{ route('logout') }}">Perfil</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                Sair
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
          </div>
        </li>
        @endguest
      </ul>
    
    </div>
  </nav>