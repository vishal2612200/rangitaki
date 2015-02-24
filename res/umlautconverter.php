<?php
class UmlautConverter
{
    function convert($text)
    {
        $output = str_replace("ä","&auml;",$text);
        $output = str_replace("Ä","&Auml;",$output);
        $output = str_replace("ö","&ouml;",$output);
        $output = str_replace("Ö","&Ouml;",$output);
        $output = str_replace("ü","&uuml;",$output);
        $output = str_replace("Ü","&Uuml;",$output);
        $output = str_replace("ß","&szlig;",$output);
        return $output;
    }
}