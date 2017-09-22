/**
 * Created by Mohammad on 2017-09-10.
 */
$(document).ready(function(){

    $('.add-author').click(function (e) {
        e.preventDefault();
        var number=parseInt($('.authors-div').last().attr('data-number'))+1;
        var selectAuthor='<div class="form-group authors-div" data-number="'+number+'">'+
            '<label for="author" class="col-md-2 control-label">نام نویسنده</label>'+
            '<div class="col-md-6">'+
            '<input autocomplete="off" id="author" data-number="'+number+'" type="text" placeholder="نام و یا نام خانوادگی را تایپ کنید" class="form-control get_profile" name="authornew[]">'+
            '<div class="instant_box profile_target"></div>'+
            '<input name="author[]" data-number="'+number+'" type="hidden" class="author">'+
            '</div>'+
            '<div class="col-md-2" style="padding: 0">'+
            '<a href="#" data-number="'+number+'" class="btn btn-danger remove-author"><i class="fa fa-remove"></i> حذف نویسنده</a>'+
            '</div>'+
            '</div>'+
            '<div class="form-group authors-div" data-number="'+number+'"><label for="email" class="col-md-2 control-label">ایمیل نویسنده</label>'+
            '<div class="col-md-6"><input id="email" data-number="'+number+'" type="text" class="form-control email" name="email[]"></div></div>'+
            '<div class="form-group authors-div" data-number="'+number+'"><label for="affiliation" class="col-md-2 control-label">وابستگی نویسنده</label>'+
            '<div class="col-md-6">'+
            '<textarea autocomplete="off" id="affiliation" data-number="'+number+'" placeholder="تایپ کنید" class="form-control get_affiliation" name="affiliationnew[]"></textarea>'+
            '<div class="instant_box affiliation_target"></div>'+'' +
            '<input name="affiliation[]" data-number="'+number+'" type="hidden" class="affiliation"></div></div>';
        $('.authors-div').last().after(selectAuthor);
    });

    $('.add-figure').click(function (e) {
        e.preventDefault();
        var number=parseInt($('.fig-number').last().attr('data-number'))+1;
        var selectFig='<div class="form-group figures-div" data-number="'+number+'">'+
            '<label for="name_figure" class="col-md-2 control-label">نام جدول یا شکل<span class="label-desc">مثال: جدول 1</span></label>'+

        '<div class="col-md-6">'+
            '<input id="name_figure" type="text" data-number="'+number+'" class="form-control" name="name_figure[]">'+
            '</div>'+
            '<div class="col-md-2 noselect">'+
            '<span class="fig-find">[figure-</span><span class="fig-find fig-number" data-number="'+number+'">'+number+'</span><span class="fig-find">]</span>'+
            '</div>'+
            '<div class="col-md-2" style="padding: 0">'+
            '<a href="#" data-number="'+number+'" class="btn btn-danger remove-figure"><i class="fa fa-remove"></i> حذف</a>'+
            '</div>'+
            '</div>'+

            '<div class="form-group figures-div" data-number="'+number+'">'+
            '<label for="caption_figure" class="col-md-2 control-label">کپشن</label>'+

            '<div class="col-md-6">'+
            '<input id="caption_figure" type="text" data-number="'+number+'" class="form-control" name="caption_figure[]">'+
            '</div>'+
            '</div>'+

            '<div class="form-group figures-div" data-number="'+number+'">'+
            '<label for="url_figure1" class="col-md-2 control-label">تصویر</label>'+

            '<div class="col-md-6">'+
            '<input id="url_figure'+number+'" type="text" data-number="'+number+'" class="form-control" name="url_figure[]">'+
            '</div>'+
            '<a class="btn btn-default iframe-btn" type="button" href="/filemanager/dialog.php?type=1&subfolder=&editor=mce_0&lang=eng&fldr=&field_id=url_figure'+number+'">انتخاب</a>'+
            '</div>'+

            '<div class="form-group figures-div" data-number="'+number+'">'+
            '<label for="desc_figure" class="col-md-2 control-label">توضیح بیشتر</label>'+

        '<div class="col-md-6">'+
            '<input id="desc_figure" type="text" data-number="'+number+'" class="form-control" name="desc_figure[]">'+
            '</div>'+
            '</div>';
        $('.figures-div').last().after(selectFig);
        $('.iframe-btn').fancybox({
            'width'		: 900,
            'height'	: 600,
            'type'		: 'iframe',
            'autoScale'    	: false
        });
    });

    $(document).on('click','.remove-author',function (e) {
        e.preventDefault();
        var number=$(this).attr('data-number');
        $('.authors-div[data-number="'+number+'"]').remove();
    });

    $(document).on('click','.remove-figure',function (e) {
        e.preventDefault();
        var number=$(this).attr('data-number');
        $('.figures-div[data-number="'+number+'"]').remove();
        var num=1;
        $('.fig-number').each(function() {
            $(this).html(num);
            $(this).attr('data-number',num);
            num=num+1;
        });
        var num2=1;
        var num3=1;
        $('.figures-div').each(function() {
            $(this).attr('data-number',num2);
            if(num3%4==0){
                num2=num2+1;
            }
            num3=num3+1;
        });
        var num4=2;
        $('.remove-figure').each(function() {
            $(this).attr('data-number',num4);
            num4=num4+1;
        });
    });

    $(document).on('keyup','.get_profile',function () {
        var $this=$(this);
        var pvalue=$this.val();
        if(pvalue.length>=2) {

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
                        if(userid==0){
                            $this.val(pvalue);
                        }else{
                            $this.val($(this).attr('data-name'));
                        }
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
        if(pvalue.length>=2) {

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
                        if(userid==0){
                            $this.val(pvalue);
                        }else{
                            $this.val($(this).html());
                        }
                        $('.affiliation[data-number="'+$this.attr('data-number')+'"]').val(userid);
                        $('.affiliation_target').hide();
                    });
                }
            });
        }
    });

    $('.references_new').keyup(function () {
        var value=$(this).val();
        var dataString = {
            value: value
        };
        $.ajax
        ({
            headers: { 'X-CSRF-Token' : $('[name="_token"]').val() },
            type: "POST",
            url: "/Process/DoRefs",
            data: dataString,
            success: function (response) {
                $('.reference_place').html(response);
            }
        });
    });

    $('.fancy').fancybox({
        'width'		: 900,
        'height'	: 600,
        'type'		: 'iframe',
        'autoScale'    	: false
    });

});