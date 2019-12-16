<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Firefox\FirefoxDriver;
use Facebook\WebDriver\Firefox\FirefoxProfile;
use Facebook\WebDriver\WebDriverExpectedCondition;
use GuzzleHttp\Client;

class TestController extends Controller
{



    public function login()
    {
    	$mail = 'Thanhbinhkmadev';
    	$pass = 'Thanhbinh198x';
    	$host = 'http://localhost:4444/wd/hub';
    	$caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();

        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ';
		$profile->setPreference('general.useragent.override', $userAgentChange);
		
		$capss = DesiredCapabilities::firefox();
		$capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
    	$driver->get('https://accounts.google.com/ServiceLogin/identifier?service=youtube&uilel=3&passive=true&continue=https%3A%2F%2Fwww.youtube.com%2Fsignin%3Faction_handle_signin%3Dtrue%26app%3Ddesktop%26hl%3Den%26next%3D%252F&hl=en&ec=65620&flowName=GlifWebSignIn&flowEntry=AddSession');
    	sleep(5);
    	$driver->findElement(WebDriverBy::id("Email"))->sendKeys($mail);
    	sleep(1	);
    	$driver->findElement((WebDriverBy::id('next')))->click();
    	sleep(2);
    	$driver->findElement(WebDriverBy::id('Passwd'))->sendKeys($pass);
    	sleep(2);
    	$driver->findElement((WebDriverBy::id('signIn')))->click();
    	sleep(5);

    }

    public function kma()
    {
    	$mail = 'AT130506';
    	$pass = 'thanhbinh98';
    	$host = 'http://localhost:4444/wd/hub';
    	$caps = DesiredCapabilities::chrome();
        $prefs = array();
        $options = new ChromeOptions();

        $prefs['profile.default_content_setting_values.notifications'] = 2;
        $caps->setCapability(ChromeOptions::CAPABILITY, $options);
        $profile = new FirefoxProfile();
        $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ';
		$profile->setPreference('general.useragent.override', $userAgentChange);
		
		$capss = DesiredCapabilities::firefox();
		$capss->setCapability(FirefoxDriver::PROFILE, $profile);
        $driver = RemoteWebDriver::create($host, $capss);
    	$driver->get('http://qldt.actvn.edu.vn/CMCSoft.IU.Web.info/Login.aspx');
    	sleep(5);
    	$driver->findElement(WebDriverBy::id("txtUserName"))->sendKeys($mail);
    	sleep(2);
    	$driver->findElement(WebDriverBy::id('txtPassword'))->sendKeys($pass);
    	sleep(2);
    	$driver->findElement((WebDriverBy::id('btnSubmit')))->click();
    	sleep(3);
    	$driver->get('http://qldt.actvn.edu.vn/CMCSoft.IU.Web.info/StudyRegister/StudyRegister.aspx');
    	sleep(3);
    }

    public function test_api()
    {
    	$client = new \GuzzleHttp\Client();

    	$response = $client->request('get','http://api.tovicorp.com/getNew');
    	$api = json_decode($response->getBody()->getContents(),1);
      
        if($api['status'] == true){
        	$mailfb = 'Thanhbinhkmadev@gmail.com';
        	$passfb = 'Thanhbinh198x';

        	$mailtw = 'apkvi.com@gmail.com';
            $passtw = 'apkvi12#';


        	$host = 'http://localhost:4444/wd/hub';
        	$caps = DesiredCapabilities::chrome();
            $prefs = array();
            $options = new ChromeOptions();

            $prefs['profile.default_content_setting_values.notifications'] = 2;
            $caps->setCapability(ChromeOptions::CAPABILITY, $options);
            $profile = new FirefoxProfile();
            $userAgentChange = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ';
    		$profile->setPreference('general.useragent.override', $userAgentChange);
    		
    		$capss = DesiredCapabilities::firefox();
    		$capss->setCapability(FirefoxDriver::PROFILE, $profile);
            $driver = RemoteWebDriver::create($host, $capss);
            
            
        	$driver->get('https://vi-vn.facebook.com/');
        	sleep(2);
        	$driver->findElement(WebDriverBy::id("email"))->sendKeys($mailfb);
        	sleep(2);
        	$driver->findElement(WebDriverBy::id('pass'))->sendKeys($passfb);
        	sleep(2);
        	$driver->findElement((WebDriverBy::cssSelector('#loginbutton > input[type="submit"]')))->click();
        	sleep(2);
            $cookie =$driver->manage()->getCookies();
            // dd($cookie);
            // header("Refresh:0");
        	$driver->findElement((WebDriverBy::name('xhpc_message')))->sendKeys($api['data']['new']);
        	sleep(5);
            
            $driver->wait(10, 1000)->until(
              WebDriverExpectedCondition::visibilityOfElementLocated(WebDriverBy::cssSelector("div#pagelet_composer button.selected"))
            );
        	$elements  = $driver->findElement(WebDriverBy::cssSelector("div#pagelet_composer button.selected"))->click();
        	sleep(5);

        	// Twiter
        	$driver->get('https://twitter.com/?lang=en');
        	sleep(3);
        	$driver->findElement((WebDriverBy::className('js-signin-email')))->sendKeys($mailtw);
        	
        	sleep(3);
        	$driver->findElement((WebDriverBy::name('session[password]')))->sendKeys($passtw);

        	sleep(3);

        	$driver->findElement((WebDriverBy::className('EdgeButton--medium')))->click();
        	
        	sleep(2);
        	$driver->findElement((WebDriverBy::cssSelector('div[id="tweet-box-home-timeline"]')))->sendKeys(str_limit($api['data']['new'],70));
        	sleep(2);
        	$driver->findElement(WebDriverBy::xpath("//span[@class='add-tweet-button ']//following-sibling::button[contains(@class,'tweet-action')]"))->click();
        	sleep(2);
        }

    }
}
