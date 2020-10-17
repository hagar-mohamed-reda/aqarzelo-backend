@php

if (session("locale"))
    App()->setLocale(session("locale"));
else
    App()->setLocale("ar");

@endphp
<!-- css styles  -->
<link rel="stylesheet" href="{{ url('/website') }}/css/post.css">
<style type="text/css">
    .home {
        background-size: 100% 100%;
        background-repeat: no-repeat;
        width: 100%;
        background: #DEDEDE;
        overflow: auto;
    }

    .w3-modal-content {
        background-color: transparent!important;
    }

    .w3-ul .btn {
        padding: 0px!important;
        margin-bottom: 0px!important;
    }

    .register-item {
        margin-bottom: 15px!important;
    }

    .small-height-item {
        border: 0px!important;
    }

    .application-container {
    }

    .small-height-item img {
        width: 10vw!important;
    }

    .spinner-btn {
        background-color: transparent!important;
        padding: 8px 16px!important;
    }

    .spinner-input {
        border-radius: 5em!important;
        width: 70px!important;
        float: none!important;
    }

    .select-item select {
        margin-bottom: 10px!important;
    }

</style>

<!-- html content -->
<div class="home dark-theme-background filter-modal" id="page" v-bind:style="'height: ' + height + 'px'" >
    <div class="application-header" >
        <br>
        <div class="w3-bar w3-padding w3-display-container">
            <a href="#" class="w3-bar-item btn" onclick="back()" >
                <span class="fa fa-angle-{{ session("direction")=='rtl'? 'right' : 'left' }} w3-text-white w3-xlarge" ></span>
            </a>
            <a href="#" class="w3-bar-item btn w3-display-topmiddle"  >
                <span class="w3-text-white w3-xlarge" >{{ __('mobile.filter') }}</span>
            </a>
        </div>
    </div>
    <div class="application-container w3-display-container" v-bind:style="'min-height: ' + (height - 80) + 'px'" >
        <br>
            <ul class="w3-ul filters w3-padding" >
                <li class="select-item" >
                    <select class="w3-round-large w3-light-gray btn btn-default w3-block btn-lg " style="height: 50px;padding-left:25px!important;padding-right:25px!important"  v-model="filter.country_id" style="margin-bottom: 7px" >
                        <option value="null" >{{ __("words.country") }}</option>
                        @foreach(App\Country::all() as $item)
                        <option value="{{ $item->id }}" >{{ session("direction") == 'rtl'? $item->name_ar : $item->name_en }}</option>
                        @endforeach
                    </select>
                    <select class="w3-round-large w3-light-gray btn btn-default w3-block btn-lg " style="height: 50px;padding-left:25px!important;padding-right:25px!important"  v-model="filter.city_id" style="margin-bottom: 7px" >
                        <option value="null" >{{ __("words.city") }}</option>
                        @foreach(App\City::all() as $city)
                        <option value="{{ $city->id }}" v-if="filter.country_id == '{{ $city->country_id }}'" >{{ session("direction") == 'rtl'? $city->name_ar : $city->name_en }}</option>
                        @endforeach
                    </select>
                    <select class="w3-round-large w3-light-gray btn btn-default w3-block btn-lg " style="height: 50px;padding-left:25px!important;padding-right:25px!important" v-model="filter.area_id" style="margin-bottom: 7px" >
                        <option value="null" >{{ __("words.area") }}</option>
                        @foreach(App\Area::all() as $area)
                        <option value="{{ $area->id }}" v-if="filter.city_id == '{{ $area->city_id }}'" >{{ session("direction") == 'rtl'? $area->name_ar : $area->name_en }}</option>
                        @endforeach
                    </select>
                    <select class="w3-round-large w3-light-gray btn btn-default w3-block btn-lg " style="height: 50px;padding-left:25px!important;padding-right:25px!important" v-model="filter.category_id" style="margin-bottom: 7px" >
                        <option value="null" >{{ __("words.category") }}</option>
                        @foreach(App\Category::all() as $category)
                        <option value="{{ $category->id }}" >{{ session("direction") == 'rtl'? $category->name_ar : $category->name_en }}</option>
                        @endforeach
                    </select>
                </li>
                <br>
                <li class="w3-row" >
                    <label class="w3-text-gray w3-col l6 m6 s6 w3-large" >
                        <b>{{ __("words.bedroom_number") }}</b>
                    </label>
                    <div class="w3-col l6 m6 s6 w3-display-container" >

                        <center class="input-group number-bedroom-spinner w3-light-gray  w3-round-xxlarge w3-display-topright" style="width: 150px!important;direction: ltr!important" >
                            <span class="btn input-group-btn spinner-padding" style="padding: 8px 16px!important;"  >
                                <button class="w3-padding btn  w3-text-gray btn-number-spinner-left w3-circle btn-lg w3-large spinner-btn" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input type="text" class="form-control text-center spinner-input input-lg w3-text-gray" v-model="filter.bedroom_number" value="1">
                            <span class="btn input-group-btn spinner-padding" style="padding: 8px 16px!important;" >
                                <button class="w3-padding btn w3-text-gray btn-number-spinner-right w3-circle btn-lg w3-large spinner-btn" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                            </span>
                        </center>

                    </div>
                </li>
                <li class="w3-row" >
                    <label class="w3-text-gray w3-col l6 m6 s6 w3-large" >
                        <b>{{ __("words.bathroom_number") }}</b>
                    </label>
                    <div class="w3-col l6 m6 s6 w3-display-container">
                        <center class="input-group number-bathroom-spinner w3-light-gray  w3-round-xxlarge w3-display-topright" style="width: 150px!important;direction: ltr!important" >
                            <span class="btn input-group-btn spinner-padding" style="padding: 8px 16px!important;"  >
                                <button class="w3-padding btn  w3-text-gray btn-number-spinner-left w3-circle btn-lg w3-large spinner-btn" data-dir="dwn"><span class="glyphicon glyphicon-minus"></span></button>
                            </span>
                            <input type="text" class="form-control text-center spinner-input input-lg w3-text-gray" v-model="filter.bathroom_number" value="1">
                            <span class="btn input-group-btn spinner-padding" style="padding: 8px 16px!important;" >
                                <button class="w3-padding btn w3-text-gray btn-number-spinner-right w3-circle btn-lg w3-large spinner-btn" data-dir="up"><span class="glyphicon glyphicon-plus"></span></button>
                            </span>
                        </center>
                    </div>
                </li>
                <li>
                    <label class="w3-text-gray w3-col l6 m6 s6 w3-large" >
                        <b>{{ __("words.price") }}</b>
                    </label>
                    <br>
                    <br>
                    <div>
                        <input class="ranger price-range w3-block" type="text" v-on:change="price(this.value)" class="span2" value="" data-slider-min="1000" data-slider-max="1000000" data-slider-step="1000" data-slider-value="[1000,1000000]"/>
                    </div>
                    <div class="w3-display-container" >
                        <b  class="w3-left w3-tiny text-gray" >1000</b>
                        <b class="w3-right w3-tiny text-gray" >1000000</b>
                    </div>
                    <br>
                </li>
                <li>
                    <label class="w3-text-gray w3-col l6 m6 s6 w3-large" >
                        <b>{{ __("words.space") }}</b>
                    </label>
                    <br>
                    <br>
                    <div>
                        <input class="ranger space-range w3-block" type="text" v-on:change="space(this.value)" class="span2" value="" data-slider-min="100" data-slider-max="100000" data-slider-step="10" data-slider-value="[100,100000]"/>
                    </div>
                    <div class="w3-display-container" >
                        <b  class="w3-left w3-tiny text-gray" >100</b>
                        <b class="w3-right w3-tiny text-gray" >100000</b>
                    </div>
                    <br>
                </li>
                <li class="w3-row" >
                    <br>
                    <center>
                        <button
                            onclick="search()"
                            style="padding: 8px 16px!important;"
                            class="w3-padding text-capitalize btn light-theme-background w3-block w3-large w3-text-white w3-round-xlarge shadow current-location-btn" >
                            {{ __('mobile.show') }}
                        </button>
                    </center>
                </li>
            </ul
        </div>
    </div>




</div>




<script>
    var ranger1 = null;
    var ranger2 = null;

    function setFilterSpinnerOptions() {
        // preparse number spinner for bedroom_number
        $(document).on('click', '.filter-modal .number-bedroom-spinner button', function () {
            var btn = $(this),
                    oldValue = btn.closest('.filter-modal .number-bedroom-spinner').find('input').val().trim(),
                    newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                page.filter.bedroom_number = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    page.filter.bedroom_number = parseInt(oldValue) - 1;
                } else {
                    page.filter.bedroom_number = 1;
                }
            }
            btn.closest('.filter-modal .number-bedroom-spinner').find('input').val(page.filter.bedroom_number);
        });
        $(document).on('click', '.filter-modal .number-bathroom-spinner button', function () {
            var btn = $(this),
                    oldValue = btn.closest('.filter-modal .number-bathroom-spinner').find('input').val().trim(),
                    newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                page.filter.bathroom_number = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    page.filter.bathroom_number = parseInt(oldValue) - 1;
                } else {
                    page.filter.bathroom_number = 1;
                }
            }
            btn.closest('.filter-modal .number-bedroom-spinner').find('input').val(page.filter.bathroom_number);
        });
    }

    function setFilterRangesOptions() {
        ranger1 = $($(".ranger")[0]).slider({})
                .on("slide", changePriceSlideValues)
                .data('slider');
        ranger2 = $($(".ranger")[1]).slider({})
                .on("slide", changeSpaceSlideValues)
                .data('slider');
    }

    var changePriceSlideValues = function () {
        var prices = $(".price-range").val().split(",");

        page.filter.price1 = prices[0];
        page.filter.price2 = prices[1];

    }

    var changeSpaceSlideValues = function () {
        var spaces = $(".space-range").val().split(",");

        page.filter.space1 = spaces[0];
        page.filter.space2 = spaces[1];
    }

    function search() {
        var data = $.param(page.filter);
        loadPage('phone/home?'+data);
    }

    var page = new Vue({
        el: '#page',
        data: {
            api_token: window.localStorage.getItem("api_token"),
            filter: {
                bedroom_number: 0,
                bathroom_number: 0,
                city_id: null,
                area_id: null,
                category_id: null,
            },
        },
        methods: {
        },
        computed: {
            height: function () {
                return window.innerHeight;
            }
        }
    });

    $(document).ready(function () {

        // set spinner of bedroom and bathroom
        setFilterSpinnerOptions();

        // set range of price and space
        setFilterRangesOptions();

    });
</script>
