<?php 
namespace App\Helpers;

use GuzzleHttp\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;

class SymfonySkeletonHelper {
	
	private static $client;
	private static $token;
	
	public static function getToken()
	{
		$user_data = session()->get('user_data');
		
		if(!$user_data){
			return redirect()->route('auth.login');
		}
		
		return [
			'token_key' => $user_data->token_key,
			'token_refresh' => $user_data->refresh_token_key
		];
	}
	
	public static function authenticate($email, $password)
	{	
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'POST', 
				'https://symfony-skeleton.q-tests.com/api/v2/token', [
					'headers' => [
						'accept' => 'application/json',
						'Content-Type' => 'application/json'
					],
					'body' => \json_encode([
						'email' => $email,
						'password' => $password
					]),
				]
			);
			
			return $res;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
	public static function getAuthHeader($headers=[])
	{
		$token = self::getToken();
		$headers = array_merge( [
			'Authorization' => 'Bearer '. $token['token_key']
		], $headers);
		
		return $headers;
	}
	
	public static function getAuthors($query=[])
	{
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'GET', 
				'https://symfony-skeleton.q-tests.com/api/v2/authors', [
					'headers' => self::getAuthHeader(['accept' => 'application/json']),
					'query' => [
						'orderBy' => \Arr::get($query, 'orderBy', 'id'),
						'direction' => \Arr::get($query, 'direction', 'desc'),
						'limit' => \Arr::get($query, 'limit', 12),
						'page' => \Arr::get($query, 'direction', 1),
						'query' => \Arr::get($query, 'query', ''),
					],
				]
			);
			
			$data = null;
			
			if($res){
				if($res->getStatusCode() == 200 && $res->getReasonPhrase() == 'OK'){
					$data = \json_decode($res->getBody()->getContents());
				}
			}
			
			return $data;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
	public static function getAuthor($id)
	{
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'GET', 
				'https://symfony-skeleton.q-tests.com/api/v2/authors/'.$id, [
					'headers' => self::getAuthHeader(['accept' => 'application/json'])
				]
			);
			
			$data = null;
			
			if($res){
				if($res->getStatusCode() == 200 && $res->getReasonPhrase() == 'OK'){
					$data = \json_decode($res->getBody()->getContents());
				}
			}
			
			return $data;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
	public static function createAuthor($data)
	{	
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'POST', 
				'https://symfony-skeleton.q-tests.com/api/v2/authors', [
					'headers' => self::getAuthHeader([
						'accept' => 'application/json', 
						'Content-Type' => 'application/json'
					]),
					'body' => \json_encode($data),
				]
			);
			
			$data = null;
			
			if($res){
				if($res->getStatusCode() == 200 && $res->getReasonPhrase() == 'OK'){
					$data = \json_decode($res->getBody()->getContents());
				}
			}
			
			return $data;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
	public static function deleteAuthor($id)
	{
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'DELETE', 
				'https://symfony-skeleton.q-tests.com/api/v2/authors/'.$id, [
					'headers' => self::getAuthHeader(['accept' => 'application/json'])
				]
			);
			
			$data = null;
			
			if($res){
				if($res->getStatusCode() == 204){
					$data = true;
				}
			}
			
			return $data;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
	public static function createBook($data)
	{	
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'POST', 
				'https://symfony-skeleton.q-tests.com/api/v2/books', [
					'headers' => self::getAuthHeader([
						'accept' => 'application/json', 
						'Content-Type' => 'application/json'
					]),
					'body' => \json_encode($data),
				]
			);
			
			$data = null;
			
			if($res){
				if($res->getStatusCode() == 200 && $res->getReasonPhrase() == 'OK'){
					$data = \json_decode($res->getBody()->getContents());
				}
			}
			
			return $data;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
	public static function deleteBook($id)
	{
		try{
			self::$client = new Client();
			$res = self::$client->request(
				'DELETE', 
				'https://symfony-skeleton.q-tests.com/api/v2/books/'.$id, [
					'headers' => self::getAuthHeader(['accept' => 'application/json'])
				]
			);
			
			$data = null;
			
			if($res){
				if($res->getStatusCode() == 204){
					$data = true;
				}
			}
			
			return $data;
		}
		catch (ClientErrorResponseException $e) {
			return false;
		}
	}
	
}