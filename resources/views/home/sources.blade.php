@extends('layouts.blog.app')
@section('content')
    <style type="text/css">
        .just-padding {
          padding: 15px;
        }
        
        .list-group.list-group-root {
          padding: 0;
          overflow: hidden;
        }

        .list-group.list-group-root .list-group {
          margin-bottom: 0;
        }

        .list-group.list-group-root .list-group-item {
          border-radius: 0;
          border-width: 1px 0 0 0;
        }

        .list-group.list-group-root > .list-group-item:first-child {
          border-top-width: 0;
        }

        .list-group.list-group-root > .list-group > .list-group-item {
          padding-left: 30px;
        }

        .list-group.list-group-root > .list-group > .list-group > .list-group-item {
          padding-left: 45px;
        }

        .list-group-item .glyphicon {
          margin-right: 5px;
        }
    </style>

    <div class="section">
        <div class="container">
            <div id="hot-post" class="row hot-post">
                <div class="col-md-12">
                    <h1 class="text-center"> Source Lists and Articals</h1>
                </div>
            </div>
        </div>
    </div>
    
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="just-padding">
                        <div class="list-group list-group-root well">
                          
                            <?php foreach($sources as $source){ ?>
                                    <a href="#item-<?php echo $source->id ?>" class="list-group-item" data-toggle="collapse">
                                        <?php if(count($source->articals) >0 ){ ?>
                                            <i class="glyphicon glyphicon-chevron-right"></i>
                                        <?php }?>
                                        {{$source->name}}
                                    </a>
                                    <div class="list-group collapse" id="item-<?php echo $source->id ?>">
                                        
                                        <?php
                                            if(!empty($source->articals)){ ?>
                                                <?php foreach($source->articals as $artical){?>
                                                    <a href="{{ url('details/'.$artical->id)}}" class="list-group-item">
                                                      {{$artical->title}}
                                                    </a>
                                                <?php } ?> 
                                        <?php }?>
                                    </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        $('.list-group-item').on('click', function() {
            $('.glyphicon', this)
              .toggleClass('glyphicon-chevron-right')
              .toggleClass('glyphicon-chevron-down');
        });
    });
</script>
@endsection