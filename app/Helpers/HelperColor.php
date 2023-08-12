<?php

use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class HelperColor
{
    public static function color($image)
    {

        $filename = basename($image);

        $image = Image::make($image)->save(public_path('images/' . $filename . '.jpg'));

        $file = $image->dirname . "/" . $image->basename;

        $palette = Palette::fromFilename($file);
        $extractor = new ColorExtractor($palette);
        $colors = $extractor->extract(5);
        $arrayColors = array();
        foreach ($colors as $color) {
            $arrayColors[] = Color::fromIntToHex($color);

        }
        return "linear-gradient(180deg, " . $arrayColors[0] . " 0%, " . $arrayColors[1] . " 50%, " . $arrayColors[2] . " 100%)";
    }
    public static function colorPrimary($image)
    {

        $filename = basename($image);
        try {
            $image = Image::make($image)->save(public_path('images/' . $filename . '.jpg'));

            $file = $image->dirname . "/" . $image->basename;

            $palette = Palette::fromFilename($file);
            $extractor = new ColorExtractor($palette);
            $colors = $extractor->extract(1);
            $arrayColors = array();
            foreach ($colors as $color) {
                $arrayColors[] = Color::fromIntToHex($color);

            }
            return $arrayColors[0];
        } catch (Exception $e) {
            return "#6b6868";
        }

    }

}
