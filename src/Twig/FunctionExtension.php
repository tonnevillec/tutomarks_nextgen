<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FunctionExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        $default = ['is_safe' => ['html']];

        return [
            new TwigFunction('headerStyle2', [$this, 'getHeaderStyle2'], $default),
        ];
    }

    public function getHeaderStyle2(string $title, string $icon): string
    {
        return '<div class="section-heading style-2 mb-7 w-full mt-10">
            <h2 class="text-3xl mb-2">
                <i class="fa-solid fa-'.$icon.' text-indigo"></i>'.$title.'
            </h2>
            <div class="line"></div>
        </div>';
    }
}