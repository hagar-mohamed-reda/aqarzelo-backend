<!-- css styles  -->
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

        .application-container{
            background-color: #fdfdfd;
            overflow: hidden;

        }
 
        .step {
            display: none
        }

        .step-1 {
            background-size: 100%;
            background-position: top; 
            background-image: url({{ url('/mobile/images/create_post.png')  }});
            background-repeat: no-repeat;
            display: block;
            padding-top: 30%;
        }

        .step-1-img {
            padding-bottom: 30%;
        }
        
        .next-btn {
            background-color: transparent!important;
            border: 2px solid #02A2A7!important;
        }

        /**
            time line
        */


/*===== Vertical Timeline =====*/
#conference-timeline {
  position: relative;
  max-width: 920px;
  width: 100%;
  margin: 0 auto;
}
#conference-timeline .timeline-start,
#conference-timeline .timeline-end {
  display: table;
  font-family: "Roboto", sans-serif;
  font-size: 18px;
  font-weight: 900;
  text-transform: uppercase;
  background: #00b0bd;
  padding: 15px 23px;
  color: #fff;
  max-width: 5%;
  width: 100%;
  text-align: center;
  margin: 0 auto;
}
#conference-timeline .conference-center-line {
  position: absolute;
  width: 3px;
  height: 80%;
  top: 87px;
  left: 50%;
  margin-left: -2px;
  background: #00b0bd;
  z-index: 1;
}
#conference-timeline .conference-timeline-content {
  padding-top: 67px;
  padding-bottom: 67px;
}
.timeline-article {
  width: 100%;
  height: 100%;
  position: relative;
  overflow: hidden;
  /*margin: 20px 0;*/
}
.timeline-article .content-left-container,
.timeline-article .content-right-container {
  max-width: 44%;
  width: 100%;
}
.timeline-article .timeline-author {
  display: block;
  font-weight: 400;
  font-size: 14px;
  line-height: 24px;
  color: #242424;
  text-align: right;
}
.timeline-article .content-left,
.timeline-article .content-right {
  position: relative;
  width: auto; 
  box-shadow: 0 1px 3px rgba(0,0,0,.03);
  padding: 27px 25px;
}
.timeline-article p {
  margin: 0 0 0 60px;
  padding: 0;
  font-weight: 400;
  color: #242424;
  font-size: 14px;
  line-height: 24px;
  position: relative;
}
.timeline-article p span.article-number {
  position: absolute;
  font-weight: 300;
  font-size: 44px;
  top: 10px;
  left: -60px;
  color: #00b0bd;
}
.timeline-article .content-left-container {
  float: left;
}
.timeline-article .content-right-container {
  float: right;
}
.timeline-article .content-left:before,
.timeline-article .content-right:before{
  position: absolute;
  top: 20px;
  font-size: 23px;
  font-family: "FontAwesome";
  color: #fff;
}
.timeline-article .content-left:before {
  content: "\f0da";
  right: -8px;
}
.timeline-article .content-right:before {
  content: "\f0d9";
  left: -8px;
}
.timeline-article .meta-date {
  position: absolute;
  top: 0;
  left: 50%;
  width: 62px;
  height: 62px;
  margin-left: -31px;
  color: #fff;
  border-radius: 100%;
  background: white;
  z-index: 2;
  border: 1px solid #02A2A7;
}
.timeline-article .meta-date .date,
.timeline-article .meta-date .month {
  display: block;
  text-align: center;
  font-weight: 900;
}
.timeline-article .meta-date .date {
  font-size: 30px;
  line-height: 40px;
}
.timeline-article .meta-date .month {
  font-size: 18px;
  line-height: 10px;
}
/*===== // Vertical Timeline =====*/

/*===== Resonsive Vertical Timeline =====*/
@media only screen and (max-width: 830px) {
  #conference-timeline .timeline-start,
  #conference-timeline .timeline-end {
    margin: 0;
  }
  #conference-timeline .conference-center-line {
    margin-left: 0;
    left: 50px;
  }
  .timeline-article .meta-date {
    margin-left: 0;
    left: 20px;
  }
  .timeline-article .content-left-container,
  .timeline-article .content-right-container {
    max-width: 100%;
    width: auto;
    float: none;
    margin-left: 70px;
    min-height: 53px;
  }
  .timeline-article .content-left-container {
    margin-bottom: 20px;
  }
  .timeline-article .content-left,
  .timeline-article .content-right {
    padding: 10px 25px;
    min-height: 65px;
  }
  .timeline-article .content-left:before {
    content: "\f0d9";
    right: auto;
    left: -8px;
  }
  .timeline-article .content-right:before {
    display: none;
  }
}
@media only screen and (max-width: 400px) {
  .timeline-article p {
    margin: 0;
  }
  .timeline-article p span.article-number {
    display: none;
  }
  
}

.post-timeline-content {
    display: none;
}
/*===== // Resonsive Vertical Timeline =====*/
    
    .spinner-btn {
        background-color: transparent!important;
        padding: 8px 16px!important;
    }
    
    .spinner-input {
        border-radius: 5em!important;
        width: 70px!important;
        float: none!important;
    } 
    
    </style>
    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #06D9B2!important;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<style type="text/css">

    .map {  
        width: 100%;
        display: none;
        z-index: 99;
        position: fixed;
        left: 0;
        top: 0;

    }

        .post-button-container {
            bottom: 5%;
        }

        .post-current-location-btn {
            width: 60px;
            height: 60px;
            border-radius: 10em;
        }
        
        .breadcrumb {
            height: 60px;
            padding-top: 20px;
            z-index: 10;
            border-radius: 0px!important;
        }
        .invert {
          filter: brightness(200%);
        }

        .meta-date img {
          padding-top: 4px!important;
        }
        .top-step-bar button {
          height: 50px!important;
          border-top-left-radius: 0px!important;
          border-bottom-left-radius: 0px!important;
          width: 32.3333%!important;
          background-color: #06D9B2!important;
          box-shadow: 2px -1px 3px 0px rgba(0,0,0,.5)!important;
        }
</style>