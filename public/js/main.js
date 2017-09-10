/**
 * Created by Mohammad on 2017-09-10.
 */
$(document).ready(function(){

    var number=1;
    $('.add-author').click(function (e) {
        e.preventDefault();
        number=number+1;
        var selectAuthor='<div class="form-group authors-div"><label for="author" class="col-md-2 control-label">نویسنده '+number+'</label><div class="col-md-6"><input id="author" placeholder="تایپ کنید" data-number="'+number+'" type="text" class="form-control get_profile" name="author[]"><div class="profile_target"></div></div></div>';
        $('.authors-div').last().after(selectAuthor);
    });

    $(document).on('keyup','.get_profile',function (e) {
        var $this=$(this);
        var pvalue=$this.val();
        if(pvalue.length>2) {
            var dataString = 'value=' + pvalue;
            $.ajax
            ({
                type: "POST",
                url: "/Process/GetProfile/",
                data: dataString,
                cache: false,
                success: function (response) {
                    alert(response);
                    $('.profile_target').html(response);
                    $this.next().show();
                    $(document).mouseup(function (e)
                    {
                        var container = $(".profile_target");

                        if (!container.is(e.target) // if the target of the click isn't the container...
                            && container.has(e.target).length === 0) // ... nor a descendant of the container
                        {
                            container.hide();
                        }
                    });
                    $('.user_select').click(function (e) {
                        e.preventDefault();
                        var userid=$(this).attr('data-userid');
                        $this.val($(this).html());
                        $this.attr('data-user',userid);
                        $this.trigger('change');
                        $('.profile_target').hide();
                    });
                }
            });
        }
    });

});