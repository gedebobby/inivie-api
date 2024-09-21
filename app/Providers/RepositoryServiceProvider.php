<?php

namespace App\Providers;

use App\Repositories\Album\AlbumInterface;
use App\Repositories\Album\AlbumRepository;
use App\Repositories\Gallery\GalleryInterface;
use App\Repositories\Gallery\GalleryRepository;
use App\Repositories\Icon\IconInterface;
use App\Repositories\Icon\IconRepository;
use App\Repositories\InquiryAndPolicy\InquiryAndPolicyInterface;
use App\Repositories\InquiryAndPolicy\InquiryAndPolicyRepository;
use App\Repositories\ListProperties\ListPropertiesInterface;
use App\Repositories\ListProperties\ListPropertiesRepository;
use App\Repositories\Offers\OffersInterface;
use App\Repositories\Offers\OffersRepository;
use App\Repositories\Photos\PhotoInterface;
use App\Repositories\Photos\PhotoRepository;
use App\Repositories\Property\IniViePropertyInterface;
use App\Repositories\Property\IniViePropertyRepository;
use App\Repositories\RoomList\RoomListInterface;
use App\Repositories\RoomList\RoomListRepository;
use App\Repositories\ServiceFacility\ServiceFacilityInterface;
use App\Repositories\ServiceFacility\ServiceFacilityRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ListPropertiesInterface::class, ListPropertiesRepository::class);
        $this->app->bind(RoomListInterface::class, RoomListRepository::class);
        $this->app->bind(GalleryInterface::class, GalleryRepository::class);
        $this->app->bind(AlbumInterface::class, AlbumRepository::class);
        $this->app->bind(PhotoInterface::class, PhotoRepository::class);
        $this->app->bind(OffersInterface::class, OffersRepository::class);
        $this->app->bind(IniViePropertyInterface::class, IniViePropertyRepository::class);
        $this->app->bind(InquiryAndPolicyInterface::class, InquiryAndPolicyRepository::class);
        $this->app->bind(ServiceFacilityInterface::class, ServiceFacilityRepository::class);
        $this->app->bind(IconInterface::class, IconRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
    }
}
