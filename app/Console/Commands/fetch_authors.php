<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

Use App\Models\Comics;
Use App\Models\Authors;
Use App\Models\AuthorComics;

class fetch_authors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:authors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'fetch authors from API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timestamp = Carbon::now()->timestamp;
        $curl_author = curl_init();
        
        curl_setopt_array($curl_author, array(
          CURLOPT_URL => "http://gateway.marvel.com/v1/public/creators?ts=".$timestamp."&apikey=1c122dc12ffc4875d78767521ba82e36&hash=".md5($timestamp.'f53516ca69b5a449b12498b5a53031da97ee529d'.'1c122dc12ffc4875d78767521ba82e36')."&limit=10",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
          ),
        ));

        $author_response = curl_exec($curl_author);
        $author_err = curl_error($curl_author);

        curl_close($curl_author);

        if ($author_err) {
          die("cURL Error #:" . $author_err);
        } 
           $author_obj = json_decode($author_response, TRUE);

           $prepare_creator_data = array();

           for($a = 0;$a < count($author_obj['data']['results']);$a++)
           {
            
                $prepare_creator_data['created_at'] = Carbon::now();
                $prepare_creator_data['id'] = $author_obj['data']['results'][$a]['id'];
                $prepare_creator_data['first_name'] = $author_obj['data']['results'][$a]['firstName'];
                $prepare_creator_data['last_name'] = $author_obj['data']['results'][$a]['lastName'];
                $prepare_creator_data['thumbnail_url'] = $author_obj['data']['results'][$a]['thumbnail']['path'].".".$author_obj['data']['results'][$a]['thumbnail']['extension'];
            
                 Authors::insert($prepare_creator_data);


                 //FETCH AUTHOR'S COMICS
                $curl_comics = curl_init();
                curl_setopt_array($curl_comics, array(
                CURLOPT_URL => "http://gateway.marvel.com/v1/public/creators/".  $prepare_creator_data['id']."/comics?ts=".$timestamp."&apikey=1c122dc12ffc4875d78767521ba82e36&hash=".md5($timestamp.'f53516ca69b5a449b12498b5a53031da97ee529d'.'1c122dc12ffc4875d78767521ba82e36')."&limit=50",
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Cache-Control: no-cache",
                ),
                ));


                $comics_response = curl_exec($curl_comics);
                $comics_err = curl_error($curl_comics);

                curl_close($curl_comics);

                if ($comics_err) {
                  die("cURL Error #:" . $comics_err);
                }


                $comics_obj = json_decode($comics_response, TRUE);
                $prepare_comics_data = array();

                for($c = 0;$c < count($comics_obj['data']['results']);$c++){
                    $prepare_comics_data['created_at'] = Carbon::now();
                    $prepare_comics_data['id'] = $comics_obj['data']['results'][$c]['id'];
                    $prepare_comics_data['title'] = $comics_obj['data']['results'][$c]['title'];
                    $prepare_comics_data['series_name'] = $comics_obj['data']['results'][$c]['series']['name'];
                    $prepare_comics_data['description'] = $comics_obj['data']['results'][$c]['description'];
                    $prepare_comics_data['page_count'] = $comics_obj['data']['results'][$c]['pageCount'];
                    $prepare_comics_data['thumbnail_url'] = $comics_obj['data']['results'][$c]['thumbnail']['path'].".".$comics_obj['data']['results'][$c]['thumbnail']['extension'];
                    
                    // INSERT COMICS
                    Comics::insert($prepare_comics_data);


                    $prepare_author_comics_data = array();

                    $prepare_author_comics_data['author_id'] = $prepare_creator_data['id'];
                    $prepare_author_comics_data['comic_id'] = $prepare_comics_data['id'];
                    AuthorComics::insert($prepare_author_comics_data);
                }
            }

    }
}
