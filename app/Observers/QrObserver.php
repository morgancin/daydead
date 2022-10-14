<?php

namespace App\Observers;

use Exception;
use App\Models\Qr;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrObserver
{
    /**
     * Handle the Lead "created" event.
     *
     * @param  \App\Models\Qr  $oQr
     * @return void
     */
    public function created(Qr $oQr)
    {
        try	{
            QrCode::format('png')->size(450)->generate(route('leads.register', $oQr->hash), storage_path("app/public/qrcodes/$oQr->src"));

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
