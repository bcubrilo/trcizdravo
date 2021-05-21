<?php
namespace Concrete\Package\ThemeTrcizdravo\Theme\Trcizdravo;


use Concrete\Core\Area\Layout\Preset\Provider\ThemeProviderInterface;
use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme implements ThemeProviderInterface
{
    public function registerAssets()
    {
        $this->providesAsset('css', 'bootstrap/*');
        $this->providesAsset('css', 'blocks/event_list');

//        $this->re('css', 'font-awesome');
        $this->requireAsset('javascript', 'jquery');
        $this->providesAsset('javascript', 'bootstrap/*');
        $this->requireAsset('javascript', 'picturefill');
        $this->providesAsset('javascript-conditional', 'html5-shiv');
        $this->providesAsset('javascript-conditional', 'respond');
        $this->providesAsset('javascript','localization/*');
    }

    protected $pThemeGridFrameworkHandle = 'bootstrap3';

    public function getThemeName()
    {
        return t('Trci zdravo');
    }

    public function getThemeDescription()
    {
        return t('Elegant, spacious theme with support for blogs, portfolios, layouts and more.');
    }

    /**
     * @return array
     */
    public function getThemeBlockClasses()
    {
        return [
            'feature' => ['feature-home-page'],
            'page_list' => [
                'recent-blog-entry',
                'blog-entry-list',
                'page-list-with-buttons',
                'block-sidebar-wrapped',
            ],
            'next_previous' => ['block-sidebar-wrapped'],
            'share_this_page' => ['block-sidebar-wrapped'],
            'content' => [
                'block-sidebar-wrapped',
                'block-sidebar-padded',
            ],
            'date_navigation' => ['block-sidebar-padded'],
            'topic_list' => ['block-sidebar-wrapped'],
            'testimonial' => ['testimonial-bio'],
            'image' => [
                'image-right-tilt',
                'image-circle',
            ],
        ];
    }

    /**
     * @return array
     */
    public function getThemeAreaClasses()
    {
        return [
            'Page Footer' => ['area-content-accent'],
        ];
    }

    /**
     * @return array
     */
    public function getThemeDefaultBlockTemplates()
    {
        return [
            'calendar' => 'bootstrap_calendar.php',
        ];
    }

    /**
     * @return array
     */
    public function getThemeResponsiveImageMap()
    {
        return [
            'large' => '900px',
            'medium' => '768px',
            'small' => '0',
        ];
    }

    /**
     * @return array
     */
    public function getThemeEditorClasses()
    {
        return [
            ['title' => t('Title Thin'), 'menuClass' => 'title-thin', 'spanClass' => 'title-thin', 'forceBlock' => 1],
            ['title' => t('Title Caps Bold'), 'menuClass' => 'title-caps-bold', 'spanClass' => 'title-caps-bold', 'forceBlock' => 1],
            ['title' => t('Title Caps'), 'menuClass' => 'title-caps', 'spanClass' => 'title-caps', 'forceBlock' => 1],
            ['title' => t('Image Caption'), 'menuClass' => 'image-caption', 'spanClass' => 'image-caption', 'forceBlock' => '-1'],
            ['title' => t('Standard Button'), 'menuClass' => '', 'spanClass' => 'btn btn-default', 'forceBlock' => '-1'],
            ['title' => t('Success Button'), 'menuClass' => '', 'spanClass' => 'btn btn-success', 'forceBlock' => '-1'],
            ['title' => t('Primary Button'), 'menuClass' => '', 'spanClass' => 'btn btn-primary', 'forceBlock' => '-1'],
        ];
    }

    /**
     * @return array
     */
    public function getThemeAreaLayoutPresets()
    {
        $presets = [
            [
                'handle' => 'left_sidebar',
                'name' => 'Left Sidebar',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-sm-4"></div>',
                    '<div class="col-sm-8"></div>',
                ],
            ],
            [
                'handle' => 'right_sidebar',
                'name' => 'Right Sidebar',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-sm-8"></div>',
                    '<div class="col-sm-4"></div>',
                ],
            ],
            [
                'handle' => 'slider_section_layout',
                'name' => 'Slider Section Layout',
                'container' => '<section id="sliderSection"><div class="row"></div></section>',
                'columns' => [
                    '<div class="col-sm-8"></div>',
                    '<div class="col-sm-4"></div>',
                ],
            ],
            [
                'handle' => 'two_columns_layout',
                'name' => 'Two Columns Layout',
                'container' => '<div class="row"></div>',
                'columns' => [
                    '<div class="col-md-6"></div>',
                    '<div class="col-md-6"></div>',
                ],
            ],
        ];

        return $presets;
    }
}
