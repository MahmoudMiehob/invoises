<?php

namespace App\Http\Controllers;

use App\invoices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

            $count_all =invoices::count();
            $count_invoices1 = invoices::where('Value_Status', 1)->count();
            $count_invoices2 = invoices::where('Value_Status', 2)->count();
            $count_invoices3 = invoices::where('Value_Status', 3)->count();
    
            if($count_invoices2 == 0){
                $nspainvoices2=0;
            }
            else{
                $nspainvoices2 = $count_invoices2/ $count_all*100;
            }
    
            if($count_invoices1 == 0){
                $nspainvoices1=0;
            }
            else{
                $nspainvoices1 = $count_invoices1/ $count_all*100;
            }
    
            if($count_invoices3 == 0){
                $nspainvoices3=0;
            }
            else{
                $nspainvoices3 = $count_invoices3/ $count_all*100;
            }
    
    
            $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 350, 'height' => 200])
                ->labels([__('messages.unpaid_invoices'), __('messages.paid_invoices'),__('messages.partially_paid_invoices')])
                ->datasets([
                    [
                        "label" => __('messages.unpaid_invoices'),
                        'backgroundColor' => ['#ec5858'],
                        'data' => [$nspainvoices2]
                    ],
                    [
                        "label" => __('messages.paid_invoices'),
                        'backgroundColor' => ['#81b214'],
                        'data' => [$nspainvoices1]
                    ],
                    [
                        "label" => __('messages.partially_paid_invoices'),
                        'backgroundColor' => ['#ff9642'],
                        'data' => [$nspainvoices3]
                    ],
    
    
                ])
                ->options([]);


        $chartjs_2 = app()->chartjs
                ->name('pieChartTest')
                ->type('pie')
                ->size(['width' => 340, 'height' => 200])
                ->labels([__('messages.unpaid_invoices'),__('messages.paid_invoices'),__('messages.partially_paid_invoices')])
                ->datasets([
                    [
                        'backgroundColor' => ['#ec5858', '#81b214','#ff9642'],
                        'data' => [$nspainvoices2, $nspainvoices1,$nspainvoices3]
                    ]
                ])
                ->options([]);
    
        return view('home',compact('chartjs','chartjs_2'));
    }
}
