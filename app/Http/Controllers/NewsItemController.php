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
        $page = isset($_GET['p'])?$_GET['p']:0;
        $items = $this->model->paginate(3,$page,'created_at');
        $count = count($this->model->get());
        foreach ($items as $item) {
            $images = $this->image_model->get(['item_id' => $item->id]);
            $item->images = objectToArray($images);
        }

        if (count($items) == 0) {
            return redirect(404);
        }

        return view('news.index', compact('items', 'count'));
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
        $item = $this->model->get($id);
        //should use JOIN instead when implemented
        $images = $this->image_model->get(['item_id' => $id]);
        $item = count($item)? $item[0]:$item;

        if (count($item)) {
            $images = objectToArray($images);
            return view('news.show', compact('item', 'images'));
        }
        return redirect(404);
    }

    public function edit($id)
    {
        $item = $this->model->get($id);
        $item = count($item)? $item[0]:$item;

        if (count($item)) {
            return view('news.edit', compact('item'));
        }
        return redirect(404);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('remove')) {
            // delete old images when delete is implemented
        }
        $updated = $this->model->update($request->all(), ['id' => $id]);

        if ($updated) {
            return redirect()->route('news.show', $id)
            ->with('flash_message', 'News Item Created Successfully');
        }
        return back()->withErrors('something went wrong');
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
