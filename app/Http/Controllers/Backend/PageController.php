<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Validation\Validator;

class PageController extends Controller {
       
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function index() {

        $pages = Page::all();

        return view('backend.pages.index', [
            'pages' => $pages
        ]);
    }

    public function add() {
        return view('backend.pages.add');
    }

    public function edit($id) {

        $page = Page::find($id);

        if ( ! $page) {
            return redirect(route('back_pages'));
        }

        return view('backend.pages.edit', [
            'page' => $page
        ]);
    }

    public function save(Request $request) {
        if ($request->isMethod('post')) {
            try {
                $rules = $this->_getValidationRules();
                $msg   = $this->_getValidationMsg();
                if ($id = $request->get('id')) {
                    $rules['slug'] = 'required|min:2|max:250|alpha_dash|unique:pages,slug,' . $id;
                    $page = Page::find($request->get('id'));
                } else {
                    $page = new Page;
                }

                $this->validate($request, $rules, $msg);
                if ($request->file('banner')) {
                    $storagePath = config('backend.page.upload');
                    $upload      = $this->uploadBannerImg([
                        'file'         => $request->file('banner'),
                        'storage_path' => $storagePath
                    ]);

                    if ( ! $upload) {
                        return back()->with('error', 'Could not upload image!!!');
                    }

                    $page->banner = $upload;
                }

                $page->page_slogan = $request->get('page_slogan');
                $page->slug        = $request->get('slug');
                $page->title       = $request->get('title');
                $page->content     = $request->get('content');
                $page->save();

            } catch (\Exception $e) {
                return back()->withInput($request->input())->withErrors(['title' => 'Whoop!! Something went wrong, please try again.']);
            }

            return redirect(route('back_pages'));
        }
    }

    public function block(Request $request) {
        if ($request->isMethod('post')) {
            $pageId = $request->get('pageId');
            $page   = Page::find($pageId);

            if ( ! $page) {
                throw new \Exception('Page not found!!!');
            }

            $page->block = ($page->block) ? 0 : 1;
            $page->save();

            return redirect(route('back_pages'));
        }
    }

    public function home() {
        $configSlug = config('backend.page.slug.home');
        $page       = Page::where('slug', $configSlug)->first();
        $default    = $this->defaultPageClass();
        
        return view('backend.pages.home', [
            'home' => ($page) ? $page : $default,
            'slug' => $configSlug
        ]);
    }
    
    protected function defaultPageClass() {
        
        $default          = new \stdClass();
        $default->name    = null;
        $default->content = null;
        
        return $default;
    }
    
    protected function uploadBannerImg($options = []) {
        $file        = isset($options['file'])         ? $options['file']         : '';
        $oldFile     = isset($options['old_file'])     ? $options['old_file']     : '';
        $storagePath = isset($options['storage_path']) ? $options['storage_path'] : '';

        if($file && $file->isValid()) {

            $fileStr   = random_string(16, $available_sets = 'lud');
            $fileExt   = $file->getClientOriginalExtension();
            $fileName  = $fileStr . '.' . $fileExt;

            try {
                if ($file->move($storagePath, $fileName)) {
                    delete_file($storagePath . '/' . $oldFile);
                    
                    return $fileName;
                }
            } catch (Exception $ex) {
                Log::error($ex->getMessage());
            }
            
            return false;
        }
        
        return false;
    }

    private function _getValidationRules() {
        return [
            'banner'  => 'image',
            'title'   => 'required|min:2|max:250',
            'slug'    => 'required|min:2|max:250|unique:pages,slug|alpha_dash'
        ];
    }

    private function _getValidationMsg() {
        return [
            'banner.image'     => "Banner must be an image.",
            'title.required'   => "Title is required.",
            'title.min'        => "Title is too short.",
            'title.max'        => "Title is too long.",
            'slug.required'    => "Slug is required.",
            'slug.min'         => "Slug is too short.",
            'slug.max'         => "Slug is too long.",
            'slug.unique'      => "Slug has been chosen, please pick an other.",
            'slug.alpha_dash'  => "Slug contains unallow character.",
            'content.required' => "Content is required.",
            'content.min'      => "Content is too short.",
        ];
    }

}