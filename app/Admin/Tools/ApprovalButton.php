<?php

namespace App\Admin\Tools;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Tools\AbstractTool;
use Illuminate\Support\Farcades\Request;

class ApprovalButton extends AbstractTool
{
    protected $ApplicationId;

    protected $user_id;

    protected $type;
    
    public function __construct($user_id, $ApplicationId, $type){
        $this->user_id = $user_id;
        $this->ApplicationId = $ApplicationId;
        $this->type = $type;
    }



    protected function script(){
       return <<<SCRIPT
        $('.approval-button').on('click', function(){
            let userId = $(this).data('userId');
            let applicationId = $(this).data('applicationId');
            let url = $(this).data('url');

            let data = {
                'user_id' : userId,
                'application_id' : applicationId,
                _token: LA.token,
            }

            $.post(url, data, 'json').done(() => {
                //location.reload();
            })
        });


       SCRIPT;
    }

    public function render(){
        Admin::script($this->script());
        $url = ($this->type == "STUDENT")? '/admin/users/approval' : '/admin/drivers/approval';

        return "<a class='btn btn-sm btn-success fa fa-check approval-button' data-user-id='{$this->user_id}' data-application-id='{$this->ApplicationId}' data-url='{$url}'>Approval</a>";
    }
}
