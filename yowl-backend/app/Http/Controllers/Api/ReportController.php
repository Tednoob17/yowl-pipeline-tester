<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\StoreRequest;
use App\Http\Requests\Report\UpdateRequest;
use App\Models\Report;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        try
        {
            $reports = Report::paginate(10);
            return response()->json([
                "status" => "success",
                "reports" => $reports
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Internal server error"
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) : JsonResponse
    {
        try
        {
            $report = Report::create($request->validated());
            return response()->json([
                "status" => "success",
                "message" => "Report created successfully",
                "report" => $report
            ], 201);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Internal server error"
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($report): JsonResponse
    {
        try
        {
            $report = Report::find($report);
            return response()->json([
                "status" => "success",
                "report" => $report
            ], 200);
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Report not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $report)
    {
        try
        {
            $report = Report::find($report);
            try
            {
                $report->update($request->validated());
                return response()->json([
                    "status" => "success",
                    "message" => "Report updated successfully",
                    "report" => $report
                ], 200);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    "status" => "error",
                    "message" => "Internal server error"
                ], 500);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Report not found"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($report)
    {
        try
        {
            $report = Report::find($report);
            try
            {
                $report->delete();
                return response()->json([
                    "status" => "success",
                    "message" => "Report deleted successfully"
                ], 200);
            }
            catch (\Exception $e)
            {
                return response()->json([
                    "status" => "error",
                    "message" => "Internal server error"
                ], 500);
            }
        }
        catch (\Exception $e)
        {
            return response()->json([
                "status" => "error",
                "message" => "Report not found"
            ], 404);
        }
    }
}
