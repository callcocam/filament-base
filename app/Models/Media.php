<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Core\Landlord\BelongsToTenants;
use App\Core\Sluggable\HasSlug;
use App\Core\Sluggable\SlugOptions;
use App\Models\AbstractModel;
use Awcodes\Curator\Models\Media as ModelsMedia;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Media extends ModelsMedia
{
    use HasFactory, BelongsToTenants, HasSlug, HasUlids, LogsActivity, SoftDeletes;

     
    protected static $logAttributes = ['*'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly($this->getLogAttributes());
        // Chain fluent methods for configuration options
    }

    
    public function getLogAttributes()
    {
        return $this->logAttributes ?? ['*'];
    }

    
    /**
     * @return SlugOptions
     */
    public function getSlugOptions()
    {
        if (is_string($this->slugTo())) {
            return SlugOptions::create()
                ->generateSlugsFrom($this->slugFrom())
                ->saveSlugsTo($this->slugTo());
        }
    }
}
