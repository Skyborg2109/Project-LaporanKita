<?php
$dir = new RecursiveDirectoryIterator('C:\laragon\www\Project-LaporanKita');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, 'predictAjax') !== false || strpos($content, 'naivebayes/predict') !== false) {
            echo "Found in: " . $file->getPathname() . "\n";
        }
    }
}
