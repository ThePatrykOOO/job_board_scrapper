<?php


namespace App\Services\Scrappers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class GoldmanRecruitmentScrapperService extends AbstractScrapperService implements ScrapperInterface
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getListOfJobsOffers(): array
    {
        $response = $this->client->get(config('external.goldmanrecruitment.job_offer_list_url'));
        $contentJobOfferList = $response->getBody()->getContents();
        $crawlerJobOfferList = new Crawler($contentJobOfferList);

        $jobOffersIds = $crawlerJobOfferList
            ->filter('#offers-list li')
            ->each(function (Crawler $node) {
                return (int)filter_var($node->filter('.item .title a')->attr('href'), FILTER_SANITIZE_NUMBER_INT);
            });

        $items = [];

        foreach ($jobOffersIds as $jobOffersId) {
            try {
                $items[] = $this->scrapSingleJobOfferProcess($jobOffersId);
            } catch (\Throwable $exception) {
                Log::error("Problem with scrapping single job offer",
                    ['job_offer_id' => $jobOffersId, 'message' => $exception->getMessage()]
                );
            }

        }
        return $items;
    }

    protected function scrapTitle(Crawler $crawler): string
    {
        return $crawler->filter('.title .h1-on-offer')->text();
    }

    protected function scrapReferenceNumber(Crawler $crawler): string
    {
        return $crawler->filter('.offerTop .justify-content-center .col-9 .number')->text();
    }

    protected function scrapShortDescription(Crawler $crawler): string
    {
        return $crawler->filter('.offerTop .justify-content-center .col-9 .lead')->text();
    }

    protected function scrapLongDescription(Crawler $crawler): string
    {
        return $crawler->filter('#jobsContent')->text();
    }

    protected function scrapLinkToApplication(Crawler $crawler): string
    {
        return $crawler->filter('.offerContainer .rightColumn .button a')->attr('href');
    }

    /**
     * @param int $jobOfferId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function scrapSingleJobOfferProcess(int $jobOfferId): array
    {
        $response = $this->client->get(config('external.goldmanrecruitment.single_job_offer_url') . $jobOfferId);
        $contentSingleJobOffer = $response->getBody()->getContents();

        $crawler = new Crawler($contentSingleJobOffer);

        return [
            'title' => $this->scrapTitle($crawler),
            'reference_number' => $this->scrapReferenceNumber($crawler),
            'short_description' => $this->scrapShortDescription($crawler),
            'long_description' => $this->scrapLongDescription($crawler),
            'link_to_application' => $this->scrapLinkToApplication($crawler),
        ];
    }
}
