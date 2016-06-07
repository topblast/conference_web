<?php
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
	// use DatabaseMigrations;
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
	
	public function testDatabase()
	{
		// Make call to application...

		//$this->assertEquals(0, $this->getConnection()->getRowCount('attendees'), "Pre-Condition");
		$this->seeNumRecords(11, 'attendees', ['salted_password' => '']);
		
	}
	
	/* public function test_blank_passwords()
	{
		//Attendee::create(['name'])
		$sodium = Attendees::blank()->get();
		$this->assertCount(11, $sodium->count());
	} */
}
