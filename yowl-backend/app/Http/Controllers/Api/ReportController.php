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
        $reports = Report::all();

        return response()->json([
            "status" => "success",
            "reports" => $reports
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request) : JsonResponse
    {
        $report = Report::create($request->validated());

        return response()->json([
            "status" => "success",
            "message" => "Report created successfully",
            "report" => $report
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($report): JsonResponse
    {
        $report = Report::find($report);
        return response()->json([
            "status" => "success",
            "report" => $report
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $report)
    {
        $report = Report::find($report);
        $report->update($request->validated());

        return response()->json([
            "status" => "success",
            "message" => "Report updated successfully",
            "report" => $report
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($report)
    {
        Report::destroy($report);

        return response()->json([
            'status' => 'success',
            'deleted_report' => $report,
            'message' => 'Report deleted successfully'
        ], 204);
    }
}
