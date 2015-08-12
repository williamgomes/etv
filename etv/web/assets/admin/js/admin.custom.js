/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    "use strict";
    //windows load event
    $(document).ready(function () {
        $("input:checkbox").bootstrapSwitch();
    });
})(jQuery);


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

function removeImage(image, showId, elem)
{
    $.ajax({
        url: window.siteUrl + "/admin/show/removePicture",
        type: "POST",
        data: {showId: showId, image: image},
        success: function (data) {
            var response = jQuery.parseJSON(data);
            if (response.isPosted)
            {
                $(elem).parent().fadeOut();
                notify('success', response.message);
            }
            else
            {
                alert("Something went wrong!!")
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    });
}

function setBanner(image, showId)
{
    $.ajax({
        url: window.siteUrl + "/admin/show/setBanner",
        type: "POST",
        data: {showId: showId, image: image},
        success: function (data) {
            var response = jQuery.parseJSON(data);
            if (response.isPosted)
            {
                notify('success', response.message);
            }
            else
            {
                alert("Something went wrong!!")
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    });
}

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








function updateCharacter(id) {
    var defaultName = $('#form_characterTitle').val();
    var aliasOne = $('#form_characterAliasOne').val();
    var aliasTwo = $('#form_characterAliasTwo').val();
    var aliasThree = $('#form_characterAliasThree').val();
    var aliasFour = $('#form_characterAliasFour').val();
    var actorOne = $('#form_actorOne').val();
    var actorTwo = $('#form_actorTwo').val();
    var status = 0;

    if (defaultName == "") {
        notify('error', "Character Title is required.");
        status++;
    }

    if (status == 0) {
        $.ajax({
            url: window.siteUrl + "/update/character/" + id,
            type: "POST",
            data: {
                defaultName: defaultName,
                aliasOne: aliasOne,
                aliasTwo: aliasTwo,
                aliasThree: aliasThree,
                aliasFour: aliasFour,
                actorOne: actorOne,
                actorTwo: actorTwo,
            },
            success: function (data) {
                var response = jQuery.parseJSON(data);
                if (response.id > 0) {
                    notify('success', "Character updated successfully");
                } else {
                    alert("Something went wrong!!")
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: ' + errorThrown);
            }
        });
    }
}


function uploadCharImg() {
//    alert(seasonID);

    var options = {
        url: window.siteUrl + "/upload/character/image",
        type: 'post',
        dataType: 'json',
        success: function (response) {
            notify('success', "Character image uploaded successfully. Refreshing...");
            setTimeout(function () {
                location.reload();
            }, 3000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    };
    $('#character_form_upload').ajaxSubmit(options);
    // always return false to prevent standard browser submit and page navigation 
    return false;
}






function submitSeason(seasonID) {
//    alert(seasonID);

    var options = {
        url: window.siteUrl + "/admin/update/season/" + seasonID,
        type: 'post',
        dataType: 'json',
        success: function (response) {
            notify('success', "Season information updated successfully. Refreshing...");
            setTimeout(function () {
                location.reload();
            }, 3000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    };
    $('#season_form_' + seasonID).ajaxSubmit(options);
    // always return false to prevent standard browser submit and page navigation 
    return false;
}






function removeSeasonBanner(seasonID) {
    $.ajax({
        url: window.siteUrl + "/admin/deletebanner/season/" + seasonID,
        type: "POST",
        data: {
            seasonID: seasonID,
        },
        success: function (data) {
            var response = jQuery.parseJSON(data);
            notify('success', "Banner image deleted successfully. Redirecting...");
            $("#banner_img_" + seasonID).hide("slow");
            $("#banner_btn_" + seasonID).hide("slow");
            $("#banner_div_" + seasonID).html("<h6>No banner image found.</h6>");
//                setTimeout(function () {
//                    location.reload();
//                }, 3000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    });
}


function removeSeasonImage(seasonID, imageID) {
    $.ajax({
        url: window.siteUrl + "/admin/deleteother/season/" + seasonID,
        type: "POST",
        data: {
            seasonID: seasonID, imageID: imageID
        },
        success: function (data) {
            var response = jQuery.parseJSON(data);
            notify('success', "Banner image deleted successfully. Redirecting...");
            $("#other_img_div_" + imageID).hide("slow");
//            setTimeout(function () {
//                location.reload();
//            }, 3000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    });
}





function submitSettings() {
//    alert(seasonID);

    var options = {
        url: window.siteUrl + "/admin/update/settings",
        type: 'post',
        dataType: 'json',
        success: function (response) {
            notify('success', "Season information updated successfully. Refreshing...");
            setTimeout(function () {
                location.reload();
            }, 3000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown)
        {
            alert('Error: ' + errorThrown);
        }
    };
    $('#form_settings').ajaxSubmit(options);
    // always return false to prevent standard browser submit and page navigation 
    return false;
}




function userSuspend(userId, status) {
    if (userId > 0 && status != "") {
        $.ajax({
            url: window.siteUrl + "/admin/user/suspend/" + userId,
            type: "POST",
            data: {
                status: status
            },
            success: function (response) {
                if (response.isPosted) {
                    notify('success', response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    notify('error', response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: ' + errorThrown);
            }
        });
    }
}



function userDelete(userId) {
    var r = confirm("Are you sure about deleting the user?");
    if (r == true) {
        if (userId > 0 && userType != "") {
            $.ajax({
                url: window.siteUrl + "/admin/user/delete/" + userId,
                type: "POST",
                data: {
                    userId: userId
                },
                success: function (response) {
                    if (response.isPosted) {
                        notify('success', response.message);
                        window.location.assign(window.siteUrl + "/admin/user/control");
                    } else {
                        notify('error', response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                },
                error: function (XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('Error: ' + errorThrown);
                }
            });
        }
    }
}


function userType(userId, userType) {
//    alert(userId);
    if (userId > 0 && userType != "") {
        $.ajax({
            url: window.siteUrl + "/admin/user/type/" + userId,
            type: "POST",
            data: {
                userType: userType
            },
            success: function (response) {
                if (response.isPosted) {
                    notify('success', response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                } else {
                    notify('error', response.message);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {
                alert('Error: ' + errorThrown);
            }
        });
    }
}




function sortUsers(attrType) {
//    alert(attrType);
    if (attrType == "All") {
        $('#userParentDiv > div').fadeIn("slow");
    } else {
        var $el = $('.' + attrType).fadeIn("slow");
        $('#userParentDiv > div').not($el).fadeOut("slow");
    }
}