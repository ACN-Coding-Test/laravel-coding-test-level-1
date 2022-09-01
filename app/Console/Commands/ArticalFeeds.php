<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Source;
use App\Models\Artical;

class ArticalFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Artical:Feeds';

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
        $url = env("ARTICAL_URL").'/everything';
        $token = env("NEWSAPI_KEY");
        
        $sources = Source::where('done',0)->take(80)->get();
        if($sources->isEmpty()){
            Source::update('done',0);
            $sources = Source::take('90')->get();
        }
        
        $from = date('Y-m-dTH:i:s',strtotime("-12 hours"));
        $to = date('Y-m-dTH:i:s');
        foreach($sources as $source){
            $query = '?sources='.$source->source_id;
            $query .= '&from='.$from;
            $query .= '&to='.$to;
            \Log::info(print_r($url.$query,true));
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url.$query,
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
                $source->done = 1;
                $source->save();
                if(!empty($result['articles'])){
                    $this->__saveArtical($source->id,$result['articles'] );
                }
                
            }
        }
        return 0;
    }

    private function __saveArtical($sourceID, $data)
    {
        foreach($data as $artical){
            $row = Artical::where('title',$artical['title'])->where('author',$artical['author'])->get();
            if($row->isEmpty()){
                $articalObj = new Artical;
                $articalObj->source_id = $sourceID;
                $articalObj->author = $artical['author'];
                $articalObj->title = $artical['title'];
                $articalObj->description = $artical['description'];
                $articalObj->url = $artical['url'];
                $articalObj->urlToImage = $artical['urlToImage'];
                $articalObj->published_at = date('Y-m-d H:i:s',strtotime($artical['publishedAt']));
                $articalObj->content = $artical['content'];
                $articalObj->save();
            }
        }
        return;
    }
}
