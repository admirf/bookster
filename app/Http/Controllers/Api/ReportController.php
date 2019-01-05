<?php

namespace App\Http\Controllers\Api;

use App\Report;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;

class ReportController extends Controller
{
    public function index()
    {
        return ReportResource::collection(Report::all()->load('user'));
    }

    public function show(Report $report)
    {
        return new ReportResource($report->load('user'));
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        $report = $request->user()->reports()->create($attributes);

        return new ReportResource($report->load('user'));
    }

    public function destroy(Report $report)
    {
        $report->delete();

        return response('', 204);
    }
}
