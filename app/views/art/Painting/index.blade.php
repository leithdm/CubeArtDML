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
                        <p id="new-artwork-header">MODERN PAINTINGS FOR SALE</p>

                        <p id="new-artwork-tag">When art historians and critics speak of modern paintings, they’re
                            typically referring to ‘modernist’ works belonging to western art movements from the 1860s
                            until around the 1970s (i.e. the time when ‘postmodernism’ began to take hold).
                            Contemporary art, in contrast, is typically used to describe artworks from the end of WWII
                            to the present day. All the works featured on Saatchi Art are contemporary, as they’ve been
                            created by some of the most talented emerging artists working today. However, fans of modern
                            art will find an impressive selection of contemporary works of modern art paintings for sale
                            on our site, including modern oil paintings, modern wall art, and paintings inspired by
                            impressionism, cubism, or abstract expressionism.</p>
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
                        <p id="new-artwork-header">FAMOUS MODERN PAINTERS AND THEIR PAINTINGS </p>

                        <p id="new-artwork-tag">Many consider Edouard Manet to be the first modern painter for his
                            controversial subjects and style. His works “Le Dejeuner sur l’herbe” (1862-1863) and
                            “Olympia” (1863) prominently featured nude women and riffed on previous paintings, combining
                            elements of works by masters like Raphael and Titian with traditional portrait, still life,
                            and landscape styles.

                            Similarly, Henri Matisse played with these genre styles in his “Le bonheur de vivre”
                            (1905-06). Matisse used vibrant, arbitrary colors and skewed perspective to create a modern
                            pastoral scene. In his famous modern paintings like “The Basket of Apples” (1893), Paul
                            Cezanne painted with wide, flat strokes to create an almost vertiginous composition with
                            varying planes and flattened perspective.

                            Pablo Picasso also played with multiple perspectives and fragmented visual space in “Les
                            Demoiselles d’Avignon” (1907). Picasso merged low and high cultures in true modernist
                            fashion, focusing on a group of prostitutes in a brothel in this masterpiece.

                            Famous modern abstract paintings include Wassily Kandinsky’s “Composition VII” (1913), Joan
                            Miro’s “The Birth of the World” (1925), Jackson Pollock’s “Number 1A, 1948” (1948), and Piet
                            Mondrian’s series of mostly white, black, red, blue, and yellow grids. Other famous modern
                            painters include Claude Monet, Edgar Degas, Pierre-Auguste Renoir, Mary Cassatt, Gustave
                            Caillebotte, Georges Seurat, Paul Gauguin, Vincent Van Gogh, Robert Delaunay, Salvador Dali,
                            Paul Klee, Georgia O’Keeffe, Diego Rivera, Willem de Kooning, and Mark Rothko. </p>
                    </div>
                    <div class="viewpage-query">
                        <hr/>
                        <p id="new-artwork-header">THE HISTORY OF MODERN PAINTINGS </p>

                        <p id="new-artwork-tag">Modern art emerged as a response to the drastic changes in the quality
                            of social, economic, and cultural life in Europe accompanying the rise of industry during
                            the late 1800s. Artists sought to criticize traditional modes of representation, mainly
                            government-commissioned religious and allegorical works, by blending elements of high and
                            low culture and incorporating parts of newly modernized quotidien life in their works.

                            Modern art paintings, in particular, shifted from traditional subjects and styles like
                            portraiture, still lifes, and realism toward an existence as art for art’s sake, without
                            necessarily referring to objects in the real world. Art critic Clement Greenberg theorized
                            that modernism aimed to showcase the unique elements specific to each artistic medium.

                            Modern painting, then, emphasized the flatness that only pigment on a support can have.
                            Different artistic movements related to modern painting, such as Cubism, Surrealism, and
                            Abstract Expressionism, each sought to further achieve this goal of creating a purely
                            optical world that exists only on a flat canvas.</p>
                    </div>
                    <div class="viewpage-query">
                        <hr/>
                        <p id="new-artwork-header">MODERN PAINTING TECHNIQUES AND MOVEMENTS </p>

                        <p id="new-artwork-tag">Modern art paintings fall into several movements spanning the years
                            roughly between the late 1800s to the 1950s. The Impressionists rejected traditional
                            painting practices of outlining planned compositions and working in a studio in favor of
                            painting en plein air and layering on thick, wet paint to capture a fleeting moment. These
                            painters also focused more on the street life accompanying the rise in industry; wandering
                            flaneurs and isolated people in crowded city scenes were popular subjects in their modern
                            art oil paintings.

                            Fauvists like Henri Matisse used arbitrary yet vibrant colors in their compositions, while
                            Cubist painters like Pablo Picasso and Georges Braque emphasized form over content, creating
                            the illusion of space with flat, abstract planes. Surrealist painters similarly pulled away
                            from the outside world by focusing on the subconscious and dream-like scenes, albeit with
                            realistic precision.

                            Abstract compositions, including Wassily Kandinsky’s colorful scenes and Piet Mondrian’s
                            grids, were also popular, as they did not refer to any existing objects in real life.
                            Abstract expressionists are often associated with the end of modernism and, according to
                            Clement Greenberg’s theory of modernism, achieved the purest form of modern painting. Their
                            splatters did not create a recognizable subject but instead embodied all the unique
                            qualities of painting (pigment on a flat support).

                            Artists like Jackson Pollock also embodied the modern practice of bridging low and high
                            forms of culture; he is known for mixing objects like sand, broken glass, and nails onto the
                            surfaces of his drip paintings. Other movements associated with modern painting include
                            Futurism, Expressionism, Orphism, Suprematism, and Precisionism.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@stop







