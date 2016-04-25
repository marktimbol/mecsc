<?php
namespace App;

trait Algolia
{
    public function getAlgoliaRecord()
    {
        /**
         * Load the categories relation so that it's available
         *  in the laravel toArray method
         */
        $this->roles;

       return $this->toArray();
    }
}