<?php

namespace SuhaibKotb\NovaAjaxText;

use Laravel\Nova\Fields\Field;

class AjaxText extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-ajax-text';

    /**
     * @param $endpoint
     * @return $this
     */
    public function get($endpoint)
    {
        $this->withMeta(['endpoint' => $endpoint]);

        return $this;
    }

    /**
     * @param $attribute
     * @return $this
     */
    public function parent($attribute)
    {
        $this->withMeta(['parent_attribute' => $attribute]);

        return $this;
    }

    /**
     * @return $this
     */
    public function alwaysDisabled()
    {
        $this->withMeta(['always_disabled' => true]);

        return $this;
    }
}
