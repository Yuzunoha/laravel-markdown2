<?php

namespace App\Http\Controllers;

use App\Models\Markdown;
use Illuminate\Http\Request;

class MarkdownController extends Controller
{
    public function index()
    {
        $compiledText = '変換されたテキスト';
        $rawText = '生テキスト';
        return view('markdown', compact('compiledText', 'rawText'));
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
