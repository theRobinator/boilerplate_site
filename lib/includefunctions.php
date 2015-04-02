<?php

class IncludeFunctions {
    /**
     * Include a CSS file in the page, link tag and all.
     * @param string $filename The name of the css file, without an extension
     */
    static function IncludeCss($filename) {
        return '<link rel="stylesheet" href="' . CSS_URL . '/' . $filename . '.css"></link>';
    }

    /**
     * Include a JavaScript file in the page, link tag and all.
     * @param string $filename The name of the js file, without an extension
     */
    static function IncludeJS($filename, $forceMinify=null) {
        $minify = is_null($forceMinify) ? MINIFY_STATICS : $forceMinify;
        if ($minify) {
            return '<script src="' . JS_URL . '/' . $filename . '.min.js"></script>';
        } else {
            return '<script src="' . JS_URL . '/' . $filename . '.js"></script>';
        }
    }

    /**
     * Include all JavaScript recursively from a directory.
     * @param string $dirName The name of the directory containing the JS.
     * @param string $forceMinify If specified, override the default minification with this value
     */
    static function IncludeAllJS($dirName, $forceMinify=null) {
        $minify = is_null($forceMinify) ? MINIFY_STATICS : $forceMinify;
        $extension = $minify ? '.min.js' : '.js';
        $extensionLen = strlen($extension);

        $result = array();
        $iterator = new IteratorIterator(new RecursiveDirectoryIterator(WWW_DIR . '/static/js/' . $dirName), RecursiveIteratorIterator::SELF_FIRST);
        foreach ($iterator as $file) {
            $path = $file->getRealPath();
            $relativePath = str_replace(WWW_DIR, URL_ROOT, $path);
            if ($minify) {
                if ($file->isFile() && substr($path, -7) === '.min.js') {
                    $result[] =  '<script src="' . $relativePath . '"></script>';
                }
            } else if ($file->isFile() && substr($path, -7) !== '.min.js' && substr($path, -3) === '.js') {
                $result[] =  '<script src="' . $relativePath . '"></script>';
            }
        }
        return implode("\n", $result);
    }

    /**
     * Return the correct image URL for a given image.
     * @param string $filename The name of the image, extension included.
     */
    static function ImageURL($filename) {
        return IMAGE_URL . '/' . $filename;
    }
}
