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
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
  <div class="col-md-3">
    <h2><?= ($search == '1') ? 'Search' : 'All' ?> Events</h2>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
    <form id="event_search_form" action="<?= route('search_event_web') ?>" method="post">
      <div class="input-group">
        <input type="text" id="event_search_val" name="event_search_val" class="form-control" placeholder="ID, Event name, or Slug...">
        <span class="input-group-btn">
          @csrf
          <?php
          if ($search == '1') {
          ?>
            <a href="<?= route('event_list_web') ?>">
              <button id="event_search_reset" class="btn btn-primary form-control" type="button" alt="Search Reset" title="Search Reset"><i class="fa fa-refresh"></i></button>
            </a>
          <?php
          } else {
          ?>
            <button id="event_search" style="background-color:black;" class="btn btn-primary form-control" type="submit" alt="Search" title="Search"><i class="fa fa-search"></i></button>
          <?php
          }
          ?>
        </span>
      </div>
    </form>
  </div>
  <div class="col-sm">
    <a href="<?= route('event_create_web') ?>">
      <button class="btn btn-outline-secondary float-right" type="button " alt="Create Event" title="Create Event"><i class="fa fa-plus"></i> Create Event</button>
    </a>
    <a href="<?= route('event_list_remote') ?>">
      <button class="btn btn-outline-secondary float-right"  style="margin-right:10px;" type="button" alt="Create Event" title="Create Event"><i class="fa fa-laptop"></i> Remote Event</button>
    </a>
  </div>
</div>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Created At</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (count($events) > '0') {
      foreach ($events as $event) {
    ?>
        <tr>
          <td><?= $event->id ?></td>
          <td><?= $event->name ?></td>
          <td><?= $event->slug ?></td>
          <td><?= $event->createdAt ?></td>
          <td>
            <a href="<?= route('event_show_web', ['id' => $event->id]) ?>/edit"><span class="badge badge-primary" role="button">Edit</span></a>
            <span class="badge badge-danger" role="button" <?php if (Auth::check()) { ?> Onclick="delete_event('<?= $event->id ?>');" <?php } else { ?> Onclick="go_to_login();" <?php } ?>>Delete</span>
          </td>
        </tr>
      <?php
      }
    } else {
      ?>
      <tr class="text-center">
        <td colspan="5">There is no events.</td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
<div class="d-felx justify-content-center">
  <?= $events->links() ?>
</div>
@endsection

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.0.0/sweetalert.min.js" integrity="sha512-zwZQtJZnpG982ihGzVT53UY+yTFtT66spX5HOiYmKFeO1unLJ7NJdprbWOHKAhHdKSDwNKbBgCubsrvGJaAehQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  function delete_event(id) {
    var _token = $('meta[name="csrf-token"]').attr('content');
    swal({
        title: "Are you sure?",
        text: "Event may deleted!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            url: "<?= route('delete_event_web') ?>",
            method: 'post',
            data: {
              event_id: id,
              _token: _token,
            },
            cache: false,
            success: function(response) {
              if (response.success == true) {
                swal({
                  title: "Deleted",
                  text: "Event deleted successfully.",
                  icon: "success",
                  timer: 2000,
                  buttons: false
                });
                setTimeout(function() {
                  window.location = ('<?= route('event_list_web') ?>');
                }, 2000);
              }
            }
          });
        }
      });
  }

  function go_to_login() {
    window.location = ('<?= route('login') ?>');
  }
  $(document).ready(function() {
    $("#event_search_form").submit(function(e) {
      e.preventDefault();
    });
    $("#event_search_form").validate({
      errorElement: "div",
      errorClass: "form-error-block",
      rules: {
        'event_search_val': {
          required: true,
        },
      },
      messages: {
        'event_search_val': {
          required: "",
        },
      },
      submitHandler: function(form) {
        $('#event_search_form')[0].submit();
      }
    });
  });
</script>