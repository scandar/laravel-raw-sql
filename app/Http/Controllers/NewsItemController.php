<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\NewsItem;
use App\Image;

class NewsItemController extends Controller
{
    private $model;
    private $image_model;

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new NewsItem;
        $this->image_model = new Image;
    }

    public function index()
    {
        return view('news.index');
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $request->request->set('user_id', Auth::user()->id);
        $request->request->set('created_at', Carbon::now()->format('Y-m-d H:i:s'));

        $item_id = $this->model->insert($request->all());
        if ($item_id) {

            if ($request->hasFile('images')) {
               $images = $request->file('images');
               foreach ($images as $image) {
                   $this->addImages($image, $item_id);
               }
            }

            return redirect()->route('news.show', $item_id)
            ->with('flash_message', 'News Item Created Successfully');
        }

        return back()->withErrors('something went wrong');
    }

    public function show($id)
    {
        return view('news.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function addImages($image, $item_id)
    {
       // move item to storage
       $filename = time() . $image->getClientOriginalName();
       $path = public_path('images');
       $image->move($path, $filename);

       $this->image_model->insert([
           'path' => $filename,
           'item_id' => $item_id,
       ]);
    }
}
