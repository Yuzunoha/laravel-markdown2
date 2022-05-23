<?php

namespace App\Http\Controllers;

use App\Models\Markdown;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{
    public function index()
    {
        return view('markdown');
        return "インデックス";
    }

    public function test()
    {
        $m = Markdown::first();
        $editedText = '編集しました。';
        if (!$m) {
            $m = new Markdown;
            $m->text = 'テキストです。';
            $m->save();
        } else {
            if ($m->text !== $editedText) {
                $m->text = $editedText;
                $m->save();
            }
        }
        return $m->text;
    }

    public function store(Request $request)
    {
        dd($request);
        return "aaa";
    }
}
