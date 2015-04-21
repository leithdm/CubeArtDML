@extends('layouts.main')

@section('title')
    <title>Cube Art | {{$art->artist->first_name . " " .  $art->artist->second_name . " , " . $art->title }}</title>
@stop

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="art-details-header">
                    <h2><a href="{{ URL::to('artist/' . $art->artist->id) }}">{{$art->artist->first_name . " " .  $art->artist->second_name}}</a>{{", ". "'".$art->title."'"}}</h2>
                    <br/>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="art-details-picture-sidebar">
                <div class="row">
                    <div class="col-md-8">
                        <img src="/artPictures/{{ $art->picture }}" alt="picture" style="width:700px;height:700px">
                    </div>
                    <div class="col-md-4">
                        <div class="art-details-rightsidebar">
                            <h3>{{ "'". $art->title ."'" }}</h3>
                            <h4><a href="{{ URL::to('artist/' . $art->artist->id) }}">{{$art->artist->first_name . " " .  $art->artist->second_name}}</a></h4>
                            <h5>{{$art->artist->country}}</h5>
                            <br/>
                            <h5>{{$art->category}}</h5>
                            <h5>{{$art->medium}}</h5>
                            <h5>{{$art->year}}</h5>
                            <h5>Size: {{$art->height}} H x {{$art->width}} W x {{$art->depth}} inches</h5>
                            <br/>

                            <div class="price-container">
                                <?php setlocale(LC_MONETARY,"en_us"); ?>
                                <h1 id=art-thumbnail-price>€{{ money_format("%!.0i", $art->price)}}</h1>
                                <hr>
                                <h6>7 day money back guarantee  <span class="glyphicon glyphicon-info-sign"></span></h6>
                            </div>
                            <div class="views-container">
                                <button class="btn btn-primary" type="button">
                                    Views <span class="badge">{{$art->views}}</span>
                                </button>
                                {{--<h5>100 Views</h5>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        {{--description of art--}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p id="new-artwork-header">ART DESCRIPTION</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="art-details-picture-sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <h4>{{$art->details}}</h4>
                    </div>
                </div>
            </div>
            <br/><br/>
        </div>

        {{--more by this artist--}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p id="new-artwork-header">MORE BY <a href="{{ URL::to('artist/' . $art->artist->id) }}">{{$art->artist->first_name . " " .  $art->artist->second_name }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    @foreach($artistArt as $art)
                        <div class="col-md-3">
                            <div class="art-details-youmightlike">
                                <div class="thumbnail" style="padding: 10px">
                                    <a href="{{ URL::to('art/' . $art->category . '/' . $art->id) }}"><img
                                                src="/artPictures/{{ $art->picture }}"
                                                alt="picture"
                                                style="width:200px;height:200px"></a>
                                </div>
                                <p style="margin-left:25px;">{{ "'".$art->title."'"}}</p>
                                <p style="margin-left:25px;"><a href="{{ URL::to('artist/' . $art->artist->id) }}">{{$art->artist->first_name . " " .  $art->artist->second_name}}</a></p>
                                <?php setlocale(LC_MONETARY,"en_us"); ?>
                                <p id=gallery-thumbnail-price>€{{ money_format("%!.0i", $art->price)}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <br/><br/>
            </div>

            {{--you might like--}}
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p id="new-artwork-header">YOU MIGHT LIKE...</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    @foreach($artistCategory as $art)
                        <div class="col-md-3">
                            <div class="art-details-youmightlike">
                                <div class="thumbnail" style="padding: 10px">
                                    <a href="{{ URL::to('art/' . $art->category . '/' .$art->id) }}"><img
                                                src="/artPictures/{{ $art->picture }}"
                                                alt="picture"
                                                style="width:200px;height:200px"></a>
                                </div>
                                <p style="margin-left:25px;">{{ "'".$art->title."'"}}</p>
                                <p style="margin-left:25px;"><a href="{{ URL::to('artist/' . $art->artist->id) }}">{{$art->artist->first_name . " " .  $art->artist->second_name}}</a></p>
                                <?php setlocale(LC_MONETARY,"en_us"); ?>
                                <p id=gallery-thumbnail-price>€{{ money_format("%!.0i", $art->price)}}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <br/><br/><br/>
        <div id="disqus_thread"></div>
        <script type="text/javascript">
            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
            var disqus_shortname = 'elegantartstudios'; // required: replace example with your forum shortname

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    </div>
@stop