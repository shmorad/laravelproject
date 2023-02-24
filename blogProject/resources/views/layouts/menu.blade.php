<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{url('/')}}"><img class="brand-logo ml-5" src="{{asset('images/logo.svg.png')}}" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url('/')}}">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/service')}}">SERVICE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{'/protfolio'}}">PORTFOLIO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{'/about'}}">ABOUT</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>