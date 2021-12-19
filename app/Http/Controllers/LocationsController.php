<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Locations;
use JavaScript;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('locations');
        // return Locations::paginate(5);
    }



     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function weather_list()
    {
        $apiKey = "7de68508229fba7929b2e8c00550bed4";

        $locations = Locations::paginate(25);

        foreach($locations as $key => $val){
           
            $apiUrl = "https://api.openweathermap.org/data/2.5/forecast?q=".$val->name.",".$val->state.",".$val->country_code."&appid=".$apiKey;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_VERBOSE, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);

            curl_close($ch);
            $data = json_decode($response);
            $locations[$key]['current_time'] = date('H:i:s');
            $locations[$key]['current_date'] = date('Y-m-d');
            $locations[$key]['weather'] = $data;
        }

        return $locations;
        
        
    }
    public function weather_details($id)
    {
        $apiKey = "7de68508229fba7929b2e8c00550bed4";

        $locations = Locations::find($id);

 
           
        $apiUrl = "https://api.openweathermap.org/data/2.5/forecast?q=".$locations->name.",".$locations->state.",".$locations->country_code."&appid=".$apiKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);

        curl_close($ch);
        $data = json_decode($response);
        $locations['current_time'] = date('H:i:s');
        $locations['current_date'] = date('Y-m-d');
        $locations['weather'] = $data;
        $dates = [];

        for ($i=0; $i<count($locations['weather']->list); $i++) {
            if(!in_array(date('Y-m-d',strtotime($locations['weather']->list[$i]->dt_txt)),$dates)){
                $dates[] = date('Y-m-d',strtotime($locations['weather']->list[$i]->dt_txt));
            }

            $locations['weather']->list[$i]->date = date('Y-m-d',strtotime($locations['weather']->list[$i]->dt_txt));

        }
        $locations['dates'] = $dates;
        // $x= 0;
        // foreach($locations['weather'] as $weather_key => $weather_val){
            
            // dd($weather_val['list']);
            // foreach($weather_val->list as $list_key =>$list_val){

            // }
            
               
            // echo (strtotime($val2->dt_txt));
            // $locations['weather']->list[$key2]->date = date('Y-m-d',strtotime($val2->dt_txt));
            // if (!in_array(date('Y-m-d', strtotime($val2->dt_txt)), $locations['dates'])) {
                // echo $val2->dt_txt;
                // $x++;
            // }
        //    }
        // }
        

        return $locations;
        
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function locations_list()
    {
        return Locations::get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function weather()
    {
        return view('weather');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // dd($locations);
        // JavaScript::put(['location_id'=>$id]);
        // return view('weather',['location_id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
