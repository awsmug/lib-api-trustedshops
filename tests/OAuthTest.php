<?php

require( dirname( __FILE__ ) . '/Bootstrap.php' );

use AWSM\LibAPI\Examples\TrustedShopsAPI;
use AWSM\LibAPI\Examples\TrustedShopsAuth;
use AWSM\LibAPI\Examples\TrustedShopsReviews;
use PHPUnit\Framework\TestCase;

class OAuthTest extends TestCase {
    public function testAPIAPIFunction() {
		$auth  = new TrustedShopsAuth( TS_CLIENT_ID, TS_CLIENT_SECRET );
		$api   = new TrustedShopsAPI( $auth );
		$reviews = new TrustedShopsReviews( $api );
		
		$params = [
			'count' => 3,
			'status' => 'APPROVED',
			'orderBy' => 'rating'
		];

		$response = $api->request( '/reviews', 'GET', $params );
		
		$this->assertEquals( 5, $response->items[0]->rating );

		$result = $reviews->get( $params );

		// $api->reviews->get( $params );
	}
}