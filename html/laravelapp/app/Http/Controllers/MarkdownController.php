<?php

namespace App\Http\Controllers;

use App\Models\Markdown;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown as MailMarkdown;

class MarkdownController extends Controller
{
    public function index()
    {
        $rawText = '# タイトル';
        $compiledText = MailMarkdown::parse($rawText);
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
