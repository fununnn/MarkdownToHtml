<?php
require_once "../vendor/autoload.php";
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);
$md = <<<EOF
# Sample Markdown
EOF;
$htmlContent = $Parsedown->text($md);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markdown to HTML Converter</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <div class="editor-pane">
            <div id="editor"></div>
        </div>
        <div class="preview-pane">
            <div class="preview-controls">
                <button id="html-btn">HTML</button>
                <button id="download-btn">Download</button>
            </div>
            <div id="preview-content"></div>
        </div>
    </div>
    <script src="../node_modules/monaco-editor/min/vs/loader.js"></script>
    <script>
        require.config({ paths: { 'vs': '../node_modules/monaco-editor/min/vs' }});
        require(['vs/editor/editor.main'], function() {
            var editor = monaco.editor.create(document.getElementById('editor'), {
                value: <?php echo json_encode($md); ?>,
                language: 'markdown',
                theme: 'vs-dark'
            });

            function convertMarkdownToHtml(markdown) {
                return fetch('convert.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'markdown=' + encodeURIComponent(markdown)
                })
                .then(response => response.text());
            }

            document.getElementById('html-btn').addEventListener('click', function() {
                var markdown = editor.getValue();
                convertMarkdownToHtml(markdown).then(html => {
                    document.getElementById('preview-content').innerHTML = html;
                });
            });

            document.getElementById('download-btn').addEventListener('click', function() {
                var markdown = editor.getValue();
                convertMarkdownToHtml(markdown).then(html => {
                    var blob = new Blob([html], {type: 'text/html'});
                    var url = URL.createObjectURL(blob);
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'converted.html';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                });
            });
        });
    </script>
</body>
</html>