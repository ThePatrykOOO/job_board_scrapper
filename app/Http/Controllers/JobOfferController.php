<?php

namespace App\Http\Controllers;

use App\Http\Resources\JobOfferResource;
use App\Repositories\JobOfferRepository;

class JobOfferController extends Controller
{
    private JobOfferRepository $jobOfferRepository;

    public function __construct(JobOfferRepository $jobOfferRepository)
    {
        $this->jobOfferRepository = $jobOfferRepository;
    }

    public function index()
    {
        $jobOffers = $this->jobOfferRepository->all();
        return JobOfferResource::collection($jobOffers);
    }

    public function show(int $id)
    {
        $jobOffer = $this->jobOfferRepository->findOrFail($id);
        return new JobOfferResource($jobOffer);
    }
}
