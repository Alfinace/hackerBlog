<?php
/*
 * @Author: your name
 * @Date: 2020-08-06 14:54:30
 * @LastEditTime: 2020-08-10 11:15:39
 * @LastEditors: Please set LastEditors
 * @Description: In User Settings Edit
 * @FilePath: /cours-symfony-container/src/Twig/AppExtension.php
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('shortly',[$this,'sortlyFunction'])
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('plusiraze', [$this, 'doSomething']),
        ];
    }

    public function doSomething(int $count, string $sigular, string $plurial):string
    {
        $result  = ($count == 1) ? $sigular : $plurial ;    

        return "$count $result";
    }

    public function sortlyFunction(string $text):string
    {
        $tabText = explode(" ",$text);
        $tab =[];
        if(count($tabText)>10){
            for ($i=0; $i < 10 ; $i++) { 
                $tab[] = $tabText[$i];
             }
             $text= implode(" ",$tab).' ...';
        }
        return $text;
    }

}
