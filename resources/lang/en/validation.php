<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'فیلد :attribute باید be accepted.',
    'active_url'           => 'فیلد :attribute is not a valid URL.',
    'after'                => 'فیلد :attribute باید be a date after :date.',
    'after_or_equal'       => 'فیلد :attribute باید be a date after or equal to :date.',
    'alpha'                => 'فیلد :attribute may only contain letters.',
    'alpha_dash'           => 'فیلد :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'فیلد :attribute may only contain letters and numbers.',
    'array'                => 'فیلد :attribute باید be an array.',
    'before'               => 'فیلد :attribute باید be a date before :date.',
    'before_or_equal'      => 'فیلد :attribute باید be a date before or equal to :date.',
    'between'              => [
        'numeric' => 'فیلد :attribute باید be between :min and :max.',
        'file'    => 'فیلد :attribute باید be between :min and :max kilobytes.',
        'string'  => 'فیلد :attribute باید be between :min and :max characters.',
        'array'   => 'فیلد :attribute باید have between :min and :max items.',
    ],
    'boolean'              => 'فیلد :attribute field باید be true or false.',
    'confirmed'            => 'فیلد :attribute confirmation does not match.',
    'date'                 => 'فیلد :attribute is not a valid date.',
    'date_format'          => 'فیلد :attribute does not match the format :format.',
    'different'            => 'فیلد :attribute and :other باید be different.',
    'digits'               => 'فیلد :attribute باید be :digits digits.',
    'digits_between'       => 'فیلد :attribute باید be between :min and :max digits.',
    'dimensions'           => 'فیلد :attribute has invalid image dimensions.',
    'distinct'             => 'فیلد :attribute field has a duplicate value.',
    'email'                => 'فیلد :attribute باید آدرس ایمیل معتبر باشد.',
    'exists'               => 'فیلد selected :attribute is invalid.',
    'file'                 => 'فیلد :attribute باید be a file.',
    'filled'               => 'فیلد :attribute field باید have a value.',
    'image'                => 'فیلد :attribute باید be an image.',
    'in'                   => 'فیلد selected :attribute is invalid.',
    'in_array'             => 'فیلد :attribute field does not exist in :other.',
    'integer'              => 'فیلد :attribute باید be an integer.',
    'ip'                   => 'فیلد :attribute باید be a valid IP address.',
    'ipv4'                 => 'فیلد :attribute باید be a valid IPv4 address.',
    'ipv6'                 => 'فیلد :attribute باید be a valid IPv6 address.',
    'json'                 => 'فیلد :attribute باید be a valid JSON string.',
    'max'                  => [
        'numeric' => 'فیلد :attribute نباید بیشتر از :max باشد.',
        'file'    => 'فیلد :attribute نباید بیشتر از :max کیلوبایت باشد.',
        'string'  => 'فیلد :attribute نباید بیشتر از :max کاراکتر باشد.',
        'array'   => 'فیلد :attribute نباید بیشتر از :max مورد باشد.',
    ],
    'mimes'                => 'فیلد :attribute باید فایل با پسوند :values باشد.',
    'mimetypes'            => 'فیلد :attribute باید be a file of type: :values.',
    'min'                  => [
        'numeric' => 'فیلد :attribute نباید کمتر از :min باشد.',
        'file'    => 'فیلد :attribute نباید کمتر از :min کیلوبایت باشد.',
        'string'  => 'فیلد :attribute نباید کمتر از :min کاراکتر باشد.',
        'array'   => 'فیلد :attribute نباید کمتر از :min مورد باشد.',
    ],
    'not_in'               => 'فیلد selected :attribute is invalid.',
    'numeric'              => 'فیلد :attribute باید عدد باشد.',
    'present'              => 'فیلد :attribute field باید be present.',
    'regex'                => 'فیلد :attribute format is invalid.',
    'required'             => 'پرکردن فیلد :attribute الزامی است.',
    'required_if'          => 'فیلد :attribute field is required when :other is :value.',
    'required_unless'      => 'فیلد :attribute field is required unless :other is in :values.',
    'required_with'        => 'فیلد :attribute field is required when :values is present.',
    'required_with_all'    => 'فیلد :attribute field is required when :values is present.',
    'required_without'     => 'فیلد :attribute field is required when :values is not present.',
    'required_without_all' => 'فیلد :attribute field is required when none of :values are present.',
    'same'                 => 'فیلد :attribute and :other باید match.',
    'size'                 => [
        'numeric' => 'فیلد :attribute باید be :size.',
        'file'    => 'فیلد :attribute باید be :size kilobytes.',
        'string'  => 'فیلد :attribute باید be :size characters.',
        'array'   => 'فیلد :attribute باید contain :size items.',
    ],
    'string'               => 'فیلد :attribute باید بصورت رشته باشد.',
    'timezone'             => 'فیلد :attribute باید be a valid zone.',
    'unique'               => 'فیلد :attribute وارد شده، قبلا ثبت شده است.',
    'uploaded'             => 'فیلد :attribute failed to upload.',
    'url'                  => 'فیلد :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'email' => 'ایمیل',
        'password' => 'رمزعبور',
        'title' => 'عنوان',
        'keywords' => 'کلمه‌های کلیدی',
        'abstract' => 'چکیده',
        'volume_id' => 'شماره',
        'name' => 'نام',
        'num' => 'شماره تماس',
        'txt' => 'متن پیام',
    ],

];
