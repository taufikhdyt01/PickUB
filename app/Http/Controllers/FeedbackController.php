<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Laporan;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Laporan::with(['user', 'kategori', 'feedback'])->get();
        $data->map(function ($data) {
            $data->time = $data->created_at->format('H:i');
            $data->status = ($data->feedback) ? 'selesai' : 'belum';
        });
        // dd($data);
        return view('laporan-masuk.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'description' => 'required|min:6',
            'laporan_id' => 'required',
        ]);



        Feedback::create($validation);


        return redirect()->route('laporan-masuk.index')->with('success', 'Laporan anda berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('laporan-masuk/create', [
            'data' => Laporan::with(['user', 'kategori'])->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
