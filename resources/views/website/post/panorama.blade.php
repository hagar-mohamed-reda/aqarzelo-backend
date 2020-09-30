<!DOCTYPE html>
<!-- saved from url=(0062)https://pchen66.github.io/Panolens/examples/panorama_cube.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width, shrink-to-fit=no">
        <title>Panolens.js panorama cube</title>
        <style>
            html, body {
                margin: 0;
                width: 100%;
                height: 100%;
                overflow: hidden;
                background-color: #000;
            }

            a:link, a:visited{
                color: #bdc3c7;
            }

            .credit{
                position: absolute;
                text-align: center;
                width: 100%;
                padding: 20px 0;
                color: #fff;
            }
            /*
            #vrview {
                width: 100%;
                height: 100%;
                position: fixed;
                left: 0px;
                right: 0px;
            } */
            
            
        </style>
        <script src="{{ url('/website') }}/js/jquery-3.2.1.min.js"></script>
    </head>

    <body>
         
        <div id='vrview'></div>

   
        <script src="https://pchen66.github.io/js/three/three.min.js"></script>
        <script src="{{ url('/website') }}/js/panolens.min.js"></script>
        
     <!--    
    
        <script src="https://storage.googleapis.com/vrview/2.0/build/vrview.min.js"></script>
-->
          <!--
        <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
        <script src="http://blog.n42designs.com/pano/jquery.pano.js"></script>
        -->
        

        <script>
            var images = '{{ $_GET["image"] }}';
            /*
            $(document).ready(function(){
            	var pano = $("#myPanoViewer").pano({
            		img: images,
            		interval: 100,
            		speed: 50
            	});
             
            	pano.moveLeft();
            	pano.stopMoving();
            	pano.moveRight();
            	pano.stopMoving(); 
            	
            });*/
            
            

              const panorama = new PANOLENS.ImagePanorama( images );
              const viewer = new PANOLENS.Viewer( { output: 'console' } );
              viewer.add( panorama );

    
            
         
            //var images = 
/*
                    let
            panorama, panorama2, viewer;
                    const path = 'asset/textures/cube/sand/';
                    const format = '.png';
                    panorama = new PANOLENS.CubePanorama([
                        path + 'px' + format, path + 'nx' + format,
                        path + 'py' + format, path + 'ny' + format,
                        path + 'pz' + format, path + 'nz' + format
                    ]);

            //var panorama3 = new PANOLENS.ImagePanorama('http://localhost/zello/public/website/image/360/4.jpg');
            panorama2 = new PANOLENS.ImagePanorama(images);

            panorama.link(panorama2, new THREE.Vector3(-807.50, 604.88, -5000.00));
            panorama2.link(panorama, new THREE.Vector3(-807.50, 604.88, -5000.00));

            viewer = new PANOLENS.Viewer();
            viewer.add(panorama2); */
            
            /*
            window.addEventListener('load', onVrViewLoad);

            function onVrViewLoad() {
              // Selector '#vrview' finds element with id 'vrview'.
              var vrView = new VRView.Player('#vrview', {
                //preview: images,
                image: images,
                width: "100%",
                height: "100%" 
              });
              
              vrView.setContentInfo({
                  image: images,
                  preview:images,
                  is_stereo: true
                }); 
            }
            */
            

        </script>

    </body></html>