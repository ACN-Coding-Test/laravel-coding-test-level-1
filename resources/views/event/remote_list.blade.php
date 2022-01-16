@extends('layout')
@section('content')
    <div class="row text-right">
      <div class="col-md-12">
          <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>                
              @else
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                         Welcome {{ Auth::user()->name }}
                      </a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                              {{ __('Logout') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
          </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h2>Events Fetched By Remote</h2>                
      </div>  
      <div class="col-md-6 text-right">
        <a href="<?=route('event_list_web')?>">
          <button class="btn btn-primary" type="button" alt="Create Event" title="Create Event"><i class="fa fa-home"></i> Home</button>
        </a>               
      </div>          
    </div>
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Created At</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="events_remote">
            
        </tbody>
      </table>
      
@endsection

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.0.0/sweetalert.min.js" integrity="sha512-zwZQtJZnpG982ihGzVT53UY+yTFtT66spX5HOiYmKFeO1unLJ7NJdprbWOHKAhHdKSDwNKbBgCubsrvGJaAehQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {    
    $.ajax({
        url: 'http://localhost:8000/api/v1/events',
        dataType: 'json',
        success:function(response) {
            console.log(response);
            for (var i = 0; i < response.data.length; i++) {
                $('#events_remote').append(
                    '<tr>' +
                        '<td>' + response.data[i].id + '</td>' +
                        '<td>' + response.data[i].name + '</td>' +
                        '<td>' + response.data[i].slug + '</td>' +
                        '<td>' + moment(response.data[i].createdAt).format('MMMM Do YYYY, h:mm:ss A') + '</td>' +
                        '<td>-</td>' +
                    '</tr>'
                );
            }
        }
    });
});  
</script>


