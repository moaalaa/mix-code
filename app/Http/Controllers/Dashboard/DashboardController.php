<?php

namespace MixCode\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use MixCode\Contact;
use MixCode\Http\Controllers\Controller;
use MixCode\User;
use MixCode\Service;
use MixCode\Portfolio;
 
class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // if ($user->isCompany()) {
        //     return $this->companiesDashboard();
        // }

        return $this->adminsDashboard();
    }

    protected function adminsDashboard()
    {
        $admins_count                   = User::typeAdmin()->count();
        $users_count                    = User::typeCustomer()->count();
        $portfolios_count               = Portfolio::count();
        $services_count                 = Service::count();
         $messages_count                = Contact::count();

        return view('dashboard.dashboard', compact(
            'admins_count',
            'users_count',
            'messages_count',
            'services_count',
            'portfolios_count'
        ));
    }

    // protected function companiesDashboard()
    // {
    //     return view('dashboard.companies_dashboard');
    // }
}
