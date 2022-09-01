@extends('layouts.blog.app')
@section('content')
    <div id="post-header" class="page-header">
        <div class="page-header-bg" style="background-image: url(&quot;{{$artical->urlToImage}}&quot;); background-position: 0px -17.25px;" data-stellar-background-ratio="0.5"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="post-category">
                        <a href="#">{{$source->category}}</a>
                    </div>
                    <h1>{{$artical->title}}</h1>
                    <ul class="post-meta">
                        <li><a href="#">{{$artical->author}}</a></li>
                        <li>{{date('D M-Y',strtotime($artical->published_at))}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="section-row">
                <h3>{{$artical->title}}</h3>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <p>{!! nl2br($artical->content)!!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a target="_blank" class="btn btn-primary" href="{{$source->url}}">Visit Publisher Site</a>
                </div>
                <div class="col-md-6">
                    <a target="_blank" class="btn btn-primary" href="{{$artical->url}}">View Artical On publisher site</a>
                </div>
            </div>
        </div>    
    </div>
     <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="section-title">
                        <h2 class="title">Comments</h2>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="section-row">
                        <div class="post-comments" id="comments">
                            <?php foreach($comments as $comment){ ?>
                            <div class="media">
                                <div class="media-body">
                                    <div class="media-heading">
                                        <h4>{{$comment->user->name}}</h4>
                                        <span class="time">{{date('D M-Y H:i:s',strtotime($comment->created_at))}}</span>
                                    </div>
                                    <p>{!! $comment->comment !!}</p>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="section-title">
                        <h3 class="title">Add Comment</h3>
                    </div>
                </div>
                <div class="section-row">
                    <form class="post-reply" action="{{url('/submitComment/'.$artical->id)}}" method="POST">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <textarea class="input" name="message" id="message" required placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input class="input" id="name" type="text" name="name" required placeholder="Name">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <input class="input" id="email" type="email" name="email" required placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <button class="primary-button">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="display:none;" id="media">
            <div class="media" >
                <div class="media-body">
                    <div class="media-heading">
                        <h4>XXX</h4>
                        <span class="time">YYY</span>
                    </div>
                    <p>ZZZ</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $("input,textarea").val('');
      $("form").submit(function (event) {
        var formData = {
            name: $("#name").val(),
            email: $("#email").val(),
            message: $("#message").val(),
            "_token": "{{ csrf_token() }}",
        };

        $.ajax({
          type: "POST",
          url: "{{url('/submitComment/'.$artical->id)}}",
          data: formData,
        }).done(function (data) {
            let htm = $('#media').html();
            htm.replace("XXX",  $("#name").val());
            htm = htm.replace("XXX",  $("#name").val());
            htm = htm.replace("YYY",  'Just Now');
            htm = htm.replace("ZZZ",  $("#message").val());
            $( "#comments" ).append(htm);
            $("input,textarea").val('');
        }).fail(function()  {
            alert("Sorry. We are unable to proceed your request ");
        }); 
        event.preventDefault();
      });
    });
</script>
@endsection