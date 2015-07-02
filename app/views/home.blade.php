@extends('layouts.main')

@section('title')
    <title>Cube Art Studio</title>
@stop

@section('content')
    @include('flash::message')
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="4000">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="/artPictures/{{ $carouselArt->find(1)->arts->picture }}">

                <div class="container">
                    <div class="carousel-caption">
                        <p class="carousel-firstPicture-headingone">Find Art You Love</p>

                        <p class="carousel-firstPicture-headingtwo">Choose from over 500,000 original works of art</p>

                        <p class="carousel-firstPicture-headingthree"><span class="glyphicon glyphicon-ok"
                                                                            style="color:deepskyblue"></span>
                            Buy original artwork from E100 - E50,000</p>

                        <p class="carousel-firstPicture-headingthree"><span class="glyphicon glyphicon-ok"
                                                                            style="color:deepskyblue"></span>
                            Paintings, photography, drawings, and sculptures from 45,000+ emerging artists</p>

                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse the Gallery</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/artPictures/{{ $carouselArt->find(2)->arts->picture }}">

                <div class="container">
                    <div class="carousel-caption">
                        <p class="carousel-firstPicture-headingone">Cube Art is the world’s leading online art gallery,
                            connecting people with art and artists they love.</p>

                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="/artPictures/{{ $carouselArt->find(3)->arts->picture }}">

                <div class="container">
                    <div class="carousel-caption">
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">View the Artists</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    {{--main content--}}
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mainpage-header">
                        <p id="new-artwork-header">CUBE ART SELECTS</p>

                        <p id="new-artwork-tag">Discover original artwork from around the world, selected by Cube Art
                            and
                            guest curators.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    @foreach($galleryArt as $gallery)
                        <div class="col-md-4">
                            <div class="art-details-youmightlike">
                                <div class="thumbnail" style="padding: 20px">
                                    <a href="{{ URL::to('art/' . $gallery->arts->category .'/' . $gallery->arts->id) }}"><img
                                                src="/artPictures/{{ $gallery->arts->picture }}"
                                                alt="picture"
                                                style="width:300px;height:300px"></a>
                                </div>
                                <p id=gallery-thumbnail-title>{{ "'". $gallery->arts->title."'"}}</p>

                                <p id=gallery-thumbnail-category>{{ $gallery->arts->category}}</p>

                                <a href="{{ URL::to('artist/' . $gallery->arts->artist->id) }}"><p
                                            id=gallery-thumbnail-artist>{{$gallery->arts->artist->first_name . " " .  $gallery->arts->artist->second_name }}</p>
                                </a>

                                <p id=gallery-thumbnail-category>{{ $gallery->arts->artist->country}}</p>

                                <?php setlocale(LC_MONETARY, "en_us"); ?>
                                <p id=gallery-thumbnail-price>€{{ money_format("%!.0i", $gallery->arts->price)}}</p></span>
                            </div>
                            <div id="gallery-break"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mainpage-header">
                            <div class="mainpage-header">
                                <p id="new-artwork-header">NEW ARTWORK FOR SALE</p>

                                <p id="new-artwork-tag">Browse the latest original art. Updated every hour.</p>
                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="container">
                    <div class="row">
                        @foreach($recentArt as $art)
                            <div class="col-md-4">
                                <div class="art-details-youmightlike">
                                    <div class="thumbnail" style="padding: 20px">
                                        <a href="{{ URL::to('art/' .$art->category  . '/'. $art->id) }}"><img
                                                    src="/artPictures/{{ $art->picture }}"
                                                    alt="picture"
                                                    style="width:300px;height:300px"></a>
                                    </div>
                                    <p id=gallery-thumbnail-title>{{ "'".$art->title."'"}}</p>

                                    <p id=gallery-thumbnail-category>{{ $art->category}}</p>

                                    <a href="{{ URL::to('artist/' . $art->artist->id) }}"><p
                                                id=gallery-thumbnail-artist>{{$art->artist->first_name . " " .  $art->artist->second_name }}</p>
                                    </a>

                                    <p id=gallery-thumbnail-category>{{ $art->artist->country}}</p>

                                    <?php setlocale(LC_MONETARY, "en_us"); ?>
                                    <p id=gallery-thumbnail-price>€{{ money_format("%!.0i", $art->price)}}</p>
                                </div>
                                <div id="gallery-break"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mainpage-header">
                                <div class="mainpage-header">
                                    <p id="new-artwork-header">RECENTLY SOLD ARTWORK</p>
                                    <p id="new-artwork-tag">See what's selling to collectors all over the world.</p>
                                    <br/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="container">
                        <div class="row">
                            @foreach($soldArt as $art)
                                <div class="col-md-3">
                                    <div class="art-details-youmightlike">
                                        <div class="thumbnail" style="padding: 20px">
                                            <a href="{{ URL::to('art/' .$art->category .'/' . $art->id) }}"><img
                                                        src="/artPictures/{{ $art->picture }}"
                                                        alt="picture"
                                                        style="width:200px;height:200px"></a>
                                        </div>
                                        <p id=gallery-thumbnail-title>{{ "'".$art->title."'"}}</p>

                                        <p id=gallery-thumbnail-artist>{{$art->artist->first_name . " " .  $art->artist->second_name }}</p>
                                        <?php setlocale(LC_MONETARY, "en_us"); ?>
                                        <p id=gallery-thumbnail-price>€{{ money_format("%!.0i", $art->price)}}</p>
                                    </div>
                                    <div id="gallery-break"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop







