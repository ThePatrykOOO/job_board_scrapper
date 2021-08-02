<?php

namespace Console\Commands;

use App\Models\JobOffer;
use App\Services\Scrappers\GoldmanRecruitmentScrapperService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class JobBoardScrapperCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testJobBoardScrapperSuccess()
    {
        $this->instance(
            GoldmanRecruitmentScrapperService::class,
            Mockery::mock(GoldmanRecruitmentScrapperService::class, function (MockInterface $mock) {
                $mock->shouldReceive('getListOfJobsOffers')->andReturn([
                    [
                        "title" => "Packaging Project Manager",
                        "reference_number" => "Nr ref. 192652\/7359",
                        "short_description" => "For our Client international leader in the lighting industry we are looking candidate for Packaging Project Manager.",
                        "long_description" => "Responsibilities: overall project management \u2013 including planning, project administration and coordination, creating artwork briefings and approval of artwork designs created by our artwork management agency, ensure providing packaging suppliers with suitable artwork designs, working together with design and marketing teams on finalization of graphic packaging guidelines, analysis and maintenance of project portfolio spreadsheets, packaging databases, initiating and implementation of packaging creation process improvements, graphic budget control, invoice checking vs requests, approval for payments, graphic consultancy & expertise across company, towards marketing, sales, purchasing, quality and\/ or other functions when required, safeguard legal and brand compliance by application of necessary guidelines and regulations. Requirements: affinity with design and eye for both details and bigger picture, excellent project management skills, flexible and pragmatic team player with strong interpersonal skills, inspiring commitment, and drive towards excellent results, experience in working in a multinational environment, virtual teams and dealing with complex stakeholder management, good communication and persuasion skills, ability to manage stress with tight deadlines and last-minute changes, experience in and knowledge of large packaging projects is a plus, written and verbal excellence in English. The offer: competetive salary and bonus scheme, social benefits package, international business environment.",
                        "link_to_application" => "https:\/\/my.goldmanrecruitment.pl\/pl\/aplikuj\/192652\/7359\/packaging-project-manager\/"
                    ],
                    [
                        "title" => "Finance Manager",
                        "reference_number" => "Nr ref. 192651\/7358",
                        "short_description" => "For our client international service company we are looking for Finance Manager.",
                        "long_description" => "Responsibilities: advising General Manager\u00a0 and Management Team on all matters relating to financial issues, controlling all financial and accountancy matters including month end reports, management accounts, cash flow management, statutory accounts, directing and controlling finance staff to ensure that they are appropriately motivated, overseeing all audit and internal control operations, ensuring adherence to financial laws and guidelines, overseeing review, and adhere to the budgets for each business department, ensuring that all of the company's financial practices are in line with statutory regulations and legislation, monitoring cash flow, accounts, and other financial transactions, supervising team members in the facilitation of day-to-day operations, including tracking financial data, invoicing, payroll, etc., contracting auditing services to ensure financial monitoring is up-to-date. Requirements: at least 5 years of experience in a similar role, In-depth knowledge of corporate finance and accounting principles, laws and best practices, solid knowledge of financial analysis and forecasting, excellent organizational and leadership skills, ACCA,\u00a0CPA\u00a0or other relevant qualification will be a definite asset. The offer: competetive salary and bonus scheme, social benefits package, international business environment.",
                        "link_to_application" => "https:\/\/my.goldmanrecruitment.pl\/pl\/aplikuj\/192651\/7358\/finance-manager\/"
                    ]
                ]);
            })
        );

        $this->artisan('job-board:scrapper')->assertExitCode(0);
        $this->assertEquals(2, JobOffer::query()->count());
    }
}
