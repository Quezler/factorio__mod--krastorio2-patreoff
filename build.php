<?php

use Symfony\Component\Finder\SplFileInfo;

require __DIR__ . '/vendor/autoload.php';

echo "Hello world!";

$finder = new \Symfony\Component\Finder\Finder();

foreach ($finder->in("Krastorio2/locale")->files()->contains('[color=173, 19, 173]') as $file){
    /**
     * @var SplFileInfo $file
     */
    $contents = "[item-name]\n";

    $lines = explode(PHP_EOL, $file->getContents());

    foreach ($lines as $line){
        if(strpos($line, "[color=173, 19, 173]") !== false){
            if(strpos($line, "imersite=") !== false) continue; // skip imersite :o
            $contents .= preg_replace('/ \[color=173, 19, 173\](.*)\[\/color\]/', '', $line) . PHP_EOL;
        }
    }

    if(!is_dir($path = './Krastorio2_Patreoff_1.0.0/locale/' . $file->getRelativePath())) mkdir($path, 0777, true);

    file_put_contents('./Krastorio2_Patreoff_1.0.0/locale/' . $file->getRelativePathname(), $contents);
    dump($file);
}
