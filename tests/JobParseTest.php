<?php

/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2015/10/22
 * Time: 9:20
 */
class JobParseTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Jenner\Crontab\Parser\JobParse
     */
    protected $job_parser;

    public function setUp()
    {
        $this->job_parser = new \Jenner\Crontab\Parser\JobParse();
    }

    /**
     * @dataProvider parseProvider
     * @param $raw
     * @param $time
     * @param $command
     */
    public function testParse($raw, $time, $command)
    {
        var_dump(func_get_args());
        $this->job_parser->parse($raw);
        $this->assertEquals($this->job_parser->time(), $time);
        $this->assertEquals($this->job_parser->command(), $command);
    }

    public function parseProvider(){
        return array(
            array('* * * * * ls -al > test.log', '* * * * *', 'ls -al > test.log'),
            array('* * * *  * ls -al > test.log', '* * * * *', 'ls -al > test.log'),
            array('* * * * * ls   -al > test.log', '* * * * *', 'ls -al > test.log'),
            array('* * * * * ls   -al  >  test.log', '* * * * *', 'ls -al > test.log'),
        );
    }
}