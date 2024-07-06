<?php
require_once "../vendor/autoload.php";

$Parsedown = new Parsedown();
// safeModeをtrueにしておくとエスケープしてくれる。
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
            <?php echo $md; ?>
        </div>
        <div class="preview-pane">
            <div class="preview-controls">
                <button id="preview-btn">Preview</button>
                <button id="html-btn">HTML</button>
                <button id="highlight-btn">Highlight: ON</button>
                <button id="download-btn">Download</button>
            </div>
            <div id="preview-content">
                <?php echo $htmlContent; ?>
            </div>
        </div>
    </div>
    <script src="../node_modules/monaco-editor/min/vs/loader.js"></script>
    <script src="./javascript/script.js"></script>
</body>
</html>