<?php
class messages
{

    function alertmessage($type, $content)
    {
        if($type=='success') {
            $clr='success';
        }
        else if($type=='danger') {
            $clr='danger';
        }
        else if($type=='info') {
            $clr='info';
        }
        else if($type=='warning') {
            $clr='warning';
        }
        $msg='<div class="alert alert-'.$clr.' alert-dismissible fade show" role="alert">'.$content.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        return $msg;

    }
}
