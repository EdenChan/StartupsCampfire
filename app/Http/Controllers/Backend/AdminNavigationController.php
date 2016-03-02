<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\NavigationRepository;
use StartupsCampfire\Http\Requests\CreateNavigationRequest;

class AdminNavigationController extends AdminCommonController
{
    protected $navigationRepository;

    public function __construct(NavigationRepository $navigationRepository)
    {
        parent::__construct();

        $this->navigationRepository = $navigationRepository;
    }

    public function index()
    {
        $navigations = $this->navigationRepository->getPaginatedNavigations(15);

        $navigation_count = $this->navigationRepository->all()->count();

        return ViewHelper::backView('navigations.index', compact('navigations', 'navigation_count'));
    }

    public function create()
    {
        return ViewHelper::backView('navigations.create');
    }

    public function store(CreateNavigationRequest $request)
    {
        $input = $request->all();

        $this->navigationRepository->createNavigation($input);

        return Redirect::route('backend::admin.navigations.index');
    }

    public function edit($navigation_id)
    {
        $navigation = $this->navigationRepository->find($navigation_id);

        return ViewHelper::backView('navigations.edit', compact('navigation'));
    }

    public function update($navigation_id, CreateNavigationRequest $request)
    {
        $this->navigationRepository->updateNavigation($navigation_id, $request->all());

        return Redirect::back();
    }

    public function destroy($navigation_id)
    {
        $this->navigationRepository->deleteNavigation($navigation_id);

        return Redirect::route('backend::admin.navigations.index');
    }
}
