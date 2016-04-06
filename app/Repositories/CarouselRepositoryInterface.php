<?php
namespace StartupsCampfire\Repositories;


interface CarouselRepositoryInterface extends BaseRepositoryInterface
{
    public function getCarouselsList();

    public function getPaginatedCarousels($page_size);

    public function createCarousel($input);

    public function updateCarousel($carousel_id, $input);

    public function deleteCarousel($carousel_id);
}