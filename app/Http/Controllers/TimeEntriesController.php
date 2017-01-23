<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\TimeEntries;

class TimeEntriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * Gets time entries and eager loads their associated users
	 * @return Response
	 */
	//
	public function index()
	{
		$time = TimeEntries::with('user')->get();

		return $time;
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
    public function store()
    {
        $data = Request::all();

        $time_entry = new TimeEntries();

        $time_entry->fill($data);

        $time_entry->save();

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id)
    {
        $timeentry = TimeEntries::find($id);

        $data = Request::all();

        $timeentry->fill($data);

        $timeentry->save();

    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        $timeentry = TimeEntry::find($id);

        $timeentry->delete();
    }


}
