<!-- css styles  -->
<style type="text/css">
    .splash { 
        background-size: 100% 100%; 
        background-repeat: no-repeat;
        width: 100%;
        background-color: #02A2A7;
    }

    .w3-modal-content {
        background-color: transparent!important;
    }

    .logo-container {
        top: 50vw;
        width: 100%;
    }
</style>

<!-- html content -->
<div 
class="splash" 
id="page" 
v-bind:style="'height: ' + height + 'px'"
style="background-image: url('{{ url('/mobile/images/background2.png') }}')!important"
    >
    <div class="w3-modal-content"  >
        <div class="logo-container w3-display-topmiddle text-center" >
            <img class="logo animated bounceInDown" src="{{ url('/mobile/images/logo.png') }}" width="100px" >
            <br>
            <br>
            <br>
            <div class="w3-xxlarge w3-text-white" ><b>AQAR ZELO</b></div>
        </div>
    </div>
 
</div>


<!-- javascript -->
<script>
    setTimeout(function(){
        $(".logo").addClass("flip");
    }, 1500);
    
    setTimeout(function(){
        loadPage('phone/choose-location');
    }, 4000);

    var page = new Vue({
            el: '#page',
            data: {
                content: '',
                h: 100
            },
            methods: {

            },
            computed: {
                height: function(){
                    return window.innerHeight;
                }
            }
    });
 

</script>