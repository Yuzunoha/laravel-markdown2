<?php

namespace App\Http\Controllers;

use App\Models\Markdown;
use Illuminate\Http\Request;
use Illuminate\Mail\Markdown as MailMarkdown;

class MarkdownController extends Controller
{
    public function index()
    {
        $m = Markdown::find(1);
        $rawText = $m->text ?? '';
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

    protected function _update(string $text)
    {
        $m = Markdown::find(1);
        if (!$m) {
            $m = new Markdown;
        }
        $m->text = $text;
        $m->save();
    }

    public function store(Request $request)
    {
        $this->_update($request->textarea1 ?? '');
        return redirect('markdown');
    }
}
