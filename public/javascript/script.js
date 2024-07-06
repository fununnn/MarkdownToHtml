require.config({ paths: { 'vs': '../node_modules/monaco-editor/min/vs' }});
require(['vs/editor/editor.main'], function() {
    var editor = monaco.editor.create(document.getElementById('editor'), {
        value: '# Hello, World!',
        language: 'markdown',
        theme: 'vs-dark'
    });

    document.getElementById('preview-btn').addEventListener('click', function() {
        // ここにプレビュー機能を実装
    });

    document.getElementById('html-btn').addEventListener('click', function() {
        // ここにHTML表示機能を実装
    });

    document.getElementById('highlight-btn').addEventListener('click', function() {
        // ここにハイライト切り替え機能を実装
    });

    document.getElementById('download-btn').addEventListener('click', function() {
        // ここにダウンロード機能を実装
    });
});