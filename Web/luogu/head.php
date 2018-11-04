<?php
echo <<<LABEL
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="prism.css">
    <script src="prism.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.staticfile.org/KaTeX/0.10.0-rc.1/katex.min.css">
    <script src="https://cdn.staticfile.org/KaTeX/0.10.0-rc.1/katex.min.js"></script>
    <script src="https://cdn.staticfile.org/KaTeX/0.10.0-rc.1/contrib/auto-render.min.js"></script>
    <link rel="stylesheet" href="luogu.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            renderMathInElement(document.body, {
                delimiters:[{left: "$", right: "$", display: false}]
            });
        });
    </script>
</head>
LABEL;
?>