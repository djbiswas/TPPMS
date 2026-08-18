<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Support\DemoLedger;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function __invoke(): View
    {
        return view('tenant.history', [
            'history' => DemoLedger::history(),
        ]);
    }
}
