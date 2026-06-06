<?php

namespace Laraliveui;

use Illuminate\View\Compilers\ComponentTagCompiler;

class LaraliveuiTagCompiler extends ComponentTagCompiler
{
    public function componentString(string $component, array $attributes)
    {
        if ($component === 'laraliveui::delegate-component') {
            $component = $attributes['component'];

            $class = \Illuminate\View\AnonymousComponent::class;

            return "<?php if (!Laraliveui::componentExists(\$name = {$component})) throw new \Exception(\"LaraLiveUI component [{\$name}] does not exist.\"); ?>##BEGIN-COMPONENT-CLASS##@component('{$class}', 'laraliveui::' . {$component}, [
    'view' => (app()->version() >= 12 ? hash('xxh128', 'laraliveui') : md5('laraliveui')) . '::' . {$component},
    'data' => \$__env->getCurrentComponentData(),
])
<?php \$component->withAttributes(\$attributes->getAttributes()); ?>";
        }

        return parent::componentString($component, $attributes);
    }

    protected function compileOpeningTags(string $value)
    {
        $pattern = "/
            <
                \s*
                laraliveui[\:]([\w\-\:\.]*)
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                @(?:class)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                @(?:style)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                (\:\\\$)(\w+)
                            )
                            |
                            (?:
                                [\w\-:.@%]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
                (?<![\/=\-])
            >
        /x";

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            return $this->componentString('laraliveui::'.$matches[1], $attributes);
        }, $value);
    }

    protected function compileSelfClosingTags(string $value)
    {
        $pattern = "/
            <
                \s*
                laraliveui[\:]([\w\-\:\.]*)
                \s*
                (?<attributes>
                    (?:
                        \s+
                        (?:
                            (?:
                                @(?:class)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                @(?:style)(\( (?: (?>[^()]+) | (?-1) )* \))
                            )
                            |
                            (?:
                                \{\{\s*\\\$attributes(?:[^}]+?)?\s*\}\}
                            )
                            |
                            (?:
                                (\:\\\$)(\w+)
                            )
                            |
                            (?:
                                [\w\-:.@%]+
                                (
                                    =
                                    (?:
                                        \\\"[^\\\"]*\\\"
                                        |
                                        \'[^\']*\'
                                        |
                                        [^\'\\\"=<>]+
                                    )
                                )?
                            )
                        )
                    )*
                    \s*
                )
            \/>
        /x";

        return preg_replace_callback($pattern, function (array $matches) {
            $this->boundAttributes = [];

            $attributes = $this->getAttributesFromAttributeString($matches['attributes']);

            if (isset($attributes['slot'])) {
                $slot = $attributes['slot'];

                unset($attributes['slot']);

                return '@slot('.$slot.') ' . $this->componentString('laraliveui::'.$matches[1], $attributes)."\n@endComponentClass##END-COMPONENT-CLASS##" . ' @endslot';
            }

            return $this->componentString('laraliveui::'.$matches[1], $attributes)."\n@endComponentClass##END-COMPONENT-CLASS##";
        }, $value);
    }

    protected function compileClosingTags(string $value)
    {
        return preg_replace("/<\/\s*laraliveui[\:][\w\-\:\.]*\s*>/", ' @endComponentClass##END-COMPONENT-CLASS##', $value);
    }
}
