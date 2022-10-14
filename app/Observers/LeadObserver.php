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
            $aRequest = [
                'Name' => $lead->name,
                'Email' => $lead->email,
                'Phone' => trim($lead->phone),
                'PlaceId' => $lead->place->code,
                'BusinessLine' => $lead->business_line,
                'UserId' => $lead->qr->user->leader_user_id,
            ];

            $response = Http::post('https://api.leader.sale/prospect/add-lead-lp', $aRequest);

            if((int) $response->status() == 200)
            {
                $lead->prospect_id = $response['body']['ProspectId'];
                $lead->save();
            }

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
