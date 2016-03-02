<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use StartupsCampfire\Http\Requests\CreateCarouselRequest;
use StartupsCampfire\Http\Requests\UpdateCarouselRequest;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;
use StartupsCampfire\Repositories\CarouselRepository;

class AdminCarouselController extends AdminCommonController
{
    protected $carouselRepository;

    public function __construct(CarouselRepository $carouselRepository)
    {
        parent::__construct();

        $this->carouselRepository = $carouselRepository;
    }

    public function index()
    {
        $carousels = $this->carouselRepository->getPaginatedCarousels(15);

        $carousels_count = $this->carouselRepository->all()->count();

        return ViewHelper::backView('carousels.index', compact('carousels', 'carousels_count'));
    }

    public function show($carousel_id)
    {
        $carousel = $this->carouselRepository->find($carousel_id);

        return ViewHelper::backView('carousels.show', compact('carousel'));
    }

    public function create()
    {
        return ViewHelper::backView('carousels.create');
    }

    public function store(CreateCarouselRequest $request)
    {
        $input = $request->all();
        // 可以根据type字段扩展多种幻灯片组件 这里默认只设置主页幻灯片
        $input['type'] = 'index';

        $this->carouselRepository->createCarousel($input);

        return Redirect::route('backend::admin.carousels.index');
    }

    public function edit($carousel_id)
    {
        $carousel = $this->carouselRepository->find($carousel_id);

        return ViewHelper::backView('carousels.edit', compact('carousel'));
    }

    public function update($carousel_id, UpdateCarouselRequest $request)
    {
        $this->carouselRepository->updateCarousel($carousel_id, $request->all());

        return Redirect::back();
    }

    public function destroy($carousel_id)
    {
        $this->carouselRepository->deleteCarousel($carousel_id);

        return Redirect::route('backend::admin.carousels.index');
    }
}