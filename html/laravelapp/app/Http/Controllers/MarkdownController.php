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

    public function setsample()
    {
        $this->_update($this->_sample());
        return redirect('markdown');
    }

    public function _sample()
    {
        // 'EOM' みたいに識別子をシングルクォートすると変数展開されなくなる
        return <<< 'EOM'
# mermaid-demo

## 概要

マーメイドJSとprettyprintの共存

## Flowchart

```mermaid
graph TD;
    A-->B;
    A-->C;
    B-->D;
    C-->D;
```

# JavaScript
```js
'use strict';
 
const p = console.log;
 
const timeoutPromise = ({ ms, func, arg }) => {
  return new Promise((resolve, reject) => {
    if (20 === ms) {
      reject(`${ms}ミリ秒はエラーです!!`);
    }
    setTimeout(() => {
      resolve(func(arg));
    }, ms);
  }).catch((a) => a);
};
 
const createArg = ({ ms }) => ({ ms, func: () => `${ms}ミリ秒待ちました。` });
 
(async () => {
  /* promiseのcatchのコールバック関数の戻り値をawaitで受け取る */
  p(await timeoutPromise(createArg({ ms: 21 })));
  p(await timeoutPromise(createArg({ ms: 20 })));
  p(await timeoutPromise(createArg({ ms: 19 })));
})();
```

## Sequence diagram

```mermaid
sequenceDiagram
    participant Alice
    participant Bob
    Alice->>John: Hello John, how are you?
    loop Healthcheck
        John->>John: Fight against hypochondria
    end
    Note right of John: Rational thoughts <br/>prevail!
    John-->>Alice: Great!
    John->>Bob: How about you?
    Bob-->>John: Jolly good!
```

## Gantt diagram

```mermaid
gantt
dateFormat  YYYY-MM-DD
title Adding GANTT diagram to mermaid
excludes weekdays 2014-01-10

section A section
Completed task            :done,    des1, 2014-01-06,2014-01-08
Active task               :active,  des2, 2014-01-09, 3d
Future task               :         des3, after des2, 5d
Future task2               :         des4, after des3, 5d
```


## Class diagram

```mermaid
classDiagram
Class01 <|-- AveryLongClass : Cool
Class03 *-- Class04
Class05 o-- Class06
Class07 .. Class08
Class09 --> C2 : Where am i?
Class09 --* C3
Class09 --|> Class07
Class07 : equals()
Class07 : Object[] elementData
Class01 : size()
Class01 : int chimp
Class01 : int gorilla
Class08 <--> C2: Cool label
```

本家のサンプルと異なり、グラフ上に乗る文字の色が薄くて読みにくく、コミットを表す丸が線の後ろになってしまっている。

## Entity Relationship Diagram - exclamation experimental

```mermaid
erDiagram
    CUSTOMER ||--o{ ORDER : places
    ORDER ||--|{ LINE-ITEM : contains
    CUSTOMER }|..|{ DELIVERY-ADDRESS : uses
```

## User Journey Diagram

```mermaid
journey
    title My working day
    section Go to work
      Make tea: 5: Me
      Go upstairs: 3: Me
      Do work: 1: Me, Cat
    section Go home
      Go downstairs: 5: Me
      Sit down: 5: Me
```

---


以下は[mermaid公式のサンプルの一部](https://mermaid-js.github.io/mermaid/#/examples)に記載されていたもの


## Basic Pie Chart

```mermaid
pie title NETFLIX
         "Time spent looking for movie" : 90
         "Time spent watching it" : 10
```

```mermaid
pie title What Voldemort doesn't have?
         "FRIENDS" : 2
         "FAMILY" : 3
         "NOSE" : 45
```

## Basic sequence diagram

```mermaid
sequenceDiagram
    Alice ->> Bob: Hello Bob, how are you?
    Bob-->>John: How about you John?
    Bob--x Alice: I am good thanks!
    Bob-x John: I am good thanks!
    Note right of John: Bob thinks a long<br/>long time, so long<br/>that the text does<br/>not fit on a row.

    Bob-->Alice: Checking with John...
    Alice->John: Yes... John, how are you?
```

## Basic flowchart

```mermaid
graph LR
    A[Square Rect] -- Link text --> B((Circle))
    A --> C(Round Rect)
    B --> D{Rhombus}
    C --> D
```

## Larger flowchart with some styling

```mermaid
graph TB
    sq[Square shape] --> ci((Circle shape))

    subgraph A
        od>Odd shape]-- Two line<br/>edge comment --> ro
        di{Diamond with <br/> line break} -.-> ro(Rounded<br>square<br>shape)
        di==>ro2(Rounded square shape)
    end

    %% Notice that no text in shape are added here instead that is appended further down
    e --> od3>Really long text with linebreak<br>in an Odd shape]

    %% Comments after double percent signs
    e((Inner / circle<br>and some odd <br>special characters)) --> f(,.?!+-*ز)

    cyr[Cyrillic]-->cyr2((Circle shape Начало));

     classDef green fill:#9f6,stroke:#333,stroke-width:2px;
     classDef orange fill:#f96,stroke:#333,stroke-width:4px;
     class sq,e green
     class di orange
```

## SequenceDiagram: Loops, alt and opt

```mermaid
sequenceDiagram
    loop Daily query
        Alice->>Bob: Hello Bob, how are you?
        alt is sick
            Bob->>Alice: Not so good :(
        else is well
            Bob->>Alice: Feeling fresh like a daisy
        end

        opt Extra response
            Bob->>Alice: Thanks for asking
        end
    end
```

## SequenceDiagram: Message to self in loop

```mermaid
sequenceDiagram
    participant Alice
    participant Bob
    Alice->>John: Hello John, how are you?
    loop Healthcheck
        John->>John: Fight against hypochondria
    end
    Note right of John: Rational thoughts<br/>prevail...
    John-->>Alice: Great!
    John->>Bob: How about you?
    Bob-->>John: Jolly good!
```

# PHP
```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\UrlGenerator;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    // ユーザ新規登録処理
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot(UrlGenerator $url)
  {
    // https://blog.capilano-fw.com/?p=4668
    // 指定されたテキストからビューを取得し「そのまま」コードを取得します ※
    // パッケージを使ってMarkdownをHTMLへ変換
    // 変換したコードを返す
    Blade::directive('markdown', function ($expression) {
      $markdown = view(
        str_replace('\'', '', $expression)
      )->render();
      $Parsedown = new \Parsedown();
      return $Parsedown->text($markdown);
    });

    // ssl化(https強制)
    $keyHttpHost = 'HTTP_HOST';
    if (array_key_exists($keyHttpHost, $_SERVER)) {
      if ('localhost' !== $_SERVER[$keyHttpHost]) {
        $url->forceScheme('https');
      }
    }
  }
}
```

# Java
```java
import java.util.*;
 
public class Main {
    public static void main(String[] args) throws Exception {
        var sub = new Sub();
        sub.run();
    }
}
 
class Sub {
    public void run() {
        var list = getList();
        p(list);
        
        var iterator = list.iterator();
        while (iterator.hasNext()) {
            var next = iterator.next();
            p(next);
        }
    }
    public <T> void p(T a) {
        System.out.println(a);
    }
    public void p() {
        System.out.println();
    }
    public List getList() {
        var n = 5;
        List<Integer> list = new ArrayList<>();
        for (var i = 0; i < n; i++) {
            list.add(i);
        }
        return list;
    }
}
```

# C
```c
#include <stdio.h>
 
void hello()
{
  printf("こんにちは\n");
}
 
int sum(int a, int b)
{
  return a + b;
}
 
void higher_order_hello(void (*f)())
{
  f();
}
 
int higher_order_sum(int (*f)(), int a, int b)
{
  return f(a, b);
}
 
int main()
{
  void (*hello_ptr)() = hello;
  int (*sum_ptr)() = sum;
 
  higher_order_hello(hello_ptr);
  int ret = higher_order_sum(sum_ptr, 2, 3);
 
  printf("%d\n", ret);
  return 0;
}
```

Markdownを使う理由
=================================

最近使い始めたMarkdownについてまとめます。


-------------------------------
  Markdown（マークダウン）とは
-------------------------------

> Markdown は、文書を記述するための軽量マークアップ言語のひとつである。  
> 「書きやすくて読みやすいプレーンテキストとして記述した文書を、
> 妥当なXHTML（もしくはHTML）文書へと変換できるフォーマット」として、
> ジョン・グル―バー（John Gruber）により作成された。  
> 出典：[Wikipedia（Markdown）](http://ja.wikipedia.org/wiki/Markdown)

要は、プレーンテキストを勝手にHTML化して、それっぽく見せてくれるモノです。

議事録やアイデアメモを普通のテキストエディタで作ってもよいのですが、  
それだと文字の強調や、資料画像の埋め込み、リンク追加などができません。

それを解決してくれるのがMarkdownです。


-------------------------------
   Markdownを使う理由
-------------------------------

Lifehackerの「 [読みやすいマークダウン記法を始めてみませんか？](http://www.lifehacker.jp/2013/02/130213markdown.html) 」を読み、  
初めてMarkdown記法を知りました。

第一印象は、 **簡単なのにそれっぽく見えるカッコイイ！！** です。
テキストエディタの表現限界を感じもっと見やすい資料が作りたい、  
でも忙しいから手間がかからないやつが良いという私にピッタリのモノでした。

いちいちHTMLを書くのも面倒だし、  
Office Word？そんなもん使ってたら貴重な時間が潰されてしまいます。


-------------------------------
  基本的な文法
-------------------------------

Markdownの文法は非常に簡単なものです。  
私の場合、使い始めて1週間しないうちにだいたいの文法を覚えることができました。  
基本的な文法だけ紹介します。

-------------------------------
  見出し
-------------------------------
# 見出し１（h1）
## 見出し２（h2）
### 見出し３（h3）
#### 見出し４（h4）
##### 見出し５（h5）
###### 見出し６（h6）

-------------------------------
  強調
-------------------------------
*イタリック*  
_イタリック_  
**ボールド**  
__ボールド__  
**_イタリック＆ボールド_**  

-------------------------------
  改行
-------------------------------
空白行で囲まれた１行、または複数行の文章はひとつの段落になる

改行を入れないと複数の
段落にならない  
複数行で改行を入れたい場合は、  
末尾に半角スペース２つを入れる

-------------------------------
  リスト
-------------------------------
* リスト１
- リスト２
  リストの末尾に半角2つで改行
+ リスト３
 + 入れ子
1. 番号付き
1. 番号付き
5. 数字は無視されリストの順序が優先される  

-------------------------------
  リンク
-------------------------------
[リンクになる](http://kuroeveryday.blogspot.jp/)  
これでもOK <http://kuroeveryday.blogspot.jp/>

-------------------------------
  テーブル
-------------------------------
| Left align       |       Right align |    Center align    |
|:-----------------|------------------:|:------------------:|
| This             |              This |        This        |
| column           |            column |       column       |
| will             |              will |        will        |
| be               |                be |         be         |
| left             |             right |       center       |
| aligned          |           aligned |      aligned       |

-------------------------------
  引用
-------------------------------
> 引用とチェックボックスはLaravelでは表現できないらしい


-------------------------------
より詳しい文法は、  以下のサイトを参照してください。

+ [Wikipedia（Markdown）](http://ja.wikipedia.org/wiki/Markdown)
+ [Markdown文法の全訳](http://blog.2310.net/archives/6)

以上
EOM;
    }
}
