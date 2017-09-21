<?php
/**
 * (c) Artem Ostretsov <artem@ostretsov.ru>
 * Created at 21.09.17 11:09.
 */

namespace Tests\Model\ResponseTransformer;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Sci\API\Client\Model\ResponseTransformer\EventSearchResponseTransformer;
use Sci\API\Client\Model\Wrapper\EventSearchResponseWrapper;

class EventSearchResponseTransformerTest extends TestCase
{
    public function testTransform()
    {
        $streamMock = $this->getMockBuilder(StreamInterface::class)->getMock();
        $streamMock->expects($this->once())
            ->method('__toString')
            ->willReturn($this->getResponseBody());

        $responseMock = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $responseMock->expects($this->once())
            ->method('getBody')
            ->willReturn($streamMock);

        $transformer = new EventSearchResponseTransformer();
        $object = $transformer->transform($responseMock);

        $this->assertInstanceOf(EventSearchResponseWrapper::class, $object);
    }

    private function getResponseBody(): string
    {
        return <<<'RESPONSE'
{
   "hits": 85,
   "strict": true,
   "events": [
      {
         "id": 4435,
         "default_domain_link": "https://lomonosov-msu.ru/rus/event/4435/",
         "type": {
            "id": 1
         },
         "type_string": "Конференция",
         "attendance_type": 0,
         "attendance_type_string": "Только очная форма",
         "short_name": "КИМО-2018",
         "full_name": "III Всероссийская научная конференция молодых ученых «Комплексные исследования Мирового океана»",
         "location": {
            "id": 820,
            "title": "Санкт-Петербург",
            "parent": {
               "id": 308,
               "title": "Санкт-Петербург",
               "parent": {
                  "id": 1,
                  "title": "Россия"
               }
            }
         },
         "event_timezone": "Europe/Moscow",
         "registration_start_date": "01.09.2017 00:00",
         "registration_end_date": "15.11.2017 00:00",
         "event_start_date": "21.05.2018 09:00",
         "event_end_date": "25.05.2018 17:00",
         "registration_status": 1,
         "logo_url": "https://foobarhost/file/event/4435/rus_logo_00437982b5d844b79a59b5868ae69b24ea990e98.jpg",
         "has_sections": true,
         "is_request_only_of_leaf_section": false,
         "section_title": "Секция",
         "has_roles": true,
         "updated_at": 1504513635,
         "language_settings": [
            {
               "language": "ukr",
               "availability_status": 0
            },
            {
               "language": "eng",
               "availability_status": 0
            },
            {
               "language": "rus",
               "availability_status": 1
            }
         ]
      },
      {
         "id": 4407,
         "default_domain_link": "https://lomonosov-msu.ru/rus/event/4407/",
         "type": {
            "id": 1
         },
         "type_string": "Конференция",
         "attendance_type": 0,
         "attendance_type_string": "Только очная форма",
         "short_name": "МиТУР 2018",
         "full_name": "3-я Международная молодёжная конференция «Мировоззрение и технологии устойчивого развития»",
         "location": {
            "id": 836,
            "title": "Тюмень",
            "parent": {
               "id": 318,
               "title": "Тюменская область",
               "parent": {
                  "id": 1,
                  "title": "Россия"
               }
            }
         },
         "event_timezone": "Europe/Moscow",
         "registration_start_date": "23.05.2017 10:00",
         "registration_end_date": "01.11.2017 19:00",
         "event_start_date": "25.04.2018 09:00",
         "event_end_date": "27.04.2018 19:00",
         "registration_status": 0,
         "logo_url": "https://foobarhost/blank/event.png",
         "has_sections": false,
         "is_request_only_of_leaf_section": false,
         "section_title": "Секция",
         "has_roles": false,
         "updated_at": 1495650961,
         "language_settings": [
            {
               "language": "rus",
               "availability_status": 1
            },
            {
               "language": "eng",
               "availability_status": 2
            },
            {
               "language": "ukr",
               "availability_status": 2
            }
         ]
      }
   ]
}
RESPONSE;
    }
}