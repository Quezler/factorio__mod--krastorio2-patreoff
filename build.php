<?php

use Symfony\Component\Finder\SplFileInfo;

require __DIR__ . '/vendor/autoload.php';

echo "Hello world!";

$finder = new \Symfony\Component\Finder\Finder();

foreach ($finder->in("Krastorio2/locale")->files()->contains('[color=173, 19, 173]') as $file){
    /**
     * @var SplFileInfo $file
     */

    $lines = explode(PHP_EOL, $file->getContents());
    $section = "";

    foreach ($lines as &$line){

        // keep sections
        if(strpos($line, "[") === 0){
            $section = trim($line);
            continue;
        }

        // remove unmodified lines
        if(strpos($line, "[color=173, 19, 173]") === false || $section != "[item-name]"){
            $line = null;
            continue;
        }

        // modify pink lines
        $line = preg_replace('/ \[color=173, 19, 173\](.*)\[\/color\]/', '', $line);
        dump($line);
    }

    if(!is_dir($path = './Krastorio2_Patreoff_1.0.0/locale/' . $file->getRelativePath())) mkdir($path, 0777, true);

    file_put_contents('./Krastorio2_Patreoff_1.0.0/locale/' . $file->getRelativePathname(), implode(PHP_EOL, array_filter($lines)));
//    dump($file);
}
