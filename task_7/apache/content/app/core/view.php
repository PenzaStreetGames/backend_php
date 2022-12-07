<?php
class View
{
    function generate($content_view, $data = null, $template_view = "TemplateView.php")
    {
        include 'app/views/'.$template_view;
    }
}