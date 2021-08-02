<?php

namespace App\Console\Commands;

use App\Repositories\JobOfferRepository;
use App\Services\Scrappers\GoldmanRecruitmentScrapperService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class JobBoardScrapperCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job-board:scrapper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Job scraping process';

    private GoldmanRecruitmentScrapperService $goldmanRecruitmentScrapperService;

    private JobOfferRepository $jobOfferRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GoldmanRecruitmentScrapperService $goldmanRecruitmentScrapperService, JobOfferRepository $jobOfferRepository)
    {
        parent::__construct();
        $this->goldmanRecruitmentScrapperService = $goldmanRecruitmentScrapperService;
        $this->jobOfferRepository = $jobOfferRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $goldmanRecruitmentJobsOffers = $this->goldmanRecruitmentScrapperService->getListOfJobsOffers();

        foreach ($goldmanRecruitmentJobsOffers as $jobsOffer) {
            try {
                $this->jobOfferRepository->create($jobsOffer);
            } catch (\Exception $exception) {
                Log::error("Problem with saving job offer",
                    ['reference_number' => $jobsOffer['reference_number'], 'message' => $exception->getMessage()]
                );
            }
        }

        return 0;
    }
}
