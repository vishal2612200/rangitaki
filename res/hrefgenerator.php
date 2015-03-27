<?php

/*
 * The MIT License
 * 
 * Copyright 2015 mmk2410.
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FINESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 */

/**
 * This is a small tool for converting the title of a post into someting usable
 * as an url. This is used for the article urls.
 * 
 * @author Marcel Kapfer <marcelmichaelkapfer@yahoo.co.nz>
 */

class HrefGenerator {
    
    function createHref($text)
    {
        $output = str_replace(" ", "-", $text);
        $output = str_replace("ä","ae",$output);
        $output = str_replace("Ä","Ae",$output);
        $output = str_replace("ö","oe",$output);
        $output = str_replace("Ö","Oe",$output);
        $output = str_replace("ü","ue",$output);
        $output = str_replace("Ü","Ue",$output);
        $output = str_replace("ß","ss",$output);
        return $output;
    }
    
}
