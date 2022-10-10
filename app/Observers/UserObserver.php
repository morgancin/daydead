<?php

namespace App\Observers;

use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Http;

class UserObserver
{
    public function creating(User $user)
    {
        try	{
            $response = Http::get("https://api.leader.sale/user/".request()->code."/by-code-saler");

            if(isset($response['body'][0]['UserId']))
            {
                $user->leader_user_id = $response['body'][0]['UserId'];
            }

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
