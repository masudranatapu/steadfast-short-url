<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        try {

            $shortUrls = ShortUrl::query()
                    ->where('user_id', Auth::user()->id)
                    ->paginate(1);

            return view('shorturl', compact('shortUrls'));

        } catch (\Throwable $e) {

            return redirect()->back()->with('message', $e->getMessage());
        }
    }
    public function store(ShortUrlRequest $request)
    {
        try {

            DB::beginTransaction();

            $urlShort = 'short-url-'.date('Ymdhis');

            $shortUrl = new ShortUrl();
            $shortUrl->user_id = auth()->id();
            $shortUrl->short_url = $urlShort;
            $shortUrl->long_url = $request->long_url;
            $shortUrl->total_view = 0;
            $shortUrl->save();
            DB::commit();

            return redirect()->back()->with('message', 'Short URL Successfully Created Done');

        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    public function redirectUrl(Request $request)
    {
        try {
            $url = ShortUrl::query()
                ->where('short_url', $request->shortUrl)
                ->firstOrFail();

            $url->total_view  += 1;

            $url->save();

            return redirect($url->long_url);

        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $url = ShortUrl::query()
                ->findOrFail($id);

            $url->delete();

            return redirect()->back()->with('message', 'Short URL Successfully Deleted Done');

        } catch (\Throwable $e) {
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

}
