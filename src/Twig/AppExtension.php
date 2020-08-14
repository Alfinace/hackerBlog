<?php
/*
 * @Author: your name
 * @Date: 2020-08-06 14:54:30
 * @LastEditTime: 2020-08-12 00:04:18
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
        $nbrRandom =rand(2,5);
        $tabText = explode(" ",$text);
        $tab =[];
        if(count($tabText)>$nbrRandom){
            for ($i=0; $i < $nbrRandom ; $i++) { 
                $tab[] = $tabText[$i];
             }
             $text= implode(" ",$tab).' ...';
        }
        return $text;
    }

}
