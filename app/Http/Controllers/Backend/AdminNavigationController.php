<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Http\Requests\CreateNavigationRequest;

class AdminNavigationController extends AdminCommonController
{
    public function index()
    {
        $navigations = \NavigationRepository::getPaginatedNavigations(15);

        $navigation_count = \NavigationRepository::all()->count();

        return ViewHelper::backView('navigations.index', compact('navigations', 'navigation_count'));
    }

    public function create()
    {
        return ViewHelper::backView('navigations.create');
    }

    public function store(CreateNavigationRequest $request)
    {
        $input = $request->all();

        \NavigationRepository::createNavigation($input);

        return Redirect::route('backend::admin.navigations.index');
    }

    public function edit($navigation_id)
    {
        $navigation = \NavigationRepository::find($navigation_id);

        return ViewHelper::backView('navigations.edit', compact('navigation'));
    }

    public function update($navigation_id, CreateNavigationRequest $request)
    {
        \NavigationRepository::updateNavigation($navigation_id, $request->all());

        return Redirect::back();
    }

    public function destroy($navigation_id)
    {
        \NavigationRepository::deleteNavigation($navigation_id);

        return Redirect::route('backend::admin.navigations.index');
    }
}
