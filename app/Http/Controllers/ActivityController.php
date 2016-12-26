<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Activity;
use App\Http\Requests;
use App\Http\Requests\ActivityValidator;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Inputs not included in the mass-assigns.
     *
     * @var array
     */
    protected $inputFilter;

    /**
     * MySQL database relations array.
     *
     * @var array
     */
    protected $dbRelations;

    /**
     * ActivityController constructor
     */
    public function __construct()
    {
        $this->inputFilter = ['_token', 'group'];   // Fill in the filter array for the inputs.
        $this->dbRelations = ['groups', 'creator']; // The MySQL database relations.

        $this->middleware('auth'); // See if the user is logged in.
        $this->middleware('lang'); // Determine the language and get the correct trans. files.
    }

    /**
     * [BACK-END]: Get the activity overview.
     *
     * @url:platform  GET|HEAD: /backend/activity
     * @see:phpunit   ActivityControllerTest::testOverview()
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Activity states.
        // 0 = draft
        // 1 = publish

        $data['drafts'] = Activity::with($this->dbRelations)
            ->where('state', 0)
            ->orderBy('date', 'ASC')
            ->paginate(25);

        $data['published'] = Activity::with($this->dbRelations)
            ->where('state', 1)
            ->orderBy('date', 'ASC')
            ->paginate(25);

        $data['groups'] = Groups::all();

        return view('activity.index', $data);
    }

    /**
     * [METHOD]: Store a new activity in the database.
     *
     * @url:platform  POST: /backend/activity
     * @see:phpunit   ActivityControllerTest::testInsertWithError()
     * @see:phpunit   ActivityControllerTest::testInsertWithOutError()
     *
     * @param  Requests\ActivityValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActivityValidator $input)
    {
        // For DEBUGGING propose.
        // dd($input->all());

        $inputs = array_merge(['user_id' => auth()->user()->id], $input->except($this->inputFilter));
        $create = Activity::create($inputs);

        Activity::find($create->id)->groups()->attach($input->group);

        if ($create) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.activity-store'));
        }

        return redirect()->back();
    }

    /**
     * [BACK-END]: Update view for a activity.
     *
     * @url:platform  GET|HEAD:
     * @see:phpunit   ActivityControllerTest::testEditView()
     *
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $data['activity'] = Activity::find($id);
        return view('', $data);
    }


    /**
     * [METHOD]: Update a activity in the database.
     *
     * @url::platform  PUT|PATCH: /backend/activity/update/{id}
     * @see:phpunit    ActivityControllerTest::testUpdateWithError()
     * @see:phpunit    ActivityControllerTest::testUpdateWithOutError()
     *
     * @param  Requests\ActivityValidator $input
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ActivityValidator $input, $id)
    {
        $activity = Activity::find($id);
        $inputs = array_merge(['user_id' => auth()->user()->id], $input->except($this->inputFilter));
        $update   = $activity->update($inputs);

        if ($update) {
            session()->flash('success', 'alert alert-success');
            session()->flash('message', trans('flash-session.activity-update'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Destroy a activity.
     *
     * @url:platform  GET|HEAD: /backend/activity/destroy/{id}
     * @see:phpunit   ActivityControllertest::testDestroyActivity()
     *
     * @param  int $id the activity id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if (Activity::destroy($id)) {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.activity-destroy'));
        }

        return redirect()->back();
    }
}
