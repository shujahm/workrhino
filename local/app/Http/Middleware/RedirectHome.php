<?php

namespace Responsive\Http\Middleware;

use Closure;

class RedirectHome
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	$datas = $request->all();
	$bookTotalAmount = $datas['bookTotalAmt'];
	if($bookTotalAmount != 0)
	{
		return redirect('/index');
	}
 
       return $next($request);
    }
}
