<?php

namespace App\Http\Controllers;

use App\Jobs\CrawlTitle;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use App\ShortLink;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shortLinks = ShortLink::latest()->paginate(10);

        return view('shortenLink', compact('shortLinks'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        $shortLink = ShortLink::create($input);
        // NOTE: crawling using queue job (background/async)
        CrawlTitle::dispatch($shortLink);

        return redirect('generate-shorten-link')
            ->with('success', 'Shorten Link Generated Successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();
        $find->visit_count = $find->visit_count + 1;
        $find->save();

        return redirect($find->link);
    }

    public function popularLinks()
    {
        $popularLinks = ShortLink::orderBy('visit_count', 'desc')->limit(100)->paginate(10);

        return view('popularLinks', compact('popularLinks'));
    }
}
