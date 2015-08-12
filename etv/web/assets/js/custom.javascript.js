/* 
 * This is the page for our custom java scripts
 * All custom javascript functions and modified or override code will be placed here
 */

/*
 * 
 * @param string msgType = success | error | info
 * @param string msgDetails
 * @returns jQuery Toast Message
 */
function notify(msgType, msgDetails) {

    if (msgType === 'success') {
        $.simplyToast('<i class="fa fa-check-circle"></i>&nbsp;&nbsp;' + msgDetails, 'success');
    }

    if (msgType === 'error') {
        $.simplyToast('<i class="fa fa-times-circle"></i>&nbsp;&nbsp;' + msgDetails, 'danger');
    }

    if (msgType === 'info') {
        $.simplyToast('<i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;' + msgDetails, 'info');
    }
}


$(document).ready(function () {
    $(document).ajaxSuccess(function () {
        $('img').error(function () {
            //alert ("missing Image");
            $(this).attr('src', window.siteUrl + '/assets/images/missing.jpg');
        });
    });
    $.extend(true, $.simplyToast.defaultOptions,
            {
                appendTo: "body",
                customClass: true,
                type: "info",
                offset:
                        {
                            from: "top",
                            amount: 20
                        },
                align: "right",
                minWidth: 250,
                maxWidth: 450,
                delay: 5000,
                allowDismiss: true,
                spacing: 10
            });
    $(".epi-carousel4").owlCarousel({
        autoPlay: true,
        items: 4,
        pagination: false,
        responsive: true,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 4],
        itemsTablet: [768, 3],
        itemsTabletSmall: [600, 3],
        itemsMobile: [479, 3]

    });
});




function submitEpisodeEssential(episodeId, review, showId)
{
    $.ajax({
        url: window.siteUrl + "/episode/episodeReactions",
        type: "POST",
        data: {showId: showId, episodeId: episodeId, feedback: review},
        success: function (data) {
            var response = data;
            //console.log(episodeId);
            if (response.isPosted)
            {
                $("#yes-no" + episodeId + " .yesbtn").html(Math.round(response.rating[0].percent) + "%");
                $("#yes-no" + episodeId + " .nobtn").html(Math.round(100 - response.rating[0].percent) + "%");

                notify('success', response.message);
                $('#addspoiler').modal('show');
            } else {
                notify('error', response.message);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    });

}

function loadPostAjax(postType, elem)
{
    divElem = '<div class="plus col-md-2 col-md-offset-5">Loading...</div>';
    $(".scrollLoader").html(divElem);
    $.ajax({
        url: window.siteUrl + "/post/moreposts/0/" + postType,
        type: "GET",
        success: function (data) {
            $(".scrollLoader").html(data);
            $(".header-nav > li").removeClass("active");
            $(elem).parent().addClass('active');
            infiniteLoader.destroy();
            infiniteLoader = new Waypoint.Infinite({
                element: $('.scrollLoader')[0],
                //more : $('.infinite-more-link:last')
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {

        }
    });
}

function loadEpisodeAjax(postType, elem,showId)
{
    divElem = '<div class="plus col-md-2 col-md-offset-5">Loading...</div>';
    $(".scrollLoader").html(divElem);
    $.ajax({
        url: window.siteUrl + "/show/loadMoreEpisodes/"+showId+"/0" ,
        type: "GET",
        success: function (data) {
            $(".scrollLoader").html(data);
            $(".header-nav > li").removeClass("active");
            $(elem).parent().addClass('active');
            infiniteLoader.destroy();
            infiniteLoader = new Waypoint.Infinite({
                element: $('.scrollLoader')[0],
                //more : $('.infinite-more-link:last')
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {

        }
    });
}

function chooseShowAjax(postType, elem)
{
    divElem = '<div class="plus col-md-2 col-md-offset-5">Loading...</div>';
    $(".scrollLoader").html(divElem);
    $.ajax({
        url: window.siteUrl + "/show/showListAjax/" + postType + "/0",
        type: "GET",
        success: function (data) {
            $(".scrollLoader").html(data);
            $(".header-nav > li").removeClass("active");
            $(elem).parent().addClass('active');
            infiniteLoader.destroy();
            infiniteLoader = new Waypoint.Infinite({
                element: $('.scrollLoader')[0],
                //more : $('.infinite-more-link:last')
            });
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {

        }
    });
}



/*
 * 
 * @param integer spoilerID
 * @returns status
 */

function approveSpoiler() {
    var spoilerID = $("#spoiler_id").val();
    if (spoilerID > 0) {
        $.ajax({
            url: window.siteUrl + "/spoiler/approve",
            type: "POST",
            data: {spoilerID: spoilerID},
            success: function (data) {

                notify('success', 'You approved this spoiler successfully.');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });

    } else {
        notify('error', 'Incorrect parameter');
    }
}



/*
 * 
 * @param integer spoilerID
 * @returns status
 */

function disputeSpoiler() {
    var spoilerID = $("#spoiler_id").val();
    if (spoilerID > 0) {
        $.ajax({
            url: window.siteUrl + "/spoiler/dispute",
            type: "POST",
            data: {spoilerID: spoilerID},
            success: function (data) {

                notify('success', 'You disputed this spoiler successfully.');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });

    } else {
        notify('error', 'Incorrect parameter');
    }
}






/*
 * 
 * @param integer quoteID
 * @returns status
 */

function approveQuote() {
    var quoteID = $("#quote_id").val();
    if (quoteID > 0) {
        $.ajax({
            url: window.siteUrl + "/quote/approve",
            type: "POST",
            data: {quoteID: quoteID},
            success: function (data) {

                notify('success', 'You approved this quote successfully.');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });

    } else {
        notify('error', 'Incorrect parameter');
    }
}



/*
 * 
 * @param integer quoteID
 * @returns status
 */

function disputeQuote() {
    var quoteID = $("#quote_id").val();
    if (quoteID > 0) {
        $.ajax({
            url: window.siteUrl + "/quote/dispute",
            type: "POST",
            data: {quoteID: quoteID},
            success: function (data) {

                notify('success', 'You disputed this quote successfully.');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });

    } else {
        notify('error', 'Incorrect parameter');
    }
}




/*
 * 
 * @param integer spoilerID
 * @returns null
 */

function actionSpoiler(spoilerID) {
    $("#spoiler_id").val(spoilerID);
}


/*
 * 
 * @param integer quoteID
 * @returns null
 */

function actionQuote(quoteID) {
    $("#quote_id").val(quoteID);
}



function limitText(limitField, limitCount, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    } else {
        limitCount.value = limitNum - limitField.value.length;
    }
}



$(document).ready(function ()
{
    $("#txtQuote").on("keyup", function (){
        $("#characterQuoteCount").val(500-$(this).val().length); 
    });
    var start = /@/ig; // @ Match
    var word = /@(\w+)/ig; //@abc Match
    $("#spoilerCharCount").val(100);
    $(".textbox").html("");
    $(".textbox").on("keyup", function ()
    {
        var content = $(this).text(); //Content Box Data
        var go = content.match(start); //Content Matching @
        var name = content.match(word); //Content Matching @abc
        var keyword = name;
//If @ available
        if (go !== null && go.length > 0)
        {
//            alert(go.length);
//            $("#msgbox").slideDown('show');
//            $("#display").slideUp('show');
//            $("#msgbox").html("Type the name of someone or something...");
//if @abc avalable
//            if (name.length > 0)
//            {
              var dataArr = {};
              dataArr["keyword"]= keyword;
            if(typeof window.glShowId != 'undefined')
              dataArr["showId"] = window.glShowId;
          
          
            $.ajax({
                url: window.siteUrl + "/character/suggest",
                type: "POST",
                dataType: "json",
                data: dataArr,
                success: function (data)
                {
                    var HTML = '';
                    var obj = unescape(data);
                    obj = JSON.parse(obj);
//                    console.log(obj);
//                        alert(obj);
//                        alert(obj.characters.length);
                    if (obj.characters.length > 0) {
                        HTML += '<div id="divCharSuggestion" class="col-sm-12" style="z-index: 999; position:absolute; background-color: white;">';
                        $.each(obj.characters, function (key, Character) {
                            HTML += '<div class="col-sm-12" style="border-bottom: 1px black solid;" id="' + Character.characterId + '">';
                            HTML += '<a href="javascript:void(0);" title="' + Character.characterTitle + '" onclick="javascript:getChar(this.id, ' + word + ', this.title, this.id);" id="' + Character.characterId + '">';
                            HTML += '<div class="col-sm-2 col-xs-12 pull-left">';
                            if (Character.characterOriginalDataSupersede == 'active') {
                                HTML += '<img src="' +window.siteUrl+Character.characterBannerImage + '" class="img-responsive" height="40px"/>';
                            } else {
                                HTML += '<img src="' + window.siteUrl+Character.characterBannerImage + '" class="img-responsive" height="40px"/>';
                            }
                            HTML += '</div>';
                            HTML += '<div class="col-sm-10 col-xs-12 pull-right">';

                            HTML += '<h5>' + Character.characterTitle + '</h5>';
                            HTML += '<em><small>' + Character.showTitle + '</small></em>';
                            HTML += '</div>';
                            HTML += '</a>';
                            HTML += '</div>';
//                            alert(Character.characterTitle);
                        });
                        HTML += '</div>';
                    }

//                        if(obj.characters.length > 0){
//                            alert('Found');
//                        } else {
//                            alert('Not Found');
//                        }
//                        $("#msgbox").hide();
//alert(HTML);
                    $("#suggestion").show();
                    $("#suggestion").html(HTML);
                }
            });
//            }
        }
        else
            $("#suggestion").hide();
        $("#spoilerCharCount").val(100-$(this).text().length);   
//        return false();
    });

//Adding result name to content box.
//    $(".addname").on("click", function ()
//    {
//        alert($(this).attr("data-id"));
////        var username = $(this).attr('title');
////        var old = $("#contentbox").html();
////        var content = old.replace(word, " "); //replacing @abc to (" ") space
////        $("#contentbox").html(content);
////        var E = "<a class='red' contenteditable='false' href='#' >" + username + "</a>";
////        $("#contentbox").append(E);
////        $("#display").hide();
////        $("#msgbox").hide();
//    });



//    $('#divCharSuggestion').bind('click', function (event) {
//        alert('clicked');
//    });
//    $(".addname").delegate("div", "click", function () {
//        alert($(this).attr("data-id"));
//    });
});



function getChar(divId, word, title, charId) {
//    alert(word);
    $("#suggestion").hide();
    var taggedChar = $("#taggedChar").val();
    if (taggedChar == "") {
        taggedChar = divId + ',';
    } else {
        taggedChar += divId + ',';
    }
    $("#taggedChar").val(taggedChar);
    var username = title;
    var old = $(".textbox").html();
    var content = old.replace(word, " "); //replacing @abc to (" ") space
    $(".textbox").html(content);
    var E = "<a style='color: #115059; font-weight: bold;' contenteditable='false' href='" + window.siteUrl + "/character/" + charId + "/" + (username.replace(" ", "-")) + "' >" + username + "</a>";
    //document.execCommand('insertHTML', false, '');
    $(".textbox").append(E);
    $(".textbox").trigger('blur');
    $(".textbox").focus();
    
//    $("#msgbox").hide();
}




/*
 * 
 * @param
 * @returns status
 */

function addSpoiler() {
    var taggedChactr = $("#taggedChar").val();
    var episodeId = $("#episodeId").val();
    var spoiler = $(".textbox").val();
    var tags = [] ;
    var chkStat = 0;
    $('textarea.tagged_text').textntags('val', function(text) {
        spoiler = text;
        });
        
    $('textarea.tagged_text').textntags('getTags', function(data) {
        tags = data;
            //console.log(JSON.stringify(data), data);
        });
        
        var res = spoiler.match(/(@)\[\[(\d+):([\w\s\.\-]+):([\w\s@\.,-\/#!$%\^&\*;:{}=\-_`~()]+)\]\]/gi);
        for(i=0;i<res.length;i++)
        {
            var urld  = '<a style="color: #115059; font-weight: bold;" contenteditable="false" href="'+window.siteUrl+'/character/'+tags[i].id+'/'+tags[i].name.replace(' ','-')+'">'+tags[i].name+'</a>';
            spoiler = spoiler.replace(res[i],urld);
        }
        //console.log(tags);
        //console.log(res);
        //console.log(spoiler);return false;
//    alert(spoiler.replace(/\s/g, "").length);
//    console.log("-" + suggestion + "-");
//    notify('error', 'Please write something before submitting.');
    if($(".textbox").text().length > 100)
    {
        notify('error', 'You can write spoiler maximum of 100 characters.');
        return false;
    }
    if (($.trim(spoiler)).length == 0) {
        chkStat++;
        notify('error', 'Please write something before submitting.');
    }
    if (chkStat == 0) {
        $.ajax({
            url: window.siteUrl + "/spoiler/add",
            type: "POST",
            data: {taggedChactr: taggedChactr, episodeId: episodeId, spoiler: spoiler},
            success: function (data) {
                var obj = unescape(data);
                obj = $.parseJSON(obj);
                if (obj.isPosted == true) {
                    notify('success', 'You spoiler saved successfully.');
                    $(".textbox").html('');
                    $(".close").click();
                    var htmlSpoiler = '';
                    $.each(obj.objSpoilerInfo, function (key, Spoiler) {
                        htmlSpoiler += '<div onclick="javascript:actionSpoiler(' + Spoiler.spoilerId + ');" id="spoiler_div_' + Spoiler.spoilerId + '" class="spoilers" data-toggle="modal" data-target="#spoiler">';
                        htmlSpoiler += '<p>' + Spoiler.spoilerText + '</p>';
                        htmlSpoiler += '</div>';
                    });
                    $("#episodeSpoiler").html(htmlSpoiler);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });

    }
}




function charSuggestion(keyword) {
    $.ajax({
        url: window.siteUrl + "/character/suggest",
        type: "POST",
        dataType: "json",
        data: {keyword: keyword},
        success: function (data)
        {
            var HTML = '';
            var obj = unescape(data);
            obj = JSON.parse(obj);
            if (obj.characters.length > 0) {
                $.each(obj.characters, function (key, Character) {
                    HTML += '<option value="' + Character.characterTitle + '" data-charid="' + Character.characterId + '"></option>';
                });
            }
            $("#datalistChar").html(HTML);
        }
    });
}



function episodeSuggestion(keyword, showId) {
    $.ajax({
        url: window.siteUrl + "/episode/suggest/" + showId,
        type: "POST",
        dataType: "json",
        data: {keyword: keyword, showId: showId},
        success: function (data)
        {
            var HTML = '';
//            var obj = unescape(data);
//            obj = JSON.parse(obj);
            if (data.episodes.length > 0) {
                $.each(data.episodes, function (key, Episode) {
                    HTML += '<option value="Season ' + Episode.episodeSeasonId + ': ' + Episode.episodeTitle + '" data-charid="' + Episode.episodeId + '"></option>';
                });
            }
            $("#datalistChar").html(HTML);
        }
    });
}





function addQuote(type) {

    if (type == "Epi") {
        var val = $('#character').val()
        var charId = $('#datalistChar option').filter(function () {
            return this.value == val;
        }).data('charid');
        $("#charId").val(charId);
        var txtQuote = $("#txtQuote").val();
        var episodeId = $("#episodeIdQuote").val();
        var chkStat = 0;
    } else {
        var charId = $("#charId").val();
        var txtQuote = $("#txtQuote").val();
        var episodeId = $("#episodeIdQuote").val();
        var chkStat = 0;
    }

    if (($.trim(txtQuote)).length == 0) {
        chkStat++;
        notify('error', 'Please write something before submitting.');
    }

    if (charId == "" || typeof charId == "undefined") {
        chkStat++;
        notify('error', 'Please select a character.');
    }

    if (chkStat == 0) {
        $.ajax({
            url: window.siteUrl + "/quote/add",
            type: "POST",
            data: {txtQuote: txtQuote, charId: charId, episodeId: episodeId, type: type},
            success: function (data) {

                var obj = data;
//                obj = $.parseJSON(obj);
                if (obj.isPosted == true) {
                    notify('success', 'Your quote saved successfully.');
                    var htmlQuote = '';
                    $.each(obj.quoteInfo, function (key, Quote) {

                        htmlQuote += '<div onclick="javascript:actionQuote(' + Quote.quoteId + ');" class="quotes" data-toggle="modal" data-target="#quote">';
                        htmlQuote += '<div class="quote_img">';
                        if (Quote.characterOriginalDataSupersede == "active") {
                            htmlQuote += '<img src="' + Quote.characterBannerImage + '" alt="' + Quote.characterTitle + '" />';
                        } else {
                            htmlQuote += '<img src="' + Quote.characterApiImages + '" alt="' + Quote.characterTitle + '" />';
                        }
                        htmlQuote += '</div>';
                        htmlQuote += '<div class="quote_area">';
                        htmlQuote += '<div class="quote arrow_box">';
                        htmlQuote += '<p>"' + Quote.quoteText + '"</p>';
                        htmlQuote += '</div>';
                        htmlQuote += '<h5 class="name">- ' + Quote.characterTitle + '</h5>';
                        htmlQuote += '<ul class="list-inline social">';
                        htmlQuote += '<li><a class="facebook" href="#" title=""><i class="fa fa-facebook"></i></a></li>';
                        htmlQuote += '<li><a class="twitter" href="#" title=""><i class="fa fa-twitter"></i></a></li>';
                        htmlQuote += '</ul>';
                        htmlQuote += '</div>';
                        htmlQuote += '</div>';
                    });
                    $("#showQuotes").html(htmlQuote);
                    $('#txtQuote').val('');
                    $(".close").click();
                    $('#character').val('');
                    $("#charId").val('');
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });

    }
}




//function addQuoteChar() {
//
//    var charId = $("#charId").val();
//    var txtQuote = $("#txtQuote").val();
//    var episodeId = $("#episodeIdQuote").val();
//    var chkStat = 0;
//
//    if (($.trim(txtQuote)).length == 0) {
//        chkStat++;
//        notify('error', 'Please write something before submitting.');
//    }
//
//    if (charId == "" || typeof charId == "undefined") {
//        chkStat++;
//        notify('error', 'Please select a character.');
//    }
//
//    if (chkStat == 0) {
//        $.ajax({
//            url: window.siteUrl + "/quote/add",
//            type: "POST",
//            data: {txtQuote: txtQuote, charId: charId, episodeId: episodeId},
//            success: function (data) {
//
//                notify('success', 'Your quote saved successfully.');
//                $("#txtQuote").val('');
//                $(".close").click();
//            },
//            error: function (XMLHttpRequest, textStatus, errorThrown)
//            {
//                notify('error', errorThrown);
//            }
//        });
//
//    }
//}



function addReaction() {
    var reaction = $('#txtReaction').val();
    var episodeId = $('#episodeId').val();
    var chkStat = 0;

    if (reaction == "") {
        chkStat++;
        notify('error', 'Please write something before submitting.');
    }

    if (chkStat == 0) {
        $.ajax({
            url: window.siteUrl + "/create/reaction",
            type: "POST",
            data: {reaction: reaction, episodeId: episodeId},
            success: function (data) {
                var obj = unescape(data);
                obj = $.parseJSON(obj);
                if (obj.isPosted == true) {
                    notify('success', 'Your reaction saved successfully.');
                    $(".textbox").html('');
                    $(".close").click();
                    var htmlReaction = '';
                    $.each(obj.reactionInfo, function (key, Reaction) {
//                        var d = new Date();
//                        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
//
//                        var date = d.getDay() + " " + month[d.getMonth()] + ", " + d.getFullYear();
//                        var time = d.toLocaleTimeString().toLowerCase();
//
//                        console.log(date + " at " + time);

                        htmlReaction += '<div class="reactions">';
                        htmlReaction += '<img src="" alt="" />';
                        htmlReaction += '<h4><a href="#" title="">' + Reaction.userFirstName + '</a> | ';
                        htmlReaction += '<a class="responses"  href="' + window.siteUrl + '"/reaction/' + Reaction.reactionId + '/' + Reaction.reactionEpisodeId + '>' + Reaction.ResponseCount + ' Responses</a></h4>';
                        htmlReaction += '<p>' + Reaction.reactionText + '</p>';
                        htmlReaction += '</div>';
                    });
                    $("#showReaction").html(htmlReaction);
                    notify('success', 'You reaction saved successfully.');
                    $('#txtReaction').val('');
                    $(".close").click();
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });
    }
}



function addResponse() {
    var response = $('#response').val();
    var reactionId = $('#reactionId').val();
    var episodeId = $('#episodeId').val();
    var chkStat = 0;

    if (response == "") {
        chkStat++;
        notify('error', 'Please write something before submitting.');
    }

    if (chkStat == 0) {
        $.ajax({
            url: window.siteUrl + "/create/response",
            type: "POST",
            data: {response: response, episodeId: episodeId, reactionId: reactionId},
            success: function (data) {
                notify('success', 'You response saved successfully.');
                $('#response').val('');
                $(".close").click();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                notify('error', errorThrown);
            }
        });
    }
}

