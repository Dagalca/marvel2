<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MarvelAPIService;

class MarvelController extends Controller
{
    protected $marvelService;

    public function __construct(MarvelAPIService $marvelService)
    {
        $this->marvelService = $marvelService;
    }

    public function index()
    {
        $characters = $this->marvelService->getFeaturedCharacters();
        $comics = $this->marvelService->getFeaturedComics();
        $series = $this->marvelService->getFeaturedSeries();
        return view('marvel.home', compact('characters', 'comics', 'series'));
    }

    public function characters(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 12;
        $searchTerm = $request->input('search');
        $characters = $searchTerm ?
            $this->marvelService->search('characters', $searchTerm, $page, $limit) :
            $this->marvelService->get('characters', $page, $limit);

        return view('marvel.characters.index', compact('characters', 'searchTerm'));
    }

    public function showCharacter($id)
    {
        $character = $this->marvelService->getById('characters', $id);

        $relatedItems = [
            'comics' => $this->marvelService->getRelated('characters', $id, 'comics'),
            'stories' => $this->marvelService->getRelated('characters', $id, 'stories'),
            'series' => $this->marvelService->getRelated('characters', $id, 'series')
        ];

        return view('marvel.characters.show', compact('character', 'relatedItems'));
    }



    public function comics(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 12;
        $searchTerm = $request->input('search');
        $comics = $searchTerm ?
            $this->marvelService->search('comics', $searchTerm, $page, $limit) :
            $this->marvelService->get('comics', $page, $limit);

        return view('marvel.comics.index', compact('comics', 'searchTerm'));
    }

    public function showComic($id)
    {
        $comic = $this->marvelService->getById('comics', $id);
        $relatedCharacters = $this->marvelService->getRelated('comics', $id, 'characters');
        $relatedCreators = $this->marvelService->getRelated('comics', $id, 'creators');

        return view('marvel.comics.show', compact('comic', 'relatedCharacters', 'relatedCreators'));
    }

    public function series(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 12;
        $searchTerm = $request->input('search');
        $series = $searchTerm ?
            $this->marvelService->search('series', $searchTerm, $page, $limit) :
            $this->marvelService->get('series', $page, $limit);

        return view('marvel.series.index', compact('series', 'searchTerm'));
    }

    public function showSeries($id)
    {
        $series = $this->marvelService->getById('series', $id);
        $relatedCharacters = $this->marvelService->getRelated('series', $id, 'characters');
        $relatedCreators = $this->marvelService->getRelated('series', $id, 'creators');

        return view('marvel.series.show', compact('series', 'relatedCharacters', 'relatedCreators'));
    }

    public function stories(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 12;
        $searchTerm = $request->input('search', '');
        $stories = $searchTerm ?
            $this->marvelService->search('stories', $searchTerm, $page, $limit) :
            $this->marvelService->get('stories', $page, $limit);

        return view('marvel.stories.index', compact('stories', 'searchTerm'));
    }

    public function showStory($id)
    {
        $story = $this->marvelService->getById('stories', $id);

        return view('marvel.stories.show', compact('story'));
    }

    public function creators(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 12;
        $searchTerm = $request->input('search');
        $creators = $searchTerm ?
            $this->marvelService->search('creators', $searchTerm, $page, $limit) :
            $this->marvelService->get('creators', $page, $limit);

        return view('marvel.creators.index', compact('creators', 'searchTerm'));
    }

    public function showCreator($id)
    {
        $creator = $this->marvelService->getById('creators', $id);
        $relatedComics = $this->marvelService->getRelated('creators', $id, 'comics');
        $relatedSeries = $this->marvelService->getRelated('creators', $id, 'series');

        return view('marvel.creators.show', compact('creator', 'relatedComics', 'relatedSeries'));
    }
}
