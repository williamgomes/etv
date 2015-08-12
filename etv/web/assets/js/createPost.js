(function($) {
 
  
	var highestBox = 0;
	$('.add_relate .images').each(function(){  
			if($(this).height() > highestBox){  
			highestBox = $(this).height();  
	}
	});    
	$('.add_relate .images').height(highestBox);
	var highestBox = 0;
	$('.add_episode .images').each(function(){  
			if($(this).height() > highestBox){  
			highestBox = $(this).height();  
	}
	});    
	$('.add_episode .images').height(highestBox);
	var highestBox = 0;
	$('.add_character .images').each(function(){  
			if($(this).height() > highestBox){  
			highestBox = $(this).height();  
	}
	});    
	$('.add_character .images').height(highestBox);
	var highestBox = 0;
	$('.add_post .images').each(function(){  
			if($(this).height() > highestBox){  
			highestBox = $(this).height();  
	}
	});    
	$('.add_post .images').height(highestBox);
        
        

})(jQuery);

function PreviewImage(elem) {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(elem.files[0]);
        
        oFReader.onload = function (oFREvent) {
            //console.log(oFREvent.target.result);
            $(elem).parent().parent()
                    .css("background", 'url(' +oFREvent.target.result+ ') no-repeat center center ')
                    .css("-webkit-background-size","cover")
                    .css(" -moz-background-size","cover")
                    .css("-o-background-size","cover")
                    .css("background-size","cover");
            //document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
    
$('#showModal').on('shown.bs.modal', function (e) {
    var $activate_selectator4 = $('#form_postShowIds');
			$activate_selectator4.click(function () {
				var $select4 = $('#showList');
                               
				if ($select4.data('selectator') === undefined) {
					$select4.selectator({
						showAllOptionsOnFocus: true
					});
					
				} 
			});
			$activate_selectator4.trigger('click');
                        $("#selectator_showList").css("position","fixed")
});
 function updateShowList(){
     $("#imageChooser").parent().find(".shImg").parent().remove();
    $('#form_postShowIds').val($('#showList').val());
    $(".showListImage").remove();
    $(".selectator_chosen_item_left").find("img").each(function(idx,elem){
        onclickFunc ="removeParent(this,"+idx+",'form_postShowIds')"; 
        parent = '<div class="images showListImage"><a title="" data-placement="top" data-toggle="tooltip" href="javascript:void(0)" onclick="'+onclickFunc+'" class="remove_icon" data-original-title="Remove"><i class="fa fa-times"></i></a></div>';
        $(parent).append(elem).css("height",$("firstShowImg").css("height")).insertBefore("#showListImagesAddBtn");
        $(elem).addClass('shImg');
        addBannerImage(elem);
        $('#showList').selectator('refresh');
        $('#showList').selectator('destroy');
        $('#showModal').modal('toggle');
    });    
}
function removeParent(elem,idx,targetElem)
{
    
    imageSrc = $(elem).parent().find('img').attr("src");
    $("#imageChooser").parent().find("img[src$='"+imageSrc+"']").parent().remove();
    addBannerImage($("#imageChooser").parent().find("img:first"));
    $(elem).parent().remove();
    var str = $("#"+targetElem).val();
    var t = str.split(",");
    t[idx] = "";
    //t.splice(idx,1);
    $("#"+targetElem).val(t.join());
    if(targetElem=="form_postShowIds")
    {
        $(".add_episode").find('img').parent().remove();
        $(".add_character").find('img').parent().remove();
        $("#form_postShowIds").val("");
        $("#form_postEpisodeIds").val("");
        $("#form_postCharacterIds").val("");
        $("#imageChooser").parent().find("img").parent().remove();
    }
}


$('#episodeModal').on('shown.bs.modal', function (e) {
    showId = $("#form_postShowIds").val();
    $("#episodeList").html();
    $.ajax({
            url: window.siteUrl+"/episode/getEpisodeList",
            type: "POST",
            data: {showId: showId},
            success: function (data) {
                var response =jQuery.parseJSON(data);
                if(response.isPosted)
                $("#episodeList").html(response.message);
                else
                notify('error',response.message);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: ' + errorThrown);
            }
        });
    var $activate_selectator1 = $('#form_postEpisodeIds');
			$activate_selectator1.click(function () {
				var $select1 = $('#episodeList');
                               
				if ($select1.data('selectator') === undefined) {
					$select1.selectator({
						showAllOptionsOnFocus: true
					});
					
				} 
			});
			$activate_selectator1.trigger('click');
                        $("#selectator_episodeList").css("position","fixed")
});

 function updateEpisodeList(){
     
     $("#imageChooser").parent().find(".epiImg").parent().remove();
    $('#form_postEpisodeIds').val($('#episodeList').val());
    $(".episodeListImage").remove();
    $(".selectator_chosen_item_left").find("img").each(function(idx,elem){
        onclickFunc ="removeParent(this,"+idx+",'form_postEpisodeIds')"; 
        parent = '<div class="images episodeListImage"><a title="" data-placement="top" data-toggle="tooltip" href="javascript:void(0)" onclick="'+onclickFunc+'" class="remove_icon" data-original-title="Remove"><i class="fa fa-times"></i></a></div>';
        $(elem).addClass('epiImg');
        addBannerImage(elem);
        $(parent).append(elem).insertBefore("#episodeListAddBtn");
        $('#episodeList').selectator('refresh');
        $('#episodeList').selectator('destroy');
    });    
}

$('#characterModal').on('shown.bs.modal', function (e) {
    showId = $("#form_postShowIds").val();
    $("#characterList").html();
    $.ajax({
            url: window.siteUrl+"/character/getCharacterList",
            type: "POST",
            data: {showId: showId},
            success: function (data) {
                var response =jQuery.parseJSON(data);
                if(response.isPosted)
                $("#characterList").html(response.message);
                else
                notify('error',response.message);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: ' + errorThrown);
            }
        });
    var $activate_selectator1 = $('#form_postCharacterIds');
			$activate_selectator1.click(function () {
				var $select1 = $('#characterList');
                               
				if ($select1.data('selectator') === undefined) {
					$select1.selectator({
						showAllOptionsOnFocus: true
					});
					
				} 
			});
			$activate_selectator1.trigger('click');
                        $("#selectator_characterList").css("position","fixed")
});

 function updateCharacterList(){
    $('#form_postCharacterIds').val($('#characterList').val());
    $("#imageChooser").parent().find(".charImg").parent().remove();
    $(".characterListImage").remove();
    
    $(".selectator_chosen_item_left").find("img").each(function(idx,elem){
        onclickFunc ="removeParent(this,"+idx+",'form_postCharacterIds')"; 
        parent = '<div class="images characterListImage"><a title="" data-placement="top" data-toggle="tooltip" href="javascript:void(0)" onclick="'+onclickFunc+'" class="remove_icon" data-original-title="Remove"><i class="fa fa-times"></i></a></div>';
        $(parent).append(elem).insertBefore("#characterListAddBtn");
        $(elem).addClass('charImg');
        addBannerImage(elem);
        $('#form_postCharacterIds').trigger('click');
        $('#characterList').selectator('refresh');
        $('#characterList').selectator('destroy');
    });    
}
function addBannerImage(elem){
    if($(elem).attr("src")!="")
    {
    imageSrc = $(elem).attr("src");
    $("#imageChooser").parent().find("img[src$='"+imageSrc+"']").parent().remove();
    console.log($("#imageChooser").parent().find("img[src$='"+imageSrc+"']"));
    $(".overlay-image").remove();
        OvelayElem  = '<div style="position:absolute;left:0px;height:100%;width:100%;background:rgba(255,255,255,0.6);" class="overlay-image"></div>';
        parent2 = '<div class="images"></div>';
        $(parent2).append(OvelayElem).append($(elem).clone()).insertAfter("#imageChooser");
        if ($("#form_postCoverImage").attr('type') == 'hidden')
        {    
            $("#form_postCoverImage").val($(elem).attr("src"));
        }
        $(parent2).on('click',function(){
            $(".overlay-image").remove();
            $(parent2).append(OvelayElem);
        });
        $(parent2).trigger('click');
    }
}

$(".Editor-editor").change(function(){
    console.log($(this).html());
});

