<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminApprovalNoticeController extends Controller
{
    /**
     * Display the approval notice.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        return $request->user()->isApproved()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.wait-for-approval');
    }
}
