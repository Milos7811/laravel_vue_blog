


    <div  class="user-image-wrapper">
        <img src="{{auth()->user()->avatar}}" alt="..." class="user-image">
    </div>
<div class="nav-button">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <a class="text-white">{{auth()->user()->name}}</a>
  </button>
  <div class="dropdown-menu dropdown-menu-right">
    <a  class="dropdown-item" type="button" href="/users/{{auth()->user()->id}}">Profil</a>
    <button class="dropdown-item" type="button"> <a  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Odhlasenie') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></button>
  </div>
  </div>


