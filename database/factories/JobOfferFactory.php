<?php

namespace Database\Factories;

use App\Models\JobOffer;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobOfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobOffer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => "Packaging Project Manager",
            "reference_number" => "Nr ref. 192652\/7359",
            "short_description" => "For our Client international leader in the lighting industry we are looking candidate for Packaging Project Manager.",
            "long_description" => "Responsibilities: overall project management \u2013 including planning, project administration and coordination, creating artwork briefings and approval of artwork designs created by our artwork management agency, ensure providing packaging suppliers with suitable artwork designs, working together with design and marketing teams on finalization of graphic packaging guidelines, analysis and maintenance of project portfolio spreadsheets, packaging databases, initiating and implementation of packaging creation process improvements, graphic budget control, invoice checking vs requests, approval for payments, graphic consultancy & expertise across company, towards marketing, sales, purchasing, quality and\/ or other functions when required, safeguard legal and brand compliance by application of necessary guidelines and regulations. Requirements: affinity with design and eye for both details and bigger picture, excellent project management skills, flexible and pragmatic team player with strong interpersonal skills, inspiring commitment, and drive towards excellent results, experience in working in a multinational environment, virtual teams and dealing with complex stakeholder management, good communication and persuasion skills, ability to manage stress with tight deadlines and last-minute changes, experience in and knowledge of large packaging projects is a plus, written and verbal excellence in English. The offer: competetive salary and bonus scheme, social benefits package, international business environment.",
            "link_to_application" => "https:\/\/my.goldmanrecruitment.pl\/pl\/aplikuj\/192652\/7359\/packaging-project-manager\/"
        ];
    }
}
