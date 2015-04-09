@extends('layouts.main')

@section('title')
    <title>Cube Art | {{$artist->first_name . " " .  $artist->second_name}}</title>
@stop

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="artist-details-header">
                    <p id="new-artwork-header">{{$artist->first_name . " " .  $artist->second_name }}</p>
                    <hr/>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="art-details-picture-sidebar">
                <div class="row">
                    <div class="col-md-7">
                        <img src="/upload/{{ $artist->picture }}" alt="picture" class="img-thumbnail"
                             style="width:600px;height:600px">
                    </div>
                    <div class="col-md-5">
                        <div class="art-details-rightsidebar">
                            {{--<h3>{{ "'". $art->title ."'" }}</h3>--}}
                            <h4>{{ $artist->first_name . " " .  $artist->second_name}}</h4>
                            <h5>{{$artist->country}} | {{$artist->city}} </h5>

                            <div class="views-container">
                                <button class="btn btn-primary" type="button">
                                    Views <span class="badge">10</span>
                                </button>
                            </div>
                            <h5>Artworks <span class="badge">{{ $count }}</span></h5>

                            <div class="views-container">
                                <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/"
                                     data-layout="button_count" data-action="like" data-show-faces="true"
                                     data-share="true">

                                </div>
                            </div>
                            <div>
                                <!-- Place this tag where you want the +1 button to render. -->
                                <div class="g-plusone" data-size="medium"></div>
                            </div>
                        </div>
                        <div class="artist-quote">
                            <h1>"{{$artist->quote }}"</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        {{--about the artist--}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p id="new-artwork-header">ABOUT</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="art-details-picture-sidebar">
                <div class="row">
                    <div class="col-md-12">
                        <h4>{{$artist->about}}</h4>
                    </div>
                </div>
            </div>
            <br/><br/>
        </div>

        {{--more by this artist--}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p id="new-artwork-header">ALL ARTWORK
                        BY {{$artist->first_name . " " .  $artist->second_name }}</p>
                </div>
            </div>
            <br/><br/>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    @foreach($artistArt as $art)
                        <div class="col-md-2">
                            <div class="artist-details-allart">
                                <div class="img-thumbnail">
                                    <a href="{{ URL::to('art/' . $art->category . '/' . $art->id) }}"><img
                                                src="/artPictures/{{ $art->picture }}"
                                                alt="picture"
                                                style="width:140px;height:140px"></a>
                                </div>
                            </div>
                            <hr/>
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
            (function () {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript>
        <a href="http://disqus.com" class="dsq-brlink">comments powered by <span
                    class="logo-disqus">Disqus</span></a>
    </div>
@stop