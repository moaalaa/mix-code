<?php

namespace MixCode;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use MixCode\Utils\UsingUuid;
use MixCode\Utils\UsingMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Laravel\Passport\HasApiTokens;
Use MixCode\Order ;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasApiTokens, UsingUuid, UsingMedia, HasMediaTrait, SoftDeletes;

    const CUSTOMER_TYPE = 'customer';
    const ADMIN_TYPE = 'admin';
    const USER_TYPES = [
        self::CUSTOMER_TYPE, 
         self::ADMIN_TYPE
    ];

    const ACTIVE_STATUS = 'active';
    const PENDING_STATUS = 'pending';
    const INACTIVE_STATUS = 'disable';
    const USER_STATUS = [
        self::ACTIVE_STATUS, 
        self::PENDING_STATUS, 
        self::INACTIVE_STATUS
    ];

    const CREATOR_RELATION_KEY = 'creator_id';
    
    /**
     * The attributes that are mass assignable.
     *
     * NOTE: This Model Has Media (Files and Images) And It's Saved In media Relation By Media Package
     * -- ID Card
     * -- Travel-Certificate
     * -- Tax Card
     * -- Business Register
     * -- Logo
     *
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'full_name', 
        'email', 
        'password', 
        'phone', 
        'phone_code', // Came From frontend only
        'type', 
        'status', 
        'lang',
        
        'facebook', 
        'twitter', 
        'linkedin', 
        'instagram', 
        'snapchat', 
        'youtube', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'media'
    ];

    /**
     * The attributes that should be appended.
     *
     * @var array
     */
    protected $appends = ['allUserMedia'];
    protected $with = ['media'];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /** 
     * Attached Media Names
     * @var array
    */
    protected $attachedMedia = [
        'logo', 
     ];

 

    public function categories()
    {
        return $this->hasMany(Category::class, static::CREATOR_RELATION_KEY);
    }

  

    public function cards()
    {
        return $this->hasMany(Card::class, static::CREATOR_RELATION_KEY);
    }


    public function orders()
    {
        return $this->belongsToMany(Card::class,'orders', 'user_id' , 'card_id');
    }

    public function useOrders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }


    public function views()
    {
        return $this->belongsToMany(Card::class, 'card_views', 'user_id', 'card_id')
            ->using(CardView::class)
            ->withoutGlobalScopes();
    }

    public function isType($type)
    {
        return $this->type == $type;
    }

    public function isCustomer()
    {
        return $this->isType(static::CUSTOMER_TYPE);
    }
 

    public function isAdmin()
    {
        return $this->isType(static::ADMIN_TYPE);
    }

    

    public function hasStatus($status)
    {
        return $this->status == $status;
    }

    public function isActive()
    {
        return $this->hasStatus(static::ACTIVE_STATUS);
    }

    public function isAllowed()
    {
        return ($this->isAdmin());
    }


    public function isPending()
    {
        return $this->hasStatus(static::PENDING_STATUS);
    }

    public function isInActive()
    {
        return $this->hasStatus(static::INACTIVE_STATUS);
    }

    public function scopeTypeCustomer(Builder $builder)
    {
        return $builder->where('type', static::CUSTOMER_TYPE);
    }

  

    public function scopeTypeAdmin(Builder $builder)
    {
        return $builder->where('type', static::ADMIN_TYPE);
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', static::ACTIVE_STATUS);
    }

    public function scopePending(Builder $builder)
    {
        return $builder->where('status', static::PENDING_STATUS);
    }

    public function scopeInActive(Builder $builder)
    {
        return $builder->where('status', static::INACTIVE_STATUS);
    }

    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->create($data);
        
        $user->attachMedia($data);
        
        return $user;
    }

    /**
     * Update Existed User With Media
     *
     * @param array $data
     * @return \MixCode\Profile
     */
    public function updateWithMedia($data)
    {
        $this->update($data);
        
        $this->syncMedia($data);

       return $this;
    }

    /**
     * attach Media to User
     *
     * @param array $data
     * @return $this
     */
    public function attachMedia($data)
    {
        // Filter Array Data And Return Just Wanted Media Key/Value Pairs
        $media = array_filter(Arr::only($data, $this->attachedMedia));

        // If There is Media
        if (count($media) > 0) {
            foreach ($media as $media_name => $media_value) {
                // Define Media Type Post Key "For More Readability"
                $post_media_type = 'file';
                
                if ($media_name === 'logo') {
                    $post_media_type = 'image';
                }

                // Upload Single Media
                $this->uploadSingleMedia($media_value, $media_name, $post_media_type);
            }
        }

        return $this;
    }

    /**
     * Sync Media of User
     *
     * @param array $data
     * @return $this
     */
    public function syncMedia($data)
    {
        // Filter Array Data And Return Just Wanted Media Key/Value Pairs
        $media = array_filter(Arr::only($data, $this->attachedMedia));

        // If There is Media
        if (count($media) > 0) {
            foreach ($media as $media_name => $media_value) {   
                // Define Media Type Post Key "For More Readability"
                $post_media_type = 'file';
                
                if ($media_name === 'logo') {
                    $post_media_type = 'image';
                }

                // Update Single Media
                $this->updateSingleMedia($media_value, $media_name, $post_media_type);
            }
        }

        return $this;
    }

    /**
     * Get All User Media Link
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function allUserMedia()
    {
        return [
            'logo'                  => $this->userLogoMedia(),
         
        ];
    }
    
    /**
     * Get All User Media Link
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllUserMediaAttribute()
    {
        return $this->allUserMedia();
    }

    /**
     * Get User Media
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function userMedia()
    {
        return [
            'id_card'               => $this->userIdCardMedia(),
            'travel_certificate'    => $this->userTravelCertificateMedia(),
            'tax_card'              => $this->userTaxCardMedia(),
            'business_register'     => $this->userBusinessRegisterMedia(),
        ];
    }

    public function userLogoMedia()
    {
        return $this->safeMediaUrl($this->mainMediaUrl('logo'));
    }

    public function userIdCardMedia()
    {
        return $this->safeMediaUrl($this->mainMediaUrl('id_card', 'file'));
    }

    public function userTravelCertificateMedia()
    {
        return $this->safeMediaUrl($this->mainMediaUrl('travel_certificate', 'file'));
    }

    public function userTaxCardMedia()
    {
        return $this->safeMediaUrl($this->mainMediaUrl('tax_card', 'file'));
    }

    public function userBusinessRegisterMedia()
    {
        return $this->safeMediaUrl($this->mainMediaUrl('business_register', 'file'));
    }
}
