<?php
namespace App\Http\Controllers\Frontend;

use App\Models\Theme;
use App\Models\Page;

class IndexController extends Controller {
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function index() {
        $perPage    = config('frontend.lazy_loading.per_page');
        $configSlug = config('backend.page.slug.home');
        $page       = Page::where('slug', $configSlug)->first();
        $themes     = Theme::where('activated', 1)->paginate($perPage);
        $themeCount = Theme::where('activated', 1)->skip(0)->take($perPage + 1)->count();
        return view('frontend.index.index', [
            'themes'   => $themes,
            'page'     => $page,
            'isPaging' => $themeCount > $themes->count()
        ]);
    }
    
    public function contact() {
        $configSlug = config('backend.page.slug.contact');
        $contact    = Page::where('slug', $configSlug)->first();

        if( ! $contact) {
            abort(404);
        }

        return view('frontend.index.contact', [
            'page' => $contact
        ]);
    }
    
    public function hireus() {
        $configSlug = config('backend.page.slug.hireus');
        $hireus     = Page::where('slug', $configSlug)->first();

        if( ! $hireus) {
            abort(404);
        }

        return view('frontend.index.hire-us', [
            'page' => $hireus
        ]);
    }
    
    public function privacyPolicy() {
        $configSlug = config('backend.page.slug.privacy');
        $page       = Page::where('slug', $configSlug)->first();

        if( ! $page) {
            abort(404);
        }

        return view('frontend.index.privacy', [
            'page' => $page
        ]);
    }
    
    public function termsAndConditions() {
        $configSlug = config('backend.page.slug.terms');
        $page       = Page::where('slug', $configSlug)->first();

        if( ! $page) {
            abort(404);
        }

        return view('frontend.index.terms', [
            'page' => $page
        ]);
    }
}