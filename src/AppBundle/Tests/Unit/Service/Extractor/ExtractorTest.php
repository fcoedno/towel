<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 22:15
 */

namespace AppBundle\Tests\Unit\Service\Extractor;

use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Extractor\Dto\Person;
use PHPUnit\Framework\TestCase;

class ExtractorTest extends TestCase
{
    /**
     * @test
     */
    public function extractPeople_ValidPeopleXmlGiven_ShouldReturnACollectionOfPerson()
    {
        $people = [
            (new Person())
                ->setPersonid(1)
                ->setPersonname('Name 1')
                ->setPhones(['2345678', '1234567']),
            (new Person())
                ->setPersonid(2)
                ->setPersonname('Name 2')
                ->setPhones(['4444444']),
            (new Person())
                ->setPersonid(3)
                ->setPersonname('Name 3')
                ->setPhones(['7777777', '8888888'])
        ];

        $extractor = new Extractor();
        $extracted = $extractor->extractPeople(file_get_contents(__DIR__ . '/../../../Resources/people.xml'));
        $this->assertEquals($people, $extracted);
    }
}