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
                'Phone' => $lead->phone,
                'UserId' => $lead->qr->user->leader_user_id,
                'PlaceId' => $lead->qr->place->id,
                //'businessline'
                //PF (PREVENSIÓN FINAL)
                //SG (SANTA GLORIA)
                //BF (BYE BYE FRIEND)
            ]);

            //$response['body']['ProspectId']

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
