<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $taskKeys = ['fizzbuzz', 'kuku', 'fukuri', 'shiharai',];

        // in_array(調べる値, 検索対象の配列
        if (!in_array($taskKey, $taskKeys)) {
            $fnThrow("不正なtaskKeyです: " . $taskKey);
        }

        // ファイルがあるかどうかチェックする
        if (!$request->file("file")) {
            $fnThrow("ファイルを添付してください");
        }
        // ファイルを保存する。"fizzbuzz.php", "fukuri.php", ...
        $fileNameTarget = $taskKey . ".php";
        $toFileDir = 'codegym/' . Auth::id(); // storage/app/codegym/1
        $request->file("file")->storeAs($toFileDir, $fileNameTarget);

        // ルートディレクトリを確保する "/var/www/html/laravelapp"
        exec('cd ..; pwd', $output);
        $laravelappDir = $output[0];
        // codegymDir "/var/www/html/laravelapp/storage/app/codegym"
        $codegymDir = $laravelappDir . '/storage/app/codegym';
        // volumeディレクトリを作る "/var/www/html/laravelapp/storage/app/codegym/1/volume"
        $volumeDir = $codegymDir . '/' . Auth::id() . '/volume';
        exec('mkdir ' . $volumeDir);
        // テストファイル "/var/www/html/laravelapp/storage/app/codegym/tests/test_fizzbuzz.php"
        $testFilePath = $codegymDir . '/tests/test_' . $taskKey . '.php';
        // テスト対象ファイル
        $targetFilePath = $codegymDir . '/' . Auth::id() . '/' . $taskKey . '.php';
        // テストファイルとテスト対象ファイルをvolumeにコピーする
        exec('cp ' . $testFilePath . ' ' . $targetFilePath . ' ' . $volumeDir);

        // dockerを実行する
        // docker run --rm -v /home/yuzunoha/git/github/laravel-markdown2/html/laravelapp/storage/app/codegym:/app jitesoft/phpunit phpunit tests/DiceTest.php
        $s = 'sudo docker run --rm';
        $s .= ' -v ${HOST_REPOSITORY_ROOTDIR}/html/laravelapp/storage/app/codegym/' . Auth::id() . '/volume:/app';
        $s .= ' jitesoft/phpunit phpunit test_' . $taskKey . '.php';
        exec($s, $output);
        return $this->arrayToStr($output);
    }
}
