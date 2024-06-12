<?php

namespace App\Seo;

use App\Entity\Media;
use Symfony\Component\String\Slugger\SluggerInterface;

class Seo
{
    public ?string $canonical;
    public ?string $ogLocale;
    public ?string $ogType;
    public ?string $ogTitle;
    public ?string $ogDescription;
    public ?string $ogUrl;
    public ?string $ogSiteName;
    public ?string $ogImageSecureUrl;
    public ?string $ogImageWidth;
    public ?string $ogImageHeight;

    public function __construct(
        public string $title,
        public string $description,
        public Media  $image,
    )
    {
        $this->ogLocale = 'fr_FR';
        $this->ogType = 'website';
        $this->ogSiteName = 'Augusta Sarlin - Portfolio';
        $this->ogImageSecureUrl = $image->getMediaPath();
        $this->ogImageWidth = '1280';
        $this->ogImageHeight = '521';
        $this->canonical = 'https://www.augustasarlin.com';
        $this->ogTitle = $this->title;
        $this->ogDescription = $this->description;
        $this->ogUrl = $this->canonical;
    }
}