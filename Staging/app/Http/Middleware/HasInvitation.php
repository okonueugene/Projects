<?php

namespace App\Http\Middleware;

use App\Models\Invitation;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class HasInvitation
{   
    // Only for get requests

    public function handle(Request $request, Closure $next)
    {   
        if ($request->isMethod('get')) {

        /**
         * No token = Goodbye.
         */
        if (!$request->has('invitation_token')) {
            return redirect(route('login'));
        }

        $invitation_token = $request->get('invitation_token');

        /**
         * Lets try to find invitation by its token.
         * If failed -> return to request page with error.
         */
        try {
            $invitation = Invitation::where('invitation_token', $invitation_token)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return redirect(route('login'))
                ->with('error', 'Wrong invitation token! Please check your URL.');
        }

        /**
         * Let's check if users already registered.
         * If yes -> redirect to login with error.
         */
        if (!is_null($invitation->registered_at)) {
            
            return redirect(route('login'))->with('error', 'The invitation link has already been used.');
        }
    }
        return $next($request);
    }
}
