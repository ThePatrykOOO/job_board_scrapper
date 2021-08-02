<?php


namespace App\Services\Scrappers;


use Symfony\Component\DomCrawler\Crawler;

abstract class AbstractScrapperService
{
    abstract protected function scrapTitle(Crawler $crawler) : string;

    abstract protected function scrapReferenceNumber(Crawler $crawler) : string;

    abstract protected function scrapShortDescription(Crawler $crawler) : string;

    abstract protected function scrapLongDescription(Crawler $crawler) : string;

    abstract protected function scrapLinkToApplication(Crawler $crawler) : string;

}
