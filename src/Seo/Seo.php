<?php

namespace App\Seo;

use Symfony\Component\String\Slugger\SluggerInterface;

class Seo
{
    private string $title;
    private string $description;
    private string $canonical;
    private string $ogLocale;
    private string $ogType;
    private string $ogTitle;
    private string $ogDescription;
    private string $ogUrl;
    private string $ogSiteName;
    private string $ogImageSecureUrl;
    private string $ogImageWidth;
    private string $ogImageHeight;
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->ogLocale = 'en_US';
        $this->ogType = 'website';
        $this->ogSiteName = 'yourname';
        $this->ogImageSecureUrl = 'https://www.yourdomain.com/theme/assets/img/seo.png';
        $this->ogImageWidth = '1280';
        $this->ogImageHeight = '521';
        $this->slugger = $slugger;
    }

    public function home(): static
    {
        $this->title = 'Seo title here!';
        $this->description = 'Seo description here!';
        $this->canonical = 'https://www.yourdomain.com';

        $this->ogTitle = $this->title;
        $this->ogDescription = $this->description;
        $this->ogUrl = $this->canonical;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param $title
     * @return  self
     */
    public function setTitle($title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param $description
     * @return  self
     */
    public function setDescription($description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of ogLocale
     */
    public function getOgLocale(): string
    {
        return $this->ogLocale;
    }

    /**
     * Set the value of ogLocale
     *
     * @param $ogLocale
     * @return  self
     */
    public function setOgLocale($ogLocale): static
    {
        $this->ogLocale = $ogLocale;

        return $this;
    }

    /**
     * Get the value of ogType
     */
    public function getOgType(): string
    {
        return $this->ogType;
    }

    /**
     * Set the value of ogType
     *
     * @param $ogType
     * @return  self
     */
    public function setOgType($ogType): static
    {
        $this->ogType = $ogType;

        return $this;
    }

    /**
     * Get the value of ogTitle
     */
    public function getOgTitle(): string
    {
        return $this->ogTitle;
    }

    /**
     * Set the value of ogTitle
     *
     * @param $ogTitle
     * @return  self
     */
    public function setOgTitle($ogTitle): static
    {
        $this->ogTitle = $ogTitle;

        return $this;
    }

    /**
     * Get the value of ogDescription
     */
    public function getOgDescription(): string
    {
        return $this->ogDescription;
    }

    /**
     * Set the value of ogDescription
     *
     * @param $ogDescription
     * @return  self
     */
    public function setOgDescription($ogDescription): static
    {
        $this->ogDescription = $ogDescription;

        return $this;
    }

    /**
     * Get the value of ogUrl
     */
    public function getOgUrl(): string
    {
        return $this->ogUrl;
    }

    /**
     * Set the value of ogUrl
     *
     * @param $ogUrl
     * @return  self
     */
    public function setOgUrl($ogUrl): static
    {
        $this->ogUrl = $ogUrl;

        return $this;
    }

    /**
     * Get the value of ogSiteName
     */
    public function getOgSiteName(): string
    {
        return $this->ogSiteName;
    }

    /**
     * Set the value of ogSiteName
     *
     * @param $ogSiteName
     * @return  self
     */
    public function setOgSiteName($ogSiteName): static
    {
        $this->ogSiteName = $ogSiteName;

        return $this;
    }

    /**
     * Get the value of ogImageSecureUrl
     */
    public function getOgImageSecureUrl(): string
    {
        return $this->ogImageSecureUrl;
    }

    /**
     * Set the value of ogImageSecureUrl
     *
     * @param $ogImageSecureUrl
     * @return  self
     */
    public function setOgImageSecureUrl($ogImageSecureUrl): static
    {
        $this->ogImageSecureUrl = $ogImageSecureUrl;

        return $this;
    }

    /**
     * Get the value of ogImageWidth
     */
    public function getOgImageWidth(): string
    {
        return $this->ogImageWidth;
    }

    /**
     * Set the value of ogImageWidth
     *
     * @param $ogImageWidth
     * @return  self
     */
    public function setOgImageWidth($ogImageWidth): static
    {
        $this->ogImageWidth = $ogImageWidth;

        return $this;
    }

    /**
     * Get the value of ogImageHeight
     */
    public function getOgImageHeight(): string
    {
        return $this->ogImageHeight;
    }

    /**
     * Set the value of ogImageHeight
     *
     * @param $ogImageHeight
     * @return  self
     */
    public function setOgImageHeight($ogImageHeight): static
    {
        $this->ogImageHeight = $ogImageHeight;

        return $this;
    }

    /**
     * Get the value of canonical
     */
    public function getCanonical(): string
    {
        return $this->canonical;
    }

    /**
     * Set the value of canonical
     *
     * @param $canonical
     * @return  self
     */
    public function setCanonical($canonical): static
    {
        $this->canonical = $canonical;

        return $this;
    }
}