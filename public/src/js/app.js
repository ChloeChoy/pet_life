var postId = 0;
var postBodyElement = null;

//edit post
function editPost(){
    $('.edit-post').on('click', function (event) {
            event.preventDefault();

            postBodyElement = $(this).parent().parent().parent().next().children().first();
            var postBody = postBodyElement.text();
            postId = event.target.parentNode.parentNode.parentNode.parentNode.dataset['postid'];
            $('#post-body').val(postBody);
        });

    $('#modal-save').on('click', function () {
        $.ajax({
                method: 'POST',
                url: urlEdit,
                data: {body: $('#post-body').val(), postId: postId, _token: token},
            })
            .done(function (msg) {
                $(postBodyElement).text(msg['new_body']);
                $('#edit-modal').modal('hide');
            });
    });
}
//end edit post
editPost();

$('.like').on('click', function(event) {
    event.preventDefault();
    var checkLike = $(this).next().next();
    if(!checkLike.hasClass('liked')){
        checkLike.addClass('liked').text('1');
    }else{
        checkLike.removeClass('liked').text('0');
    }
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = checkLike.text();
    console.log(isLike);
    $.ajax({
        method: 'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token},
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })
    .done(function(msg) {
        // event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
        // if (isLike) {
        //     event.target.nextElementSibling.innerText = 'Dislike';
        // } else {
        //     event.target.previousElementSibling.innerText = 'Like';
        // }
        $(this).prev().text(msg['num_like']);
    });
});

//post ajax
// $('#create-post').click(function(event){
//     var formData = new FormData();
//     formData.append('att_files', file);
//     // event.stopPropagation();
//     event.preventDefault();
//     $.ajax({
//         type: 'POST',
//         url: routePost,
//         // data: formData,
//         // contentType: false,
//         // processData: false
//         data: {
//             body: $('#new-post').val(), 
//             att_files: new FormData($('#att-files')[0]),
//             _token: token
//         }
//     })
//     .done(function (msg) {
//         var bodyPost = '<p>'+ msg['post_body'] +'</p>';
//         $('.post-form').after('<div class="post-row" data-postid="'+ msg['post_id'] +'"><div class="post-info"><div class="user-avatar"><a href="#"><img alt="avatar" src="'+ userAvatar +'" class="responsive-img"></a></div><div class="user-post"><span class="post-username"><a href="#">'+ msg['post_user'] +'</a></span><span class="post-on">Posted on '+ msg['create_at'] +'</span></div><div class="post-act"><a class="popup-post-menu"><i class="material-icons"><i class="material-icons">keyboard_arrow_down</i></i></a><div class="post-menu-act" style="display:none;"><a class="edit-post" data-toggle="modal" href="#modal-edit-post"><i class="material-icons">mode_edit</i> Edit</a><a class="delete-post"><i class="material-icons">delete</i> Delete</a></div></div></div><div class="post-content">'+ bodyPost +'</div><div class="interaction"><a href="#" class="like"><i class="material-icons">thumb_up</i> Like</a><a href="#" class="share-post"><i class="material-icons">share</i> Share</a></div></div>');
//         $('#new-post').val('');
//         interActivePost();
//         editPost();
//         deletePost();
//     });
// });

//delete post ajax
function deletePost(){
    $('.delete-post').click(function(event){
        var post = event.target.parentNode.parentNode.parentNode.parentNode;
        postId = post.dataset['postid'];
        event.preventDefault();
        $.ajax({
            method: 'GET',
            url: '/pet_life/public/delete-post/' + postId,
            error: function (request, status, error) {
                alert(request.responseText);
            }
        })
        .done(function(msg){
            if(msg['ok']){
                post.remove();
            }
        });
    });
}
deletePost();