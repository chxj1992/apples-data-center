<?php namespace Chxj1992\ApplesDataCenter\Tests;

use Chxj1992\ApplesDataCenter\App\Http\Controllers\CruiseController;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->response->getContent(), $this->app->version()
        );
    }

    public function testA(){
        CruiseController::itinerariesByMonth();
    }
}
