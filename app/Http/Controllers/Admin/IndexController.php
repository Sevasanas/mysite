<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create(Request $request, Categories $categories) {
        if ($request->isMethod('post')) {
            $request->flash();
            $arr = $request->except('_token');

            $arrId = ['id' => rand(5, 100)] + $arr;
            $news_arr = $news->getNews(); 
            $result  =  array_merge($news_arr, [$arrId]); 
            File::put(storage_path() . '/news.json', json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            dd($result);
            return redirect()->route('admin.create');
        }

        return view('admin.create',[
            'categories' => $categories->getCategories()
        ]);
    }

    public function test_1(News $news)
    {
        return response()->json($news->getNews())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    public function test2()
    {
        return view('admin.test_1');
        return response()->download('cat.jpg');
    }
}
