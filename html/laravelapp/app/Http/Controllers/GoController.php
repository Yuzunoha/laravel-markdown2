<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoController extends Controller
{
    private function arrayToStr(array $a): string
    {
        $r = '';
        foreach ($a as $l) {
            $r .= $l . PHP_EOL;
        }
        return $r;
    }

    public function index(Request $request)
    {
        $file = $request->file("file");
        // TODO
        $file->storeAs('codegym/1', 'fizzbuzz123');
        $size = filesize($file);
        $data = [
            'file' => $file,
            'size' => $size,
            '$request->all()' => $request->all(),
        ];
        return $this->responseJson($data);
    }

    public function test(Request $request)
    {
        // docker run --rm -v /home/yuzunoha/git/github/laravel-markdown2/html/laravelapp/storage/app/codegym:/app jitesoft/phpunit phpunit tests/DiceTest.php
        $s = 'sudo docker run --rm';
        $s .= ' -v ${HOST_REPOSITORY_ROOTDIR}/html/laravelapp/storage/app/codegym:/app';
        $s .= ' jitesoft/phpunit phpunit tests/DiceTest.php';

        exec($s, $output);

        return $this->arrayToStr($output);
    }

    public function unittest(Request $request)
    {
        $fnThrow = fn (string $msg) => throw new HttpResponseException(response($msg, 400));

        if (!isset($request->taskKey)) {
            $fnThrow("taskKeyを指定してください");
        }
        $taskKey = $request->taskKey;
        $taskKeys = ['fizzbuzz', "fukuri",];

        // in_array(調べる値, 検索対象の配列
        if (!in_array($taskKey, $taskKeys)) {
            $fnThrow("不正なtaskKeyです: " . $taskKey);
        }

        // ファイルがあるかどうかチェックする
        if (!isset($request->file("file"))) {
            $fnThrow("ファイルを添付してください");
        }
        // ファイルを保存する
        $request->file("file")->storeAs('', "ファイル名");
    }
}
