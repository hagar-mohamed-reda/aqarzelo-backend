<div class="infobox" style="display: none;max-width: 150px" > 
    <div  style="width: 210px;cursor: pointer;" onclick="loadPost('{post}')" > 
        <img src="{src}" class="w3-block details" style='display: none' >
        <div class="media-body details" style='display: none'>
            <h4 class="media-heading">{title}</h4>
            {description}
            <br>
        </div>
    </div>
    <center class="w3-padding" >
        <b onclick="$(this).parent().parent().find('.details').toggle(300)" >{price}</b>
    </center>

   
</div>