<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Post extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active', 'title', 'description', 'user_id', 'category_id', 'type', 'address', 'phone',
        'lng', 'lat', 'ownar_type', 'phone', 'space', 'price_per_meter', 'payment_method',
        'bedroom_number', 'bathroom_number', 'floor_number', 'finishing_type', 'refused_reason',
        'real_estate_number', 'build_date', 'active', 'has_garden', 'has_parking', 'status', 'city_id',
        'area_id', 'price', 'furnished', 'title_ar', 'country_id', 'is_admin', 'show_recommended', 'recommended_sort'
    ];

    /**
     * The attributes that are appended to object after loaded from db.
     *
     * @var array
     */
    protected $appends = [
        'category', 'images', 'city','country',
        'area', 'rate', 'views',
        'rates', 'chart_data', 'contact_phone',
        'user_review', 'favourite', 'show_logo', 'logo_url'
    ];

    public function getShowLogoAttribute() {
        $plan = optional(optional($this->user)->company)->plan;

        if (optional($plan)->show_logo == 1)
            return 1;

        return 0;
    }

    public function getLogoUrlAttribute() {
        $plan = optional(optional($this->user)->company)->plan;

        if (optional($plan)->show_logo == 1)
            return optional(optional($this->user)->company)->photo_url;
        return null;
    }



    /**
     * return category object
     *
     * @return Category
     */
    public function getFavouriteAttribute() {
        return '';
        /*
        $request = new Request();
        $user = User::auth($request);

        return $user;
        if ($user) {
            if (Favourite::where("user_id", $user->id)->where("post_id", $this->id)->count() > 0) {
                return true;
            }
        }
        return false;*/
    }

    /**
     * return category object
     *
     * @return Category
     */
    public function getUserReviewAttribute() {
        return $this->reviews()->get();
    }

    /**
     * return category object
     *
     * @return Category
     */
    public function getContactPhoneAttribute() {
        $request = new Request();
        $user = User::auth($request);

        try {
            if ($user)
                return $this->user->company->phone;
            else
                return substr($this->user->company->phone, 0, 4) . "xxxxxxx";
        } catch (\Exception $exc) {
            return "xxxxxxxxxxx";
        }
    }

    /**
     * return chart data
     *
     * @return Array
     */
    public function getChartDataAttribute() {
        $xData = [];
        $yData = [];
        $data = [];

        $city = $this->city_id;

        $dates = Post::where("city_id", $city)->latest()->distinct()->pluck("created_at");
        foreach ($dates as $date) {
            $date = date("Y-m-d", strtotime($date));

            if (!isset($data[$date])) {
                $data[$date] = $date;
                $xData[] = $date;
                $yData[] = Post::where("city_id", $city)->whereDate("created_at", $date)->avg("price_per_meter");
            }
        }

        return [
            "x" => $xData,
            "y" => $yData
        ];
    }

    /**
     * return category object
     *
     * @return Category
     */
    public function getCategoryAttribute() {
        return $this->category()->first();
    }

    /**
     * return category object
     *
     * @return Array Image
     */
    public function getImagesAttribute() {
        $image = new Image();
        $image->photo = 'default-image.jpg';

        $images = $this->images()->orderBy('updated_at')->get();

        if (count($images) > 0) {
            $firstImage = $images[0];
            if (!file_exists(public_path('images/posts/' . $firstImage->photo))) {
                $images[0]->photo = 'default-image.jpg';
            }
            return $images;
        }
        else
            return [$image];
    }

    /**
     * return city object
     *
     * @return City
     */
    public function getCityAttribute() {
        return $this->city()->first();
    }
    public function getCountryAttribute() {
        return $this->country()->first();
    }

    /**
     * return area object
     *
     * @return Area
     */
    public function getAreaAttribute() {
        return $this->area()->first();
    }

    /**
     * return rate of the post from user reviews
     * rate = average of the rate
     *
     * @return integer
     */
    public function getRateAttribute() {
        return (int) $this->reviews()->avg("rate");
    }

    /**
     * return rates of the post
     *
     * @return integer
     */
    public function getRatesAttribute() {
        return $this->reviews()->count();
    }

    /**
     * return views of the post
     *
     * @return integer
     */
    public function getViewsAttribute() {
        return $this->views()->count();
    }

    /**
     * add view for post
     *
     * @param String $token [ip or mac address]
     */
    public function addView($token) {
        if (PostView::where('post_id', $this->id)->where('ip', $token)->count() == 0) {
            PostView::create([
                "post_id" => $this->id,
                "ip" => $token
            ]);
        }
    }

    public function category() {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function country() {
        return $this->belongsTo('App\Country', 'country_id');
    }
    public function city() {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function area() {
        return $this->belongsTo('App\Area', 'area_id');
    }

    public function images() {
        return $this->hasMany('App\Image', 'post_id');
    }

    public function reviews() {
        return $this->hasMany('App\PostReview');
    }

    public function views() {
        return $this->hasMany('App\PostView');
    }

}
