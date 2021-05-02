var mediaAvatar = false, // cho phép chọn n1 hay nhiều hình
    mediaPage = 1,
    mediaPageCheck = true,
    currentFeature = 1;
    currentEditor = null,
    currentIdDiv = null,
    currentAvatarId = null,
    articleShow = 0,
    mediaShow = 0;

// currentFeature = 1
var initMediaEditor = function(editorName) {
    currentEditor = editorName;
    mediaAvatar = false;
    currentFeature = 1;

    settings.multiple = true;

    initMediaCommon();
}

// currentFeature = 2
var initMediaDiv = function(idDiv) {
    currentIdDiv = idDiv;
    mediaAvatar = false;
    currentFeature = 2;
    settings.multiple = true;

    initMediaCommon();
}

// currentFeature = 3
var initMediaAvatar = function(avatarId) {
    currentAvatarId = avatarId;
    mediaAvatar = true;
    currentFeature = 3;
    settings.multiple = false;

    initMediaCommon();
}

var initMediaCommon = function() {
    $('.ajax-upload-dragdrop').remove();
    $("#upload").uploadFile(settings);
    $('#mediaModal').modal('show');

    if(mediaShow == 0) {
        getMedias();
        mediaShow = 1;
    }

    $('#insert-into-post').attr('disabled', true);
    $('#delete-media').attr('disabled', true);

    jQuery("input[name='check_image_media[]']:checked").each(function () {
        jQuery(this).prop("checked", false);
    });
} 

// thêm bài viết mẫu vào editor
var initMediaArticleExample = function(editorName) {
    currentEditor = editorName;
    $('#articleModal').modal('show');

    if(articleShow == 0) {
        getArticleSample();
        articleShow = 1;
    }
}

$('#insert-into-post').on('click', function(e) {
    if(currentFeature == 1) {
        jQuery("input[name='check_image_media[]']:checked").each(function() {
            let src = jQuery(this).val();
            let data = '<img src="'+src+'"class="img-thumbnail img-check">';
            currentEditor.insertContent(data);
            jQuery(this).prop("checked", false);
        });
    } else if(currentFeature == 2) {
        jQuery("input[name='check_image_media[]']:checked").each(function() {
            let src = jQuery(this).val();
            let data = '<div class="item">' +
                    '<img class="img-thumbnail" src="'+src+'">' +
                    '<input type="hidden" name="images[]" value="'+src+'">' +
                    '<span onclick="removeImgUpload(this)" class="remove-img"><i class="far fa-times-circle"></i><span></span></span>' +
                '</div>';
            $('#'+currentIdDiv).append(data);
            jQuery(this).prop("checked", false);
        });
    } else if(currentFeature == 3) {
        jQuery("input[name='check_image_media[]']:checked").each(function () {
            var src = jQuery(this).val();
            var data = '<img src="' + src + '" class="img-thumbnail" />';
            $('#'+currentAvatarId+' .img-preview').html(data);
            $('#'+currentAvatarId+' .input_value').val(src);
            jQuery(this).prop("checked", false);
        });

        $('#'+currentAvatarId+' .get-media').hide();
        $('#'+currentAvatarId+' .remove-avatar').show();

        $('#delete-media').attr('disabled', true);
        $('#mediaModal').modal('hide');
    }
    
    $('#insert-into-post').attr('disabled', true);
    $('#delete-media').attr('disabled', true);
    $('#mediaModal').modal('hide');
});

$('#use-article-sample').on('click', function(event) {
    $.ajax({
        type: "get",
        url: BASE_API_URL + "/article_samples/" + $("input[name='article-sample']:checked").val(),
        beforeSend: function() {
            $('.loadding-body').show();
            $('body').css('opacity', 0.6);
        },
        success: function (response) {
            if(response.code == 200) {
                currentEditor.setContent(response.data.content);
            }
            $('body').css('opacity', 1);
            $('#articleModal').modal('hide');
            $('.loadding-body').hide();
        }
    });
});

/* setting upload file*/
var settings = {
    url: BASE_API_URL + "/medias/upload",
    method: "POST",
    allowedTypes: "jpg,png,gif,jpeg",
    fileName: "file",
    multiple: true,
    onSuccess: function (files, response, xhr) {
        $('#upload-media a').removeClass('active');
        $('#media-list a').addClass('active');
        $('#upload-files').removeClass('active');
        $('#upload-files').removeClass('in');
        $('#media-library').addClass('active');
        $('#media-library').addClass('in');
        if (response.code == 200) {
            if (mediaAvatar) {
                jQuery("input[name='check_image_media[]']:checked").each(function () {
                    jQuery(this).prop("checked", false);
                });
            }
            var data = response.data;
            var html = '<li id="media-li-' + data.id + '">';
            html += '<input type="hidden" name="value-id" id ="value-id" value="' + data.id + '">';
            html += '<input type="checkbox" id="cb' + data.id + '" name="check_image_media[]" value="' + data.url + '" checked/>';
            html += '<label for="cb' + data.id + '"><img src="' + data.thumbnail + '"/></label>';
            html += '</li>';
            $('#list-media ul').prepend(html);
            $('#insert-into-post').attr('disabled', false);
            $('#delete-media').attr('disabled', false);
            check_image();
        } else {
            alert(response.message);
        }
    },
    onError: function (files, status, errMsg) {}
}

//loai bo su kien click khi chan chon ảnh
// $('#insert-into-post').unbind();
$(".img-check").click(function () {
    $(this).toggleClass("check");
});
check_image();

//search media 
$('#media_sub_search').click(function (event) {
    mediaPage = 1;
    mediaPageCheck = true;
    $('#list-media .data').html('');
    getMedias();
});

$('#media_filter_date').change(function (event) {
    mediaPage = 1;
    mediaPageCheck = true;
    $('#list-media .data').html('');
    getMedias();
});

//delete media
$('#delete-media').click(function (event) {
    $('#insert-into-post').attr('disabled', true);
    Swal.fire({
        title: 'Bạn có chắc chắn muốn xóa?',
        text: "Bạn sẽ không thể khôi phục được dữ liệu sau khi xóa!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            var array_id = [];
            var array_image = [];
            jQuery("input[name='check_image_media[]']:checked").each(function () {
                var id = jQuery(this).parent('li').children('#value-id').val();
                array_id[array_id.length] = id;
                array_image[array_image.length] = jQuery(this).val();
            });
            $.ajax({
                url: BASE_API_URL + '/medias/delete',
                type: 'POST',
                data: {
                    'array_id': array_id,
                    'array_image': array_image,
                },
                beforeSend: function () {
                    $('.loadding-body').show();
                },
                success: function (response) {
                    $('.loadding-body').hide();
                    if (response.code == 200) {
                        jQuery("input[name='check_image_media[]']:checked").each(function () {
                            var id = jQuery(this).parent('li').children('#value-id').val();
                            $('#media-li-' + id).remove();
                        });
                        $('#insert-into-post').attr('disabled', true);
                        $('#delete-media').attr('disabled', true);
                        swal("Xóa thành công");
                    } else {
                        swal("xóa thất bại");
                    }
                },
            });
        } else {
            $('#insert-into-post').attr('disabled', false);
        }
    });
});

// scroll load media
$('#list-media').bind('scroll', chk_scroll);

// load more
$('#media_load_more').click(function() {
    mediaPage++;
    getMedias();
});

function chk_scroll(e) {
    if (!mediaPageCheck) {
        return;
    }
    var elem = $(e.currentTarget);
    if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight()) {
        mediaPage++;
        getMedias();
    }
}

//check image
function check_image() {
    $("input[name='check_image_media[]']").change(function () {
        var new_check = jQuery(this);
        var check = '';
        var i = 0;
        jQuery("input[name='check_image_media[]']:checked").each(function () {
            check = check + ',' + jQuery(this).val();
            i++;
        });
        if (check.length > 1) {
            if (mediaAvatar) {
                if (i > 1) {
                    jQuery("input[name='check_image_media[]']:checked").each(function () {
                        jQuery(this).prop("checked", false);
                    });
                    new_check.prop("checked", true);
                }
            }
            $('#insert-into-post').attr('disabled', false);
            $('#delete-media').attr('disabled', false);
        } else {
            $('#insert-into-post').attr('disabled', true);
            $('#delete-media').attr('disabled', true);
        }
    });
}

function removeAvatar(id) {
    $('#'+id+' .img-preview').html('');
    $('#'+id+' .input_value').val('');
    $('#'+id+' .get-media').show();
    $('#'+id+' .remove-avatar').hide();
}

function getMedias() {
    var key = $('#key-search-file').val();
    var media_filter_date = $('#media_filter_date').val();
    $.ajax({
        url: BASE_API_URL + '/medias',
        type: 'GET',
        data: {
            'key': key,
            'media_filter_date': media_filter_date,
            'type': 'add',
            'page': mediaPage
        },
        beforeSend: function () {
            $('#list-media .loadding-media').html('<img src="/images/loading-1.gif" width="40px"> Loading');
            $('#media_load_more').hide();
        },
        success: function (response) {
            if (response.code == 404) {
                mediaPageCheck = false;
            } else if (response.code == 204) {
                $('#list-media .data').html(response.data);
                mediaPageCheck = false;
            } else if (response.code == 200) {
                $('#list-media .data').append(response.data);

                if(response.page_last) {
                    mediaPageCheck = false;
                    $('#media_load_more').hide();
                } else {
                    $('#media_load_more').show();
                }

                check_image();  
            }
            $('#list-media .loadding-media').html('');
        }
    });
}

var getArticleSample = function() {
    $.ajax({
        type: "get",
        url: BASE_API_URL + "/article_samples",
        beforeSend: function () {
            $('#list-article').html('<div class="loadding-media"><img src="/images/loading-1.gif" width="40px"> Loading</div>');
        },
        complete: function (response) {
            $('#list-article').html(response.responseText);
            $('.article-sample').on('click', function (e) {
                $('#use-article-sample').attr('disabled', false);
            });
        }
    });
}

function removeImgUpload(e) {
    e.parentElement.remove();
}
