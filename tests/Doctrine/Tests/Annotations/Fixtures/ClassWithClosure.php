<?php

namespace Doctrine\Tests\Annotations\Fixtures;

use Doctrine\Tests\Annotations\Fixtures\AnnotationTargetAll;
use Doctrine\Tests\Annotations\Fixtures\AnnotationTargetAnnotation;

/**
 * @AnnotationTargetAll("Foo")
 */
final class ClassWithClosure
{

    /**
     * @AnnotationTargetAll(@AnnotationTargetAnnotation)
     * @var string
     */
    public $value;

    /**
     * @AnnotationTargetAll(@AnnotationTargetAnnotation)
     *
     * @param   \Closure $callback
     * @return  \Closure
     */
    public function methodName(\Closure $callback)
    {
        return function() use ($callback) {
            return $callback;
        };
    }

    /**
     * @param   integer $year
     * @param   integer $month
     * @param   integer $day
     * @return  \Doctrine\Common\Collections\ArrayCollection
     */
    public function getEventsForDate($year, $month, $day){
        $extractEvents  = null; // check if date of item is inside day given
        $extractEvents  = $this->events->filter(function ($item) use ($year, $month, $day) {
            $leftDate   = new \DateTime($year.'-'.$month.'-'.$day.' 00:00');
            $rigthDate  = new \DateTime($year.'-'.$month.'-'.$day.' +1 day 00:00');
            return ( ( $leftDate <= $item->getDateStart() ) && ( $item->getDateStart() < $rigthDate ) );

            }
        );
        return $extractEvents;
    }

}
