<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInhabitantReportRequest;
use App\Http\Requests\UpdateInhabitantReportRequest;
use App\Models\InhabitantReport;

class InhabitantReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $laporan = InhabitantReport::get_laporan();

        $data = [
            'title' => 'Kelola Lahan Parkiran - Aplikasi Pemesanan Parkir Perumahan Buah Batu',
            'laporan' => $laporan,
        ];

        // dd(ParkingArea::where('id_zone', $id)->get());

        return view('pages.list_laporan', $data);
    }

    public function selesaikan_laporan($id)
    {

        $stat = InhabitantReport::find($id);

        $data = [
            'status' => 1,
        ];

        $stat->update($data);

        return redirect()->back()->with(['success' => 'Data Laporan Telah diselesaikan!']);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInhabitantReportRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInhabitantReportRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InhabitantReport  $inhabitantReport
     * @return \Illuminate\Http\Response
     */
    public function show(InhabitantReport $inhabitantReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InhabitantReport  $inhabitantReport
     * @return \Illuminate\Http\Response
     */
    public function edit(InhabitantReport $inhabitantReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInhabitantReportRequest  $request
     * @param  \App\Models\InhabitantReport  $inhabitantReport
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInhabitantReportRequest $request, InhabitantReport $inhabitantReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InhabitantReport  $inhabitantReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(InhabitantReport $inhabitantReport)
    {
        //
    }
}
