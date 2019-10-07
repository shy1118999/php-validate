<?php
namespace App\Validate;
use App\Validate\Core\Base;

class IDMustBePositiveInt extends Base {
    protected $rule = [
        "id"=>"require|isPositiveInt",
    ];
    protected $message = [
        "id"=>"id必须是正整数",
    ];
}