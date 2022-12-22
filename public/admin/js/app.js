var xulyadin =
{

    init : function () {
        let _this = this;

        _this.showModal();
        _this.previewImg();
    },
    showModal()
    {
        $(".view-detail-post").click(function () {
            let $id = $(this).attr("data-id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                dataType : 'json',
                url:  '/admins/posts/'+$id+'/view',
                data: {id: $id },
                success: function( msg ) {
                    console.log(msg.post);
                    let html = '<div class="modal-dialog modal-lg">\n' +
                        '            <div class="modal-content">\n' +
                        '                <div class="modal-header">\n' +
                        '                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>\n' +
                        '                    <h4 class="modal-title">'+ msg.post.po_title +'</h4>\n' +
                        '                </div>\n' +
                        '                <div class="modal-body">'+ msg.post.po_content +'</div>\n' +
                        '                <div class="modal-footer">\n' +
                        '                    <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal"> Đóng </button>\n' +
                        '                </div>\n' +
                        '            </div>\n' +
                        '        </div>'
                    $("#modal-view-posts").html('').append(html);
                    $("#modal-view-posts").modal({
                        show : true,
                        backdrop : 'static'
                    });
                },
                error : function () {
                    console.log(" LOI AJAX ");
                }
            });
        })
    },
    previewImg()
    {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });
    }
}


$(function () {
    xulyadin.init();
})