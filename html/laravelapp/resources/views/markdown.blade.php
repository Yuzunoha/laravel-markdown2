<html>

<head>
    <meta charset="utf-8">
    <title>markdown</title>
    <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-google-code-prettify/themes/github-v2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css">
</head>

<body style="background-color: #FFFFEF;">
    <div>
        {{ $compiledText }}
        {{ Form::open(['url' => 'markdown/store', 'method' => 'post']) }}
        {{ Form::token() }}
        {{ Form::textarea('textarea1', $rawText, ['class' => 'form-control', 'rows' => '30', 'cols' => '80']) }}
        {{ Form::submit('上書き', ['class' => 'btn btn-primary btn-lg']) }}
        {{ Form::close() }}
    </div>
    <script src="{{ asset('js/markdown_preprocess.js') }}"></script>
    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mermaid/dist/mermaid.min.js"></script>
    <script>
        mermaid.initialize({
            startOnLoad: true
        });
    </script>
    <link rel="stylesheet" href="https://jmblog.github.io/color-themes-for-google-code-prettify/themes/github-v2.min.css">
</body>

</html>
