<?php

namespace App\Admin\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Farcades\Request;

class ApprovalButton extends AbstractTool
{
    protected $studentApplicationId;

    protected $user_id;
    
    public function __construct($user_id, $studentApplicationId){
        $this->user_id = $user_id;
        $this->studentApplicationId = $studentApplicationId;
    }



    protected function script(){
       return <<<SCRIPT
        $('.approval-button').on('click', function(){
            let userId = $(this).data('userId');
            let studentApplicationId = $(this).data('studentApplicationId');

            let data = {
                'user_id' : userId,
                'student_application_id' : studentApplicationId,
                _token: LA.token,
            }

            $.post("/admin/users/approval", data, 'json').done(() => {
                //location.reload();
            })
        });


       SCRIPT;
    }

    public function render(){
        Admin::script($this->script());

        return "<a class='btn btn-sm btn-success fa fa-check approval-button' data-user-id='{$this->user_id}' data-student-application-id='{$this->studentApplicationId}'>Approval</a>";
    }
}
