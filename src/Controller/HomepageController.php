<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Utils\ApiConst;

class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function index(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/contact.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/website", name="website")
     */
    public function website()
    {
        return $this->render('homepage/website.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/about.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/policy", name="policy")
     */
    public function policy(\Swift_Mailer $mailer)
    {
        return $this->render('homepage/policy.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/{id}/portfolio", name="my_portfolio", methods="GET")
     */
    public function portfolio()
    {

        $TWITTER_CONSUMER_KEY = ApiConst::TWITTER_CONSUMER_KEY;
        $TWITTER_CONSUMER_SECRET=ApiConst::TWITTER_CONSUMER_SECRET;
        $TWITTER_ACCESS_TOKEN_KEY=ApiConst::TWITTER_ACCESS_TOKEN_KEY;
        $TWITTER_ACCESS_TOKEN_SECRET=ApiConst::TWITTER_ACCESS_TOKEN_SECRET;
        $twitteruser = "NoStarSunshine1";

        $connection = new TwitterOAuth($TWITTER_CONSUMER_KEY, $TWITTER_CONSUMER_SECRET, $TWITTER_ACCESS_TOKEN_KEY, $TWITTER_ACCESS_TOKEN_SECRET);
        //$content = $connection->get("account/verify_credentials");
   
        $tweets = $connection->get('statuses/user_timeline', array(
            'screen_name' => $twitteruser,
             'exclude_replies' => 'true',
              'include_rts' => 'false',
               'count' => 5));    

        return $this->render('portfolios/view.html.twig', [
            'controller_name' => 'HomepageController',
            'tweet_posts' => $tweets
        ]);
    }


    /**
     * @Route("/test", name="test")
     */
    public function portfolios()
    {

        $TWITTER_CONSUMER_KEY = ApiConst::TWITTER_CONSUMER_KEY;
        $TWITTER_CONSUMER_SECRET=ApiConst::TWITTER_CONSUMER_SECRET;
        $TWITTER_ACCESS_TOKEN_KEY=ApiConst::TWITTER_ACCESS_TOKEN_KEY;
        $TWITTER_ACCESS_TOKEN_SECRET=ApiConst::TWITTER_ACCESS_TOKEN_SECRET;
        $twitteruser = "NoStarSunshine1";

        $connection = new TwitterOAuth($TWITTER_CONSUMER_KEY, $TWITTER_CONSUMER_SECRET, $TWITTER_ACCESS_TOKEN_KEY, $TWITTER_ACCESS_TOKEN_SECRET);
        //$content = $connection->get("account/verify_credentials");
   
        $tweets = $connection->get('statuses/user_timeline', array(
            'screen_name' => $twitteruser,
             'exclude_replies' => 'true',
              'include_rts' => 'false',
               'count' => 5));    

        return $this->render('portfolios/view.html.twig', [
            'controller_name' => 'HomepageController',
            'tweet_posts' => $tweets
        ]);
    }

}