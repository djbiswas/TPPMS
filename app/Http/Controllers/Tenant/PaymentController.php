<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Support\Company;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __invoke(): View
    {
        return view('tenant.payments', [
            'property' => Company::property(),
            'zelle' => Company::get('zelle_handle', '@LLInternationalVentures'),
            'wire' => Company::get('wire_instructions'),
        ]);
    }
}
