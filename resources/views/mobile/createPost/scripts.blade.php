


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@include("mobile.createPost.getLocationScripts")
    <script>

    function setPostSpinner() {
        // preparse number spinner for bedroom_number
        $(document).on('click', '.create-post-modal .number-bedroom-spinner button', function () {
            var btn = $(this),
                    oldValue1 = parseInt($('.create-post-modal .number-bedroom-spinner').find('input').val().trim()),
                    newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                page.post.bedroom_number = parseInt(oldValue1) + 1;
            } else {
                if (oldValue1 > 1) {
                    page.post.bedroom_number = parseInt(oldValue1) - 1;
                } else {
                    page.post.bedroom_number = 1;
                }
            }
            $('.create-post-modal .number-bedroom-spinner').find('input').val(page.post.bedroom_number);
        });
        $(document).on('click', '.create-post-modal .number-bathroom-spinner button', function () {
            var btn = $(this),
                    oldValue = $('.create-post-modal .number-bathroom-spinner').find('input').val().trim(),
                    newVal = 0;

            if (btn.attr('data-dir') == 'up') {
                page.post.bathroom_number = parseInt(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    page.post.bathroom_number = parseInt(oldValue) - 1;
                } else {
                    page.post.bathroom_number = 1;
                }
            }
            btn.closest('.create-post-modal .number-bedroom-spinner').find('input').val(page.post.bathroom_number);
        });
    }

        function validateStep3() {
            if (
                !page.post.title ||
                !page.post.title_ar ||
                !page.post.category_id ||
                !page.post.type ||
                !page.post.space ||
                !page.post.bedroom_number ||
                !page.post.bathroom_number ||
                !page.post.price_per_meter ||
                !page.post.price
                )
            {
                errorToast("{{ __('mobile.fill_all_required_data') }}");
                return false;
            }

            return true;
        }

        function validateStep4() {
            if (
                !page.post.lng ||
                !page.post.lat ||
                !page.post.country_id ||
                !page.post.city_id ||
                !page.post.area_id
                )
            {
                errorToast("{{ __('mobile.fill_all_required_data') }}");
                return false;
            }

            return true;
        }

        function validateStep5() {
            if (
                !page.post.description ||
                !page.post.owner_type ||
                !page.post.payment_method ||
                !page.post.finishing_type
                )
            {
                errorToast("{{ __('mobile.fill_all_required_data') }}");
                return false;
            }

            return true;
        }

        function goto(step) {
            if (step == 2) {
            }

            if (step == 4) {
                if (!validateStep3())
                    return;
            }
            if (step == 5) {
                if (!validateStep4())
                    return;
            }

            $('.step').hide();
            $('.step-'+step).show();
            page.step = step;
        }

        function sendPost() {
            if (!validateStep5())
                return;
            Swal.fire({
              title: '{{ __("mobile.warning") }}?',
              text: "{{ __('mobile.are_you_sure_to_create_post') }} ?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: '{{ __("mobile.ok") }}',
              cancelButtonText: '{{ __("mobile.cancel") }}',
            }).then((result) => {
              if (result.value) {
                savePost();
              }
            })
        }

        var images = [];

        function getPostParams() {
            var fitlerImages = page.post.images.filter(function(value, index, arr){
                return value;
            });
            var post = page.post;
            post.images = null;
            var string = $.param(post);
            page.post.images = fitlerImages;

            return string;
        }

        function savePost() {
            if (!app.api_token)
                return error('{{ __("words.login_first") }}');

            images = page.post.images.filter(function(value, index, arr){
                return value;
            });

            // show loading
            $(".post-loader").show();

            var data = "";

            data += "api_token=" + app.api_token + "&" + getPostParams();

            // reverse array
            images.reverse();

            page.uploadedImageCount = 0;

            // save post info
            $.post(public_path + "/api/post/add", data, function(response){
                if (response.status == 1) {
                    if (LANG == "en")
                        successToast(response.message_en);
                    if (LANG == "ar")
                        successToast(response.message_ar);

                    //
                    for(var i = 0; i < page.post.images.length; i ++) {
                        images[i].post_id =  response.data.id;
                        page.post.images[i].post_id =  response.data.id;
                    }

                    savePostImages(images);

                } else {
                    if (LANG == "en")
                        errorToast(response.message_en);
                    if (LANG == "ar")
                        errorToast(response.message_ar);

                    // show loading
                    $(".post-loader").show();
                }

            });
        }

        function savePostImages(imgs) {
            if (imgs.length <= 0)
                return finish();

            var image = imgs.pop();
            var formData = new FormData();
            if (image.id)
                formData.append("id", image.id);
            if (image.file)
                formData.append("photo", image.file);
            formData.append("is_360", image.is_360);
            formData.append("api_token", app.api_token);
            formData.append("post_id", image.post_id);

            $.ajax({
                url: public_path + "/api/post/add-image",
                type: 'POST',
                data: formData,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function (data) {
        //            if (response.status == 1) {
        //                if (LANG == "en")
        //                    success(response.message_en)
        //                if (LANG == "ar")
        //                    success(response.message_ar)
        //            } else {
        //                if (LANG == "en")
        //                    error(response.message_en)
        //                if (LANG == "ar")
        //                    error(response.message_ar)
        //            }
                    page.uploadedImageCount += 1;
                    savePostImages(imgs)
                }
            });
        }

        function finish() {
            $(".post-loader").hide();
            loadPage('phone/profile');
        }


        function uploadMaster(input) {

            if (!app.api_token) {
                    Swal.fire({
                      title: '{{ __("mobile.warning") }}?',
                      text: "{{ __('mobile.login_first') }} ?",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: '{{ __("mobile.ok") }}',
                      cancelButtonText: '{{ __("mobile.cancel") }}',
                    }).then((result) => {
                      if (result.value) {
                        loadPage('phone/login');
                      }
                    });

                return false;
            }

            var file = input.files[0];
            //console.log(input.files[0]);
            page.post.images[0] = {
                file: file,
                path: URL.createObjectURL(file)
            };
            page.images = page.post.images;

            goto(2);
        }

        function uploadImage(input) {
            var file = input.files[0];
            //console.log(input.files[0]);
            var image = {
                file: file,
                path: URL.createObjectURL(file)
            };
            page.post.images.push(image);
            page.images = page.post.images;
        }

        function upload360Image(input) {
            var file = input.files[0];
            //console.log(input.files[0]);
            var image = {
                file: file,
                is_360: true,
                path: URL.createObjectURL(file)
            };
            page.post.images.push(image);
            page.images = page.post.images;
        }

        var page = new Vue({
            el: '#page',
            data: {
                step: 1,
                uploadedImageCount: 1,
                post: {
                    title: null,
                    title_ar: null,
                    lat: null,
                    lng: null,
                    category_id: null,
                    country_id: null,
                    owner_type: null,
                    payment_method: null,
                    finishing_type: null,
                    type: null,
                    bedroom_number: 0,
                    bathroom_number: 0,
                    images: []
                },
                images: [],
                api_token: window.localStorage.getItem("api_token"),
                name: window.localStorage.getItem("name"),
                photo: window.localStorage.getItem("photo")
            },
            methods: {
            },
            computed: {
                height: function () {
                    return window.innerHeight;
                }
            },
            watched: {

            }
        });

        $(document).ready(function(){

            $('.create-post-bottom-nav-item').addClass("light-theme-color");
            setPostSpinner();
        });
    </script>
