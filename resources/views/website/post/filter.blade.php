<div class="transparent w3-modal show w3-display-container" style="z-index: 3;padding-top: 0px!important;overflow: hidden"  >

    <div class="w3-display-topright w3-padding transparent" id="filterSidebar" style="z-index: 3;" >
        <br>
        <br>
        <br>
        <br>
        <div class="w3-display-topleft w3-padding" style="z-index: 2;top: 150px;left: -63.7px;" onclick="toggleFilterSidebar()"  >
            <button
                class="w3-white shadow btn btn-flat animated delay-2s zoomIn "
                style="border-radius: 0px!important;transform: rotate(-90deg);width: 80px;height: 45px;"
                id="filterToggleSidebarBtn" ><i class="fa fa-angle-right" style="display: inline-block;font-size:20px !important;">  </i>
                </button>

                <div class="hidden filterToggleSidebarBtnText" >
                    <span
                        class="fa fa-filter light-theme-color"
                        style="transform: rotate(90deg);padding: 5px;font-size: 20px" >
                        <!--{{ __("words.search_about_what_you_need") }} --->
                    </span>
                </div>
        </div>
        <div class="filter-sidebar-content w3-card w3-round w3-white w3-padding nicescroll animated fadeInRight delay-1s w3-display-container" style="width: 380px;" >


            <ul class="w3-ul filters" >
                <li>
                <center class="w3-large light-theme-color text-capitalize" >
                    <b class="w3-xxlarge" >{{ __("words.filter") }}</b>
                    <br>
                    <b>{{ __("words.search_about_what_you_need") }}</b>
                </center>
                <br>
                </li>
                <li>
                    <select class="form-control w3-round select2-filter countryFilter" v-model="filter.country_id" style="margin-bottom: 7px;padding: 0px 12px;" >
                        <option value="null" selected disabled>{{ __("words.country") }}</option>
                        @foreach(DB::select('select * from countries where id in(select distinct(country_id) from posts) ORDER BY countries.name_en ASC') as $item)
                        <option value="{{ $item->id }}" >{{ session("locale")=="en"? $item->name_en : $item->name_ar }}</option>
                        @endforeach
                    </select>
                    <select class="form-control w3-round select2-filter cityFilter" v-model="filter.city_id" style="margin-bottom: 7px;padding: 0px 12px;" >
                        <option value="null" disabled>{{ __("words.city") }}</option>
                        @foreach(DB::select('select * from cities where id in(select distinct(city_id) from posts) ORDER BY cities.name_en ASC') as $city)
                        <option value="{{ $city->id }}" v-if="filter.country_id=='{{ $city->country_id }}'"  >{{ session("locale")=="en"? $city->name_en : $city->name_ar }}</option>
                        @endforeach
                    </select>
                    <select class="form-control w3-round select2-filter areaFilter" v-model="filter.area_id"  style="margin-bottom: 7px;padding: 0px 12px;"  >
                        <option value="null" disabled>{{ __("words.area") }}</option>
                        @foreach(DB::select('select * from areas where id in(select distinct(area_id) from posts) ORDER BY areas.name_en ASC') as $area)
                        <option value="{{ $area->id }}" v-if="filter.city_id=='{{ $area->city_id }}'" >{{ session("locale")=="en"? $area->name_en : $area->name_ar }}</option>
                        @endforeach
                    </select>
                    <select id='orderCategory' class="form-control w3-round select2-filter categoryFilter" v-model="filter.category_id" style="margin-bottom: 7px;padding: 0px 12px;" >
                        @foreach(App\Category::all() as $category)
                        <option value="{{ $category->id }}" >{{ session("locale")=="en"? $category->name_en : $category->name_ar }}</option>
                        @endforeach
                    </select>
                    <select class="form-control w3-round select2-filter saleFilter" v-model="filter.type" style="margin-bottom: 7px;padding: 0px 12px;" >
                        <option value="null" disabled>{{ __("words.sale_&_rent") }}</option>
                        <option value="sale" >{{ __('sale') }}</option>
                        <option value="rent" >{{ __('rent') }}</option>
                        <option value="sale or rent" >{{ __('words.sell_or_rent') }}</option>
                    </select>
                </li>
                <li>
                    <label class="w3-text-gray" >{{ __("words.price") }}</label>
                    <br>
                    <div>
                        <input class="ranger price-range w3-block" type="text" v-on:change="price(this.value)" class="span2" value="" data-slider-min="1000" data-slider-max="100000000" data-slider-step="1000" data-slider-value="[1000,100000000]"/>
                    </div>
                    <div class="w3-display-container" >
                        <b  class="w3-left w3-tiny text-gray" >1000</b>
                        <b class="w3-right w3-tiny text-gray" >100000000</b>
                    </div>
                    <br>
                </li>
                <li>
                    <label class="w3-text-gray" >{{ __("words.space") }}</label>
                    <br>
                    <div>
                        <input class="ranger space-range w3-block" type="text" v-on:change="space(this.value)" class="span2" value="" data-slider-min="30" data-slider-max="10000" data-slider-step="10" data-slider-value="[30,10000]"/>
                    </div>
                    <div class="w3-display-container" >
                        <b  class="w3-left w3-tiny text-gray" >30</b>
                        <b class="w3-right w3-tiny text-gray" >10000</b>
                    </div>
                    <br>
                </li>
                <li class="w3-row" >
                    <label class="w3-text-gray w3-col l6 m6 s6" >{{ __("words.bedroom_number") }}</label>
                    <div class="w3-col l6 m6 s6 w3-display-container" >
                        <div class="input-group number-bedroom-spinner  w3-round-xxlarge w3-display-topright" style="width: 150px!important;direction: ltr!important" >
                            <span class="input-group-btn">
                                <button class="btn btn-default light-theme-background w3-text-white btn-number-spinner-left w3-round-xlarge" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input type="text" class="form-control text-center spinner-input" v-model="filter.bedroom_number" value="1">
                            <span class="input-group-btn">
                                <button class="btn btn-default light-theme-background w3-text-white btn-number-spinner-right" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                            </span>
                        </div>
                    </div>
                </li>
                <li class="w3-row" >
                    <label class="w3-text-gray w3-col l6 m6 s6" >{{ __("words.bathroom_number") }}</label>
                    <div class="w3-col l6 m6 s6 w3-display-container" >
                        <div class="input-group number-bathroom-spinner  w3-round-xxlarge w3-display-topright" style="width: 150px!important;direction: ltr!important" >
                            <span class="input-group-btn">
                                <button class="btn btn-default light-theme-background w3-text-white btn-number-spinner-left w3-round-xlarge" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input type="text" class="form-control text-center spinner-input" v-model="filter.bathroom_number" value="1">
                            <span class="input-group-btn">
                                <button class="btn btn-default light-theme-background w3-text-white btn-number-spinner-right" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                            </span>
                        </div>
                    </div>
                </li>
                <li class="w3-row" >
                <center>
                    <button
                        class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp"
                        style="width: 45%;background-image: linear-gradient(to right, #02A2A7 , #06D9B2);color:white"
                        onclick="search()" >{{ __("words.submit") }}</button>
                    <button onclick="reset()" class="w3-btn w3-padding w3-round-xxlarge w3-large  animated fadeInUp btn-default w3-light-gray" style="width: 45%"   >{{ __("words.clear") }}</button>
                </center>
                </li>
            </ul
        </div>


        @include("website.post.result")
    </div>



</div>

<div class="search-location-btn"  >
    <span class="fa fa-map-marker btn w3-white shadow btn-flat light-theme-background w3-text-white" style="float: left;padding: 12px;font-size: 26px!important;" data-toggle="tooltip" data-placement="right" title="{{ __('words.search_with_your_location') }}" ></span>
</div>
