<?php


namespace App\Repositories;


use App\Models\JobOffer;

class JobOfferRepository
{
    public function all()
    {
        return JobOffer::all();
    }

    public function create(array $data): JobOffer
    {
        $jobOffer = new JobOffer($data);
        $jobOffer->save();
        return $jobOffer;
    }

    public function findOrFail($id)
    {
        return JobOffer::query()->findOrFail($id);
    }
}
