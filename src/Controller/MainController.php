<?php namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Favorite;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function main()
    {
        $json = file_get_contents('https://newsapi.org/v2/sources?apiKey=6931d1c9f6fe45528b8d8e659003d08d');

        $content = json_decode($json,true);

        foreach($content as $key => $value)
        {
                $topics = $value;
        }
        return $this->render('home.html.twig',['topics'=>$topics]);
    }

    
    public function source($source_name,Request $request)
    {

        $source_url = "https://newsapi.org/v2/everything?apiKey=6931d1c9f6fe45528b8d8e659003d08d".'&sources='.$source_name;

        $json = file_get_contents($source_url);

        $content = json_decode($json,true);

        foreach($content as $key => $value)
        {
                    $topic = $value;
        }

        return $this->render('source.html.twig',['topics'=>$topic]);
    }
}

?>