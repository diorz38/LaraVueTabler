<?php

namespace App\Http\InertiaControllers;

use App\Models\Prakom;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PrakomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Prakoms/Index', [
                'prakoms' => Prakom::paginate(10),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(): \Inertia\Response
    {
        return Inertia::render('Prakoms/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Redirect
     */
    public function store(Request $request): Redirect
    {
        return Redirect::route('prakoms')->with('success', 'Prakom created.');
    }

    /**
     * Display the specified resource.
     *
     * @param Prakom $prakom
     * @return \Inertia\Response
     */
    public function show(Prakom $prakom): \Inertia\Response
    {
        return Inertia::render('Prakoms/Show', [
                'prakom' => $prakom
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Prakom $prakom
     * @return \Inertia\Response
     */
    public function edit(Prakom $prakom): \Inertia\Response
    {
        return Inertia::render('Prakoms/Edit', [
                'prakom' => $prakom
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Prakom $prakom
     * @return Redirect
     */
    public function update(Request $request, Prakom $prakom): Redirect
    {
        return Redirect::back()->with('success', 'Prakom updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Prakom $prakom
     * @return Redirect
     */
    public function destroy(Prakom $prakom): Redirect
    {
        return Redirect::back()->with('success', 'Prakom restored.');
    }

    /**
     * Restore the specified resource.
     *
     * @param Prakom $prakom
     * @return Redirect
     */
    public function restore(Prakom $prakom): Redirect
    {
        $prakom->restore();

        return Redirect::back()->with('success', 'Prakom restored.');
    }
}
