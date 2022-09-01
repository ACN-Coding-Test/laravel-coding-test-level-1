@extends('layouts.blog.app')
@section('content')
    <div class="section">
        <div class="container">
            <?php if(!empty($keyword)){?>
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Top <?php echo count($latestArticals); ?> Searc Results for {{$keyword}}</h2>
                    </div>
                </div>
            <?php } ?>
            <div id="hot-post" class="row hot-post">
                <?php if(!empty($latestArticals[0])){ ?>
                    <div class="col-md-8 hot-post-left">
                        <div class="post post-thumb">
                            <a class="post-img" href="{{ url('details/'.$latestArticals[0]->id)}}"><img src="{{ $latestArticals[0]->urlToImage}}" alt="image for artical. Click to read Artical"></a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a href="#">{{$latestArticals[0]->source->category}}</a>
                                </div>
                                <h3 class="post-title title-lg"><a href="{{ url('details/'.$latestArticals[0]->id)}}">{{$latestArticals[0]->title}}</a></h3>
                                <ul class="post-meta">
                                    <li><a href="#">{{$latestArticals[0]->author}}</a></li>
                                    <li>{{date('D M-Y',strtotime($latestArticals[0]->published_at))}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                <div class="col-md-4 hot-post-right">
                    <?php if(!empty($latestArticals[1])){ ?>
                    
                        <div class="post post-thumb">
                            <a class="post-img" href="{{ url('details/'.$latestArticals[1]->id)}}"><img src="{{ $latestArticals[1]->urlToImage}}" alt="image for artical. Click to read Artical"></a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a href="#">{{$latestArticals[1]->source->category}}</a>
                                </div>
                                <h3 class="post-title"><a href="{{ url('details/'.$latestArticals[1]->id)}}">{{$latestArticals[1]->title}}</a></h3>
                                <ul class="post-meta">
                                    <li><a href="#">{{$latestArticals[1]->author}}</a></li>
                                    <li>{{date('D M-Y',strtotime($latestArticals[1]->published_at))}}</li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if(!empty($latestArticals[2])){ ?>
                
                        <div class="post post-thumb" role="next Artical">
                            <a class="post-img" href="{{ url('details/'.$latestArticals[2]->id)}}"><img src="{{ $latestArticals[2]->urlToImage}}" alt="image for artical. Click to read Artical"></a>
                            <div class="post-body">
                                <div class="post-category">
                                    <a href="#">{{$latestArticals[2]->source->category}}</a>
                                </div>
                                <h3 class="post-title"><a href="blog-post.html">{{$latestArticals[2]->title}}</a></h3>
                                <ul class="post-meta">
                                    <li><a href="#">{{$latestArticals[2]->author}}</a></li>
                                    <li>{{date('D M-Y',strtotime($latestArticals[2]->published_at))}}</li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php foreach($sources as $source){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2 class="title">{{$source->name}}</h2>
                                </div>
                            </div>
                            <?php
                            if(!empty($sourceArticals[$source->id])){
                                foreach($sourceArticals[$source->id] as $artical){?>
                                <div class="col-md-4">
                                    <div class="post">
                                        <a class="post-img" href="{{url('details/'.$artical->id)}}"><img src="{{$artical->urlToImage}}" alt="Image for Artical"></a>
                                        <div class="post-body">
                                            <div class="post-category">
                                                <a href="#">{{$source->category}}</a>
                                            </div>
                                            <h3 class="post-title"><a href="{{url('details/'.$artical->id)}}">{{$artical->title}}</a></h3>
                                            <ul class="post-meta">
                                                <li><a href="#">{{$artical->author}}</a></li>
                                                <li>{{date('D M-Y',strtotime($artical->published_at))}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php }
                            } ?>
                            <div class="clearfix visible-md visible-lg"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
@endsection