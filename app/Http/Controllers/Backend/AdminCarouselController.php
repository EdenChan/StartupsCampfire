<?php

namespace StartupsCampfire\Http\Controllers\Backend;

use StartupsCampfire\Http\Requests\CreateCarouselRequest;
use StartupsCampfire\Http\Requests\UpdateCarouselRequest;
use Illuminate\Support\Facades\Redirect;
use StartupsCampfire\Http\Requests;
use StartupsCampfire\Helpers\ViewHelper;

class AdminCarouselController extends AdminCommonController
{
    public function index()
    {
        $carousels = \CarouselRepository::getPaginatedCarousels(15);

        $carousels_count = \CarouselRepository::all()->count();

        return ViewHelper::backView('carousels.index', compact('carousels', 'carousels_count'));
    }

    public function show($carousel_id)
    {
        $carousel = \CarouselRepository::find($carousel_id);

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

        \CarouselRepository::createCarousel($input);

        return Redirect::route('backend::admin.carousels.index');
    }

    public function edit($carousel_id)
    {
        $carousel = \CarouselRepository::find($carousel_id);

        return ViewHelper::backView('carousels.edit', compact('carousel'));
    }

    public function update($carousel_id, UpdateCarouselRequest $request)
    {
        \CarouselRepository::updateCarousel($carousel_id, $request->all());

        return Redirect::back();
    }

    public function destroy($carousel_id)
    {
        \CarouselRepository::deleteCarousel($carousel_id);

        return Redirect::route('backend::admin.carousels.index');
    }
}