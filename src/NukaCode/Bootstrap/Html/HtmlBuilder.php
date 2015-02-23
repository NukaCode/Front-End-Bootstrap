<?php namespace NukaCode\Bootstrap\Html;

use Illuminate\Html\HtmlBuilder as BaseHtmlBuilder;

class HtmlBuilder extends BaseHtmlBuilder {

    public function linkImage($url, $imageSrc, $attributes = [], $https = null)
    {
        $url = $this->url->to($url, $https);

        return '<a href="' . $url . '"' . static::attributes($attributes) . '>' . $imageSrc . '</a>';
    }

    public function linkRouteImage($route, array $parameters, $imageSrc, $attributes = [], $https = null)
    {
        $url = $this->url->route($route, $parameters, $https);

        return '<a href="' . $url . '"' . static::attributes($attributes) . '>' . $imageSrc . '</a>';
    }

    public function linkIcon($url, $iconClasses, $iconText = null, $attributes = [], $https = null)
    {
        $url = $this->url->to($url, $https);

        return '<a href="' . $url . '"' . static::attributes($attributes) . '><i class="' . $iconClasses . '"></i> ' . $iconText . '</a>';
    }

    public function linkRouteIcon($route, array $parameters, $iconClasses, $iconText = null, $attributes = [],
                                  $https = null)
    {
        $url = $this->url->route($route, $parameters, $https);

        return '<a href="' . $url . '"' . static::attributes($attributes) . '><i class="' . $iconClasses . '"></i> ' . $iconText . '</a>';
    }

    public function span($value, $attributes = [])
    {
        return '<span' . static::attributes($attributes) . '>' . $value . '</span>';
    }

    public function bold($value, $attributes = [])
    {
        return '<strong' . static::attributes($attributes) . '>' . $value . '</strong>';
    }

    public function italic($value, $attributes = [])
    {
        return '<em' . static::attributes($attributes) . '>' . $value . '</em>';
    }

    public function delete($value, $attributes = [])
    {
        return '<del' . static::attributes($attributes) . '>' . $value . '</del>';
    }

    public function strike($value, $attributes = [])
    {
        return '<s' . static::attributes($attributes) . '>' . $value . '</s>';
    }

    public function insert($value, $attributes = [])
    {
        return '<ins' . static::attributes($attributes) . '>' . $value . '</ins>';
    }

    public function underline($value, $attributes = [])
    {
        return '<u' . static::attributes($attributes) . '>' . $value . '</u>';
    }

    public function mark($value, $attributes = [])
    {
        return '<mark' . static::attributes($attributes) . '>' . $value . '</mark>';
    }

    public function small($value, $attributes = [])
    {
        return '<small' . static::attributes($attributes) . '>' . $value . '</small>';
    }

    public function code($value, $attributes = [])
    {
        return '<code' . static::attributes($attributes) . '>' . e($value) . '</code>';
    }

    public function lead($value)
    {
        return '<p class="lead">' . $value . '</p>';
    }

    public function quote($value, $source = null)
    {
        $source = $source == null ? null : '<footer>' . $source . '</footer>';

        return '<blockquote><p>' . $value . '</p>' . $source . '</blockquote>';
    }

    public function description($list, $attributes = [])
    {
        $html = '';

        foreach ($list as $bold => $text) {
            $html .= '<dt>' . $bold . '</dt>';
            $html .= '<dd>' . $text . '</dd>';
        }

        return '<dl' . static::attributes($attributes) . '>' . $html . '</dl>';
    }

    public function kbd($keys)
    {
        if (is_array($keys)) {
            return '<kbd>' . implode(' + ', array_map([$this, 'kbd'], $keys)) . '</kbd>';
        }

        return '<kbd>' . $keys . '</kbd>';
    }

    public function embed($url, $aspect = '16by9')
    {
        $validAspects = ['16by9', '4by3'];

        if (! in_array($aspect, $validAspects)) {
            throw new \InvalidArguementException('Aspect ratio not recognized.');
        }

        return '
            <div class="embed-responsive embed-responsive-' . $aspect . '">
                <iframe class="embed-responsive-item" src="' . $url . '"></iframe>
            </div>';
    }

    public function iframe($url, $attributes = [])
    {
        return '<iframe src="' . $url . '"' . static::attributes($attributes) . '></iframe>';
    }
}