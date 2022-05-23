<html>

<head>
    <meta charset="utf-8">
    <title>markdown</title>
</head>

<body>
    <div>
        {{ $markdowntext ?? 'データが存在しない。' }}
        {{ Form::open(['url' => 'markdown/store', 'method' => 'post']) }}
        {{ Form::token() }}
        {{ Form::textarea('textarea1', $rawtext ?? '', ['class' => 'form-control',  'rows' => '80', 'cols' => '120']) }}
        {{ Form::submit('上書き', ['class' => 'btn btn-success btn-lg']) }}
        {{ Form::close() }}
    </div>
    <script src="{{ asset('js/markdown_preprocess.js') }}"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-google-code-prettify/themes/github-v2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css">
</body>

</html>
