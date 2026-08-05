<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Services_admin\DashboardAdminService;

class DashboardAdminController extends Controller
{
    protected $dashboardAdminService;

    public function __construct(
        DashboardAdminService $dashboardAdminService
    ) {
        $this->dashboardAdminService = $dashboardAdminService;
    }

    /**
     * Menampilkan Dashboard Admin
     */
    public function index()
    {
        $data = $this->dashboardAdminService
            ->getDashboardData();

        return view(
            'example_admin.index',
            $data
        );
    }
}