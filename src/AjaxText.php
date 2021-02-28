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
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * Indicates if the element should be shown on the detail view.
     * @var bool
     */
    public $showOnDetail = false;

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

}
