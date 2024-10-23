<?php
/**
 * $content_view – виды, отображающие контент страниц;
 * $template_view — общий для всех страниц шаблон;
 * $data — массив, содержащий элементы контента страницы. Обычно заполняется в модели.
 */
class View 
{
	function generate($content_view, $template_view, $data = null)
	{
		include 'Application/Views/'.$template_view;
	}
}