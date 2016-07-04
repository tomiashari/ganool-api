<?php

error_reporting(0);

class ganool
{

    function __construct()
    {
        // Include SimpleHTMLDom Lib
        require('simple_html_dom.php');
    }

    // Curl from Ganool Site
    private function curlGanool($url)
    {
        $data = curl_init();
        curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($data, CURLOPT_URL, $url);
        curl_setopt($data, CURLOPT_REFERER, 'http://ganool.ph/');
        $hasil = curl_exec($data);
        curl_close($data);
        return $hasil;
    }
    
    function grabGanool($url)
    {
        // Initial Array output
        $hasil = array();

        // Check URL Parameter
        if(!empty($_GET['url'])){
            $url = $_GET['url'];
        }

        // Curl Failed
        $curlData = $this->curlGanool($url);
        if($curlData == 'offline'){
            $hasil["status"]    = 'error';
            $hasil["data"]      = array();
        }else{

            // Curl Success
            $data = str_get_html($curlData);
            if($data->find('title',0)->innertext == '404 Not Found'){ // Display Error when URL Not Found
                $hasil["status"]    = 'error';
                $hasil["data"]      = array();
            }else{
                $hasil["status"]    = 'success';
                $hasil["title"]     = $data->find('img[class=logo_def2]',0)-> title;
                $img_large          = $data->find('div[class=imghidesec]',0);
                $hasil["image"]     = $img_large->find('img',0) -> src;
                $imdb_rank          = $data->find('button[class=btn btn-warning]',0);
                $hasil["imdb"]      = $imdb_rank->find('strong',0) -> innertext;
                $hasil["release"]   = $data->find('button[class=btn btn-danger]',0) -> innertext;
                $hasil["release"]   = str_replace('<b class="icon-play"></b> ','',$hasil["release"]);
                $hasil["duration"]  = $data->find('button[class=btn btn-danger]',1) -> innertext;
                $hasil["duration"]  = str_replace('<b class="icon-time"></b> ','',$hasil["duration"]);
                $hasil["year"]      = $data->find('button[class=btn btn-primary]',0) -> innertext;
                $hasil["quality"]   = $data->find('p[rel=tag]',3) -> innertext;
                $hasil["quality"]   = str_replace('Quality: ','',$hasil["quality"]);
                $hasil["source"]    = $data->find('p[rel=tag]',5) -> innertext;
                $hasil["source"]    = str_replace('Source: ','',$hasil["source"]);
                $hasil["country"]   = $data->find('p[rel=tag]',6) -> innertext;
                $hasil["country"]   = str_replace('Country: ','',$hasil["country"]);
                $hasil["synopsis"]  = $data->find('p[style=color:#fff]',0) -> innertext;
                $hasil["trailer"]   = $data->find('iframe[id=trailer_frame]',0) -> src;
                $hasil["screenshots"] = $data->find('a[style=color:#26C4F1]',0) -> href;
                $filerocks          = $data->find('td[style=font-weight:normal]',0);
                $hasil["filerocks"] = $filerocks->find('a',0) -> href;
                $mylinkgen          = $data->find('td[style=font-weight:normal]',1);
                $hasil["mylinkgen"] = $mylinkgen->find('a',0) -> href;

                $hasil = json_encode($hasil);
                $hasil = json_decode($hasil);

            }
        }
        return $hasil;
    }
}