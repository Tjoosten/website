<?php

namespace App\Http\Controllers;

use App\Groups;
use App\Activity; 
use Illuminate\Http\Request;
use App\Http\Requests\GroupValidator;
use App\Http\Requests;

/**
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class GroupController extends Controller
{
    /**
     * Auth middleware protected routes. 
     * 
     * @var array
     */
    protected $authRoutes;
    
    /**
     * GroupController constuctor
     */
    public function __construct()
	{
        $this->authRoutes = [];
        
		$this->middleware('lang');
		$this->middleware('auth')->only($this->authRoutes);
	}

	/**
	 * [FRONT-END]: Display all the scouting groups.
	 *
	 * @url:platform  GET|HEAD: /groups
	 * @see:phpunit   GroupControllerTest::
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function overview()
	{
        $data['kapoenen']   = Groups::getGroup('kapoenen')->get();
        $data['welpen']     = Groups::getGroup('welpen')->get();
        $data['jongGivers'] = Groups::getGroup('jonggivers')->get();
        $data['givers']     = Groups::getGroup('givers')->get();
        $data['jins']       = Groups::getGroup('jins')->get();
        $data['leiding']    = Groups::getGroup('leiding')->get();

		return view('groups.frontend-index', $data);
	}

	/**
	 * [FRONT-END]: Get a specific group and display them.
	 *
	 * @url:platform  GET|HEAD:
	 * @see:phpunit   GroupControllerTest::
	 *
	 * @param  string $param the group identifier in the database.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function specific($param)
	{
		$data['group']    = Groups::getGroup('selector', $param)->get();
        $data['activity'] = Activity::where('', '')->get(); 
        
		return view('groups.show', $data);
	}

	/**
	 * [BACK-END]: Update for a group.
	 *
	 * @url:platform  GET|HEAD:
	 * @see:phpunit   GroupControllerTest::
	 *
     * @param  string $param The group selector in the database.
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function edit($param)
	{
	    $data['group'] = Groups::getGroup($param)->get();
		return view('', $data);
	}

	/**
	 * [METHOD]: Update a group description.
	 *
	 * @url:platform  PUT|PATCH:
	 * @see:phpunit   GroupControllerTest::
	 * @see:phpunit   GroupControllerTest::
	 *
	 * @param  GroupValidator $input
	 * @param  string $param The group selector in the database.
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(GroupValidator $input, $param)
	{
		$group = Groups::where('selector', $param);

		if ($group->update($input->except('_token'))) // Update the group data
		{
			session()->flash('class', 'alert alert-success');
			session()->flash('message',  trans('flash-session.group-update'));
		}
	}
}
