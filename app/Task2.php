<?php

namespace App;

class Task2
{
    protected static function loadFile()
    {
        return file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'data.xml');
    }

    protected static function saveFile($contents, string $name = 'data.xml')
    {
        return file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . $name, $contents);
    }

    public static function categories()
    {
        $data = simplexml_load_string(self::loadFile());
        foreach ($data->movie as $movie) {
            $child = $movie->addChild('genres');
            foreach (explode('|', $movie->genre) as $genre) {
                $child->addChild('genre', $genre);
            }
            unset($movie->genre);
        }

        self::saveFile($data->asXML());
    }

    public static function releaseDate()
    {
        $data = simplexml_load_string(self::loadFile());
        foreach ($data->movie as $movie) {
            preg_match('/(?<title>[^(]*)(\((?<date>[^)]*)\))?$/', $movie->title, $matches);
            $movie->title = trim($matches['title']);
            $movie->addChild('date', $matches['date'] ?? 'Ismeretlen');
        }

        self::saveFile($data->asXML());
    }

    public static function horror(int $from = 2010)
    {
        $horrors = [];
        $data = simplexml_load_string(self::loadFile());
        foreach ($data->movie as $movie) {
            if ($movie->date < 2010 || !in_array('Horror', (array) $movie->genres, true)) {
                continue;
            }

            $horrors[(string) $movie->date][] = $movie->title . '(' . $movie->date . ')';
        }

        krsort($horrors);

        foreach ($horrors as $year => $movies) {
            foreach ($movies as $movie) {
                echo $movie . "\n";
            }
        }
    }
}
