<?php

namespace EklundChristopher\ViewPress\Filters\Templates;

use EklundChristopher\ViewPress\Filters\TemplateHandler as Handler;

class AttachmentHandler extends Handler
{
    /**
     * Return an array of templates in order of precedence.
     *
     * ./attachments/{type}/{subtype}.php
     * ./attachments/{subtype}.php
     * ./attachments/{type}.php
     * ./attachments/attachment.php
     * ./types/single.php
     * ./index.php
     *
     * @param  array  $templates
     * @return array
     */
    public function templates(array $templates)
    {
        if ($attachment = get_queried_object()) {
            if (false !== strpos($attachment->post_mime_type, '/')) {
                list ($type, $subtype) = explode('/', $attachment->post_mime_type);
            } else {
                list ($type, $subtype) = array($attachment->post_mime_type, null);
            }

            if (! empty($subtype)) {
                $templates[] = sprintf('attachments/%s/%s.php', $type, $subtype);
                $templates[] = sprintf('attachments/%s.php', $subtype);
            }

            $templates[] = sprintf('attachments/%s.php', $type);
        }

        $templates[] = 'attachments/attachment.php';
        $templates[] = 'types/single.php';
        $templates[] = 'index.php';

        return $templates;
    }
}
