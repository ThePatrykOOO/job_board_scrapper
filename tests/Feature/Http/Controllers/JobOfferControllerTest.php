<?php

namespace Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class JobOfferControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnAllJobOffersSuccess()
    {
        JobOffer::factory()->count(3)->create();

        $response = $this->get('/api/job-offers');
        $response->assertStatus(JsonResponse::HTTP_OK);

        $data = $response->json()['data'];
        $this->assertCount(3, $data);
    }

    public function testShowSingleJobOffer()
    {
        $jobOffer = JobOffer::factory()->create();

        $response = $this->get('/api/job-offers/' . $jobOffer->id);
        $response->assertStatus(JsonResponse::HTTP_OK);

        $data = $response->json()['data'];
        $this->assertEquals($jobOffer->id, $data['id']);
    }

    public function testShowSingleJobOfferNotFound()
    {
        $response = $this->get('/api/job-offers/0');
        $response->assertStatus(JsonResponse::HTTP_NOT_FOUND);
    }
}
