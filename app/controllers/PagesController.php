<?php

class PagesController extends \BaseController {
    /**
     * Home Page Controller
     * @return mixed
     */
    public function home()
    {
        $galleryArt = Gallery::all();
        $carouselArt = Carousel::all();
        $recentArt = Art::orderBy('id', 'desc')->take(3)->get();
        $soldArt = Art::where('status', 'Sold')->take(4)->get();

        return View::make('home', ['galleryArt' => $galleryArt, 'soldArt' => $soldArt,
                                   'recentArt'  => $recentArt, 'carouselArt' => $carouselArt]);
    }

    /**
     * Index page on main website for all items classified as a Collage
     * @return Response
     */
    public function collageIndex()
    {
        //search query
        $query = Input::get('query');

        if ($query  == 'latest')
        {
            $categoryArt = Art::where('category', 'Collage')->orderBy('id', 'desc')->paginate(15);
        }
        elseif ($query  == 'views')
        {
            $categoryArt = Art::where('category', 'Collage')->orderBy('views', 'desc')->paginate(15);
        }
        elseif ($query  == 'priceLowToHigh')
        {
            $categoryArt = Art::where('category', 'Collage')->orderBy('price', 'asc')->paginate(15);
        }
        elseif ($query  == 'priceHighToLow')
        {
            $categoryArt = Art::where('category', 'Collage')->orderBy('price', 'desc')->paginate(15);
        }
        else
        {
            $categoryArt = Art::where('category', 'Collage')->paginate(15);
        }
        return View::make('art/Collage/index', ['categoryArt' => $categoryArt]);
    }

    /**
     * Index page on main website for all items classified as a Painting
     * @return Response
     */
    public function paintingIndex()
    {
        //search query
        $query = Input::get('query');

        if ($query  == 'latest')
        {
            $categoryArt = Art::where('category', 'Painting')->orderBy('id', 'desc')->paginate(15);
        }
        elseif ($query  == 'views')
        {
            $categoryArt = Art::where('category', 'Painting')->orderBy('views', 'desc')->paginate(15);
        }
        elseif ($query  == 'priceLowToHigh')
        {
            $categoryArt = Art::where('category', 'Painting')->orderBy('price', 'asc')->paginate(15);
        }
        elseif ($query  == 'priceHighToLow')
        {
            $categoryArt = Art::where('category', 'Painting')->orderBy('price', 'desc')->paginate(15);
        }
        else
        {
            $categoryArt = Art::where('category', 'Painting')->paginate(15);
        }
        return View::make('art/Painting/index', ['categoryArt' => $categoryArt]);
    }

    /**
     * Index page on main website for all items classified as a Photograph
     * @return Response
     */
    public function photographyIndex()
    {
        //search query
        $query = Input::get('query');

        if ($query  == 'latest')
        {
            $categoryArt = Art::where('category', 'Photography')->orderBy('id', 'desc')->paginate(15);
        }
        elseif ($query  == 'views')
        {
            $categoryArt = Art::where('category', 'Photography')->orderBy('views', 'desc')->paginate(15);
        }
        elseif ($query  == 'priceLowToHigh')
        {
            $categoryArt = Art::where('category', 'Photography')->orderBy('price', 'asc')->paginate(15);
        }
        elseif ($query  == 'priceHighToLow')
        {
            $categoryArt = Art::where('category', 'Photography')->orderBy('price', 'desc')->paginate(15);
        }
        else
        {
            $categoryArt = Art::where('category', 'Photography')->paginate(15);
        }
        return View::make('art/Photography/index', ['categoryArt' => $categoryArt]);
    }


    /**
     * Index page on main website for all items classified as a Drawing
     * @return Response
     */
    public function drawingIndex()
    {
        //search query
        $query = Input::get('query');

        if ($query  == 'latest')
        {
            $categoryArt = Art::where('category', 'Drawing')->orderBy('id', 'desc')->paginate(15);
        }
        elseif ($query  == 'views')
        {
            $categoryArt = Art::where('category', 'Drawing')->orderBy('views', 'desc')->paginate(15);
        }
        elseif ($query  == 'priceLowToHigh')
        {
            $categoryArt = Art::where('category', 'Drawing')->orderBy('price', 'asc')->paginate(15);
        }
        elseif ($query  == 'priceHighToLow')
        {
            $categoryArt = Art::where('category', 'Drawing')->orderBy('price', 'desc')->paginate(15);
        }
        else
        {
            $categoryArt = Art::where('category', 'Drawing')->paginate(15);
        }
        return View::make('art/Drawing/index', ['categoryArt' => $categoryArt]);
    }

    /**
     * Index page on main website for all items classified as a Sculpture
     * @return Response
     */
    public function sculptureIndex()
    {
        //search query
        $query = Input::get('query');

        if ($query  == 'latest')
        {
            $categoryArt = Art::where('category', 'Sculpture')->orderBy('id', 'desc')->paginate(15);
        }
        elseif ($query  == 'views')
        {
            $categoryArt = Art::where('category', 'Sculpture')->orderBy('views', 'desc')->paginate(15);
        }
        elseif ($query  == 'priceLowToHigh')
        {
            $categoryArt = Art::where('category', 'Sculpture')->orderBy('price', 'asc')->paginate(15);
        }
        elseif ($query  == 'priceHighToLow')
        {
            $categoryArt = Art::where('category', 'Sculpture')->orderBy('price', 'desc')->paginate(15);
        }
        else
        {
            $categoryArt = Art::where('category', 'Sculpture')->paginate(15);
        }
        return View::make('art/Sculpture/index', ['categoryArt' => $categoryArt]);
    }


    /**
     * Check credentials, and log the user into the IMS/CMS portal
     * @return Response
     */
    public function collageView($id)
    {
        //calculating number of views
        $art = Art::find($id);
        $art->views += 1;
        $art->save();

        $artistArt = Art::where('artist_id', $art->artist_id)->take(4)->get();
        $artistCategory = Art::where('category', $art->category)->take(4)->get();

        return View::make('art/Collage/view', ['art' => $art, 'artistArt' => $artistArt, 'artistCategory' => $artistCategory]);

    }

    public function paintingView($id)
    {
        //calculating number of views
        $art = Art::find($id);
        $art->views += 1;
        $art->save();

        $art = Art::find($id);
        $artistArt = Art::where('artist_id', $art->artist_id)->take(4)->get();
        $artistCategory = Art::where('category', $art->category)->take(4)->get();

        return View::make('art/Painting/view', ['art' => $art, 'artistArt' => $artistArt, 'artistCategory' => $artistCategory]);

    }

    public function photographyView($id)
    {

        //calculating number of views
        $art = Art::find($id);
        $art->views += 1;
        $art->save();

        $art = Art::find($id);
        $artistArt = Art::where('artist_id', $art->artist_id)->take(4)->get();
        $artistCategory = Art::where('category', $art->category)->take(4)->get();

        return View::make('art/Photography/view', ['art' => $art, 'artistArt' => $artistArt, 'artistCategory' => $artistCategory]);

    }

    public function drawingView($id)
    {
        //calculating number of views
        $art = Art::find($id);
        $art->views += 1;
        $art->save();

        $art = Art::find($id);
        $artistArt = Art::where('artist_id', $art->artist_id)->take(4)->get();
        $artistCategory = Art::where('category', $art->category)->take(4)->get();

        return View::make('art/Drawing/view', ['art' => $art, 'artistArt' => $artistArt, 'artistCategory' => $artistCategory]);

    }

    public function sculptureView($id)
    {
        //calculating number of views
        $art = Art::find($id);
        $art->views += 1;
        $art->save();

        $art = Art::find($id);
        $artistArt = Art::where('artist_id', $art->artist_id)->take(4)->get();
        $artistCategory = Art::where('category', $art->category)->take(4)->get();

        return View::make('art/Sculpture/view', ['art' => $art, 'artistArt' => $artistArt, 'artistCategory' => $artistCategory]);

    }

  /**
   * Check credentials, and log the user into the IMS/CMS portal
   * @return Response
   */
  public function events()
  {
    //search query
    $query = Input::get('query');

    if ($query  == 'latest')
    {
      $exhibitions = Exhibition::orderBy('date_event', 'desc')->paginate(5);
    }
    elseif ($query  == 'oldest')
    {
      $exhibitions = Exhibition::orderBy('date_event', 'asc')->paginate(5);
    }
    else
    {
      $exhibitions = Exhibition::orderBy('date_event', 'desc')->paginate(5);
    }
    return View::make('/events', ['exhibitions' => $exhibitions]);
  }

}