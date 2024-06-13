<?php

declare(strict_types=1);

namespace Core\Path;

class Path
{
 /**
  * The method returns the path to the file in the /config directory
  *
  * @param string $filename
  * 
  * @return string
  */
    static public function config(string $filename): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/config/' . $filename;
    }

 /**
  * The method returns the path to the file in the /routes directory
  * 
  * @param string $filename
  * 
  * @return string
  */
    static public function routes(string $filename): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/routes/' . $filename . '.php';
    }
}