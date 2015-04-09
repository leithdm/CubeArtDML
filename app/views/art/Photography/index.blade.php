@extends('layouts.main')

@section('title')
    <title>Cube Art Studio | Collage</title>
@stop

@section('content')
    {{--main content--}}
    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="viewpage-query">
                        <p id="new-artwork-header">PHOTOGRAPHY</p>

                        <p id="new-artwork-tag">In 1826, when the first stable photographic image on paper was produced,
                            no one could have foreseen the wide-ranging effects that photography would have on the
                            course of history--and on the art world in particular. An amazing photograph not only frames
                            and captures a brief moment in time, but it speaks volumes through a complex interplay
                            between subject matter, light, contrast, texture, and color. Whether you favor still life,
                            nature, landscape, or street photography, we’re sure you’ll find work you love within
                            Saatchi Art’s wide selection of artistic photography art for sale by some of the world’s
                            most talented up-and-coming photographers</p>
                    </div>
                </div>
            </div>
        </div>
        <div>

            <div class="search-artists">
                <div class="row">
                    <div class="col-md-3">
                        {{ Form::open(['method' => 'GET']) }}
                        {{ Form::select('query', array(
                        'search' => 'Search...',
                        'latest' => 'Latest',
                        'views' => 'Popular',
                        'priceLowToHigh' => 'Price Low to High',
                        'priceHighToLow' => 'Price High to Low'),
                        Input::old('select'), array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-1">
                        {{ Form::button('<span class="glyphicon glyphicon-search"></span>', array('class'=>'btn btn-info','type'=>'submit'))}}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <hr/>
                    @foreach($categoryArt as $art)
                        <div class="col-md-4">
                            <div class="art-details-youmightlike">
                                <div class="thumbnail" style="padding: 20px">
                                    <a href="{{ URL::to('art/' . $art->category .'/' . $art->id) }}"><img
                                                src="/artPictures/{{ $art->picture }}"
                                                alt="picture"
                                                style="width:300px;height:300px"></a>
                                </div>
                                <p id=gallery-thumbnail-title>{{ "'". $art->title."'"}}</p>

                                <p id=gallery-thumbnail-category>{{ $art->category}}</p>

                                <a href="{{ URL::to('artist/' . $art->artist->id) }}"><p
                                            id=gallery-thumbnail-artist>{{$art->artist->first_name . " " .  $art->artist->second_name }}</p>
                                </a>

                                <p id=gallery-thumbnail-category>{{ $art->artist->country}}</p>

                                <?php setlocale(LC_MONETARY, "en_us"); ?>
                                <p id=gallery-thumbnail-price>€{{ money_format("%!.0i", $art->price)}}</p></span>
                            </div>
                            <div id="gallery-break"></div>
                        </div>
                    @endforeach
                    {{ $categoryArt->appends(Request::except('page'))->links() }}
                </div>
            </div>


            <div class="container">
                <div class="row">
                    <div class="viewpage-query">
                        <hr/>
                        <p id="new-artwork-header">HISTORY OF PHOTOGRAPHY</p>

                        <p id="new-artwork-tag">Joseph Nicephore Niepce, in 1826, used a camera obscura to produce the
                            first stable photographic image (a negative) upon silver nitrate-coated paper--but this
                            image took several days of exposure time, and the resulting picture was unclear. Later,
                            Louis Daguerre developed a technique of developing images on metal that reduced exposure
                            time and created sharper, more stable pictures. His “daguerreotype” process was commercially
                            released in 1893 and helped popularize photographic technology around the world among the
                            middle classes, especially in the area of portraiture. Paper-based methods (using
                            translucent negatives) first developed by Henry Fox Talbot would eventually replace the
                            metal-based daguerreotype. The first commercially-available color photography process,
                            Autochrome, was released in 1907 and was based on innovations by Louis Ducos Hauron and
                            Charles Cros. However, these processes proved too expensive for the general public, and it
                            wasn’t until Kodachrome film (a more affordable and quicker process) was made available in
                            1936 that color photography came into widespread public use. The next major revolution in
                            photography would come in 1990 when the first commercially-available digital camera, the
                            Dycam Model 1, was released. </p>
                    </div>
                    <div class="viewpage-query">
                        <hr/>
                        <p id="new-artwork-header">PHOTOGRAPHY TECHNIQUES</p>

                        <p id="new-artwork-tag">In addition to choosing the appropriate camera, lens, and film, and then
                            framing and timing a shot, photographers can choose to use filters, lights, special darkroom
                            processes, and digital enhancement (among other tools and techniques) to gain a high level
                            of control over their images. The equipment and techniques chosen largely depend on the
                            genre, the photographer’s individual style, and the overall mood/effect they are attempting
                            to achieve. Portrait and animal photographers wishing to make an individual subject (or a
                            group) the focal point for a shot may use a large aperture for a shallow depth of field to
                            put their subject(s) in focus while keeping the background blurred. Landscape photographers
                            wanting to clearly capture an entire panoramic view may choose the opposite. Choosing black
                            and white over color gives a timeless quality to photos and brings elements such as line,
                            texture, and tone to the forefront. The choice of black and white (or another monotone
                            process) may also help lead the eye away from elements which distract from the
                            photographer’s intended focus. Though some photography purists insist on forgoing digital
                            enhancement of any kind, many choose to use it to retouch imperfections and enhance color,
                            among other effects. </p>
                    </div>
                    <div class="viewpage-query">
                        <hr/>
                        <p id="new-artwork-header">ARTISTS KNOWN FOR PHOTOGRAPHY</p>

                        <p id="new-artwork-tag">Prominent 19th century photographers include Oscar Rejlander (known for
                            his photomontage images), Julia Cameron (celebrity portraits), Eadward Muybridge (California
                            landscapes), and Albert Bierstadt (American West landscapes). These early pioneers of
                            artistic photography helped gain acceptance of photography as an art form rather than as a
                            mere method of documentation. Well known photographers of the early 20th century include
                            Alfred Stieglitz (photographer and founder of one of the world’s most prominent photography
                            art galleries, Little Galleries of the Photo-Secession), Edward Weston (landscapes, still
                            lifes, nudes, portraits), and Man Ray, an avant garde photographer who was a proponent of
                            both Dadaism and Surrealism. Well-known photojournalists include Henri Cartier-Bresson,
                            Martin Parr, and Alfred Eisenstaedt. Ansel Adams and William Henry Jackson are giants in the
                            field of landscape photography, while famous names in portrait photography include Dorothea
                            Lange, Edward Curtis, Seydou Keita, Cindy Sherman, Diane Arbus, and Annie Leibovitz.
                            Renowned fashion photographers include Richard Avedon, Helmut Newton, Herb Ritts, Mario
                            Testino, and Patrick Demarchelier</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@stop







