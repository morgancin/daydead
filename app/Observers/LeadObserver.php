<?php

namespace App\Observers;

use Exception;
use App\Models\Lead;
use Illuminate\Support\Facades\Http;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     *
     * @param  \App\Models\Lead  $lead
     * @return void
     */
    public function created(Lead $lead)
    {
        try	{
            $response = Http::post('https://api.leader.sale/prospect/add-lead-lp', [
                'Name' => $lead->name,
                'Email' => $lead->email,
                'Phone' => trim($lead->phone),
                'PlaceId' => $lead->place->code,
                'UserId' => $lead->qr->user->leader_user_id,
                'BusinessLine' => $lead->business_line,
            ]);

            //prospect_id

            //$lead->leader_user_id = $response;

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
