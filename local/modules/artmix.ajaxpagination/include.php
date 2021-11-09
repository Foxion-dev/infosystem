<?php
/**
 * Created by Artmix.
 * User: Oleg Maksimenko <oleg.39style@gmail.com>
 * Date: 11.02.2016
 */

namespace Artmix\AjaxPagination {

    class AjaxPagination
    {

        /**
         *
         * @param string $content
         */
        public static function onAjaxRequest(&$content)
        {
            if (isset($_SERVER['HTTP_X_REQUESTED_WITH'], $_GET['ajax_page'])
                && ToLower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
            ) {

                list(, $content_html) = explode('<!--ax-ajax-pagination-separator-->', $content);

                if (is_string($content_html) && strlen(trim($content_html)) > 0) {
                    $content = $content_html;
                }
            }
        }

    }

}