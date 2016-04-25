<?php
namespace App;

trait AddRemoveSpeaker
{
	public function addSpeaker($speaker)
    {
        return $this->speakers()->attach($speaker);
    }

    public function removeSpeaker($speaker)
    {
        return $this->speakers()->detach($speaker);
    }
}