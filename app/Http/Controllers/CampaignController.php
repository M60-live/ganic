<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function capture(Request $request)
    {
        $status = "ok";
        $message = "";
        $response=array();
        $campaign_subject = $request->get('campaign_subject');
        $answer_options = $request->get('answer_options');

        if($campaign_subject!='' && $answer_options!='')
        {
            $results = DB::table('campaign')
                ->insert(['campaign'=>$campaign_subject,'response'=>$answer_options,'created_at'=>now()]);
            if($results)
            {

            }
        }

        $response = [
            'status'=>$status,
            'message'=>$message
        ];
        return json_encode($response);
    }
}
