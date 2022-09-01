<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Source;

class SourcesFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Sources:Feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = env("ARTICAL_URL").'/top-headlines/sources';
        $token = env("NEWSAPI_KEY");
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_USERAGENT=> 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0',
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer {$token}"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          
          $result = json_decode($response,true);
          foreach($result['sources'] as $item){
            $row = Source::where('name',$item['name'])->get();
            \Log::info(print_r($row,true));
            if($row->isEmpty()){
              $sourceObj = new Source;
              $sourceObj->source_id = $item['id'];
              $sourceObj->name = $item['name'];
              $sourceObj->description = $item['description'];
              $sourceObj->category = $item['category'];
              $sourceObj->url = $item['url'];
              $sourceObj->language = $item['language'];
              $sourceObj->country = $item['country'];
              $sourceObj->save();
            }
          }
          \Log::info(print_r($result,true));
        }
        
    }
}
