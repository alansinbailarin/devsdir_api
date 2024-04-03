<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getCompanies(Request $request)
    {
        // Get las 20 companies
        $companies = Company::orderBy('created_at', 'desc')->take(20)->get();

        if ($companies->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No companies found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $companies
        ]);
    }

    public function getCompanyInformation(Request $request, $companyId)
    {
        $company = Company::find($companyId);

        if (!$company) {
            return response()->json([
                'success' => false,
                'message' => 'Company not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $company
        ]);
    }

    public function getCompaniesByType(Request $request, $companyTypeId)
    {
        $companies = Company::where('company_type_id', $companyTypeId)->get();

        if ($companies->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No companies found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $companies
        ]);
    }
}
