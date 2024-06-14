<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Page\Concerns;

trait SeoTrait
{
    protected ?string $title = null;

    protected ?string $description = null;

    protected ?string $keywords = null;

    protected ?string $author = null;

    protected ?string $robots = null;

    protected ?string $canonical = null;

    protected ?string $ogTitle = null;

    protected ?string $ogDescription = null;

    protected ?string $ogImage = null;

    protected ?string $ogUrl = null;

    protected ?string $ogType = null;

    protected ?string $ogSiteName = null;

    protected ?string $ogLocale = null;

    protected ?string $ogLocaleAlternate = null;

    protected ?string $twitterCard = null;

    protected ?string $twitterSite = null;

    protected ?string $twitterCreator = null;

    protected ?string $twitterTitle = null;

    protected ?string $twitterDescription = null;

    protected ?string $twitterImage = null;

    protected ?string $twitterImageAlt = null;

    protected ?string $twitterUrl = null;


    public static function bootSeoTrait()
    {
        $model = new static();
        $model->title = config('app.name');
        $model->author = config('app.name');
        $model->robots = "index, follow";
        $model->ogType = "website";
        $model->ogUrl = url()->current();
        $model->ogSiteName = config('app.name');
        $model->ogLocale = "pt_BR";
        $model->ogLocaleAlternate = "en_US";
        $model->twitterCard = "summary_large_image";
        $model->twitterSite = config('app.name');
        $model->twitterUrl = url()->current();
        $model->twitterCreator = config('app.name');
        $model->twitterType = "summary_large_image";
        $model->twitterApp = "app";
        $model->twitterAppId = "app";
    }


    public function title($title)
    {
        $this->title = $title;
        return $this;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    public function keywords($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    public function author($author)
    {
        $this->author = $author;
        return $this;
    }

    public function robots($robots)
    {
        $this->robots = $robots;
        return $this;
    }

    public function canonical($canonical)
    {
        $this->canonical = $canonical;
        return $this;
    }

    public function ogTitle($ogTitle)
    {
        $this->ogTitle = $ogTitle;
        return $this;
    }

    public function ogDescription($ogDescription)
    {
        $this->ogDescription = $ogDescription;
        return $this;
    }

    public function ogImage($ogImage)
    {
        $this->ogImage = $ogImage;
        return $this;
    }

    public function ogUrl($ogUrl)
    {
        $this->ogUrl = $ogUrl;
        return $this;
    }

    public function ogType($ogType)
    {
        $this->ogType = $ogType;
        return $this;
    }

    public function ogSiteName($ogSiteName)
    {
        $this->ogSiteName = $ogSiteName;
        return $this;
    }

    public function ogLocale($ogLocale)
    {
        $this->ogLocale = $ogLocale;
        return $this;
    }

    public function ogLocaleAlternate($ogLocaleAlternate)
    {
        $this->ogLocaleAlternate = $ogLocaleAlternate;
        return $this;
    }

    public function twitterCard($twitterCard)
    {
        $this->twitterCard = $twitterCard;
        return $this;
    }

    public function twitterSite($twitterSite)
    {
        $this->twitterSite = $twitterSite;
        return $this;
    }

    public function twitterCreator($twitterCreator)
    {
        $this->twitterCreator = $twitterCreator;
        return $this;
    }

    public function twitterTitle($twitterTitle)
    {
        $this->twitterTitle = $twitterTitle;
        return $this;
    }

    public function twitterDescription($twitterDescription)
    {
        $this->twitterDescription = $twitterDescription;
        return $this;
    }

    public function twitterImage($twitterImage)
    {
        $this->twitterImage = $twitterImage;
        return $this;
    }

    public function twitterImageAlt($twitterImageAlt)
    {
        $this->twitterImageAlt = $twitterImageAlt;
        return $this;
    }

    public function twitterUrl($twitterUrl)
    {
        $this->twitterUrl = $twitterUrl;
        return $this;
    }

    public function twitterType($twitterType)
    {
        $this->twitterType = $twitterType;
        return $this;
    }

    public function twitterApp($twitterApp)
    {
        $this->twitterApp = $twitterApp;
        return $this;
    }

    public function twitterAppId($twitterAppId)
    {
        $this->twitterAppId = $twitterAppId;
        return $this;
    }
}
