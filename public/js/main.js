/**
 * Created by Mohammad on 2017-09-10.
 */
$(document).ready(function(){

    var number=1;
    $('.add-author').click(function (e) {
        e.preventDefault();
        number=number+1;
        var selectAuthor='<div class="form-group authors-div">'+
            '<label for="author" class="col-md-2 control-label">نام نویسنده '+number+'</label>'+
            '<div class="col-md-6">'+
            '<input id="author" data-number="'+number+'" type="text" placeholder="تایپ کنید" class="form-control get_profile">'+
            '<div class="instant_box profile_target"></div>'+
            '<input name="author[]" data-number="'+number+'" type="hidden" class="author"></div></div>'+
            '<div class="form-group authors-div"><label for="email" class="col-md-2 control-label">ایمیل نویسنده '+number+'</label>'+
            '<div class="col-md-6"><input id="email" data-number="'+number+'" type="text" class="form-control email" name="email[]"></div></div>'+
            '<div class="form-group authors-div"><label for="affiliation" class="col-md-2 control-label">وابستگی نویسنده '+number+'</label>'+
            '<div class="col-md-6">'+
            '<textarea id="affiliation" data-number="'+number+'" placeholder="تایپ کنید" class="form-control get_affiliation"></textarea>'+
            '<div class="instant_box affiliation_target"></div>'+'' +
            '<input name="affiliation[]" data-number="'+number+'" type="hidden" class="affiliation"></div></div>';
        $('.authors-div').last().after(selectAuthor);
    });

    $(document).on('keyup','.get_profile',function () {
        var $this=$(this);
        var pvalue=$this.val();
        if(pvalue.length>2) {

            var dataString = {
                value: pvalue,
                number: $this.attr('data-number')
            };

            $.ajax
            ({
                headers: { 'X-CSRF-Token' : $('[name="_token"]').val() },
                type: "POST",
                url: "/Process/GetProfile",
                data: dataString,
                success: function (response) {
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
                        $this.val($(this).attr('data-name'));
                        $('.author[data-number="'+$this.attr('data-number')+'"]').val(userid);
                        $('.email[data-number="'+$this.attr('data-number')+'"]').val($(this).attr('data-email'));
                        $('.profile_target').hide();
                    });
                }
            });
        }
    });

    $(document).on('keyup','.get_affiliation',function () {
        var $this=$(this);
        var pvalue=$this.val();
        if(pvalue.length>2) {

            var dataString = {
                value: pvalue
            };

            $.ajax
            ({
                headers: { 'X-CSRF-Token' : $('[name="_token"]').val() },
                type: "POST",
                url: "/Process/GetAffiliation",
                data: dataString,
                success: function (response) {
                    $('.affiliation_target').html(response);
                    $this.next().show();
                    $(document).mouseup(function (e)
                    {
                        var container = $(".affiliation_target");

                        if (!container.is(e.target) // if the target of the click isn't the container...
                            && container.has(e.target).length === 0) // ... nor a descendant of the container
                        {
                            container.hide();
                        }
                    });
                    $('.affiliation_select').click(function (e) {
                        e.preventDefault();
                        var userid=$(this).attr('data-affiliationid');
                        $this.val($(this).html());
                        $('.affiliation[data-number="'+$this.attr('data-number')+'"]').val(userid);
                        $('.affiliation_target').hide();
                    });
                }
            });
        }
    });

});