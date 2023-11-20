<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class isUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session()->has('ID')) {
            $user = DB::table('users')->where('id', '=', Session::get('ID'))->first();

            if ($user->role_id == 3) {
                return $next($request);
            } else {
                return back()->with('fail', 'Nemate pristup ovde!');
            }
        } else {
            return redirect()->route('login')->with('fail', 'Morate da se prijavite prvo!');
        }
    }
}
