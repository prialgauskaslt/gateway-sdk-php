<?php
namespace Isign\Gateway\Tests\Query\File;

use Isign\Gateway\Query\File\UploadStatus;
use Isign\Gateway\Query\QueryInterface;
use Isign\Gateway\Tests\TestCase;

class UploadStatusTest extends TestCase
{
    const TOKEN = 'MyToken';

    /** @var UploadStatus */
    private $query;

    public function setUp()
    {
        $this->query = new UploadStatus(
            self::TOKEN
        );
    }

    public function testGetFields()
    {
        $fields = $this->query->getFields();

        $this->assertArrayHasKey('token', $fields);

        $this->assertSame(self::TOKEN, $fields['token']);
    }

    public function testGetAction()
    {
        $this->assertSame('file/upload/'.self::TOKEN.'/status', $this->query->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::GET, $this->query->getMethod());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Gateway\Result\File\UploadStatusResult', $this->query->createResult());
    }

    public function testHasValidationConstraints()
    {
        $collection = $this->query->getValidationConstraints();

        $this->assertInstanceOf(
            'Symfony\Component\Validator\Constraints\Collection',
            $collection
        );
    }
}
