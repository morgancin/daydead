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
                'PlaceId' => $lead->qr->place->id,
                'UserId' => (isset($lead->qr->place->id)) ? $lead->qr->place->id : request()->cmbPlace,
            ]);

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
